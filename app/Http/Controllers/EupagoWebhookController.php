<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EupagoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $secret = config('eupago.webhook_secret');

        if (blank($secret)) {
            Log::critical('EuPago webhook rejected: EUPAGO_WEBHOOK_SECRET is not configured.');

            return response()->json(['message' => 'Webhook not configured.'], 503);
        }

        $rawPayload = $request->getContent();
        $signature = (string) $request->header('X-Signature');
        $expected = base64_encode(hash_hmac('sha256', $rawPayload, $secret, true));

        if (blank($signature) || ! hash_equals($expected, $signature)) {
            Log::warning('EuPago webhook rejected: invalid signature.');

            return response()->json(['message' => 'Invalid signature.'], 401);
        }

        $payload = $request->validate([
            'transactions' => ['required', 'array'],
            'transactions.identifier' => ['required', 'string'],
            'transactions.status' => ['required', 'string'],
            'transactions.trid' => ['nullable'],
            'transactions.reference' => ['nullable'],
            'transactions.method' => ['nullable', 'string'],
            'transactions.amount.value' => ['nullable', 'numeric'],
        ]);
        $transaction = $payload['transactions'];
        $order = Order::where('order_number', $transaction['identifier'])->first();

        if (! $order) {
            Log::warning('EuPago webhook: order not found.', ['identifier' => $transaction['identifier']]);

            return response()->json(['message' => 'Order not found.'], 404);
        }

        if (isset($transaction['amount']['value'])
            && round((float) $transaction['amount']['value'], 2) !== round((float) $order->grand_total, 2)) {
            Log::warning('EuPago webhook: amount mismatch.', ['order' => $order->order_number]);

            return response()->json(['message' => 'Amount mismatch.'], 422);
        }

        $status = strtolower($transaction['status']);
        $updates = [
            'payment_id' => (string) ($transaction['trid'] ?? $order->payment_id),
            'eupago_reference' => (string) ($transaction['reference'] ?? $order->eupago_reference),
            'payment_method' => $this->paymentMethod($transaction['method'] ?? null, $order->payment_method),
        ];

        if ($status === 'paid') {
            $updates += [
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'paid_at' => now(),
            ];
        } elseif (in_array($status, ['error', 'canceled', 'expired'], true)) {
            $updates['payment_status'] = $status === 'expired' ? 'expired' : 'failed';
        } else {
            return response()->json(['message' => 'Unhandled transaction status.'], 422);
        }

        $order->update($updates);

        return response()->json(['status' => 'ok']);
    }

    private function paymentMethod(?string $method, ?string $fallback): ?string
    {
        return match (strtolower((string) $method)) {
            'multibanco' => 'multibanco',
            'mbway' => 'mbway',
            'creditcard' => 'credit_card',
            default => $fallback,
        };
    }
}
