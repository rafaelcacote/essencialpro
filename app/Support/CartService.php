<?php

namespace App\Support;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class CartService
{
    public function getOrCreateCart(Request $request): Cart
    {
        $sessionId = $request->session()->getId();
        $user = $request->user();

        $query = Cart::query()->where('status', 'active');
        if ($user) {
            $query->where('user_id', $user->id);
        } else {
            $query->where('session_id', $sessionId);
        }

        $cart = $query->latest('id')->first();
        if ($cart) {
            return $cart;
        }

        return Cart::create([
            'user_id' => $user?->id,
            'session_id' => $sessionId,
            'status' => 'active',
        ]);
    }

    public function mergeGuestCartIntoUser(Request $request, ?Authenticatable $user): void
    {
        if (!$user) {
            return;
        }

        $sessionId = $request->session()->getId();
        $guestCart = Cart::query()
            ->where('status', 'active')
            ->whereNull('user_id')
            ->where('session_id', $sessionId)
            ->latest('id')
            ->first();

        if (!$guestCart) {
            return;
        }

        $userCart = Cart::query()
            ->where('status', 'active')
            ->where('user_id', $user->id)
            ->latest('id')
            ->first();

        if (!$userCart) {
            $guestCart->update(['user_id' => $user->id]);
            return;
        }

        foreach ($guestCart->items as $item) {
            $existing = CartItem::query()
                ->where('cart_id', $userCart->id)
                ->where('product_id', $item->product_id)
                ->where('selected_color', $item->selected_color)
                ->where('selected_size', $item->selected_size)
                ->first();

            if ($existing) {
                $existing->increment('quantity', $item->quantity);
                continue;
            }

            $item->cart_id = $userCart->id;
            $item->save();
        }

        $guestCart->delete();
    }

    public function addItem(Cart $cart, Product $product, int $quantity, ?string $color = null, ?string $size = null): void
    {
        $existing = CartItem::query()
            ->where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('selected_color', $color)
            ->where('selected_size', $size)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $quantity);
            return;
        }

        $cart->items()->create([
            'product_id' => $product->id,
            'selected_color' => $color,
            'selected_size' => $size,
            'quantity' => $quantity,
        ]);
    }
}
