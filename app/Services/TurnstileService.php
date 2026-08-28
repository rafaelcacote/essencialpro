<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileService
{
    public function isEnabled(): bool
    {
        return filled(config('services.turnstile.site_key'))
            && filled(config('services.turnstile.secret_key'));
    }

    public function verify(?string $token, ?string $ip = null): bool
    {
        if (! $this->isEnabled()) {
            return true;
        }

        if (blank($token)) {
            return false;
        }

        $response = Http::asForm()
            ->acceptJson()
            ->timeout(10)
            ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', array_filter([
                'secret' => config('services.turnstile.secret_key'),
                'response' => $token,
                'remoteip' => $ip,
            ]));

        if (! $response->successful()) {
            Log::warning('A verificação do Turnstile falhou ao contactar a Cloudflare.', [
                'status' => $response->status(),
            ]);

            return false;
        }

        return (bool) $response->json('success');
    }
}
