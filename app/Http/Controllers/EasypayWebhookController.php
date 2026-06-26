<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EasypayWebhookController extends Controller
{
    /**
     * Recebe notificações de pagamento do easypay.
     * O easypay faz POST nesta rota após cada evento de pagamento.
     */
    public function handle(Request $request)
    {
        $payload = $request->all();

        Log::info('Easypay webhook recebido', $payload);

        // O easypay envia o transaction_key que corresponde ao nosso order_number
        $transactionKey = $payload['key'] ?? $payload['transaction']['key'] ?? null;

        if (! $transactionKey) {
            Log::warning('Easypay webhook sem transaction_key', $payload);
            return response()->json(['status' => 'error', 'message' => 'missing key'], 400);
        }

        $order = Order::where('order_number', $transactionKey)->first();

        if (! $order) {
            Log::warning('Easypay webhook: pedido não encontrado', ['key' => $transactionKey]);
            return response()->json(['status' => 'error', 'message' => 'order not found'], 404);
        }

        $type   = $payload['type'] ?? '';
        $status = $payload['status'] ?? '';

        match (true) {
            // Pagamento confirmado
            $type === 'capture' && $status === 'ok' => $this->markPaid($order, $payload),

            // Pagamento autorizado mas ainda não capturado (cartão)
            $type === 'authorisation' && $status === 'ok' => $this->markAuthorised($order, $payload),

            // Pagamento falhado ou recusado
            in_array($status, ['err', 'failed', 'declined']) => $this->markFailed($order, $payload),

            default => Log::info('Easypay webhook: evento ignorado', [
                'order' => $transactionKey,
                'type'  => $type,
                'status' => $status,
            ]),
        };

        return response()->json(['status' => 'ok']);
    }

    private function markPaid(Order $order, array $payload): void
    {
        $order->update([
            'status'         => 'confirmed',
            'payment_status' => 'paid',
            'payment_id'     => $payload['id'] ?? $payload['transaction']['id'] ?? null,
            'payment_method' => strtolower($payload['transaction']['method'] ?? ''),
            'paid_at'        => now(),
        ]);

        Log::info('Easypay: pedido pago', ['order' => $order->order_number]);
    }

    private function markAuthorised(Order $order, array $payload): void
    {
        $order->update([
            'payment_status' => 'authorised',
            'payment_id'     => $payload['id'] ?? null,
            'payment_method' => strtolower($payload['transaction']['method'] ?? ''),
        ]);

        Log::info('Easypay: pagamento autorizado (pendente captura)', ['order' => $order->order_number]);
    }

    private function markFailed(Order $order, array $payload): void
    {
        $order->update([
            'payment_status' => 'failed',
        ]);

        Log::warning('Easypay: pagamento falhado', [
            'order'   => $order->order_number,
            'payload' => $payload,
        ]);
    }
}
