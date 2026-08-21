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

        $status = $promoCampaign->coupon
            ? 'Cupom ' . $promoCampaign->coupon->code . ' guardado. Pode comprar normalmente e usá-lo no checkout.'
            : 'Promoção desbloqueada.';

        $url = $promoCampaign->button_url ?: route('home');
        $path = parse_url($url, PHP_URL_PATH) ?: '/';
        $isAuthPage = in_array($path, ['/register', '/cadastro', '/login'], true);

        // Visitante desbloqueia o cupom e segue a comprar; login só no checkout.
        if (! $request->user() && $isAuthPage) {
            return redirect()->route('home')->with('status', $status);
        }

        if ($request->user() && in_array($path, ['/register', '/cadastro'], true)) {
            return redirect()->route('checkout.create')->with('status', $status);
        }

        return redirect()->to($url)->with('status', $status);
    }
}
