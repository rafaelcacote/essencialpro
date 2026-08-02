@extends('layouts.app')

@section('title', 'Pedido ' . $order->order_number . ' - Essencial Pro')

@push('styles')
<style>
    .order-show-page { background: #fafbfc; }
    .order-show-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .order-show-toolbar__eyebrow {
        color: var(--primary);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin: 0 0 .35rem;
    }
    .order-show-toolbar h2 {
        color: #1d2b41;
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0;
    }
    .order-show-toolbar p {
        color: #718096;
        font-size: .88rem;
        margin: .35rem 0 0;
    }
    .order-show-back {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        border: 1px solid #ccd4df;
        border-radius: 4px;
        padding: .65rem 1rem;
        color: #2b3a50;
        font-size: .8rem;
        font-weight: 600;
        text-decoration: none;
        background: #fff;
        transition: border-color .2s ease, color .2s ease;
    }
    .order-show-back:hover { border-color: var(--primary); color: var(--primary); }
    .order-show-card {
        background: #fff;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
        overflow: hidden;
    }
    .order-show-card__head {
        display: flex;
        align-items: center;
        gap: .65rem;
        padding: 1.1rem 1.25rem;
        border-bottom: 1px solid #e9edf2;
        background: #fcfdfe;
    }
    .order-show-card__head i { color: var(--primary); font-size: 1.05rem; }
    .order-show-card__head h3 {
        color: #1d2b41;
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }
    .order-show-head {
        display: grid;
        grid-template-columns: minmax(240px, 2.2fr) minmax(120px, 1fr) 80px 110px;
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
    .order-show-item {
        display: grid;
        grid-template-columns: minmax(240px, 2.2fr) minmax(120px, 1fr) 80px 110px;
        gap: 1rem;
        align-items: center;
        padding: 1.15rem 1.25rem;
        border-bottom: 1px solid #edf0f3;
    }
    .order-show-item:last-child { border-bottom: 0; }
    .order-show-product {
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 0;
    }
    .order-show-product__image {
        width: 74px;
        height: 74px;
        flex: 0 0 74px;
        border: 1px solid #edf0f3;
        border-radius: 5px;
        overflow: hidden;
        background: #fff;
        display: grid;
        place-items: center;
    }
    .order-show-product__image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .order-show-product__image i {
        color: #c5ced9;
        font-size: 1.4rem;
    }
    .order-show-product strong,
    .order-show-product a {
        display: block;
        color: #1c2a40;
        font-size: .88rem;
        font-weight: 700;
        line-height: 1.35;
        text-decoration: none;
    }
    .order-show-product a:hover { color: var(--primary); }
    .order-show-product span {
        display: block;
        color: #6c798c;
        font-size: .76rem;
        margin-top: .3rem;
    }
    .order-show-variation {
        color: #6c798c;
        font-size: .76rem;
        line-height: 1.55;
    }
    .order-show-variation strong { color: #334157; }
    .order-show-qty {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 700;
    }
    .order-show-price {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 700;
        text-align: right;
        white-space: nowrap;
    }
    .order-show-price small {
        display: block;
        color: #7c899a;
        font-size: .66rem;
        font-weight: 500;
        margin-top: .15rem;
    }
    .order-show-sticky { position: sticky; top: 1.5rem; }
    .order-show-summary { padding: 1.3rem; }
    .order-show-summary h3 {
        color: #1d2b41;
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 1.1rem;
    }
    .order-show-status {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.15rem;
        padding-bottom: 1.15rem;
        border-bottom: 1px solid #e7ebf0;
    }
    .order-show-status span {
        color: #627087;
        font-size: .8rem;
        font-weight: 600;
    }
    .order-show-badge {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .35rem .7rem;
        border-radius: 50px;
        font-size: .72rem;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;
    }
    .order-show-badge--pending { background: #fff4e5; color: #b76a00; }
    .order-show-badge--confirmed { background: #e8f5ee; color: #1f7a4d; }
    .order-show-badge--processing { background: #e8f1fb; color: #1d5fa8; }
    .order-show-badge--shipped { background: #ece9ff; color: #4b3fb8; }
    .order-show-badge--completed { background: #e7f8ef; color: #157347; }
    .order-show-badge--cancelled { background: #fdecee; color: #b02a37; }
    .order-show-badge--default { background: #eef1f5; color: #5a6478; }
    .order-show-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        color: #526075;
        font-size: .84rem;
        margin-bottom: .85rem;
    }
    .order-show-row strong { color: #1d2b41; }
    .order-show-total {
        display: flex;
        justify-content: space-between;
        align-items: end;
        border-top: 1px solid #e7ebf0;
        margin-top: 1.1rem;
        padding-top: 1.1rem;
    }
    .order-show-total span {
        color: #1e2c42;
        font-size: .9rem;
        font-weight: 700;
    }
    .order-show-total strong {
        color: var(--primary);
        font-size: 1.5rem;
        line-height: 1;
    }
    .order-show-block {
        margin-top: 1rem;
        padding: 1.15rem 1.25rem;
    }
    .order-show-block h4 {
        display: flex;
        align-items: center;
        gap: .5rem;
        color: #1d2b41;
        font-size: .92rem;
        font-weight: 700;
        margin: 0 0 .9rem;
    }
    .order-show-block h4 i { color: var(--primary); }
    .order-show-detail {
        display: grid;
        gap: .7rem;
    }
    .order-show-detail__item span {
        display: block;
        color: #7c899a;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .02em;
        text-transform: uppercase;
        margin-bottom: .15rem;
    }
    .order-show-detail__item strong {
        display: block;
        color: #28374c;
        font-size: .84rem;
        font-weight: 600;
        line-height: 1.4;
        word-break: break-word;
    }
    .order-show-note {
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
    .order-show-note i { color: var(--primary); font-size: 1.2rem; margin-top: .1rem; }
    .order-show-note strong { display: block; color: var(--primary); font-size: .85rem; margin-bottom: .2rem; }
    .order-show-note p { margin: 0; color: #3c4b60; font-size: .8rem; line-height: 1.5; }
    @media (max-width: 991.98px) {
        .order-show-sticky { position: static; }
    }
    @media (max-width: 767.98px) {
        .order-show-head { display: none; }
        .order-show-item {
            grid-template-columns: 1fr auto;
            gap: .75rem;
        }
        .order-show-product { grid-column: 1 / -1; }
        .order-show-variation { grid-column: 1; }
        .order-show-qty { grid-column: 2; text-align: right; }
        .order-show-price {
            grid-column: 1 / -1;
            text-align: left;
            padding-top: .35rem;
            border-top: 1px dashed #edf0f3;
        }
    }
</style>
@endpush

@section('content')
    @include('components.page-header', ['title' => 'Pedido'])

    @php
        $statusLabels = [
            'pending' => 'Pendente',
            'confirmed' => 'Confirmado',
            'processing' => 'Em processamento',
            'shipped' => 'Enviado',
            'completed' => 'Concluído',
            'cancelled' => 'Cancelado',
        ];
        $statusClasses = [
            'pending' => 'order-show-badge--pending',
            'confirmed' => 'order-show-badge--confirmed',
            'processing' => 'order-show-badge--processing',
            'shipped' => 'order-show-badge--shipped',
            'completed' => 'order-show-badge--completed',
            'cancelled' => 'order-show-badge--cancelled',
        ];
        $paymentLabels = [
            'pending' => 'Pendente',
            'paid' => 'Pago',
            'failed' => 'Falhou',
            'expired' => 'Expirado',
        ];
    @endphp

    <div class="order-show-page py-5">
        <div class="container">
            <div class="order-show-toolbar">
                <div>
                    <p class="order-show-toolbar__eyebrow">Detalhe do pedido</p>
                    <h2>{{ $order->order_number }}</h2>
                    <p>Realizado em {{ $order->created_at?->format('d/m/Y \à\s H:i') }}</p>
                </div>
                <a href="{{ route('account.orders') }}" class="order-show-back">
                    <i class="bi bi-arrow-left"></i> Voltar aos pedidos
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <section class="order-show-card">
                        <div class="order-show-card__head">
                            <i class="bi bi-bag-check"></i>
                            <h3>Itens do pedido</h3>
                        </div>
                        <div class="order-show-head">
                            <span>Produto</span>
                            <span>Variação</span>
                            <span>Qtd.</span>
                            <span class="text-end">Total</span>
                        </div>

                        @foreach ($order->items as $item)
                            @php
                                $image = $item->product?->images?->first();
                            @endphp
                            <article class="order-show-item">
                                <div class="order-show-product">
                                    <div class="order-show-product__image">
                                        @if ($image)
                                            <img src="{{ asset($image->path) }}" alt="{{ $item->product_title }}">
                                        @else
                                            <i class="bi bi-image"></i>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($item->product)
                                            <a href="{{ route('products.show', $item->product) }}">{{ $item->product_title }}</a>
                                        @else
                                            <strong>{{ $item->product_title }}</strong>
                                        @endif
                                        @if ($item->product_code)
                                            <span>Ref: {{ $item->product_code }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="order-show-variation">
                                    Cor: <strong>{{ $item->selected_color ?: '—' }}</strong><br>
                                    Tamanho: <strong>{{ $item->selected_size ?: '—' }}</strong>
                                </div>
                                <div class="order-show-qty">{{ $item->quantity }}</div>
                                <div class="order-show-price">
                                    {{ number_format((float) $item->line_total, 2, ',', '.') }} €
                                    <small>{{ number_format((float) $item->unit_price, 2, ',', '.') }} € / un.</small>
                                </div>
                            </article>
                        @endforeach
                    </section>

                    @if ($order->notes)
                        <div class="order-show-note">
                            <i class="bi bi-chat-left-text-fill"></i>
                            <div>
                                <strong>Notas do pedido</strong>
                                <p>{{ $order->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <aside class="order-show-sticky">
                        <section class="order-show-card order-show-summary">
                            <h3>Resumo</h3>

                            <div class="order-show-status">
                                <span>Status</span>
                                <span class="order-show-badge {{ $statusClasses[$order->status] ?? 'order-show-badge--default' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </div>

                            <div class="order-show-row">
                                <span>Data</span>
                                <strong>{{ $order->created_at?->format('d/m/Y H:i') }}</strong>
                            </div>
                            <div class="order-show-row">
                                <span>Subtotal</span>
                                <strong>{{ number_format((float) $order->subtotal, 2, ',', '.') }} €</strong>
                            </div>
                            @if ((float) $order->shipping_total > 0)
                                <div class="order-show-row">
                                    <span>Envio</span>
                                    <strong>{{ number_format((float) $order->shipping_total, 2, ',', '.') }} €</strong>
                                </div>
                            @endif
                            @if ((float) $order->discount_total > 0)
                                <div class="order-show-row">
                                    <span>Desconto</span>
                                    <strong>-{{ number_format((float) $order->discount_total, 2, ',', '.') }} €</strong>
                                </div>
                            @endif
                            @if ($order->payment_status)
                                <div class="order-show-row">
                                    <span>Pagamento</span>
                                    <strong>{{ $paymentLabels[$order->payment_status] ?? $order->payment_status }}</strong>
                                </div>
                            @endif

                            <div class="order-show-total">
                                <span>Total</span>
                                <strong>{{ number_format((float) $order->grand_total, 2, ',', '.') }} €</strong>
                            </div>
                        </section>

                        <section class="order-show-card order-show-block">
                            <h4><i class="bi bi-person"></i> Contacto</h4>
                            <div class="order-show-detail">
                                <div class="order-show-detail__item">
                                    <span>Nome</span>
                                    <strong>{{ $order->contact_name }}</strong>
                                </div>
                                <div class="order-show-detail__item">
                                    <span>Email</span>
                                    <strong>{{ $order->email }}</strong>
                                </div>
                                <div class="order-show-detail__item">
                                    <span>Telefone</span>
                                    <strong>{{ $order->phone ?: '—' }}</strong>
                                </div>
                            </div>
                        </section>

                        @if ($order->address || $order->city || $order->postal_code)
                            <section class="order-show-card order-show-block">
                                <h4><i class="bi bi-geo-alt"></i> Entrega</h4>
                                <div class="order-show-detail">
                                    @if ($order->address)
                                        <div class="order-show-detail__item">
                                            <span>Morada</span>
                                            <strong>{{ $order->address }}</strong>
                                        </div>
                                    @endif
                                    @if ($order->postal_code || $order->city)
                                        <div class="order-show-detail__item">
                                            <span>Localidade</span>
                                            <strong>{{ trim(($order->postal_code ? $order->postal_code . ' ' : '') . ($order->city ?? '')) }}</strong>
                                        </div>
                                    @endif
                                    @if ($order->country)
                                        <div class="order-show-detail__item">
                                            <span>País</span>
                                            <strong>{{ $order->country }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
