@extends('layouts.app')

@section('title', 'Pedido Confirmado - Essencial Pro')

@push('styles')
<style>
    .checkout-success-page { background: #fafbfc; }
    .checkout-success-hero {
        text-align: center;
        margin-bottom: 1.75rem;
    }
    .checkout-success-hero__icon {
        width: 78px;
        height: 78px;
        margin: 0 auto 1.15rem;
        display: grid;
        place-items: center;
        border-radius: 50%;
        font-size: 2rem;
    }
    .checkout-success-hero__icon--paid {
        background: #e7f8ef;
        color: #157347;
    }
    .checkout-success-hero__icon--pending {
        background: #fff4e5;
        color: #b76a00;
    }
    .checkout-success-hero__eyebrow {
        color: var(--primary);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin: 0 0 .4rem;
    }
    .checkout-success-hero h2 {
        color: #1d2b41;
        font-size: clamp(1.35rem, 2.5vw, 1.75rem);
        font-weight: 700;
        margin: 0 0 .55rem;
    }
    .checkout-success-hero p {
        color: #718096;
        font-size: .95rem;
        line-height: 1.55;
        max-width: 520px;
        margin: 0 auto;
    }
    .checkout-success-order {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        margin-top: 1rem;
        padding: .55rem 1rem;
        border: 1px solid #e7ebf0;
        border-radius: 50px;
        background: #fff;
        color: #526075;
        font-size: .82rem;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
    }
    .checkout-success-order strong { color: #1d2b41; }
    .checkout-success-card {
        background: #fff;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }
    .checkout-success-card__head {
        display: flex;
        align-items: center;
        gap: .65rem;
        padding: 1.1rem 1.25rem;
        border-bottom: 1px solid #e9edf2;
        background: #fcfdfe;
    }
    .checkout-success-card__head i { color: var(--primary); font-size: 1.05rem; }
    .checkout-success-card__head h3 {
        color: #1d2b41;
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }
    .checkout-success-pay {
        display: flex;
        gap: .9rem;
        padding: 1.15rem 1.25rem;
        border-left: 5px solid var(--primary);
        background: #fffaf5;
    }
    .checkout-success-pay i {
        color: var(--primary);
        font-size: 1.25rem;
        margin-top: .1rem;
        flex-shrink: 0;
    }
    .checkout-success-pay strong {
        display: block;
        color: var(--primary);
        font-size: .88rem;
        margin-bottom: .45rem;
    }
    .checkout-success-pay p {
        margin: 0;
        color: #3c4b60;
        font-size: .84rem;
        line-height: 1.55;
    }
    .checkout-success-pay-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .75rem;
        margin-top: .85rem;
    }
    .checkout-success-pay-item {
        padding: .7rem .8rem;
        border: 1px solid #f0e4db;
        border-radius: 6px;
        background: #fff;
    }
    .checkout-success-pay-item span {
        display: block;
        color: #7c899a;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
        margin-bottom: .2rem;
    }
    .checkout-success-pay-item strong {
        color: #1d2b41;
        font-size: .95rem;
        margin: 0;
    }
    .checkout-success-pay-expire {
        display: block;
        margin-top: .75rem;
        color: #765238;
        font-size: .75rem;
    }
    .checkout-success-head {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 70px 110px;
        gap: 1rem;
        align-items: center;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e9edf2;
        color: #627087;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .02em;
        text-transform: uppercase;
        background: #fcfdfe;
    }
    .checkout-success-item {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 70px 110px;
        gap: 1rem;
        align-items: center;
        padding: 1.05rem 1.25rem;
        border-bottom: 1px solid #edf0f3;
    }
    .checkout-success-item:last-of-type { border-bottom: 0; }
    .checkout-success-item strong {
        display: block;
        color: #1c2a40;
        font-size: .88rem;
        font-weight: 700;
        line-height: 1.35;
    }
    .checkout-success-item span {
        display: block;
        color: #6c798c;
        font-size: .76rem;
        line-height: 1.5;
        margin-top: .25rem;
    }
    .checkout-success-qty {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 700;
        text-align: center;
    }
    .checkout-success-price {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
    }
    .checkout-success-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 1.1rem 1.25rem;
        border-top: 1px solid #e7ebf0;
        background: #fcfdfe;
    }
    .checkout-success-total span {
        color: #1e2c42;
        font-size: .9rem;
        font-weight: 700;
    }
    .checkout-success-total strong {
        color: var(--primary);
        font-size: 1.35rem;
        line-height: 1;
    }
    .checkout-success-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: .75rem;
        margin-top: 1.5rem;
    }
    .checkout-success-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        min-width: 200px;
        padding: .85rem 1.2rem;
        border-radius: 4px;
        font-size: .88rem;
        font-weight: 700;
        text-decoration: none;
        transition: filter .2s ease, border-color .2s ease, color .2s ease, background .2s ease;
    }
    .checkout-success-cta--primary {
        background: var(--primary);
        color: #fff;
    }
    .checkout-success-cta--primary:hover { color: #fff; filter: brightness(.94); }
    .checkout-success-cta--secondary {
        border: 1px solid #ccd4df;
        background: #fff;
        color: #2b3a50;
    }
    .checkout-success-cta--secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #fff7f2;
    }
    .checkout-success-note {
        display: flex;
        gap: .85rem;
        margin-top: 1.5rem;
        padding: 1rem 1.15rem;
        border: 1px solid #e7ebf0;
        border-left: 5px solid var(--primary);
        border-radius: 8px;
        background: #fffaf5;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
    }
    .checkout-success-note i { color: var(--primary); font-size: 1.2rem; margin-top: .1rem; }
    .checkout-success-note strong { display: block; color: var(--primary); font-size: .85rem; margin-bottom: .2rem; }
    .checkout-success-note p { margin: 0; color: #3c4b60; font-size: .8rem; line-height: 1.5; }
    @media (max-width: 767.98px) {
        .checkout-success-pay-grid { grid-template-columns: 1fr; }
        .checkout-success-head { display: none; }
        .checkout-success-item {
            grid-template-columns: 1fr auto;
            gap: .55rem .85rem;
        }
        .checkout-success-item > div:first-child { grid-column: 1 / -1; }
        .checkout-success-qty { text-align: left; }
        .checkout-success-cta { width: 100%; }
    }
</style>
@endpush

@section('content')
    @include('components.page-header', ['title' => 'Pedido Recebido'])

    <div class="checkout-success-page py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-success-hero">
                        @if ($order->payment_status === 'paid')
                            <div class="checkout-success-hero__icon checkout-success-hero__icon--paid" aria-hidden="true">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <p class="checkout-success-hero__eyebrow">Pagamento confirmado</p>
                            <h2>Obrigado pela sua encomenda</h2>
                            <p>O seu pedido foi pago e está a ser processado. Pode acompanhar o estado a qualquer momento na sua conta.</p>
                        @else
                            <div class="checkout-success-hero__icon checkout-success-hero__icon--pending" aria-hidden="true">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <p class="checkout-success-hero__eyebrow">Pedido recebido</p>
                            <h2>Estamos a processar o pagamento</h2>
                            <p>Receberá uma confirmação assim que o pagamento for validado. Guarde o número do pedido para acompanhamento.</p>
                        @endif

                        <div class="checkout-success-order">
                            <i class="bi bi-receipt"></i>
                            Número do pedido: <strong>{{ $order->order_number }}</strong>
                        </div>
                    </div>

                    @if ($order->payment_method === 'multibanco' && $order->payment_status !== 'paid')
                        <section class="checkout-success-card">
                            <div class="checkout-success-card__head">
                                <i class="bi bi-credit-card-2-front"></i>
                                <h3>Dados para pagamento Multibanco</h3>
                            </div>
                            <div class="checkout-success-pay">
                                <i class="bi bi-info-circle-fill"></i>
                                <div>
                                    <strong>Utilize os dados abaixo para concluir o pagamento</strong>
                                    <p>Após o pagamento, a confirmação pode demorar alguns minutos a refletir no sistema.</p>
                                    <div class="checkout-success-pay-grid">
                                        <div class="checkout-success-pay-item">
                                            <span>Entidade</span>
                                            <strong>{{ $order->eupago_entity }}</strong>
                                        </div>
                                        <div class="checkout-success-pay-item">
                                            <span>Referência</span>
                                            <strong>{{ $order->eupago_reference }}</strong>
                                        </div>
                                        <div class="checkout-success-pay-item">
                                            <span>Valor</span>
                                            <strong>{{ number_format((float) $order->grand_total, 2, ',', '.') }} €</strong>
                                        </div>
                                    </div>
                                    @if ($order->payment_expires_at)
                                        <span class="checkout-success-pay-expire">
                                            <i class="bi bi-calendar3"></i>
                                            Válido até {{ $order->payment_expires_at->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </section>
                    @elseif ($order->payment_method === 'mbway' && $order->payment_status !== 'paid')
                        <section class="checkout-success-card">
                            <div class="checkout-success-card__head">
                                <i class="bi bi-phone"></i>
                                <h3>Pagamento MB WAY</h3>
                            </div>
                            <div class="checkout-success-pay">
                                <i class="bi bi-info-circle-fill"></i>
                                <div>
                                    <strong>Confirme o pagamento na aplicação MB WAY</strong>
                                    <p>A confirmação pode demorar alguns instantes. Não feche a aplicação até concluir a autorização.</p>
                                </div>
                            </div>
                        </section>
                    @endif

                    @if ($order->items->isNotEmpty())
                        <section class="checkout-success-card">
                            <div class="checkout-success-card__head">
                                <i class="bi bi-bag-check"></i>
                                <h3>Resumo da encomenda</h3>
                            </div>
                            <div class="checkout-success-head">
                                <span>Produto</span>
                                <span class="text-center">Qtd.</span>
                                <span class="text-end">Total</span>
                            </div>
                            @foreach ($order->items as $item)
                                <article class="checkout-success-item">
                                    <div>
                                        <strong>{{ $item->product_title }}</strong>
                                        @if ($item->selected_color)
                                            <span>Cor: {{ $item->selected_color }}</span>
                                        @endif
                                        @if ($item->selected_size)
                                            <span>Tamanho: {{ $item->selected_size }}</span>
                                        @endif
                                    </div>
                                    <div class="checkout-success-qty">{{ $item->quantity }}</div>
                                    <div class="checkout-success-price">
                                        {{ number_format((float) $item->line_total, 2, ',', '.') }} €
                                    </div>
                                </article>
                            @endforeach
                            <div class="checkout-success-total">
                                <span>Total</span>
                                <strong>{{ number_format((float) $order->grand_total, 2, ',', '.') }} €</strong>
                            </div>
                        </section>
                    @endif

                    <div class="checkout-success-actions">
                        <a href="{{ route('account.orders.show', $order) }}" class="checkout-success-cta checkout-success-cta--primary">
                            <i class="bi bi-eye"></i> Ver detalhes do pedido
                        </a>
                        <a href="{{ route('product') }}" class="checkout-success-cta checkout-success-cta--secondary">
                            <i class="bi bi-bag"></i> Continuar a comprar
                        </a>
                    </div>

                    <div class="checkout-success-note">
                        <i class="bi bi-truck"></i>
                        <div>
                            <strong>Próximos passos</strong>
                            <p>Após a confirmação do pagamento, iniciamos a preparação da sua encomenda. O prazo estimado para Portugal Continental é de 7 a 10 dias úteis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
