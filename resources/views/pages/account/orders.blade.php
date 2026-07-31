@extends('layouts.app')

@section('title', 'Meus Pedidos - Essencial Pro')

@push('styles')
<style>
    .orders-page { background: #fafbfc; }
    .orders-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .orders-toolbar__eyebrow {
        color: var(--primary);
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin: 0 0 .35rem;
    }
    .orders-toolbar h2 {
        color: #1d2b41;
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0;
    }
    .orders-toolbar p {
        color: #718096;
        font-size: .88rem;
        margin: .35rem 0 0;
    }
    .orders-back {
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
    .orders-back:hover { border-color: var(--primary); color: var(--primary); }
    .orders-card {
        background: #fff;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
        overflow: hidden;
    }
    .orders-head {
        display: grid;
        grid-template-columns: minmax(160px, 1.4fr) minmax(140px, 1fr) minmax(140px, 1fr) minmax(110px, .9fr) 120px;
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
    .orders-row {
        display: grid;
        grid-template-columns: minmax(160px, 1.4fr) minmax(140px, 1fr) minmax(140px, 1fr) minmax(110px, .9fr) 120px;
        gap: 1rem;
        align-items: center;
        padding: 1.15rem 1.25rem;
        border-bottom: 1px solid #edf0f3;
        transition: background .15s ease;
    }
    .orders-row:last-child { border-bottom: 0; }
    .orders-row:hover { background: #fffaf7; }
    .orders-number {
        display: flex;
        align-items: center;
        gap: .75rem;
        min-width: 0;
    }
    .orders-number__icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: #fff1e8;
        color: var(--primary);
        font-size: 1.05rem;
    }
    .orders-number strong {
        display: block;
        color: #1c2a40;
        font-size: .9rem;
        font-weight: 700;
        line-height: 1.3;
    }
    .orders-number span {
        display: block;
        color: #7c899a;
        font-size: .72rem;
        margin-top: .15rem;
    }
    .orders-badge {
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
    .orders-badge--pending { background: #fff4e5; color: #b76a00; }
    .orders-badge--confirmed { background: #e8f5ee; color: #1f7a4d; }
    .orders-badge--processing { background: #e8f1fb; color: #1d5fa8; }
    .orders-badge--shipped { background: #ece9ff; color: #4b3fb8; }
    .orders-badge--completed { background: #e7f8ef; color: #157347; }
    .orders-badge--cancelled { background: #fdecee; color: #b02a37; }
    .orders-badge--default { background: #eef1f5; color: #5a6478; }
    .orders-date {
        color: #526075;
        font-size: .84rem;
    }
    .orders-date small {
        display: block;
        color: #8a96a8;
        font-size: .72rem;
        margin-top: .15rem;
    }
    .orders-total {
        color: #1d2b41;
        font-size: .95rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .orders-action {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: .4rem;
        min-width: 96px;
        padding: .55rem .85rem;
        border: 1px solid #ccd4df;
        border-radius: 4px;
        color: #2b3a50;
        font-size: .78rem;
        font-weight: 600;
        text-decoration: none;
        background: #fff;
        transition: border-color .2s ease, color .2s ease, background .2s ease;
    }
    .orders-action:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #fff7f2;
    }
    .orders-pagination {
        padding: 1rem 1.25rem;
        border-top: 1px solid #edf0f3;
        background: #fcfdfe;
    }
    .orders-empty {
        max-width: 560px;
        margin: 0 auto;
        padding: 4rem 1.5rem;
        text-align: center;
    }
    .orders-empty i {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #fff1e8;
        color: var(--primary);
        font-size: 1.8rem;
    }
    .orders-empty h2 {
        color: #1d2b41;
        font-size: 1.35rem;
        font-weight: 700;
        margin: 1.2rem 0 .75rem;
    }
    .orders-empty p {
        color: #718096;
        margin: 0 0 1.5rem;
        line-height: 1.55;
    }
    .orders-empty__cta {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        border-radius: 4px;
        padding: .85rem 1.25rem;
        background: var(--primary);
        color: #fff;
        font-size: .88rem;
        font-weight: 700;
        text-decoration: none;
    }
    .orders-empty__cta:hover { color: #fff; filter: brightness(.94); }
    .orders-note {
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
    .orders-note i { color: var(--primary); font-size: 1.2rem; margin-top: .1rem; }
    .orders-note strong { display: block; color: var(--primary); font-size: .85rem; margin-bottom: .2rem; }
    .orders-note p { margin: 0; color: #3c4b60; font-size: .8rem; line-height: 1.5; }
    @media (max-width: 991.98px) {
        .orders-head { display: none; }
        .orders-row {
            grid-template-columns: 1fr auto;
            gap: .75rem 1rem;
            padding: 1.1rem 1rem;
        }
        .orders-number { grid-column: 1 / -1; }
        .orders-date { grid-column: 1; }
        .orders-total { grid-column: 2; grid-row: 2; text-align: right; }
        .orders-action { grid-column: 1 / -1; width: 100%; }
    }
</style>
@endpush

@section('content')
    @include('components.page-header', ['title' => 'Meus Pedidos'])

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
            'pending' => 'orders-badge--pending',
            'confirmed' => 'orders-badge--confirmed',
            'processing' => 'orders-badge--processing',
            'shipped' => 'orders-badge--shipped',
            'completed' => 'orders-badge--completed',
            'cancelled' => 'orders-badge--cancelled',
        ];
    @endphp

    <div class="orders-page py-5">
        <div class="container">
            <div class="orders-toolbar">
                <div>
                    <p class="orders-toolbar__eyebrow">Minha conta</p>
                    <h2>Histórico de pedidos</h2>
                    <p>Acompanhe o estado e os detalhes das suas encomendas.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="orders-back">
                    <i class="bi bi-arrow-left"></i> Voltar à conta
                </a>
            </div>

            @if ($orders->isEmpty())
                <div class="orders-card">
                    <div class="orders-empty">
                        <i class="bi bi-box-seam"></i>
                        <h2>Ainda não tem pedidos</h2>
                        <p>Quando finalizar uma encomenda, ela aparece aqui para acompanhar o estado e os detalhes.</p>
                        <a href="{{ route('product') }}" class="orders-empty__cta">
                            <i class="bi bi-bag"></i> Ver produtos
                        </a>
                    </div>
                </div>
            @else
                <section class="orders-card">
                    <div class="orders-head">
                        <span>Pedido</span>
                        <span>Status</span>
                        <span>Data</span>
                        <span>Total</span>
                        <span class="text-end">Ação</span>
                    </div>

                    @foreach ($orders as $order)
                        <article class="orders-row">
                            <div class="orders-number">
                                <div class="orders-number__icon" aria-hidden="true">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div>
                                    <strong>{{ $order->order_number }}</strong>
                                    <span>Encomenda #{{ $order->id }}</span>
                                </div>
                            </div>

                            <div>
                                <span class="orders-badge {{ $statusClasses[$order->status] ?? 'orders-badge--default' }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </div>

                            <div class="orders-date">
                                {{ $order->created_at?->format('d/m/Y') }}
                                <small>{{ $order->created_at?->format('H:i') }}</small>
                            </div>

                            <div class="orders-total">
                                {{ number_format((float) $order->grand_total, 2, ',', '.') }} €
                            </div>

                            <div class="text-end">
                                <a href="{{ route('account.orders.show', $order) }}" class="orders-action">
                                    Ver detalhes <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach

                    @if ($orders->hasPages())
                        <div class="orders-pagination">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </section>

                <div class="orders-note">
                    <i class="bi bi-info-circle-fill"></i>
                    <div>
                        <strong>Precisa de ajuda com uma encomenda?</strong>
                        <p>Consulte os detalhes do pedido ou contacte o nosso apoio ao cliente para esclarecimentos sobre pagamento, envio ou devoluções.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
