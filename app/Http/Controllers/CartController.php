<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Support\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request, CartService $cartService)
    {
        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product.images');

        return view('pages.cart', compact('cart'));
    }

    public function store(Request $request, CartService $cartService)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'selected_color' => ['nullable', 'string', 'max:100'],
            'selected_size' => ['nullable', 'string', 'max:100'],
        ]);

        $product = Product::query()->where('is_active', true)->findOrFail($validated['product_id']);
        $cart = $cartService->getOrCreateCart($request);
        $cartService->addItem(
            $cart,
            $product,
            (int) ($validated['quantity'] ?? 1),
            $validated['selected_color'] ?? null,
            $validated['selected_size'] ?? null
        );

        return back()->with('status', 'Produto adicionado ao carrinho.');
    }

    public function update(Request $request, CartItem $item)
    {
        $cart = $item->cart()->firstOrFail();
        if (!$this->canAccessCart($request, $cart->user_id, $cart->session_id)) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);

        $item->update(['quantity' => (int) $validated['quantity']]);
        return back()->with('status', 'Quantidade atualizada.');
    }

    public function destroy(Request $request, CartItem $item)
    {
        $cart = $item->cart()->firstOrFail();
        if (!$this->canAccessCart($request, $cart->user_id, $cart->session_id)) {
            abort(403);
        }

        $item->delete();
        return back()->with('status', 'Item removido do carrinho.');
    }

    public function clear(Request $request, CartService $cartService)
    {
        $cart = $cartService->getOrCreateCart($request);
        $cart->items()->delete();

        return back()->with('status', 'Carrinho limpo com sucesso.');
    }

    private function canAccessCart(Request $request, ?int $userId, ?string $sessionId): bool
    {
        if ($request->user()) {
            return $request->user()->id === $userId;
        }

        return $request->session()->getId() === $sessionId;
    }
}
