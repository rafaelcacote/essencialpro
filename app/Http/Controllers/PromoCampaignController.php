<?php

namespace App\Http\Controllers;

use App\Models\PromoCampaign;
use App\Support\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PromoCampaignController extends Controller
{
    public function unlock(Request $request, PromoCampaign $promoCampaign, CouponService $coupons): RedirectResponse
    {
        abort_unless(
            $promoCampaign->is_active
                && $promoCampaign->isVisibleTo($request->user())
                && ($promoCampaign->starts_at === null || $promoCampaign->starts_at->lte(now()))
                && ($promoCampaign->ends_at === null || $promoCampaign->ends_at->gte(now())),
            404
        );

        if ($promoCampaign->coupon) {
            $coupons->remember($promoCampaign->coupon->code);
        }

        $url = $promoCampaign->button_url ?: route('register');

        if ($request->user() && in_array(parse_url($url, PHP_URL_PATH), ['/register', '/cadastro'], true)) {
            return redirect()
                ->route('checkout.create')
                ->with('status', $promoCampaign->coupon
                    ? 'Cupom ' . $promoCampaign->coupon->code . ' guardado. Aplique-o no checkout.'
                    : 'Promoção desbloqueada.');
        }

        return redirect()->to($url);
    }
}
