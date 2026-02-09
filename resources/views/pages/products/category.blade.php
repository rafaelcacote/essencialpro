@extends('layouts.app')

@section('title', $category->name . ' - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => $category->name])

    @if($category->description)
        <div class="container-xxl py-3">
            <div class="container">
                <div class="alert alert-light border">
                    <p class="mb-0">{{ $category->description }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container-xxl py-5">
        <div class="container">
            @if($category->parent)
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.show', $category->parent->slug) }}">{{ $category->parent->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>
            @endif

            <div class="row">
                <!-- Sidebar de Filtros -->
                <div class="col-lg-3 mb-4">
                    <div class="product-filters-sidebar">
                        <!-- Categorias -->
                        <div class="filter-section mb-4">
                            <h5 class="filter-title mb-3">Categorias</h5>
                            <div class="category-list">
                                <div class="category-item">
                                    <a href="{{ route('product') }}"
                                       class="category-link">
                                        <span class="category-name">Todas as Categorias</span>
                                    </a>
                                </div>
                                @include('pages.products.partials.category-tree', [
                                    'categories' => $categoryTree,
                                    'selectedSlug' => $category->slug,
                                    'baseRoute' => 'categories.show',
                                    'useQuery' => false,
                                ])
                            </div>
                        </div>

                        <!-- Filtro de Preço -->
                        <div class="filter-section mb-4">
                            <h5 class="filter-title mb-3">Preço</h5>
                            <form id="priceFilterForm" method="GET" action="{{ route('categories.show', $category->slug) }}">
                                @if(request('sort'))
                                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif
                                <div class="price-range-container">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>€<span id="minPriceDisplay">{{ request('min_price', $minPrice) }}</span></span>
                                        <span>€<span id="maxPriceDisplay">{{ request('max_price', $maxPrice) }}</span></span>
                                    </div>
                                    <div class="price-slider-wrapper">
                                        <input type="range" class="form-range" id="minPrice" name="min_price" 
                                               min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" 
                                               value="{{ request('min_price', floor($minPrice)) }}" step="1">
                                        <input type="range" class="form-range" id="maxPrice" name="max_price" 
                                               min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" 
                                               value="{{ request('max_price', ceil($maxPrice)) }}" step="1">
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-3">Filtrar</button>
                                </div>
                            </form>
                        </div>

                        <!-- Outros Filtros (placeholder) -->
                        <div class="filter-section mb-4">
                            <h5 class="filter-title mb-3">Filtrar por</h5>
                            <select class="form-select">
                                <option>Qualquer Cor</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Área Principal de Produtos -->
                <div class="col-lg-9">
                    <!-- Controles Superiores -->
                    <div class="product-controls mb-4">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <!-- Visualização Grid/Lista -->
                            <div class="view-toggle">
                                <button type="button" class="btn btn-sm view-btn active" data-view="grid" title="Visualização em Grade">
                                    <i class="bi bi-grid"></i>
                                </button>
                                <button type="button" class="btn btn-sm view-btn" data-view="list" title="Visualização em Lista">
                                    <i class="bi bi-list"></i>
                                </button>
                            </div>

                            <!-- Ordenação -->
                            <div class="sort-control">
                                <form method="GET" action="{{ route('categories.show', $category->slug) }}" id="sortForm">
                                    @if(request('min_price'))
                                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                    @endif
                                    @if(request('max_price'))
                                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                    @endif
                                    <select name="sort" class="form-select form-select-sm" id="sortSelect" style="width: auto;">
                                        <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Ordenar por popularidade</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Preço: menor para maior</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Preço: maior para menor</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nome: A-Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nome: Z-A</option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mais recentes</option>
                                    </select>
                                </form>
                            </div>

                            <!-- Contador de Resultados -->
                            <div class="results-count">
                                <span class="text-muted">
                                    A mostrar {{ $products->firstItem() }}-{{ $products->lastItem() }} de {{ $products->total() }} resultados
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de Produtos -->
                    <div id="productsGrid" class="row g-4 products-grid-view">
                        @forelse ($products as $product)
                            @php
                                $img = $product->cover_image_url ?: asset('img/service-1.jpg');
                                $name = mb_strtoupper($product->title);
                                $priceText = filled($product->price)
                                    ? '€' . number_format((float) $product->price, 2, ',', '.') . ' + IVA'
                                    : 'Solicite orçamento';
                            @endphp

                            <div class="col-md-6 col-lg-4 product-item">
                                <div class="card shadow-sm h-100 border-0 product-grid-card">
                                    <div class="p-3">
                                        <div class="product-grid-thumb">
                                            <a href="{{ route('products.show', $product) }}">
                                                <img class="img-fluid" src="{{ $img }}" alt="{{ $product->title }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 text-center">
                                        <div class="product-grid-title">
                                            <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                                {{ $name }}
                                            </a>
                                        </div>
                                        <div class="product-grid-price">{{ $priceText }}</div>
                                    </div>
                                    <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">
                                        <a class="btn btn-primary w-100 product-grid-btn" href="{{ route('products.show', $product) }}">Ver Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info mb-0 text-center">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Ainda não há produtos cadastrados nesta categoria.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Lista de Produtos (oculta por padrão) -->
                    <div id="productsList" class="products-list-view d-none">
                        @forelse ($products as $product)
                            @php
                                $img = $product->cover_image_url ?: asset('img/service-1.jpg');
                                $name = mb_strtoupper($product->title);
                                $priceText = filled($product->price)
                                    ? '€' . number_format((float) $product->price, 2, ',', '.') . ' + IVA'
                                    : 'Solicite orçamento';
                            @endphp

                            <div class="card shadow-sm mb-3 product-list-card">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <div class="product-list-thumb">
                                            <a href="{{ route('products.show', $product) }}">
                                                <img class="img-fluid" src="{{ $img }}" alt="{{ $product->title }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <h5 class="product-list-title">
                                                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
                                                        {{ $name }}
                                                    </a>
                                                </h5>
                                                @if($product->description)
                                                    <p class="text-muted small mb-2">{{ Str::limit($product->description, 150) }}</p>
                                                @endif
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="product-list-price">{{ $priceText }}</div>
                                                <a class="btn btn-primary product-list-btn" href="{{ route('products.show', $product) }}">Ver Detalhes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info mb-0 text-center">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Ainda não há produtos cadastrados nesta categoria.
                            </div>
                        @endforelse
                    </div>

                    <!-- Paginação -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
/* Sidebar de Filtros */
.product-filters-sidebar {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    position: sticky;
    top: 20px;
}

.filter-title {
    font-weight: 700;
    font-size: 1rem;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.category-list {
    list-style: none;
    padding: 0;
}

.category-item {
    margin-bottom: 0.5rem;
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.75rem;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.category-link:hover {
    background-color: #e9ecef;
    color: var(--primary);
}

.category-link.active {
    background-color: var(--primary);
    color: white;
    font-weight: 600;
}

.category-name {
    flex: 1;
}

.category-count {
    font-size: 0.875rem;
    opacity: 0.7;
    margin-left: 0.5rem;
}

.category-children {
    border-left: 2px solid #dee2e6;
    padding-left: 0.75rem;
}

.price-range-container {
    padding: 0.5rem 0;
}

.price-slider-wrapper {
    position: relative;
    margin: 1rem 0;
}

.price-slider-wrapper input[type="range"] {
    width: 100%;
    margin: 0.5rem 0;
}

/* Controles */
.product-controls {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.view-toggle .view-btn {
    border: 2px solid #dee2e6;
    background: white;
    color: #666;
    padding: 0.5rem 0.75rem;
    margin-right: 0.5rem;
}

.view-toggle .view-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.view-toggle .view-btn.active {
    background: var(--primary);
    border-color: var(--primary);
    color: white;
}

/* Cards de Produtos - Grid */
.product-grid-card {
    border-radius: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-grid-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
}

.product-grid-thumb {
    background: #f4f4f4;
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 8px;
    min-height: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 10px;
}

.product-grid-thumb img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    object-position: center;
    transition: transform 0.3s ease;
}

.product-grid-thumb:hover img {
    transform: scale(1.05);
}

.product-grid-title {
    font-weight: 800;
    font-size: 13px;
    letter-spacing: .4px;
    line-height: 1.25;
    min-height: 34px;
    margin-bottom: 0.5rem;
}

.product-grid-price {
    font-weight: 900;
    color: var(--primary);
    margin-top: 6px;
    font-size: 1.1rem;
}

.product-grid-btn {
    font-weight: 800;
    letter-spacing: .4px;
}

/* Cards de Produtos - Lista */
.product-list-card {
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-list-card:hover {
    transform: translateX(5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
}

.product-list-thumb {
    background: #f4f4f4;
    border-radius: 8px 0 0 8px;
    min-height: 200px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 10px;
}

.product-list-thumb img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    object-position: center;
}

.product-list-title {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.product-list-price {
    font-weight: 900;
    color: var(--primary);
    font-size: 1.2rem;
}

.product-list-btn {
    font-weight: 600;
}

/* Responsividade */
@media (max-width: 991px) {
    .product-filters-sidebar {
        position: relative;
        top: 0;
        margin-bottom: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Alternância entre Grid e Lista
    const viewButtons = document.querySelectorAll('.view-btn');
    const productsGrid = document.getElementById('productsGrid');
    const productsList = document.getElementById('productsList');

    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            viewButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            if (view === 'grid') {
                productsGrid.classList.remove('d-none');
                productsList.classList.add('d-none');
                localStorage.setItem('productView', 'grid');
            } else {
                productsGrid.classList.add('d-none');
                productsList.classList.remove('d-none');
                localStorage.setItem('productView', 'list');
            }
        });
    });

    // Restaurar visualização salva
    const savedView = localStorage.getItem('productView') || 'grid';
    if (savedView === 'list') {
        document.querySelector('[data-view="list"]').click();
    }

    // Ordenação automática ao mudar select
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            document.getElementById('sortForm').submit();
        });
    }

    // Atualizar display de preços no slider
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const minPriceDisplay = document.getElementById('minPriceDisplay');
    const maxPriceDisplay = document.getElementById('maxPriceDisplay');

    if (minPriceInput && minPriceDisplay) {
        minPriceInput.addEventListener('input', function() {
            minPriceDisplay.textContent = this.value;
            if (parseInt(this.value) > parseInt(maxPriceInput.value)) {
                maxPriceInput.value = this.value;
                maxPriceDisplay.textContent = this.value;
            }
        });
    }

    if (maxPriceInput && maxPriceDisplay) {
        maxPriceInput.addEventListener('input', function() {
            maxPriceDisplay.textContent = this.value;
            if (parseInt(this.value) < parseInt(minPriceInput.value)) {
                minPriceInput.value = this.value;
                minPriceDisplay.textContent = this.value;
            }
        });
    }
});
</script>
@endpush
