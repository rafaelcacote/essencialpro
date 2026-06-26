<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\EasypayService;
use App\Support\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create(Request $request, CartService $cartService)
    {
        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product.images');
        abort_if($cart->items->isEmpty(), 422, 'Seu carrinho está vazio.');

        return view('pages.checkout', compact('cart'));
    }

    public function store(Request $request, CartService $cartService, EasypayService $easypay)
    {
        $validated = $request->validate([
            'contact_name' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:50'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'tax_id'       => ['nullable', 'string', 'max:50'],
            'address'      => ['nullable', 'string', 'max:255'],
            'postal_code'  => ['nullable', 'string', 'max:30'],
            'city'         => ['nullable', 'string', 'max:120'],
            'country'      => ['nullable', 'string', 'max:120'],
            'notes'        => ['nullable', 'string'],
        ]);

        $cart = $cartService->getOrCreateCart($request);
        $cart->load('items.product');
        abort_if($cart->items->isEmpty(), 422, 'Seu carrinho está vazio.');

        $subtotal = $cart->items->sum(function ($item) {
            return (float) ($item->product?->price ?? 0) * $item->quantity;
        });

        $order = DB::transaction(function () use ($request, $cart, $validated, $subtotal) {
            $order = Order::create([
                'order_number'  => 'PED-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -6)),
                'user_id'       => $request->user()->id,
                'cart_id'       => $cart->id,
                'contact_name'  => $validated['contact_name'],
                'email'         => $validated['email'],
                'phone'         => $validated['phone'] ?? null,
                'company_name'  => $validated['company_name'] ?? null,
                'tax_id'        => $validated['tax_id'] ?? null,
                'address'       => $validated['address'] ?? null,
                'postal_code'   => $validated['postal_code'] ?? null,
                'city'          => $validated['city'] ?? null,
                'country'       => $validated['country'] ?? null,
                'notes'         => $validated['notes'] ?? null,
                'subtotal'      => $subtotal,
                'shipping_total' => 0,
                'discount_total' => 0,
                'grand_total'   => $subtotal,
                'status'        => 'pending',
                'payment_status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                $unitPrice = (float) ($item->product?->price ?? 0);
                $order->items()->create([
                    'product_id'    => $item->product_id,
                    'product_title' => $item->product?->title ?? 'Produto removido',
                    'product_code'  => $item->product?->code,
                    'selected_color' => $item->selected_color,
                    'selected_size'  => $item->selected_size,
                    'unit_price'    => $unitPrice,
                    'quantity'      => $item->quantity,
                    'line_total'    => $unitPrice * $item->quantity,
                ]);
            }

            $cart->update(['status' => 'converted']);
            $cart->items()->delete();

            return $order;
        });

        // Redirecionar para o checkout do easypay
        $checkout = $easypay->createCheckout($order);

        if ($checkout && isset($checkout['url'])) {
            $order->update(['easypay_checkout_id' => $checkout['id'] ?? null]);
            return redirect()->away($checkout['url']);
        }

        // Se a chamada ao easypay falhar, mostrar erro sem perder o pedido
        return redirect()->route('checkout.payment.failure', $order)
            ->with('error', 'Não foi possível iniciar o pagamento. Por favor, tente novamente ou entre em contacto connosco.');
    }

    public function paymentReturn(Order $order)
    {
        abort_unless(Auth::id() === $order->user_id, 403);
        $order->load('items.product');

        // O status definitivo vem pelo webhook; aqui mostramos página de aguarda confirmação
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
}
