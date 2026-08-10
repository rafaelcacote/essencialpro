<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\EupagoService;
use App\Support\CartService;
use App\Support\CheckoutTotals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function create(Request $request, CartService $cartService)
    {
        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product.images');
        abort_if($cart->items->isEmpty(), 422, 'Seu carrinho está vazio.');

        $totals = CheckoutTotals::fromCart($cart);

        return view('pages.checkout', compact('cart', 'totals'));
    }

    public function store(Request $request, CartService $cartService, EupagoService $eupago)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => [
                Rule::requiredIf($request->input('payment_method') === 'mbway'),
                'nullable',
                'string',
                'regex:/^(?:\+351)?9\d{8}$/',
            ],
            'tax_id' => ['nullable', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:120'],
            'postal_code' => ['required', 'string', 'max:30'],
            'district' => ['required', 'string', 'max:120'],
            'municipality' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:30'],
            'floor' => ['nullable', 'string', 'max:60'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'payment_method' => ['required', Rule::in(['multibanco', 'mbway', 'credit_card'])],
        ], [
            'phone.regex' => 'Indique um telemóvel português válido (9 dígitos, com ou sem +351).',
        ]);

        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product');
        abort_if($cart->items->isEmpty(), 422, 'Seu carrinho está vazio.');

        $totals = CheckoutTotals::fromCart($cart);
        $contactName = trim($validated['first_name'] . ' ' . $validated['last_name']);
        $address = $this->formatAddress($validated);

        $order = DB::transaction(function () use ($request, $cart, $validated, $totals, $contactName, $address) {
            $order = Order::create([
                'order_number' => 'PED-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6)),
                'user_id' => $request->user()->id,
                'cart_id' => $cart->id,
                'contact_name' => $contactName,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'company_name' => null,
                'tax_id' => $validated['tax_id'] ?? null,
                'address' => $address,
                'postal_code' => $validated['postal_code'],
                'city' => $validated['city'],
                'country' => $validated['country'],
                'notes' => $validated['notes'] ?? null,
                'subtotal' => $totals['subtotal'],
                'shipping_total' => $totals['shipping_total'],
                'discount_total' => $totals['discount_total'],
                'tax_total' => $totals['tax_total'],
                'grand_total' => $totals['grand_total'],
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
            ]);

            foreach ($cart->items as $item) {
                $unitPrice = (float) ($item->product?->price ?? 0);
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_title' => $item->product?->title ?? 'Produto removido',
                    'product_code' => $item->product?->code,
                    'selected_color' => $item->selected_color,
                    'selected_size' => $item->selected_size,
                    'unit_price' => $unitPrice,
                    'quantity' => $item->quantity,
                    'line_total' => $unitPrice * $item->quantity,
                ]);
            }

            return $order;
        });

        try {
            $payment = $eupago->createPayment($order, $validated['payment_method']);

            DB::transaction(function () use ($cart, $order, $payment) {
                $order->update([
                    'payment_id' => $payment['transaction_id'] ?: null,
                    'eupago_reference' => $payment['reference'] ?: null,
                    'eupago_entity' => $payment['entity'] ?? null,
                    'payment_expires_at' => $payment['expires_at'] ?? null,
                ]);
                $cart->update(['status' => 'converted']);
                $cart->items()->delete();
            });

            if (filled($payment['redirect_url'] ?? null)) {
                return redirect()->away($payment['redirect_url']);
            }

            return redirect()->route('checkout.success', $order);
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Não foi possível iniciar o pagamento. Verifique os dados e tente novamente.');
        }
    }

    public function paymentReturn(Order $order)
    {
        abort_unless(Auth::id() === $order->user_id, 403);
        $order->load('items.product');

        return view('pages.checkout-success', compact('order'));
    }

    public function paymentFailure(Order $order)
    {
        abort_unless(Auth::id() === $order->user_id, 403);

        return view('pages.checkout-failure', compact('order'));
    }

    public function paymentCancel(Order $order)
    {
        abort_unless(Auth::id() === $order->user_id, 403);

        return view('pages.checkout-cancel', compact('order'));
    }

    public function success(Order $order)
    {
        abort_unless(Auth::id() === $order->user_id, 403);
        $order->load('items.product');

        return view('pages.checkout-success', compact('order'));
    }

    /**
     * @param  array<string, mixed>  $validated
     */
    private function formatAddress(array $validated): string
    {
        $streetLine = trim(sprintf(
            '%s, Nº %s%s',
            $validated['street'],
            $validated['number'],
            filled($validated['floor'] ?? null) ? ', ' . $validated['floor'] : ''
        ));

        $locationLine = trim(sprintf(
            '%s, %s',
            $validated['municipality'],
            $validated['district']
        ));

        return $streetLine . "\n" . $locationLine;
    }
}
