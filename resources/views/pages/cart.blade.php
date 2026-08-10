@extends('layouts.app')

@section('title', 'Carrinho - Essencial Pro')

@push('styles')
<style>
    .cart-page { background: #fafbfc; }
    .cart-note, .cart-card, .cart-summary, .cart-shipping, .cart-trust {
        background: #fff; border: 1px solid #e7ebf0; border-radius: 8px; box-shadow: 0 2px 12px rgba(12,29,58,.04);
    }
    .cart-note { display:flex; gap:.85rem; margin-bottom:1.5rem; padding:1rem 1.15rem; border-left:5px solid var(--primary); background:#fffaf5; }
    .cart-note i, .cart-shipping h2 i, .cart-trust i { color:var(--primary); font-size:1.2rem; }
    .cart-note strong { display:block; color:var(--primary); font-size:.85rem; margin-bottom:.2rem; }
    .cart-note p { margin:0; color:#3c4b60; font-size:.8rem; line-height:1.5; }
    .cart-head, .cart-item { display:grid; grid-template-columns:minmax(270px,2.1fr) minmax(120px,1fr) 116px 105px; gap:1rem; align-items:center; }
    .cart-head { padding:1rem 1.2rem; border-bottom:1px solid #e9edf2; color:#627087; font-size:.7rem; font-weight:700; letter-spacing:.02em; text-transform:uppercase; }
    .cart-item { padding:1.2rem; border-bottom:1px solid #edf0f3; }
    .cart-product { display:flex; align-items:center; gap:1rem; min-width:0; }
    .cart-product-image { width:74px; height:74px; flex:0 0 74px; border:1px solid #edf0f3; border-radius:5px; overflow:hidden; }
    .cart-product-image img { width:100%; height:100%; object-fit:contain; }
    .cart-product a:not(.cart-product-image) { color:#1c2a40; font-size:.88rem; font-weight:700; line-height:1.35; text-decoration:none; }
    .cart-product a:not(.cart-product-image):hover { color:var(--primary); }
    .cart-ref, .cart-variation { color:#6c798c; font-size:.76rem; line-height:1.55; }
    .cart-ref { margin-top:.3rem; } .cart-variation strong { color:#334157; }
    .cart-qty { display:inline-flex; height:36px; border:1px solid #dde3eb; border-radius:4px; overflow:hidden; }
    .cart-qty button { width:34px; border:0; background:#fff; color:#36455a; font-size:1.1rem; }
    .cart-qty button:hover { background:#fff3ea; color:var(--primary); }
    .cart-qty input { width:34px; border:0; border-right:1px solid #edf0f3; border-left:1px solid #edf0f3; text-align:center; font-size:.82rem; font-weight:700; appearance:textfield; -moz-appearance:textfield; }
    .cart-qty input::-webkit-inner-spin-button { -webkit-appearance:none; }
    .cart-remove { border:0; padding:0; background:none; color:#ce6b38; font-size:.73rem; font-weight:600; }
    .cart-remove:hover { color:var(--primary); }
    .cart-price { color:#1d2b41; font-size:.88rem; font-weight:700; text-align:right; white-space:nowrap; }
    .cart-price small { display:block; color:#7c899a; font-size:.66rem; font-weight:500; }
    .cart-footer { padding:1.1rem 1.2rem; }
    .cart-continue { display:inline-flex; gap:.5rem; align-items:center; border:1px solid #ccd4df; border-radius:4px; padding:.65rem 1rem; color:#2b3a50; font-size:.8rem; font-weight:600; text-decoration:none; }
    .cart-continue:hover { border-color:var(--primary); color:var(--primary); }
    .cart-sticky { position:sticky; top:1.5rem; }
    .cart-summary, .cart-shipping { padding:1.3rem; }
    .cart-summary h2, .cart-shipping h2 { color:#1d2b41; font-size:1rem; font-weight:700; margin:0 0 1.1rem; }
    .cart-row { display:flex; justify-content:space-between; gap:1rem; color:#526075; font-size:.84rem; margin-bottom:.85rem; }
    .cart-row strong { color:#1d2b41; } .cart-row--shipping strong { color:#c86a2d; font-size:.75rem; text-transform:uppercase; }
    .cart-total { display:flex; justify-content:space-between; align-items:end; border-top:1px solid #e7ebf0; margin-top:1.1rem; padding-top:1.1rem; }
    .cart-total span { color:#1e2c42; font-size:.9rem; font-weight:700; }
    .cart-total strong { color:var(--primary); font-size:1.5rem; line-height:1; }
    .cart-total small { display:block; color:#778498; font-size:.65rem; text-align:right; }
    .cart-checkout { display:flex; justify-content:center; align-items:center; gap:.55rem; width:100%; margin-top:1.4rem; border-radius:4px; padding:.9rem; background:var(--primary); color:#fff; font-size:.88rem; font-weight:700; text-decoration:none; }
    .cart-checkout:hover { color:#fff; filter:brightness(.94); }
    .cart-secure { color:#738096; font-size:.7rem; text-align:center; margin: .8rem 0 0; } .cart-secure i { color:var(--primary); }
    .cart-shipping { margin-top:1rem; } .cart-shipping h2 { display:flex; gap:.55rem; align-items:center; }
    .cart-shipping-line { display:flex; justify-content:space-between; color:#536176; font-size:.78rem; margin-bottom:.6rem; } .cart-shipping-line strong { color:#28374c; }
    .cart-promo { display:flex; gap:.6rem; margin-top:1rem; padding:.75rem; border-radius:5px; background:#fff1e5; color:#765238; font-size:.71rem; line-height:1.45; } .cart-promo i { color:#de9524; }
    .cart-free { display:flex; align-items:center; gap:.75rem; margin-top:1.5rem; padding:1rem 1.2rem; border:1px solid #f0e4db; border-radius:7px; background:#fffdfb; color:#3d4b5e; font-size:.78rem; } .cart-free i { color:var(--primary); font-size:1.25rem; }
    .cart-trust { display:grid; grid-template-columns:repeat(3,1fr); margin-top:1.5rem; } .cart-trust div { display:flex; align-items:center; gap:.8rem; padding:1.1rem 1.4rem; } .cart-trust div + div { border-left:1px solid #edf0f3; } .cart-trust i { font-size:1.6rem; }
    .cart-trust strong, .cart-trust span { display:block; } .cart-trust strong { color:#26354a; font-size:.8rem; } .cart-trust span { color:#718096; font-size:.7rem; line-height:1.4; }
    .cart-empty { max-width:600px; margin:0 auto; padding:4rem 1.5rem; text-align:center; } .cart-empty i { display:inline-flex; justify-content:center; align-items:center; width:72px; height:72px; border-radius:50%; background:#fff1e8; color:var(--primary); font-size:1.8rem; } .cart-empty h2 { color:#1d2b41; font-size:1.35rem; font-weight:700; margin-top:1.2rem; } .cart-empty p { color:#718096; margin:.75rem 0 1.5rem; }
    @media (max-width:991.98px) { .cart-sticky { position:static; } }
    @media (max-width:767.98px) { .cart-head { display:none; } .cart-item { grid-template-columns:1fr auto; gap:.8rem; } .cart-product { grid-column:1/-1; } .cart-variation { grid-column:1; } .cart-price { grid-column:2; grid-row:2/span 2; } .cart-trust { grid-template-columns:1fr; } .cart-trust div + div { border-top:1px solid #edf0f3; border-left:0; } }
</style>
@endpush

@section('content')
    @include('components.page-header', ['title' => 'Carrinho de Compras'])

    <div class="cart-page py-5">
        <div class="container">
            @if ($cart->items->isEmpty())
                <div class="cart-empty">
                    <i class="bi bi-cart3"></i>
                    <h2>O seu carrinho está vazio</h2>
                    <p>Descubra os nossos equipamentos de proteção e vestuário profissional.</p>
                    <a href="{{ route('product') }}" class="cart-continue"><i class="bi bi-arrow-left"></i> Continuar a comprar</a>
                </div>
            @else
                @php
                    $totals = \App\Support\CheckoutTotals::fromCart($cart);
                    $subtotal = $totals['subtotal'];
                    $remainingForFreeShipping = $totals['remaining_for_free_shipping'];
                    $freeShippingThreshold = $totals['free_shipping_threshold'];
                @endphp
                <div class="cart-note">
                    <i class="bi bi-info-circle-fill"></i>
                    <div><strong>Informação de entrega</strong><p>Após a confirmação do pagamento, iniciamos a preparação da sua encomenda. O prazo estimado para Portugal Continental é de 7 a 10 dias úteis.</p></div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-8">
                        <section class="cart-card">
                            <div class="cart-head"><span>Produto</span><span>Cor / Tamanho</span><span>Quantidade</span><span class="text-end">Subtotal</span></div>
                            @foreach ($cart->items as $item)
                                @php
                                    $unitPrice = (float) ($item->product?->price ?? 0);
                                    $image = $item->product?->images->first();
                                @endphp
                                <article class="cart-item">
                                    <div class="cart-product">
                                        <a href="{{ $item->product ? route('products.show', $item->product) : '#' }}" class="cart-product-image"><img src="{{ $image ? asset($image->path) : asset('img/service-1.jpg') }}" alt="{{ $item->product?->title ?? 'Produto indisponível' }}"></a>
                                        <div>
                                            @if ($item->product)<a href="{{ route('products.show', $item->product) }}">{{ $item->product->title }}</a>@else<span>Produto indisponível</span>@endif
                                            @if ($item->product?->code)<div class="cart-ref">Ref: {{ $item->product->code }}</div>@endif
                                        </div>
                                    </div>
                                    <div class="cart-variation">Cor: <strong>{{ $item->selected_color ?: '—' }}</strong><br>Tamanho: <strong>{{ $item->selected_size ?: '—' }}</strong></div>
                                    <div>
                                        <form method="POST" action="{{ route('cart.items.update', $item) }}" class="m-0">
                                            @csrf @method('PATCH')
                                            <div class="cart-qty">
                                                <button type="button" class="js-cart-quantity" data-change="-1" aria-label="Diminuir quantidade">−</button>
                                                <input type="number" min="1" max="1000" name="quantity" value="{{ $item->quantity }}" aria-label="Quantidade">
                                                <button type="button" class="js-cart-quantity" data-change="1" aria-label="Aumentar quantidade">+</button>
                                            </div>
                                        </form>
                                        <form method="POST" action="{{ route('cart.items.destroy', $item) }}" class="mt-2">@csrf @method('DELETE')<button type="submit" class="cart-remove"><i class="bi bi-trash3"></i> Remover</button></form>
                                    </div>
                                    <div class="cart-price">{{ number_format($unitPrice * $item->quantity, 2, ',', '.') }} €<small>{{ number_format($unitPrice, 2, ',', '.') }} € / un.</small></div>
                                </article>
                            @endforeach
                            <div class="cart-footer"><a href="{{ route('product') }}" class="cart-continue"><i class="bi bi-arrow-left"></i> Continuar a comprar</a></div>
                        </section>
                    </div>
                    <div class="col-lg-4">
                        <aside class="cart-sticky">
                            <section class="cart-summary">
                                <h2>Resumo da encomenda</h2>
                                <div class="cart-row"><span>Subtotal (s/ IVA)</span><strong>{{ number_format($subtotal, 2, ',', '.') }} €</strong></div>
                                <div class="cart-row cart-row--shipping"><span>Envio</span><strong>{{ $totals['has_free_shipping'] ? 'Gratuito' : number_format($totals['shipping_total'], 2, ',', '.') . ' €' }}</strong></div>
                                <div class="cart-row"><span>IVA ({{ (int) round($totals['tax_rate'] * 100) }}%)</span><strong>{{ number_format($totals['tax_total'], 2, ',', '.') }} €</strong></div>
                                <div class="cart-total"><span>Total</span><div><strong>{{ number_format($totals['grand_total'], 2, ',', '.') }} €</strong><small>IVA incluído</small></div></div>
                                @auth
                                    <a href="{{ route('checkout.create') }}" class="cart-checkout"><i class="bi bi-lock-fill"></i> Finalizar pedido</a>
                                @else
                                    <a href="{{ route('login', ['redirect' => route('checkout.create', absolute: false)]) }}" class="cart-checkout"><i class="bi bi-person-circle"></i> Entrar para finalizar</a>
                                @endauth
                                <form method="POST" action="{{ route('cart.clear') }}" class="text-center mt-3">@csrf @method('DELETE')<button type="submit" class="cart-remove"><i class="bi bi-trash3"></i> Limpar carrinho</button></form>
                                <p class="cart-secure"><i class="bi bi-shield-lock-fill"></i> Pagamento 100% seguro</p>
                            </section>
                            <section class="cart-shipping">
                                <h2><i class="bi bi-truck"></i> Envio</h2>
                                <div class="cart-shipping-line"><span>Transportadora</span><strong>GLS</strong></div>
                                <div class="cart-shipping-line"><span>Prazo estimado</span><strong>7–10 dias úteis</strong></div>
                                <div class="cart-promo"><i class="bi bi-check-circle-fill"></i><span>@if ($remainingForFreeShipping > 0)Adicione <strong>{{ number_format($remainingForFreeShipping, 2, ',', '.') }} €</strong> para portes gratuitos em Portugal Continental.@else Parabéns! A sua encomenda é elegível para portes gratuitos em Portugal Continental.@endif</span></div>
                            </section>
                        </aside>
                    </div>
                </div>
                <div class="cart-free"><i class="bi bi-truck"></i><span><strong>Portes gratuitos</strong> em encomendas iguais ou superiores a {{ number_format($freeShippingThreshold, 2, ',', '.') }} € (valor s/ IVA) para Portugal Continental.</span></div>
                <section class="cart-trust">
                    <div><i class="bi bi-shield-check"></i><span><strong>Compra 100% segura</strong><span>Os seus dados estão protegidos com encriptação SSL.</span></span></div>
                    <div><i class="bi bi-arrow-repeat"></i><span><strong>Devoluções fáceis</strong><span>Até 14 dias para devolver a sua encomenda.</span></span></div>
                    <div><i class="bi bi-headset"></i><span><strong>Apoio ao cliente</strong><span>Estamos disponíveis para ajudar sempre que precisar.</span></span></div>
                </section>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.js-cart-quantity').forEach((button) => {
        button.addEventListener('click', () => {
            const input = button.parentElement.querySelector('input[name="quantity"]');
            const next = Math.min(1000, Math.max(1, Number(input.value || 1) + Number(button.dataset.change)));
            if (next !== Number(input.value)) { input.value = next; button.closest('form').submit(); }
        });
    });
</script>
@endpush
