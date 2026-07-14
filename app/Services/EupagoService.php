<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class EupagoService
{
    public function createPayment(Order $order, string $method): array
    {
        if (blank(config('eupago.api_key'))) {
            throw new RuntimeException('A chave da API EuPago não está configurada.');
        }

        return match ($method) {
            'multibanco' => $this->createMultibancoReference($order),
            'mbway' => $this->createMbwayPayment($order),
            'credit_card' => $this->createCreditCardPayment($order),
            default => throw new RuntimeException('Método de pagamento inválido.'),
        };
    }

    private function createMultibancoReference(Order $order): array
    {
        $response = Http::baseUrl(rtrim(config('eupago.base_url'), '/') . '/clientes/rest_api')
            ->acceptJson()
            ->timeout(15)
            ->post('/multibanco/create', [
                'chave' => config('eupago.api_key'),
                'valor' => round((float) $order->grand_total, 2),
                'id' => $order->order_number,
                'per_dup' => 0,
            ]);

        $payload = $response->json() ?? [];

        if (! $response->successful() || ! ($payload['sucesso'] ?? false)) {
            $this->logFailure('Multibanco', $order, $response->status(), $payload);
            throw new RuntimeException('Não foi possível gerar a referência Multibanco.');
        }

        return [
            'transaction_id' => (string) ($payload['transacao'] ?? ''),
            'reference' => (string) ($payload['referencia'] ?? ''),
            'entity' => (string) ($payload['entidade'] ?? ''),
            'expires_at' => $payload['data_fim'] ?? null,
        ];
    }

    private function createMbwayPayment(Order $order): array
    {
        $phone = preg_replace('/\D+/', '', (string) $order->phone);
        $countryCode = str_starts_with($phone, '351') ? '+351' : '+351';
        $phone = str_starts_with($phone, '351') ? substr($phone, 3) : $phone;

        $response = $this->api()->post('/api/v1.02/mbway/create', [
            'payment' => [
                'identifier' => $order->order_number,
                'amount' => [
                    'value' => round((float) $order->grand_total, 2),
                    'currency' => config('eupago.currency'),
                ],
                'customerPhone' => $phone,
                'countryCode' => $countryCode,
                'successUrl' => route('checkout.payment.return', $order),
                'failUrl' => route('checkout.payment.failure', $order),
                'backUrl' => route('checkout.payment.cancel', $order),
                'lang' => 'PT',
            ],
            'customer' => [
                'notify' => true,
                'name' => $order->contact_name,
                'email' => $order->email,
            ],
        ]);

        return $this->parseApiKeyResponse('MB WAY', $order, $response->status(), $response->json() ?? []);
    }

    private function createCreditCardPayment(Order $order): array
    {
        $response = $this->api()->post('/api/v1.02/creditcard/create', [
            'payment' => [
                'identifier' => $order->order_number,
                'amount' => [
                    'value' => round((float) $order->grand_total, 2),
                    'currency' => config('eupago.currency'),
                ],
                'successUrl' => route('checkout.payment.return', $order),
                'failUrl' => route('checkout.payment.failure', $order),
                'backUrl' => route('checkout.payment.cancel', $order),
                'lang' => 'PT',
            ],
            'customer' => [
                'notify' => true,
                'email' => $order->email,
            ],
        ]);

        return $this->parseApiKeyResponse('Cartão', $order, $response->status(), $response->json() ?? []);
    }

    private function parseApiKeyResponse(string $method, Order $order, int $status, array $payload): array
    {
        if ($status < 200 || $status >= 300 || ($payload['transactionStatus'] ?? '') !== 'Success') {
            $this->logFailure($method, $order, $status, $payload);
            throw new RuntimeException("Não foi possível iniciar o pagamento por {$method}.");
        }

        return [
            'transaction_id' => (string) ($payload['transactionID'] ?? ''),
            'reference' => (string) ($payload['reference'] ?? ''),
            'redirect_url' => $payload['redirectUrl'] ?? null,
        ];
    }

    private function api()
    {
        return Http::baseUrl(rtrim(config('eupago.base_url'), '/'))
            ->withToken(config('eupago.api_key'), 'ApiKey')
            ->acceptJson()
            ->timeout(15);
    }

    private function logFailure(string $method, Order $order, int $status, array $payload): void
    {
        Log::error("EuPago {$method} error", [
            'order' => $order->order_number,
            'status' => $status,
            'response' => $payload,
        ]);
    }
}
