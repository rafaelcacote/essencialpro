<?php

namespace App\Rules;

use App\Services\TurnstileService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Turnstile implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $turnstile = app(TurnstileService::class);

        if (! $turnstile->isEnabled()) {
            return;
        }

        $token = is_string($value) ? $value : null;

        if (! $turnstile->verify($token, request()->ip())) {
            $fail(__('validation.turnstile'));
        }
    }
}
