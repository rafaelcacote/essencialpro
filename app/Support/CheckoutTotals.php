<?php

namespace App\Support;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Collection;

class CheckoutTotals
{
    /**
     * @param  Cart|Collection<int, mixed>  $cartOrItems
     * @return array{
     *     subtotal: float,
     *     shipping_total: float,
     *     discount_total: float,
     *     tax_total: float,
     *     taxable: float,
     *     grand_total: float,
     *     tax_rate: float,
     *     free_shipping_threshold: float,
     *     remaining_for_free_shipping: float,
     *     has_free_shipping: bool,
     *     item_count: int,
     *     coupon: ?Coupon,
     *     coupon_error: ?string
     * }
     */
    public static function fromCart(
        Cart|Collection $cartOrItems,
        ?User $user = null,
        ?string $couponCode = null
    ): array {
        $items = $cartOrItems instanceof Cart
            ? $cartOrItems->items
            : $cartOrItems;

        $subtotal = $items->sum(function ($item) {
            return (float) ($item->product?->price ?? 0) * (int) $item->quantity;
        });

        $itemCount = (int) $items->sum(fn ($item) => (int) $item->quantity);

        return self::fromSubtotal((float) $subtotal, $itemCount, $user, $couponCode);
    }

    /**
     * @return array{
     *     subtotal: float,
     *     shipping_total: float,
     *     discount_total: float,
     *     tax_total: float,
     *     taxable: float,
     *     grand_total: float,
     *     tax_rate: float,
     *     free_shipping_threshold: float,
     *     remaining_for_free_shipping: float,
     *     has_free_shipping: bool,
     *     item_count: int,
     *     coupon: ?Coupon,
     *     coupon_error: ?string
     * }
     */
    public static function fromSubtotal(
        float $subtotal,
        int $itemCount = 0,
        ?User $user = null,
        ?string $couponCode = null
    ): array {
        $threshold = (float) config('checkout.free_shipping_threshold');
        $shippingFee = (float) config('checkout.shipping_fee');
        $taxRate = (float) config('checkout.tax_rate');

        $subtotal = round($subtotal, 2);
        $shippingTotal = $subtotal >= $threshold ? 0.0 : round($shippingFee, 2);

        $resolved = app(CouponService::class)->resolveForCheckout($subtotal, $user, $couponCode);
        $discountTotal = round((float) $resolved['discount_total'], 2);

        $taxable = round(max(0, $subtotal - $discountTotal), 2);
        $taxTotal = round($taxable * $taxRate, 2);
        $grandTotal = round($taxable + $taxTotal + $shippingTotal, 2);

        return [
            'subtotal' => $subtotal,
            'shipping_total' => $shippingTotal,
            'discount_total' => $discountTotal,
            'tax_total' => $taxTotal,
            'taxable' => $taxable,
            'grand_total' => $grandTotal,
            'tax_rate' => $taxRate,
            'free_shipping_threshold' => $threshold,
            'remaining_for_free_shipping' => max(0.0, round($threshold - $subtotal, 2)),
            'has_free_shipping' => $shippingTotal <= 0.0,
            'item_count' => $itemCount,
            'coupon' => $resolved['coupon'],
            'coupon_error' => $resolved['error'],
        ];
    }
}
