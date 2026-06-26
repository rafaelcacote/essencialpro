<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EasypayService
{
    private string $baseUrl;
    private string $accountId;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl   = rtrim(config('easypay.base_url'), '/');
        $this->accountId = config('easypay.account_id');
        $this->apiKey    = config('easypay.api_key');
    }

    /**
     * Cria uma sessão de checkout no easypay e devolve a URL de redirecionamento.
     * Retorna null em caso de falha.
     */
    public function createCheckout(Order $order): ?array
    {
        $payload = [
            'type' => 'sale',
            'payment' => [
                'methods'  => config('easypay.methods', ['cc', 'mb', 'mbw']),
                'capture'  => [
                    'transaction_key' => $order->order_number,
                    'descriptive'     => config('app.name') . ' — Pedido ' . $order->order_number,
                    'value'           => round((float) $order->grand_total, 2),
                    'currency'        => 'EUR',
                ],
            ],
            'customer' => [
                'name'          => $order->contact_name,
                'email'         => $order->email,
                'phone'         => $order->phone ?? '',
                'fiscal_number' => $order->tax_id ?? '',
            ],
            'return_url'       => route('checkout.payment.return', $order),
            'cancel_url'       => route('checkout.payment.cancel', $order),
            'notification_url' => route('webhook.easypay'),
        ];

        try {
            $response = $this->http()->post('/checkout', $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Easypay checkout error', [
                'order'  => $order->order_number,
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return null;
        } catch (\Throwable $e) {
            Log::error('Easypay checkout exception', [
                'order'   => $order->order_number,
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function http(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'AccountId'    => $this->accountId,
                'ApiKey'       => $this->apiKey,
                'Content-Type' => 'application/json',
            ])
            ->acceptJson()
            ->timeout(15);
    }
}
