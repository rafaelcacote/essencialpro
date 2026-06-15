@php
    $whatsappNumber = '351923128006';
    $categoryPlaceholders = [
        ['slug' => 'epis', 'name' => 'EPIs'],
        ['slug' => 'vestuario', 'name' => 'Vestuário'],
        ['slug' => 'calcado', 'name' => 'Calçado'],
        ['slug' => 'acessorios', 'name' => 'Acessórios'],
    ];

    if (!function_exists('nav_tree_is_active')) {
        function nav_tree_is_active($category, $currentCategory, $isCategoryActive) {
            if (!$isCategoryActive || !$currentCategory) {
                return false;
            }
            if ($currentCategory->id == $category->id) {
                return true;
            }
            $parent = $currentCategory->parent;
            while ($parent) {
                if ($parent->id == $category->id) {
                    return true;
                }
                $parent = $parent->parent;
            }
            return false;
        }
    }

    $currentCategory = request()->route('category');
    $isCategoryActive = request()->routeIs('categories.show', 'category.placeholder');
@endphp

<!-- Navbar Start -->
<header class="site-header nav-essencial sticky-top">
    <div class="site-header-main d-none d-lg-block">
        <div class="site-header-inner">
            <a href="{{ route('home') }}" class="site-header-brand">
                <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro">
            </a>

            <div class="site-header-right">
                <nav class="site-header-quicklinks" aria-label="Links rápidos">
                    <a href="{{ route('quem-somos') }}" class="site-header-quicklink @if(request()->routeIs('quem-somos', 'about')) is-active @endif">Sobre Nós</a>
                    <span class="site-header-quicksep" aria-hidden="true"></span>
                    <a href="{{ route('contact') }}" class="site-header-quicklink @if(request()->routeIs('contact')) is-active @endif">Contactos</a>
                    <a href="{{ route('quote') }}" class="site-header-cta">
                        Pedir Orçamento <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </a>
                </nav>

                <div class="site-header-navrow">
                    <nav class="site-header-categories" aria-label="Categorias">
                        @if(isset($menuCategories) && $menuCategories->isNotEmpty())
                            @foreach($menuCategories as $parentCategory)
                                @php
                                    $children = $parentCategory->children->where('is_active', true)->sortBy('sort_order');
                                    $hasChildren = $children->isNotEmpty();
                                    $isActive = nav_tree_is_active($parentCategory, $currentCategory, $isCategoryActive);
                                @endphp
                                <div class="site-header-category @if($hasChildren) nav-tree-trigger @endif" @if($hasChildren) data-nav-tree-trigger @endif>
                                    <a href="{{ route('categories.show', $parentCategory->slug) }}" class="site-header-category-link {{ $isActive ? 'active' : '' }}">
                                        {{ $parentCategory->name }}
                                    </a>
                                    @if($hasChildren)
                                        <div class="nav-tree-panel" data-nav-tree-panel aria-hidden="true">
                                            <div class="nav-tree-panel__inner">
                                                @include('components.navbar-menu-tree', ['items' => $children, 'depth' => 0])
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            @foreach($categoryPlaceholders as $category)
                                <div class="site-header-category">
                                    <a href="{{ route('category.placeholder', $category['slug']) }}" class="site-header-category-link @if(request()->routeIs('category.placeholder') && request()->route('slug') === $category['slug']) active @endif">
                                        {{ $category['name'] }}
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </nav>

                    <span class="site-header-utils-sep" aria-hidden="true"></span>

                    <nav class="site-header-utils" aria-label="Ações">
                        <a href="{{ route('search') }}" class="site-header-util @if(request()->routeIs('search')) is-active @endif">
                            <i class="bi bi-search" aria-hidden="true"></i>
                            <span>Procurar</span>
                        </a>
                        <a href="https://wa.me/{{ $whatsappNumber }}" class="site-header-util site-header-util--whatsapp" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            <span>Whatsapp</span>
                        </a>
                        <div class="site-header-account dropdown">
                            <button type="button"
                                    class="site-header-util site-header-util--account dropdown-toggle"
                                    id="navAccountToggle"
                                    data-bs-toggle="dropdown"
                                    data-bs-auto-close="true"
                                    aria-expanded="false"
                                    aria-label="Minha Conta">
                                <i class="bi bi-person" aria-hidden="true"></i>
                                <span>Minha Conta</span>
                                <i class="bi bi-chevron-up d-none" aria-hidden="true"></i>
                                <i class="bi bi-chevron-down" aria-hidden="true"></i>
                            </button>
                            @include('components.navbar-account-menu')
                        </div>
                        <a href="{{ route('cart.show') }}" class="site-header-util site-header-util--cart @if(request()->routeIs('cart.*')) is-active @endif">
                            <i class="bi bi-cart3" aria-hidden="true"></i>
                            @if (!empty($cartCount))
                                <span class="site-header-util-badge">{{ $cartCount }}</span>
                            @else
                                <span class="site-header-util-badge">0</span>
                            @endif
                            <span>Carrinho</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <nav class="site-header-mobile nav-essencial navbar navbar-expand-lg bg-white navbar-light py-2 px-3">
        <a href="{{ route('home') }}" class="navbar-brand p-0 me-2">
            <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro" style="height: 80px; width: auto; max-width: 260px; object-fit: contain;">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto p-3 p-lg-0">
                <li class="nav-item"><a href="{{ route('quem-somos') }}" class="nav-link">Sobre Nós</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contactos</a></li>
                <li class="nav-item"><a href="{{ route('quote') }}" class="nav-link">Pedir Orçamento</a></li>
                <li class="nav-item"><a href="{{ route('search') }}" class="nav-link">Procurar</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Entrar</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Criar Conta</a></li>
                <li class="nav-item"><a href="{{ route('orders.track') }}" class="nav-link">Acompanhar Pedido</a></li>
                <li class="nav-item"><a href="{{ route('wishlist') }}" class="nav-link">Lista de Desejos</a></li>
                <li class="nav-item"><a href="{{ route('account.orders') }}" class="nav-link">Meus Pedidos</a></li>
                @if(isset($menuCategories) && $menuCategories->isNotEmpty())
                    @foreach($menuCategories as $parentCategory)
                        <li class="nav-item">
                            <a href="{{ route('categories.show', $parentCategory->slug) }}" class="nav-link">{{ $parentCategory->name }}</a>
                        </li>
                    @endforeach
                @else
                    @foreach($categoryPlaceholders as $category)
                        <li class="nav-item">
                            <a href="{{ route('category.placeholder', $category['slug']) }}" class="nav-link">{{ $category['name'] }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="navbar-actions d-flex align-items-center gap-2 pb-3">
                <a href="{{ route('cart.show') }}" class="btn btn-outline-primary position-relative">
                    <i class="bi bi-cart3"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount ?? 0 }}</span>
                </a>
                <a href="https://wa.me/{{ $whatsappNumber }}" class="btn btn-success" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar End -->
