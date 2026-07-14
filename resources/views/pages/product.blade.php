@extends('layouts.app')

@section('title', $product->title . ' - Essencial Pro')

@php
    $images = $product->images;
    $mainImage = $images->first();
    $mainSrc = $mainImage ? asset($mainImage->path) : asset('img/service-1.jpg');

    $colorMap = [
        'preto' => '#000000',
        'black' => '#000000',
        'branco' => '#ffffff',
        'white' => '#ffffff',
        'vermelho' => '#dc3545',
        'azul' => '#0d6efd',
        'navy' => '#1b2a4a',
        'azul-marinho' => '#1b2a4a',
        'marinho' => '#1b2a4a',
        'verde' => '#198754',
        'amarelo' => '#ffc107',
        'laranja' => '#fd7e14',
        'roxo' => '#6f42c1',
        'rosa' => '#d63384',
        'cinza' => '#6c757d',
        'castanho' => '#8b4513',
        'marrom' => '#8b4513',
        'bege' => '#f5f5dc',
        'dourado' => '#d4af37',
        'prata' => '#c0c0c0',
    ];

    $breadcrumbTrail = collect();
    $cat = $product->category;
    while ($cat) {
        $breadcrumbTrail->prepend($cat);
        $cat = $cat->parent;
    }

    $priceText = filled($product->price)
        ? number_format((float) $product->price, 2, ',', '.') . ' € + IVA'
        : null;
@endphp

@push('styles')
<style>
.pd-page {
    background: #fff;
    padding: 1.25rem 0 4rem;
}

.pd-breadcrumb {
    font-size: 0.875rem;
    color: #9aa3af;
    margin-bottom: 1.75rem;
}
.pd-breadcrumb a {
    color: #9aa3af;
    text-decoration: none;
}
.pd-breadcrumb a:hover {
    color: var(--primary);
}
.pd-breadcrumb .sep {
    margin: 0 0.4rem;
    color: #c5cbd3;
}
.pd-breadcrumb .current {
    color: #6b7280;
}

.pd-gallery {
    position: relative;
}
.pd-main-wrap {
    position: relative;
    border: 1px solid #e8eaed;
    background: #fff;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.pd-main-wrap img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    transition: transform 0.15s ease-out;
    transform-origin: center center;
    cursor: zoom-in;
}
.pd-badge-novo {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 2;
    background: var(--primary);
    color: #fff;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    padding: 0.35rem 0.65rem;
    border-radius: 2px;
    text-transform: uppercase;
}
.pd-zoom-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 2;
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,0.92);
    color: #4b5563;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    cursor: pointer;
}
.pd-zoom-btn:hover {
    color: var(--primary);
}
.pd-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    width: 36px;
    height: 36px;
    border: none;
    border-radius: 50%;
    background: rgba(120, 130, 145, 0.55);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
}
.pd-nav-btn:hover {
    background: rgba(80, 90, 105, 0.75);
}
.pd-nav-btn.prev { left: 10px; }
.pd-nav-btn.next { right: 10px; }

.pd-thumbs {
    display: flex;
    gap: 0.65rem;
    margin-top: 0.85rem;
    overflow-x: auto;
    padding-bottom: 2px;
}
.pd-thumb {
    flex: 0 0 72px;
    width: 72px;
    height: 72px;
    border: 1px solid #e0e0e0;
    background: #fff;
    padding: 4px;
    cursor: pointer;
    overflow: hidden;
    transition: border-color 0.15s;
}
.pd-thumb img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.pd-thumb.is-active,
.pd-thumb:hover {
    border: 2px solid var(--primary);
    padding: 3px;
}

.pd-title-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 0.35rem;
}
.pd-title {
    font-size: 1.65rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.25;
    margin: 0;
}
.pd-wishlist {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    border: 1px solid #d1d5db;
    background: #fff;
    color: #374151;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border-radius: 2px;
}
.pd-wishlist:hover {
    color: var(--primary);
    border-color: var(--primary);
}
.pd-ref {
    color: #9aa3af;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}
.pd-price {
    color: var(--primary);
    font-size: 1.85rem;
    font-weight: 700;
    margin: 0 0 0.75rem;
    line-height: 1.2;
}
.pd-price-quote {
    color: var(--primary);
    font-size: 1.35rem;
    font-weight: 700;
    margin: 0 0 0.75rem;
}
.pd-stock {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    color: #111827;
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.35rem;
}
.pd-stock-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #22c55e;
    display: inline-block;
}
.pd-shipping {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: #9aa3af;
    font-size: 0.92rem;
    margin-bottom: 1.35rem;
}

.pd-label {
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: #111827;
    margin-bottom: 0.55rem;
}
.pd-label span {
    font-weight: 600;
    text-transform: none;
    letter-spacing: 0;
    color: #4b5563;
}
.pd-label-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 0.55rem;
}
.pd-label-row .pd-label {
    margin-bottom: 0;
}
.pd-size-guide {
    color: var(--primary);
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    white-space: nowrap;
}
.pd-size-guide:hover {
    text-decoration: underline;
    color: var(--primary);
}

.pd-colors {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
    margin-bottom: 1.25rem;
}
.pd-color-btn {
    width: 36px;
    height: 36px;
    border: 1px solid #d1d5db;
    padding: 2px;
    background: #fff;
    cursor: pointer;
    border-radius: 2px;
}
.pd-color-btn span {
    display: block;
    width: 100%;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.06);
}
.pd-color-btn.is-active {
    border: 2px solid var(--primary);
    padding: 1px;
}

.pd-sizes {
    display: flex;
    flex-wrap: wrap;
    gap: 0.45rem;
    margin-bottom: 1.25rem;
}
.pd-size-btn {
    min-width: 48px;
    height: 42px;
    padding: 0 0.75rem;
    border: 1px solid #e0e0e0;
    background: #fff;
    color: #111827;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    border-radius: 2px;
}
.pd-size-btn:hover {
    border-color: var(--primary);
}
.pd-size-btn.is-active {
    border: 2px solid var(--primary);
    color: var(--primary);
}

.pd-qty {
    display: inline-flex;
    align-items: stretch;
    border: 1px solid #e0e0e0;
    border-radius: 2px;
    margin-bottom: 1.25rem;
    overflow: hidden;
}
.pd-qty button {
    width: 40px;
    border: none;
    background: #f7f8fa;
    color: #374151;
    font-size: 1.1rem;
    cursor: pointer;
}
.pd-qty button:hover {
    background: #eef0f3;
}
.pd-qty input {
    width: 56px;
    border: none;
    border-left: 1px solid #e0e0e0;
    border-right: 1px solid #e0e0e0;
    text-align: center;
    font-weight: 600;
    outline: none;
}

.pd-btn-cart {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.55rem;
    width: 100%;
    background: var(--primary);
    color: #fff;
    border: none;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    padding: 0.95rem 1.25rem;
    border-radius: 4px;
    margin-bottom: 0.75rem;
    transition: filter 0.2s, transform 0.15s;
}
.pd-btn-cart:hover {
    color: #fff;
    filter: brightness(0.95);
}
.pd-btn-personalize {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.15rem;
    width: 100%;
    background: #fff;
    color: var(--primary);
    border: 2px solid var(--primary);
    font-weight: 700;
    letter-spacing: 0.03em;
    text-transform: uppercase;
    padding: 0.85rem 1.25rem;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
}
.pd-btn-personalize:hover {
    color: #fff;
    background: var(--primary);
}
.pd-btn-personalize .main {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
}
.pd-btn-personalize .sub {
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0;
    text-transform: none;
    color: #000;
    opacity: 1;
}
.pd-btn-personalize:hover .sub {
    color: #fff;
}

.pd-trust {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.65rem;
    margin-top: 1.25rem;
}
.pd-trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    gap: 0.35rem;
    padding: 0.85rem 0.55rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #fff;
    text-align: center;
}
.pd-trust-head {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
}
.pd-trust-item i {
    color: #111827;
    font-size: 1.05rem;
    line-height: 1;
}
.pd-trust-item strong {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    text-transform: uppercase;
    color: #111827;
    line-height: 1.2;
}
.pd-trust-item span {
    display: block;
    font-size: 0.72rem;
    color: #6b7280;
    line-height: 1.35;
}

.pd-section {
    margin-top: 2.75rem;
    margin-bottom: 2rem;
}
.pd-details-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #fff;
    padding: 1.75rem 1.85rem 1.5rem;
}
.pd-details-top {
    padding-bottom: 1.5rem;
}
.pd-details-body {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 2.25rem;
    align-items: start;
}
.pd-details-body.pd-details-body--single {
    grid-template-columns: 1fr;
}
.pd-section-head {
    display: flex;
    align-items: center;
    gap: 0.55rem;
    margin-bottom: 1.15rem;
}
.pd-section-head i {
    color: var(--primary);
    font-size: 1.15rem;
}
.pd-section-head i.is-dark {
    color: #111827;
}
.pd-section-head h2 {
    font-size: 1.02rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin: 0;
    color: #111827;
}
.pd-desc-text {
    color: #374151;
    font-size: 0.95rem;
    line-height: 1.7;
}
.pd-features {
    list-style: none;
    padding: 0;
    margin: 0;
}
.pd-features li {
    display: flex;
    gap: 0.7rem;
    margin-bottom: 0.95rem;
    color: #374151;
    font-size: 0.92rem;
    line-height: 1.5;
}
.pd-features li:last-child {
    margin-bottom: 0;
}
.pd-check {
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.65rem;
    margin-top: 0.15rem;
}
.pd-features strong {
    color: #111827;
}

.pd-details-bottom {
    border-top: 1px solid #e5e7eb;
    padding-top: 1.35rem;
}
.pd-specs {
    border: 1px solid #e8eaed;
    background: #f5f6f8;
    overflow: hidden;
}
.pd-spec-row {
    padding: 0.85rem 1.1rem;
    color: #111827;
    font-size: 0.92rem;
    line-height: 1.45;
    border-bottom: 1px solid #e5e7eb;
}
.pd-spec-row:last-child {
    border-bottom: none;
}

.pd-related {
    margin-top: 3rem;
}
.pd-related-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}
.pd-related-head h2 {
    font-size: 1.15rem;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin: 0;
    color: #111827;
}
.pd-related-nav {
    display: flex;
    gap: 0.5rem;
}
.pd-related-nav button {
    width: 36px;
    height: 36px;
    border: 1px solid #d1d5db;
    background: #fff;
    color: #6b7280;
    border-radius: 2px;
    cursor: pointer;
}
.pd-related-nav button:hover {
    border-color: var(--primary);
    color: var(--primary);
}
.pd-related-track {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
}
.pd-card {
    border: 1px solid #e8eaed;
    background: #fff;
    padding: 1rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.pd-card:hover {
    border-color: #d1d5db;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}
.pd-card-img {
    aspect-ratio: 1 / 1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 0.85rem;
    overflow: hidden;
}
.pd-card-img img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.pd-card-title {
    font-size: 0.92rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.25rem;
    line-height: 1.3;
}
.pd-card-title a {
    color: inherit;
    text-decoration: none;
}
.pd-card-title a:hover {
    color: var(--primary);
}
.pd-card-brand {
    color: #9aa3af;
    font-size: 0.8rem;
    margin-bottom: 0.85rem;
}
.pd-card-footer {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
}
.pd-card-price {
    color: var(--primary);
    font-weight: 700;
    font-size: 0.95rem;
}
.pd-card-cart {
    width: 36px;
    height: 36px;
    border: 1px solid #e0e0e0;
    background: #fff;
    color: #6b7280;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 2px;
    cursor: pointer;
}
.pd-card-cart:hover {
    border-color: var(--primary);
    color: var(--primary);
}

@media (max-width: 991.98px) {
    .pd-details-body {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    .pd-related-track {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 575.98px) {
    .pd-title {
        font-size: 1.35rem;
    }
    .pd-price {
        font-size: 1.5rem;
    }
    .pd-trust {
        grid-template-columns: 1fr 1fr;
    }
    .pd-details-card {
        padding: 1.25rem 1rem 1.1rem;
    }
    .pd-related-track {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="pd-page">
    <div class="container">
        {{-- Breadcrumbs --}}
        <nav class="pd-breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('home') }}">Início</a>
            @foreach ($breadcrumbTrail as $crumb)
                <span class="sep">&gt;</span>
                <a href="{{ route('categories.show', $crumb) }}">{{ $crumb->name }}</a>
            @endforeach
            <span class="sep">&gt;</span>
            <span class="current">{{ $product->title }}</span>
        </nav>

        {{-- Hero: gallery + buy box --}}
        <div class="row g-4 g-lg-5">
            <div class="col-lg-6">
                <div class="pd-gallery">
                    <div class="pd-main-wrap" id="pd-zoom-wrap">
                        @if ($product->is_featured)
                            <span class="pd-badge-novo">Novo</span>
                        @endif
                        <button type="button" class="pd-zoom-btn" id="pd-zoom-toggle" aria-label="Ampliar imagem" title="Ampliar">
                            <i class="fa fa-search-plus"></i>
                        </button>
                        @if ($images->count() > 1)
                            <button type="button" class="pd-nav-btn prev" id="pd-prev" aria-label="Imagem anterior">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <button type="button" class="pd-nav-btn next" id="pd-next" aria-label="Próxima imagem">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        @endif
                        <img id="main-product-image" src="{{ $mainSrc }}" alt="{{ $product->title }}">
                    </div>

                    @if ($images->isNotEmpty())
                        <div class="pd-thumbs" id="pd-thumbs">
                            @foreach ($images as $index => $image)
                                <button
                                    type="button"
                                    class="pd-thumb {{ $index === 0 ? 'is-active' : '' }}"
                                    data-index="{{ $index }}"
                                    data-src="{{ asset($image->path) }}"
                                    aria-label="Miniatura {{ $index + 1 }}"
                                >
                                    <img src="{{ asset($image->path) }}" alt="{{ $image->alt ?? $product->title }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <form action="{{ route('cart.items.store') }}" method="POST" id="pd-cart-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="selected_color" id="pd-selected-color" value="">
                    <input type="hidden" name="selected_size" id="pd-selected-size" value="">

                    <div class="pd-title-row">
                        <h1 class="pd-title">{{ $product->title }}</h1>
                        <a href="{{ route('wishlist') }}" class="pd-wishlist" title="Lista de desejos" aria-label="Adicionar à lista de desejos">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>

                    @if ($product->code)
                        <p class="pd-ref">Ref: {{ $product->code }}</p>
                    @endif

                    @if ($priceText)
                        <p class="pd-price">{{ $priceText }}</p>
                    @else
                        <p class="pd-price-quote">Solicite um Orçamento</p>
                    @endif

                    <div class="pd-stock">
                        <span class="pd-stock-dot" aria-hidden="true"></span>
                        <span>Disponível por encomenda</span>
                    </div>
                    <div class="pd-shipping">
                        <i class="far fa-clock"></i>
                        <span>Prazo de expedição confirmado após validação do pedido.</span>
                    </div>

                    @if (!empty($product->colors))
                        <div class="mb-1">
                            <div class="pd-label">Cor: <span id="pd-color-label">{{ $product->colors[0] ?? '' }}</span></div>
                            <div class="pd-colors" id="pd-colors">
                                @foreach ($product->colors as $index => $color)
                                    @php
                                        $colorName = trim((string) $color);
                                        $normalized = \Illuminate\Support\Str::lower($colorName);
                                        $swatchColor = preg_match('/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/', $colorName)
                                            ? $colorName
                                            : ($colorMap[$normalized] ?? '#e9ecef');
                                    @endphp
                                    <button
                                        type="button"
                                        class="pd-color-btn {{ $index === 0 ? 'is-active' : '' }}"
                                        data-color="{{ $colorName }}"
                                        title="{{ $colorName }}"
                                        aria-label="{{ $colorName }}"
                                    >
                                        <span style="background-color: {{ $swatchColor }};"></span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (!empty($product->sizes))
                        <div>
                            <div class="pd-label-row">
                                <div class="pd-label">Tamanho:</div>
                                <button type="button" class="pd-size-guide" data-bs-toggle="modal" data-bs-target="#pdSizeGuideModal">
                                    <i class="fa fa-ruler"></i> Guia de tamanhos
                                </button>
                            </div>
                            <div class="pd-sizes" id="pd-sizes">
                                @foreach ($product->sizes as $index => $size)
                                    <button
                                        type="button"
                                        class="pd-size-btn {{ $index === 0 ? 'is-active' : '' }}"
                                        data-size="{{ $size }}"
                                    >{{ $size }}</button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        <div class="pd-label">Quantidade:</div>
                        <div class="pd-qty">
                            <button type="button" id="pd-qty-minus" aria-label="Diminuir quantidade">−</button>
                            <input type="number" name="quantity" id="pd-qty-input" min="1" value="1" required>
                            <button type="button" id="pd-qty-plus" aria-label="Aumentar quantidade">+</button>
                        </div>
                    </div>

                    <button type="submit" class="pd-btn-cart">
                        <i class="bi bi-cart-plus"></i>
                        Adicionar ao Carrinho
                    </button>

                    <a href="{{ route('personalization', ['produto' => $product->title]) }}#pedido-personalizacao" class="pd-btn-personalize">
                        <span class="main">
                            <i class="fa fa-tshirt"></i>
                            Personalizar este Produto
                        </span>
                        <span class="sub">Adicione o logótipo da sua empresa com DTF ou Bordado.</span>
                    </a>
                </form>

                {{-- Trust bar --}}
                <div class="pd-trust">
                    <div class="pd-trust-item">
                        <div class="pd-trust-head">
                            <i class="fa fa-shield-alt"></i>
                            <strong>Pagamento Seguro</strong>
                        </div>
                        <span>Ambiente 100% seguro</span>
                    </div>
                    <div class="pd-trust-item">
                        <div class="pd-trust-head">
                            <i class="fa fa-wallet"></i>
                            <strong>Métodos de Pagamento</strong>
                        </div>
                        <span>MB Way, Multibanco, Visa, Mastercard, etc.</span>
                    </div>
                    <div class="pd-trust-item">
                        <div class="pd-trust-head">
                            <i class="fa fa-truck"></i>
                            <strong>Envio GLS</strong>
                        </div>
                        <span>Entregas rápidas e seguras</span>
                    </div>
                    <div class="pd-trust-item">
                        <div class="pd-trust-head">
                            <i class="fa fa-award"></i>
                            <strong>Portes Grátis</strong>
                        </div>
                        <span>Em compras acima de 80€</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description + Specs --}}
        @if ($product->description || !empty($product->key_features) || !empty($product->technical_specs))
            <section class="pd-section">
                <div class="pd-details-card">
                    @if ($product->description || !empty($product->key_features))
                        <div class="pd-details-top">
                            <div class="pd-section-head">
                                <i class="fa fa-tshirt"></i>
                                <h2>Descrição e Características</h2>
                            </div>
                            <div class="pd-details-body {{ ($product->description && !empty($product->key_features)) ? '' : 'pd-details-body--single' }}">
                                @if ($product->description)
                                    <div class="pd-desc-text">
                                        {!! nl2br(e($product->description)) !!}
                                    </div>
                                @endif
                                @if (!empty($product->key_features))
                                    <ul class="pd-features">
                                        @foreach ($product->key_features as $feature)
                                            @php
                                                $featureText = trim((string) $feature);
                                                $parts = preg_split('/:\s*/', $featureText, 2);
                                            @endphp
                                            <li>
                                                <span class="pd-check"><i class="fa fa-check"></i></span>
                                                <span>
                                                    @if (count($parts) === 2 && filled($parts[0]) && filled($parts[1]))
                                                        <strong>{{ $parts[0] }}:</strong> {{ $parts[1] }}
                                                    @else
                                                        {{ $featureText }}
                                                    @endif
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (!empty($product->technical_specs))
                        <div class="pd-details-bottom">
                            <div class="pd-section-head">
                                <i class="fa fa-shield-alt is-dark"></i>
                                <h2>Especificações Técnicas (Normas)</h2>
                            </div>
                            <div class="pd-specs">
                                @foreach ($product->technical_specs as $row)
                                    @php
                                        $label = trim((string) ($row['label'] ?? ''));
                                        $value = trim((string) ($row['value'] ?? ''));
                                        if ($label !== '' && $value !== '') {
                                            $specText = $label . ' ' . $value;
                                        } else {
                                            $specText = $label !== '' ? $label : $value;
                                        }
                                    @endphp
                                    @if ($specText !== '')
                                        <div class="pd-spec-row">{{ $specText }}</div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        {{-- Related products --}}
        @if ($relatedProducts->isNotEmpty())
            <section class="pd-related">
                <div class="pd-related-head">
                    <h2>Também Pode Gostar</h2>
                    <div class="pd-related-nav d-none d-md-flex">
                        <button type="button" id="pd-related-prev" aria-label="Anterior"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" id="pd-related-next" aria-label="Seguinte"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="pd-related-track" id="pd-related-track">
                    @foreach ($relatedProducts as $rp)
                        @php
                            $rpImg = $rp->cover_image_url ?: asset('img/service-1.jpg');
                            $rpPrice = filled($rp->price)
                                ? number_format((float) $rp->price, 2, ',', '.') . ' € + IVA'
                                : 'Sob consulta';
                        @endphp
                        <article class="pd-card">
                            <a href="{{ route('products.show', $rp) }}" class="pd-card-img">
                                <img src="{{ $rpImg }}" alt="{{ $rp->title }}">
                            </a>
                            <h3 class="pd-card-title">
                                <a href="{{ route('products.show', $rp) }}">{{ $rp->title }}</a>
                            </h3>
                            @if ($rp->subtitle)
                                <div class="pd-card-brand">{{ $rp->subtitle }}</div>
                            @elseif ($rp->category_label)
                                <div class="pd-card-brand">{{ $rp->category_label }}</div>
                            @else
                                <div class="pd-card-brand">&nbsp;</div>
                            @endif
                            <div class="pd-card-footer">
                                <div class="pd-card-price">{{ $rpPrice }}</div>
                                <form method="POST" action="{{ route('cart.items.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $rp->id }}">
                                    <button type="submit" class="pd-card-cart" title="Adicionar ao carrinho" aria-label="Adicionar ao carrinho">
                                        <i class="bi bi-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

{{-- Size guide modal --}}
<div class="modal fade" id="pdSizeGuideModal" tabindex="-1" aria-labelledby="pdSizeGuideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdSizeGuideModalLabel">Guia de tamanhos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Consulte a tabela de tamanhos do fabricante ou contacte-nos para ajudar na escolha do tamanho ideal.</p>
                <p class="mb-0 text-muted small">Em caso de dúvida, a nossa equipa pode aconselhá-lo sobre o tamanho mais adequado ao seu uso.</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('contact') }}" class="btn btn-primary">Falar connosco</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const images = @json($images->map(fn ($img) => asset($img->path))->values());
    let currentIndex = 0;

    const mainImage = document.getElementById('main-product-image');
    const thumbs = Array.from(document.querySelectorAll('.pd-thumb'));
    const zoomWrap = document.getElementById('pd-zoom-wrap');
    const zoomToggle = document.getElementById('pd-zoom-toggle');

    function setImage(index) {
        if (!images.length || !mainImage) return;
        currentIndex = (index + images.length) % images.length;
        mainImage.src = images[currentIndex];
        thumbs.forEach((thumb, i) => {
            thumb.classList.toggle('is-active', i === currentIndex);
        });
    }

    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            setImage(Number(thumb.dataset.index || 0));
        });
    });

    const prevBtn = document.getElementById('pd-prev');
    const nextBtn = document.getElementById('pd-next');
    if (prevBtn) prevBtn.addEventListener('click', () => setImage(currentIndex - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => setImage(currentIndex + 1));

    if (zoomWrap && mainImage) {
        let zoomEnabled = false;

        zoomWrap.addEventListener('mousemove', function (event) {
            if (!zoomEnabled) return;
            const rect = zoomWrap.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width) * 100;
            const y = ((event.clientY - rect.top) / rect.height) * 100;
            mainImage.style.transformOrigin = x + '% ' + y + '%';
            mainImage.style.transform = 'scale(2)';
        });

        zoomWrap.addEventListener('mouseleave', function () {
            mainImage.style.transformOrigin = 'center center';
            mainImage.style.transform = 'scale(1)';
        });

        if (zoomToggle) {
            zoomToggle.addEventListener('click', function () {
                zoomEnabled = !zoomEnabled;
                zoomWrap.style.cursor = zoomEnabled ? 'zoom-in' : 'default';
                if (!zoomEnabled) {
                    mainImage.style.transform = 'scale(1)';
                }
            });
        }

        zoomWrap.addEventListener('click', function (e) {
            if (e.target.closest('.pd-nav-btn') || e.target.closest('.pd-zoom-btn') || e.target.closest('.pd-badge-novo')) {
                return;
            }
            zoomEnabled = !zoomEnabled;
            zoomWrap.style.cursor = zoomEnabled ? 'zoom-in' : 'default';
            if (!zoomEnabled) {
                mainImage.style.transform = 'scale(1)';
            }
        });
    }

    // Color selection
    const colorInput = document.getElementById('pd-selected-color');
    const colorLabel = document.getElementById('pd-color-label');
    const colorBtns = document.querySelectorAll('.pd-color-btn');
    if (colorBtns.length && colorInput) {
        colorInput.value = colorBtns[0].dataset.color || '';
        colorBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                colorBtns.forEach((b) => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                colorInput.value = btn.dataset.color || '';
                if (colorLabel) colorLabel.textContent = btn.dataset.color || '';
            });
        });
    }

    // Size selection
    const sizeInput = document.getElementById('pd-selected-size');
    const sizeBtns = document.querySelectorAll('.pd-size-btn');
    if (sizeBtns.length && sizeInput) {
        sizeInput.value = sizeBtns[0].dataset.size || '';
        sizeBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                sizeBtns.forEach((b) => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                sizeInput.value = btn.dataset.size || '';
            });
        });
    }

    // Quantity
    const qtyInput = document.getElementById('pd-qty-input');
    const qtyMinus = document.getElementById('pd-qty-minus');
    const qtyPlus = document.getElementById('pd-qty-plus');
    if (qtyInput && qtyMinus && qtyPlus) {
        qtyMinus.addEventListener('click', () => {
            const value = Math.max(1, (parseInt(qtyInput.value, 10) || 1) - 1);
            qtyInput.value = value;
        });
        qtyPlus.addEventListener('click', () => {
            const value = Math.max(1, (parseInt(qtyInput.value, 10) || 1) + 1);
            qtyInput.value = value;
        });
    }

    // Related products simple pager (desktop)
    const track = document.getElementById('pd-related-track');
    const relatedPrev = document.getElementById('pd-related-prev');
    const relatedNext = document.getElementById('pd-related-next');
    if (track && relatedPrev && relatedNext) {
        const cards = Array.from(track.children);
        let offset = 0;
        const pageSize = 4;

        function renderRelated() {
            cards.forEach((card, i) => {
                card.style.display = (i >= offset && i < offset + pageSize) ? '' : 'none';
            });
            relatedPrev.disabled = offset <= 0;
            relatedNext.disabled = offset + pageSize >= cards.length;
        }

        if (cards.length > pageSize) {
            relatedPrev.addEventListener('click', () => {
                offset = Math.max(0, offset - pageSize);
                renderRelated();
            });
            relatedNext.addEventListener('click', () => {
                offset = Math.min(Math.max(0, cards.length - pageSize), offset + pageSize);
                renderRelated();
            });
            renderRelated();
        }
    }
})();
</script>
@endpush
