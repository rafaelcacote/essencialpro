<?php

namespace App\Support;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CouponService
{
    public const SESSION_KEY = 'applied_coupon_code';

    public function findByCode(?string $code): ?Coupon
    {
        $code = $this->normalizeCode($code);
        if ($code === '') {
            return null;
        }

        return Coupon::query()->where('code', $code)->first();
    }

    public function normalizeCode(?string $code): string
    {
        return strtoupper(trim((string) $code));
    }

    public function remember(?string $code): void
    {
        $code = $this->normalizeCode($code);
        if ($code === '') {
            session()->forget(self::SESSION_KEY);

            return;
        }

        session([self::SESSION_KEY => $code]);
    }

    public function forget(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function rememberedCode(): ?string
    {
        $code = $this->normalizeCode(session(self::SESSION_KEY));

        return $code !== '' ? $code : null;
    }

    /**
     * @throws ValidationException
     */
    public function assertApplicable(Coupon $coupon, float $subtotal, ?User $user = null): void
    {
        if (! $coupon->is_active) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Este cupom não está ativo.',
            ]);
        }

        $now = now();
        if ($coupon->starts_at && $now->lt($coupon->starts_at)) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Este cupom ainda não está disponível.',
            ]);
        }

        if ($coupon->ends_at && $now->gt($coupon->ends_at)) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Este cupom expirou.',
            ]);
        }

        if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Este cupom atingiu o limite de utilizações.',
            ]);
        }

        if ($coupon->min_subtotal !== null && $subtotal < (float) $coupon->min_subtotal) {
            throw ValidationException::withMessages([
                'coupon_code' => 'Subtotal mínimo para este cupom: '
                    . number_format((float) $coupon->min_subtotal, 2, ',', '.') . ' €.',
            ]);
        }

        if ($coupon->first_order_only) {
            if (! $user) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Inicie sessão para usar este cupom de primeira compra.',
                ]);
            }

            if ($user->hasCompletedPurchase()) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Este cupom é válido apenas na primeira compra.',
                ]);
            }
        }

        if ($user && $coupon->usage_limit_per_user !== null) {
            $usedByUser = Order::query()
                ->where('user_id', $user->id)
                ->where('coupon_id', $coupon->id)
                ->where(function ($q) {
                    $q->where('payment_status', 'paid')
                        ->orWhereNotNull('paid_at')
                        ->orWhereIn('status', ['paid', 'completed', 'processing']);
                })
                ->count();

            if ($usedByUser >= $coupon->usage_limit_per_user) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Já utilizou este cupom o número máximo de vezes.',
                ]);
            }
        }
    }

    public function calculateDiscount(Coupon $coupon, float $subtotal): float
    {
        $subtotal = max(0.0, round($subtotal, 2));

        if ($coupon->isPercent()) {
            $discount = round($subtotal * ((float) $coupon->value / 100), 2);
        } else {
            $discount = round((float) $coupon->value, 2);
        }

        return min($discount, $subtotal);
    }

    /**
     * @return array{coupon: ?Coupon, discount_total: float, error: ?string}
     */
    public function resolveForCheckout(float $subtotal, ?User $user = null, ?string $code = null): array
    {
        $code = $this->normalizeCode($code ?: $this->rememberedCode());
        if ($code === '') {
            return ['coupon' => null, 'discount_total' => 0.0, 'error' => null];
        }

        $coupon = $this->findByCode($code);
        if (! $coupon) {
            return ['coupon' => null, 'discount_total' => 0.0, 'error' => 'Cupom inválido.'];
        }

        try {
            $this->assertApplicable($coupon, $subtotal, $user);
        } catch (ValidationException $exception) {
            return [
                'coupon' => null,
                'discount_total' => 0.0,
                'error' => collect($exception->errors())->flatten()->first(),
            ];
        }

        return [
            'coupon' => $coupon,
            'discount_total' => $this->calculateDiscount($coupon, $subtotal),
            'error' => null,
        ];
    }
}
