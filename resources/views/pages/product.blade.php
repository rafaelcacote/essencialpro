@extends('layouts.app')

@section('title', $product->title . ' - Essencial Pro')

@section('content')
@include('components.page-header', ['title' => $product->title])

<!-- Product Detail Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Product Images Start -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative h-100">
                    <!-- Main Product Image -->
                    <div class="mb-4">
                        @php
                            $mainImage = $product->images->first();
                            $mainSrc = $mainImage ? asset($mainImage->path) : asset('img/service-1.jpg');
                        @endphp
                        <img id="main-product-image" class="img-fluid w-100 rounded shadow" src="{{ $mainSrc }}" alt="{{ $product->title }}" style="max-height: 500px; object-fit: cover;">
                    </div>
                    <!-- Thumbnail Images -->
                    @if ($product->images->isNotEmpty())
                        <div class="row g-2">
                            @foreach ($product->images as $image)
                                <div class="col-3">
                                    <img class="img-fluid rounded cursor-pointer product-thumb"
                                        src="{{ asset($image->path) }}"
                                        alt="{{ $image->alt ?? $product->title }}"
                                        onclick="changeImage(this.src, this)">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <!-- Product Images End -->

            <!-- Product Info Start -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="h-100">
                    @if ($product->category_label)
                        <p class="fw-medium text-uppercase text-primary mb-2">{{ $product->category_label }}</p>
                    @endif
                    <h1 class="display-5 mb-4">{{ $product->title }}</h1>
                    
                    <!-- Price and SKU -->
                    <div class="mb-4">
                        @if (filled($product->price))
                            <h3 class="text-primary mb-2">R$ {{ number_format((float) $product->price, 2, ',', '.') }}</h3>
                        @else
                            <h3 class="text-primary mb-2">Solicite um Orçamento</h3>
                        @endif
                        @if ($product->code)
                            <p class="text-muted mb-0">Código do Produto: <strong>{{ $product->code }}</strong></p>
                        @endif
                    </div>

                    <!-- Colors -->
                    @if (!empty($product->colors))
                        <div class="mb-4">
                            <h5 class="mb-2">Cores disponíveis</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($product->colors as $color)
                                    <span class="badge bg-light text-dark border border-secondary px-3 py-2">{{ $color }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sizes -->
                    @if (!empty($product->sizes))
                        <div class="mb-4">
                            <h5 class="mb-2">Tamanhos disponíveis</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($product->sizes as $size)
                                    <span class="badge bg-primary px-3 py-2">{{ $size }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    @if ($product->description)
                        <div class="mb-4">
                            <h4 class="mb-3">Descrição do Produto</h4>
                            <p class="mb-0">{!! nl2br(e($product->description)) !!}</p>
                        </div>
                    @endif

                    <!-- Key Features -->
                    @if (!empty($product->key_features))
                        <div class="mb-4">
                            <h4 class="mb-3">Características Principais</h4>
                            <div class="row g-3">
                                @foreach ($product->key_features as $feature)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-check-circle text-primary me-2"></i>
                                            <span>{{ $feature }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Specifications -->
                    @if (!empty($product->technical_specs))
                        <div class="mb-4">
                            <h4 class="mb-3">Especificações Técnicas</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    @foreach ($product->technical_specs as $row)
                                        <tr>
                                            <td><strong>{{ $row['label'] ?? '' }}</strong></td>
                                            <td>{{ $row['value'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- CTA Button -->
                    <div class="d-flex gap-3">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fa fa-envelope me-2"></i>Solicitar Orçamento
                        </a>
                        <a href="{{ route('service') }}" class="btn btn-outline-primary btn-lg px-5 py-3">
                            <i class="fa fa-arrow-left me-2"></i>Voltar para Produtos
                        </a>
                    </div>
                </div>
            </div>
            <!-- Product Info End -->
        </div>
    </div>
</div>
<!-- Product Detail End -->

<!-- Related Products Start -->
@if ($relatedProducts->isNotEmpty())
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fw-medium text-uppercase text-primary mb-2">Produtos Relacionados</p>
                <h1 class="display-5 mb-4">Você Também Pode Gostar</h1>
            </div>
            <div class="row g-4">
                @foreach ($relatedProducts as $rp)
                    @php
                        $img = $rp->cover_image_url ?: asset('img/service-1.jpg');
                        $excerpt = \Illuminate\Support\Str::limit((string) $rp->description, 90);
                    @endphp
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item">
                            <img class="img-fluid" src="{{ $img }}" alt="{{ $rp->title }}">
                            <div class="service-img">
                                <img class="img-fluid" src="{{ $img }}" alt="{{ $rp->title }}">
                            </div>
                            <div class="service-detail">
                                <div class="service-title">
                                    <hr class="w-25">
                                    <h3 class="mb-0">{{ $rp->title }}</h3>
                                    <hr class="w-25">
                                </div>
                                <div class="service-text">
                                    <p class="text-white mb-0">{{ $excerpt }}</p>
                                </div>
                            </div>
                            <a class="btn btn-light" href="{{ route('products.show', $rp) }}">Ver Detalhes</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<!-- Related Products End -->

<script>
function changeImage(src, element) {
    document.getElementById('main-product-image').src = src;
    // Remove active class from all thumbs
    document.querySelectorAll('.product-thumb').forEach(thumb => {
        thumb.classList.remove('border-primary', 'border-3');
    });
    // Add active class to clicked thumb
    element.classList.add('border-primary', 'border-3');
}

document.querySelectorAll('.product-thumb').forEach(thumb => {
    thumb.style.cursor = 'pointer';
    thumb.classList.add('border', 'border-2');
    thumb.addEventListener('mouseenter', function() {
        this.style.opacity = '0.8';
    });
    thumb.addEventListener('mouseleave', function() {
        this.style.opacity = '1';
    });
});

const thumbs = document.querySelectorAll('.product-thumb');
if (thumbs.length > 0) {
    thumbs[0].classList.add('border-primary', 'border-3');
}
</script>

<style>
.product-thumb {
    transition: all 0.3s ease;
}

.product-thumb:hover {
    transform: scale(1.05);
}
</style>
@endsection

