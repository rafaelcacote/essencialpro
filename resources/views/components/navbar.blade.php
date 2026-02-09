<!-- Navbar Start -->
<nav class="nav-essencial navbar navbar-expand-lg bg-white navbar-light sticky-top py-0 pe-5">
    <a href="{{ route('home') }}" class="navbar-brand ps-5 me-0 d-flex align-items-center bg-white" style="background: white !important;">
        <img src="{{ asset('img/logo_essencial.png') }}" alt="Essencial Pro" class="me-2" style="height: 120px; width: auto; max-width: 300px; object-fit: contain;">
    </a>
    <style>.navbar .navbar-brand::after { display: none !important; }</style>

    <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Abrir menu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto p-4 p-lg-0 align-items-lg-center">
            <li class="nav-item">
                <a href="{{ route('quem-somos') }}" class="nav-link @if (request()->routeIs('quem-somos')) active @endif">Quem Somos</a>
            </li>

            @if(isset($menuCategories) && $menuCategories->isNotEmpty())
                @php
                    $currentCategory = request()->route('category');
                    $isCategoryActive = request()->routeIs('categories.show');
                    if (!function_exists('nav_tree_is_active')) {
                        function nav_tree_is_active($category, $currentCategory, $isCategoryActive) {
                            if (!$isCategoryActive || !$currentCategory) return false;
                            if ($currentCategory->id == $category->id) return true;
                            $parent = $currentCategory->parent;
                            while ($parent) {
                                if ($parent->id == $category->id) return true;
                                $parent = $parent->parent;
                            }
                            return false;
                        }
                    }
                @endphp
                @foreach($menuCategories as $parentCategory)
                    @php
                        $children = $parentCategory->children->where('is_active', true)->sortBy('sort_order');
                        $hasChildren = $children->isNotEmpty();
                        $isActive = nav_tree_is_active($parentCategory, $currentCategory, $isCategoryActive);
                    @endphp
                    @if($hasChildren)
                        <li class="nav-item nav-tree-trigger" data-nav-tree-trigger>
                            <a href="{{ route('categories.show', $parentCategory->slug) }}" class="nav-link dropdown-toggle {{ $isActive ? 'active' : '' }}">
                                {{ $parentCategory->name }}
                            </a>
                            <div class="nav-tree-panel" data-nav-tree-panel aria-hidden="true">
                                <div class="nav-tree-panel__inner">
                                    <a href="{{ route('categories.show', $parentCategory->slug) }}" class="nav-tree__link nav-tree__link--all d-lg-none">
                                        <span class="nav-tree__label">Ver todos em {{ $parentCategory->name }}</span>
                                    </a>
                                    @include('components.navbar-menu-tree', ['items' => $children, 'depth' => 0])
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('categories.show', $parentCategory->slug) }}" class="nav-link @if($isCategoryActive && $currentCategory && $currentCategory->id == $parentCategory->id) active @endif">
                                {{ $parentCategory->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <a href="{{ route('contact') }}" class="btn btn-primary px-3 d-none d-lg-block ms-lg-2">Solicitar Orçamento</a>
    </div>
</nav>
<!-- Navbar End -->
