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
        <nav class="site-header-topbar" aria-label="Links rápidos">
            <a href="{{ route('quem-somos') }}" class="site-header-quicklink @if(request()->routeIs('quem-somos', 'about')) is-active @endif">Sobre Nós</a>
            <span class="site-header-quicksep" aria-hidden="true"></span>
            <a href="{{ route('contact') }}" class="site-header-quicklink @if(request()->routeIs('contact')) is-active @endif">Contactos</a>
            <a href="{{ route('quote') }}" class="site-header-cta">
                Pedir Orçamento <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </nav>

        <div class="site-header-inner">
            <a href="{{ route('home') }}" class="site-header-brand">
                <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro">
            </a>

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

    <div class="site-header-mobile d-lg-none">
        <nav class="site-header-mobile-topbar" aria-label="Links rápidos">
            <a href="{{ route('quem-somos') }}" class="site-header-mobile-quicklink @if(request()->routeIs('quem-somos', 'about')) is-active @endif">Sobre Nós</a>
            <span class="site-header-mobile-quicksep" aria-hidden="true"></span>
            <a href="{{ route('contact') }}" class="site-header-mobile-quicklink @if(request()->routeIs('contact')) is-active @endif">Contactos</a>
            <a href="{{ route('quote') }}" class="site-header-mobile-cta">
                Pedir Orçamento <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </a>
        </nav>

        <div class="site-header-mobile-bar">
            <a href="{{ route('home') }}" class="site-header-mobile-brand">
                <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro">
            </a>

            <div class="site-header-mobile-actions">
                <a href="{{ route('search') }}" class="site-header-mobile-icon @if(request()->routeIs('search')) is-active @endif" aria-label="Procurar">
                    <i class="bi bi-search" aria-hidden="true"></i>
                </a>
                <a href="https://wa.me/{{ $whatsappNumber }}" class="site-header-mobile-icon site-header-mobile-icon--whatsapp" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                    <i class="bi bi-whatsapp" aria-hidden="true"></i>
                </a>
                <a href="{{ route('cart.show') }}" class="site-header-mobile-icon site-header-mobile-icon--cart @if(request()->routeIs('cart.*')) is-active @endif" aria-label="Carrinho">
                    <i class="bi bi-cart3" aria-hidden="true"></i>
                    <span class="site-header-mobile-icon-badge">{{ $cartCount ?? 0 }}</span>
                </a>
                <button type="button"
                        class="site-header-mobile-toggle"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse"
                        aria-controls="navbarCollapse"
                        aria-expanded="false"
                        aria-label="Abrir menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <div class="collapse site-header-mobile-menu" id="navbarCollapse">
            <div class="site-header-mobile-menu-inner">
                <p class="site-header-mobile-menu-label">Categorias</p>
                <ul class="site-header-mobile-nav">
                    @if(isset($menuCategories) && $menuCategories->isNotEmpty())
                        @foreach($menuCategories as $parentCategory)
                            <li>
                                <a href="{{ route('categories.show', $parentCategory->slug) }}" class="site-header-mobile-nav-link @if(nav_tree_is_active($parentCategory, $currentCategory, $isCategoryActive)) is-active @endif">
                                    {{ $parentCategory->name }}
                                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    @else
                        @foreach($categoryPlaceholders as $category)
                            <li>
                                <a href="{{ route('category.placeholder', $category['slug']) }}" class="site-header-mobile-nav-link @if(request()->routeIs('category.placeholder') && request()->route('slug') === $category['slug']) is-active @endif">
                                    {{ $category['name'] }}
                                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <p class="site-header-mobile-menu-label">Minha Conta</p>
                <ul class="site-header-mobile-nav">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="site-header-mobile-nav-link @if(request()->routeIs('login')) is-active @endif">
                                Entrar
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="site-header-mobile-nav-link @if(request()->routeIs('register')) is-active @endif">
                                Criar Conta
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </a>
                        </li>
                    @else
                        <li>
                            <span class="site-header-mobile-user">Olá, {{ auth()->user()->name }}</span>
                        </li>
                    @endguest
                    <li>
                        <a href="{{ route('account.orders') }}" class="site-header-mobile-nav-link @if(request()->routeIs('account.orders*', 'dashboard')) is-active @endif">
                            Meus Pedidos
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.track') }}" class="site-header-mobile-nav-link @if(request()->routeIs('orders.track')) is-active @endif">
                            Acompanhar Pedido
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('wishlist') }}" class="site-header-mobile-nav-link @if(request()->routeIs('wishlist')) is-active @endif">
                            Lista de Desejos
                            <i class="bi bi-chevron-right" aria-hidden="true"></i>
                        </a>
                    </li>
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="site-header-mobile-nav-link site-header-mobile-nav-link--button">
                                    Sair
                                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Navbar End -->
