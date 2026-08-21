<?php

namespace App\Http\Controllers;

use App\Support\CartService;
use App\Support\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutCouponController extends Controller
{
    public function apply(Request $request, CartService $cartService, CouponService $coupons): RedirectResponse
    {
        $validated = $request->validate([
            'coupon_code' => ['required', 'string', 'max:50'],
        ]);

        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product');
        $subtotal = (float) $cart->items->sum(fn ($item) => (float) ($item->product?->price ?? 0) * (int) $item->quantity);

        $coupon = $coupons->findByCode($validated['coupon_code']);
        if (! $coupon) {
            return back()->withErrors(['coupon_code' => 'Cupom inválido.'])->withInput();
        }

        $coupons->assertApplicable($coupon, $subtotal, $request->user());
        $coupons->remember($coupon->code);

        return back()->with('status', 'Cupom ' . $coupon->code . ' aplicado.');
    }

    public function remove(CouponService $coupons): RedirectResponse
    {
        $coupons->forget();

        return back()->with('status', 'Cupom removido.');
    }
}
