@php
    $currentCategory = request()->route('category');
    $isCategoryActive = request()->routeIs('categories.show');
    $depth = $depth ?? 0;

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
<ul class="nav-tree__list {{ $depth === 0 ? 'nav-tree__list--root' : '' }}" data-depth="{{ $depth }}">
    @foreach($items as $category)
        @php
            $children = $category->children->where('is_active', true)->sortBy('sort_order');
            $hasChildren = $children->isNotEmpty();
            $isActive = nav_tree_is_active($category, $currentCategory, $isCategoryActive);
        @endphp
        <li class="nav-tree__item {{ $hasChildren ? 'nav-tree__item--has-children' : '' }} {{ $isActive ? 'nav-tree__item--active' : '' }}" data-id="{{ $category->id }}">
            <a href="{{ route('categories.show', $category->slug) }}" class="nav-tree__link {{ $isActive ? 'nav-tree__link--active' : '' }}">
                <span class="nav-tree__label">{{ $category->name }}</span>
                @if($category->description)
                    <span class="nav-tree__desc">{{ Str::limit($category->description, 50) }}</span>
                @endif
            </a>
            @if($hasChildren)
                <span class="nav-tree__toggle" aria-hidden="true"></span>
                @include('components.navbar-menu-tree', ['items' => $children, 'depth' => $depth + 1])
            @endif
        </li>
    @endforeach
</ul>
