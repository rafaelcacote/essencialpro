<?php

namespace App\Http\Controllers;

use App\Models\PromoCampaign;
use App\Support\CouponService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PromoCampaignController extends Controller
{
    public const PENDING_NOTICE_KEY = 'promo_coupon_pending_notice';

    /** Kept until the notice modal is rendered (survives verified-middleware redirects). */
    public const NOTICE_KEY = 'promo_coupon_notice';

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

        $notice = $promoCampaign->coupon
            ? 'Cupom '.$promoCampaign->coupon->code.' guardado. Aplique-o no checkout.'
            : 'Promoção desbloqueada.';

        $url = $promoCampaign->button_url ?: route('register');
        $path = parse_url($url, PHP_URL_PATH) ?: '/';

        if ($request->user()) {
            $request->session()->put(self::NOTICE_KEY, $notice);

            // Checkout exige e-mail verificado — evita erro/redirect forçado.
            if (! $request->user()->hasVerifiedEmail()) {
                return redirect()->route('home');
            }

            if (in_array($path, ['/register', '/cadastro'], true)) {
                return redirect()->route('checkout.create');
            }

            return redirect()->to($url);
        }

        // Convidado: guarda o cupom e adia a mensagem até depois do login/cadastro.
        $request->session()->put(self::PENDING_NOTICE_KEY, $notice);

        return redirect()->to($url);
    }

    public static function promotePendingNotice(Request $request): void
    {
        $notice = $request->session()->pull(self::PENDING_NOTICE_KEY);

        if (is_string($notice) && $notice !== '') {
            $request->session()->put(self::NOTICE_KEY, $notice);
        }
    }
}
