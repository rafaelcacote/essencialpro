@extends('layouts.app')

@section('title', 'Checkout - Essencial Pro')

@php
    $nameParts = preg_split('/\s+/', trim((string) (auth()->user()->name ?? '')), 2);
    $defaultFirstName = old('first_name', $nameParts[0] ?? '');
    $defaultLastName = old('last_name', $nameParts[1] ?? '');
    $taxPercent = (int) round(($totals['tax_rate'] ?? 0.23) * 100);
@endphp

@push('styles')
<style>
    .ck-page { background: #f4f6f8; padding: 1.5rem 0 3rem; }
    .ck-secure-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.25rem;
        padding: .85rem 1.15rem;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(12, 29, 58, .04);
    }
    .ck-secure-bar__brand {
        color: #1d2b41;
        font-family: Rubik, sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: .02em;
        text-decoration: none;
    }
    .ck-secure-bar__brand span { color: var(--primary); }
    .ck-secure-bar__badge {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: #157347;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .ck-secure-bar__badge i { font-size: 1rem; }

    .ck-steps {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: .5rem;
        margin-bottom: 1.5rem;
        padding: .85rem;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        background: #fff;
    }
    .ck-step {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        padding: .65rem .5rem;
        border-radius: 6px;
        color: #8a96a8;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        text-align: center;
    }
    .ck-step i { font-size: .95rem; }
    .ck-step--done { color: #157347; background: #eef9f2; }
    .ck-step--active { color: #fff; background: var(--primary); }

    .ck-card {
        margin-bottom: 1.15rem;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
        overflow: hidden;
    }
    .ck-card__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid #eef1f5;
        background: #fcfdfe;
    }
    .ck-card__head h2 {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin: 0;
        color: #1d2b41;
        font-size: .95rem;
        font-weight: 700;
    }
    .ck-card__head h2 i { color: var(--primary); }
    .ck-card__body { padding: 1.15rem 1.2rem 1.3rem; }

    .ck-label {
        display: block;
        margin-bottom: .35rem;
        color: #526075;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
    }
    .ck-label .opt { color: #98a2b3; font-weight: 600; text-transform: none; letter-spacing: 0; }
    .ck-input, .ck-select, .ck-textarea {
        width: 100%;
        border: 1px solid #d9e0ea;
        border-radius: 6px;
        background: #fff;
        color: #1d2b41;
        font-size: .9rem;
        padding: .7rem .85rem;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .ck-input:focus, .ck-select:focus, .ck-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 94, 20, .12);
    }
    .ck-input.is-invalid, .ck-select.is-invalid, .ck-textarea.is-invalid {
        border-color: #dc3545;
    }
    .ck-error { color: #dc3545; font-size: .75rem; margin-top: .3rem; }
    .ck-hint { color: #8a96a8; font-size: .75rem; margin-top: .3rem; }
    .ck-check {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        color: #526075;
        font-size: .8rem;
        font-weight: 600;
        cursor: pointer;
        user-select: none;
    }
    .ck-check input { accent-color: var(--primary); }

    .ck-pay {
        display: flex;
        flex-direction: column;
        gap: .7rem;
    }
    .ck-pay-option {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: .95rem 1rem;
        border: 1.5px solid #e1e7ef;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        transition: border-color .15s ease, background .15s ease, box-shadow .15s ease;
    }
    .ck-pay-option:hover { border-color: #f0c4ad; background: #fffaf7; }
    .ck-pay-option:has(input:checked) {
        border-color: var(--primary);
        background: #fff7f2;
        box-shadow: 0 0 0 3px rgba(255, 94, 20, .1);
    }
    .ck-pay-option input { accent-color: var(--primary); flex-shrink: 0; }
    .ck-pay-option__icon {
        width: 42px;
        height: 42px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: #f4f6f8;
        color: #1d2b41;
        font-size: 1.15rem;
        flex-shrink: 0;
    }
    .ck-pay-option:has(input:checked) .ck-pay-option__icon {
        background: #ffe8db;
        color: var(--primary);
    }
    .ck-pay-option__icon img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 4px;
        border-radius: 6px;
    }
    .ck-pay-option:has(input:checked) .ck-pay-option__icon--logo {
        background: #fff;
    }
    .ck-pay-option__text { flex: 1; min-width: 0; }
    .ck-pay-option__text strong {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: .45rem;
        color: #1d2b41;
        font-size: .9rem;
    }
    .ck-pay-option__text small {
        display: block;
        margin-top: .2rem;
        color: #718096;
        font-size: .78rem;
        line-height: 1.4;
    }
    .ck-badge {
        display: inline-flex;
        align-items: center;
        padding: .15rem .45rem;
        border-radius: 999px;
        background: var(--primary);
        color: #fff;
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: .03em;
        text-transform: uppercase;
    }
    .ck-pay-note {
        display: flex;
        gap: .65rem;
        margin-top: 1rem;
        padding: .85rem 1rem;
        border-radius: 6px;
        background: #f7f9fb;
        color: #526075;
        font-size: .78rem;
        line-height: 1.45;
    }
    .ck-pay-note i { color: var(--primary); flex-shrink: 0; margin-top: .1rem; }

    .ck-summary {
        position: sticky;
        top: 1rem;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 12px rgba(12, 29, 58, .04);
        overflow: hidden;
    }
    .ck-summary__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
        padding: 1rem 1.2rem;
        border-bottom: 1px solid #eef1f5;
        background: #fcfdfe;
    }
    .ck-summary__head h2 {
        margin: 0;
        color: #1d2b41;
        font-size: .95rem;
        font-weight: 700;
    }
    .ck-summary__meta {
        color: #8a96a8;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .ck-summary__edit {
        color: var(--primary);
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
    }
    .ck-summary__edit:hover { text-decoration: underline; color: var(--primary); }
    .ck-summary__body { padding: 1rem 1.2rem 1.25rem; }

    .ck-item {
        display: grid;
        grid-template-columns: 56px 1fr auto;
        gap: .75rem;
        align-items: start;
        padding: .75rem 0;
        border-bottom: 1px solid #f0f3f7;
    }
    .ck-item:last-of-type { border-bottom: 0; padding-bottom: .25rem; }
    .ck-item img {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eef1f5;
        background: #f7f9fb;
    }
    .ck-item__info strong {
        display: block;
        color: #1d2b41;
        font-size: .84rem;
        font-weight: 600;
        line-height: 1.3;
    }
    .ck-item__info span {
        display: block;
        margin-top: .2rem;
        color: #8a96a8;
        font-size: .72rem;
    }
    .ck-item__price {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .ck-rows { margin-top: .85rem; padding-top: .85rem; border-top: 1px solid #eef1f5; }
    .ck-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: .55rem;
        color: #526075;
        font-size: .84rem;
    }
    .ck-row strong { color: #1d2b41; font-weight: 700; }
    .ck-row--shipping strong { color: #157347; }
    .ck-total {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        margin-top: .75rem;
        padding-top: .85rem;
        border-top: 1px solid #e7ebf0;
    }
    .ck-total span {
        color: #1d2b41;
        font-size: .88rem;
        font-weight: 800;
        letter-spacing: .02em;
        text-transform: uppercase;
    }
    .ck-total strong {
        color: var(--primary);
        font-size: 1.45rem;
        line-height: 1;
        font-weight: 800;
    }
    .ck-total small {
        display: block;
        margin-top: .25rem;
        color: #8a96a8;
        font-size: .68rem;
        font-weight: 600;
        text-align: right;
    }

    .ck-ship-progress {
        margin-top: 1rem;
        padding: .85rem 1rem;
        border-radius: 8px;
        background: #eef9f2;
        border: 1px solid #cdeedb;
    }
    .ck-ship-progress--warn {
        background: #fff7f2;
        border-color: #f0d3c2;
    }
    .ck-ship-progress p {
        margin: 0 0 .55rem;
        color: #1d2b41;
        font-size: .78rem;
        line-height: 1.4;
    }
    .ck-ship-progress p strong { color: #157347; }
    .ck-ship-progress--warn p strong { color: var(--primary); }
    .ck-ship-bar {
        height: 7px;
        border-radius: 999px;
        background: rgba(21, 115, 71, .15);
        overflow: hidden;
    }
    .ck-ship-progress--warn .ck-ship-bar { background: rgba(255, 94, 20, .15); }
    .ck-ship-bar > span {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: #157347;
    }
    .ck-ship-progress--warn .ck-ship-bar > span { background: var(--primary); }

    .ck-submit {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        width: 100%;
        margin-top: 1.1rem;
        padding: .95rem 1rem;
        border: 0;
        border-radius: 6px;
        background: var(--primary);
        color: #fff;
        font-size: .92rem;
        font-weight: 800;
        letter-spacing: .02em;
        text-transform: uppercase;
        transition: filter .15s ease;
    }
    .ck-submit:hover { filter: brightness(.94); color: #fff; }
    .ck-legal {
        margin: .85rem 0 0;
        color: #8a96a8;
        font-size: .7rem;
        line-height: 1.45;
        text-align: center;
    }
    .ck-legal a { color: var(--primary); text-decoration: none; font-weight: 600; }
    .ck-legal a:hover { text-decoration: underline; }

    .ck-trust {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: .85rem;
        margin-top: 1.5rem;
    }
    .ck-trust__item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .4rem;
        padding: 1rem .75rem;
        border: 1px solid #e7ebf0;
        border-radius: 8px;
        background: #fff;
        text-align: center;
        color: #526075;
        font-size: .72rem;
        font-weight: 600;
        line-height: 1.35;
    }
    .ck-trust__item i { color: var(--primary); font-size: 1.2rem; }

    @media (max-width: 991.98px) {
        .ck-summary { position: static; }
        .ck-trust { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 767.98px) {
        .ck-steps { grid-template-columns: 1fr 1fr; }
        .ck-step { font-size: .62rem; }
        .ck-secure-bar { flex-direction: column; align-items: flex-start; }
        .ck-trust { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="ck-page">
        <div class="container">
            <div class="ck-secure-bar">
                <a href="{{ route('home') }}" class="ck-secure-bar__brand">ESSENCIAL <span>PRO</span></a>
                <div class="ck-secure-bar__badge">
                    <i class="bi bi-shield-lock-fill"></i>
                    Compra 100% segura
                </div>
            </div>

            <nav class="ck-steps" aria-label="Progresso do checkout">
                <div class="ck-step ck-step--done"><i class="bi bi-check-circle-fill"></i> Carrinho</div>
                <div class="ck-step ck-step--active"><i class="bi bi-truck"></i> Dados de envio</div>
                <div class="ck-step ck-step--active"><i class="bi bi-credit-card"></i> Pagamento</div>
                <div class="ck-step"><i class="bi bi-bag-check"></i> Confirmação</div>
            </nav>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">Reveja os campos assinalados antes de continuar.</div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}" novalidate>
                @csrf
                <div class="row g-4">
                    <div class="col-lg-7 col-xl-8">
                        <section class="ck-card">
                            <div class="ck-card__head">
                                <h2><i class="bi bi-person"></i> Dados de contacto</h2>
                            </div>
                            <div class="ck-card__body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="ck-label" for="first_name">Nome</label>
                                        <input id="first_name" class="ck-input @error('first_name') is-invalid @enderror" name="first_name" value="{{ $defaultFirstName }}" required autocomplete="given-name">
                                        @error('first_name') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="last_name">Apelido</label>
                                        <input id="last_name" class="ck-input @error('last_name') is-invalid @enderror" name="last_name" value="{{ $defaultLastName }}" required autocomplete="family-name">
                                        @error('last_name') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="email">E-mail</label>
                                        <input id="email" type="email" class="ck-input @error('email') is-invalid @enderror" name="email" value="{{ old('email', auth()->user()->email) }}" required autocomplete="email">
                                        @error('email') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="phone">Telefone <span id="phone-required" class="text-danger">*</span></label>
                                        <input id="phone" class="ck-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="+351 912 345 678" autocomplete="tel">
                                        <div class="ck-hint">Obrigatório para pagamento por MB WAY.</div>
                                        @error('phone') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="tax_id">NIF <span class="opt">(opcional)</span></label>
                                        <input id="tax_id" class="ck-input @error('tax_id') is-invalid @enderror" name="tax_id" value="{{ old('tax_id') }}" autocomplete="off">
                                        @error('tax_id') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="ck-card">
                            <div class="ck-card__head">
                                <h2><i class="bi bi-geo-alt"></i> Morada de entrega</h2>
                                <label class="ck-check">
                                    <input type="checkbox" name="same_as_billing" value="1" @checked(old('same_as_billing', true))>
                                    Igual à morada de faturação
                                </label>
                            </div>
                            <div class="ck-card__body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="ck-label" for="country">País</label>
                                        <select id="country" class="ck-select @error('country') is-invalid @enderror" name="country" required>
                                            <option value="Portugal" @selected(old('country', 'Portugal') === 'Portugal')>Portugal</option>
                                        </select>
                                        @error('country') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="postal_code">Código postal</label>
                                        <input id="postal_code" class="ck-input @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" placeholder="0000-000" required autocomplete="postal-code">
                                        @error('postal_code') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="district">Distrito</label>
                                        <input id="district" class="ck-input @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" required>
                                        @error('district') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="municipality">Concelho</label>
                                        <input id="municipality" class="ck-input @error('municipality') is-invalid @enderror" name="municipality" value="{{ old('municipality') }}" required>
                                        @error('municipality') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="city">Localidade</label>
                                        <input id="city" class="ck-input @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="address-level2">
                                        @error('city') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="street">Rua / Avenida</label>
                                        <input id="street" class="ck-input @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required autocomplete="street-address">
                                        @error('street') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="number">Número</label>
                                        <input id="number" class="ck-input @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required>
                                        @error('number') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="ck-label" for="floor">Andar / Porta <span class="opt">(opcional)</span></label>
                                        <input id="floor" class="ck-input @error('floor') is-invalid @enderror" name="floor" value="{{ old('floor') }}">
                                        @error('floor') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="ck-label" for="notes">Observações da entrega <span class="opt">(opcional)</span></label>
                                        <textarea id="notes" class="ck-textarea @error('notes') is-invalid @enderror" name="notes" rows="3" placeholder="Ex.: deixar na portaria">{{ old('notes') }}</textarea>
                                        @error('notes') <div class="ck-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="ck-card">
                            <div class="ck-card__head">
                                <h2><i class="bi bi-wallet2"></i> Método de pagamento</h2>
                            </div>
                            <div class="ck-card__body">
                                <div class="ck-pay">
                                    <label class="ck-pay-option">
                                        <input type="radio" name="payment_method" value="mbway" @checked(old('payment_method', 'mbway') === 'mbway')>
                                        <span class="ck-pay-option__icon ck-pay-option__icon--logo">
                                            <img src="{{ asset('img/metodos_pagamentos/mb_way.jpeg') }}" alt="MB WAY">
                                        </span>
                                        <span class="ck-pay-option__text">
                                            <strong>MB WAY <span class="ck-badge">Recomendado</span></strong>
                                            <small>Receba uma notificação no telemóvel para confirmar o pagamento.</small>
                                        </span>
                                    </label>
                                    <label class="ck-pay-option">
                                        <input type="radio" name="payment_method" value="multibanco" @checked(old('payment_method') === 'multibanco')>
                                        <span class="ck-pay-option__icon ck-pay-option__icon--logo">
                                            <img src="{{ asset('img/metodos_pagamentos/mb_multibanco.jpeg') }}" alt="Multibanco">
                                        </span>
                                        <span class="ck-pay-option__text">
                                            <strong>Referência Multibanco</strong>
                                            <small>Receba uma entidade e referência para pagar no Multibanco ou homebanking.</small>
                                        </span>
                                    </label>
                                    <label class="ck-pay-option">
                                        <input type="radio" name="payment_method" value="credit_card" @checked(old('payment_method') === 'credit_card')>
                                        <span class="ck-pay-option__icon"><i class="bi bi-credit-card"></i></span>
                                        <span class="ck-pay-option__text">
                                            <strong>Cartão de crédito/débito</strong>
                                            <small>Será redirecionado para o formulário seguro da EuPago.</small>
                                        </span>
                                    </label>
                                </div>
                                @error('payment_method') <div class="ck-error mt-2">{{ $message }}</div> @enderror
                                <div class="ck-pay-note">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Pagamento processado de forma segura pela EuPago. Os seus dados de pagamento não são armazenados neste site.</span>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-5 col-xl-4">
                        <aside class="ck-summary">
                            <div class="ck-summary__head">
                                <div>
                                    <h2>Resumo da encomenda</h2>
                                    <div class="ck-summary__meta">{{ $totals['item_count'] }} {{ $totals['item_count'] === 1 ? 'item' : 'itens' }}</div>
                                </div>
                                <a href="{{ route('cart.show') }}" class="ck-summary__edit">Editar carrinho</a>
                            </div>
                            <div class="ck-summary__body">
                                @foreach ($cart->items as $item)
                                    @php
                                        $unitPrice = (float) ($item->product?->price ?? 0);
                                        $image = $item->product?->images->first();
                                    @endphp
                                    <article class="ck-item">
                                        <img src="{{ $image ? asset($image->path) : asset('img/service-1.jpg') }}" alt="{{ $item->product?->title ?? 'Produto' }}">
                                        <div class="ck-item__info">
                                            <strong>{{ $item->product?->title ?? 'Produto indisponível' }}</strong>
                                            <span>Qtd. {{ $item->quantity }}@if ($item->selected_size) · {{ $item->selected_size }}@endif @if ($item->selected_color)· {{ $item->selected_color }}@endif</span>
                                        </div>
                                        <div class="ck-item__price">{{ number_format($unitPrice * $item->quantity, 2, ',', '.') }} €</div>
                                    </article>
                                @endforeach

                                <div class="ck-rows">
                                    <div class="ck-row">
                                        <span>Subtotal ({{ $totals['item_count'] }} {{ $totals['item_count'] === 1 ? 'produto' : 'produtos' }})</span>
                                        <strong>{{ number_format($totals['subtotal'], 2, ',', '.') }} €</strong>
                                    </div>
                                    @if (($totals['discount_total'] ?? 0) > 0)
                                        <div class="ck-row" style="color:#157347;">
                                            <span>Desconto{{ !empty($totals['coupon']) ? ' (' . $totals['coupon']->code . ')' : '' }}</span>
                                            <strong>-{{ number_format($totals['discount_total'], 2, ',', '.') }} €</strong>
                                        </div>
                                    @endif
                                    <div class="ck-row {{ $totals['has_free_shipping'] ? 'ck-row--shipping' : '' }}">
                                        <span>Envio</span>
                                        <strong>
                                            @if ($totals['has_free_shipping'])
                                                Gratuito
                                            @else
                                                {{ number_format($totals['shipping_total'], 2, ',', '.') }} €
                                            @endif
                                        </strong>
                                    </div>
                                    <div class="ck-row">
                                        <span>IVA ({{ $taxPercent }}%)</span>
                                        <strong>{{ number_format($totals['tax_total'], 2, ',', '.') }} €</strong>
                                    </div>
                                </div>

                                <div class="mt-3 mb-3">
                                    @if (!empty($totals['coupon']))
                                        <div class="d-flex align-items-center justify-content-between gap-2 p-2 rounded" style="background:#eef9f2; border:1px solid #cce8d5;">
                                            <div class="small">
                                                <strong>Cupom {{ $totals['coupon']->code }}</strong>
                                                <span class="text-muted">· {{ $totals['coupon']->label() }}</span>
                                            </div>
                                            <button form="checkout-coupon-remove" type="submit" class="btn btn-sm btn-outline-secondary">Remover</button>
                                        </div>
                                    @else
                                        <div class="d-flex gap-2">
                                            <input
                                                form="checkout-coupon-apply"
                                                type="text"
                                                name="coupon_code"
                                                class="form-control form-control-sm text-uppercase"
                                                placeholder="Código do cupom"
                                                value="{{ old('coupon_code') }}"
                                                maxlength="50"
                                            >
                                            <button form="checkout-coupon-apply" type="submit" class="btn btn-sm btn-outline-primary text-nowrap">Aplicar</button>
                                        </div>
                                        @error('coupon_code')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        @if (!empty($totals['coupon_error']))
                                            <div class="text-danger small mt-1">{{ $totals['coupon_error'] }}</div>
                                        @endif
                                    @endif
                                </div>

                                <div class="ck-total">
                                    <span>Total</span>
                                    <div>
                                        <strong>{{ number_format($totals['grand_total'], 2, ',', '.') }} €</strong>
                                        <small>IVA incluído</small>
                                    </div>
                                </div>

                                @php
                                    $progress = $totals['free_shipping_threshold'] > 0
                                        ? min(100, ($totals['subtotal'] / $totals['free_shipping_threshold']) * 100)
                                        : 100;
                                @endphp
                                <div class="ck-ship-progress {{ $totals['has_free_shipping'] ? '' : 'ck-ship-progress--warn' }}">
                                    @if ($totals['has_free_shipping'])
                                        <p><strong>Parabéns!</strong> O seu envio é gratuito para Portugal Continental.</p>
                                    @else
                                        <p>Faltam <strong>{{ number_format($totals['remaining_for_free_shipping'], 2, ',', '.') }} €</strong> (s/ IVA) para portes gratuitos.</p>
                                    @endif
                                    <div class="ck-ship-bar" aria-hidden="true"><span style="width: {{ number_format($progress, 2, '.', '') }}%"></span></div>
                                </div>

                                <button type="submit" class="ck-submit">
                                    <i class="bi bi-lock-fill"></i> Finalizar encomenda
                                </button>
                                <p class="ck-legal">
                                    Ao finalizar, aceita os
                                    <a href="{{ route('terms') }}">Termos e Condições</a>
                                    e a
                                    <a href="{{ route('privacy-policy') }}">Política de Privacidade</a>.
                                </p>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>

            <form id="checkout-coupon-apply" method="POST" action="{{ route('checkout.coupon.apply') }}" class="d-none">
                @csrf
            </form>
            <form id="checkout-coupon-remove" method="POST" action="{{ route('checkout.coupon.remove') }}" class="d-none">
                @csrf
                @method('DELETE')
            </form>

            <div class="ck-trust">
                <div class="ck-trust__item"><i class="bi bi-shield-check"></i> Pagamento 100% seguro</div>
                <div class="ck-trust__item"><i class="bi bi-truck"></i> Logística profissional</div>
                <div class="ck-trust__item"><i class="bi bi-arrow-repeat"></i> Devoluções em 14 dias</div>
                <div class="ck-trust__item"><i class="bi bi-headset"></i> Apoio ao cliente</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const phone = document.querySelector('[name="phone"]');
        const required = document.getElementById('phone-required');
        const methods = document.querySelectorAll('[name="payment_method"]');

        const updatePhoneRequirement = () => {
            const mbway = document.querySelector('[name="payment_method"]:checked')?.value === 'mbway';
            phone.required = mbway;
            required.classList.toggle('d-none', !mbway);
        };

        methods.forEach((method) => method.addEventListener('change', updatePhoneRequirement));
        updatePhoneRequirement();
    })();
</script>
@endpush
