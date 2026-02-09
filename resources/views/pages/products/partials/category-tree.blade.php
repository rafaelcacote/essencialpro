@php
    $level = $level ?? 0;
@endphp

@foreach ($categories as $category)
    @php
        $isActive = ($selectedSlug ?? null) === $category->slug;
        $link = ($useQuery ?? false)
            ? route($baseRoute, ['category' => $category->slug])
            : route($baseRoute, $category->slug);
    @endphp
    <div class="category-item" style="margin-left: {{ $level * 12 }}px;">
        <a href="{{ $link }}"
           class="category-link {{ $isActive ? 'active' : '' }}">
            <span class="category-name">{{ $category->name }}</span>
            <span class="category-count">({{ $category->products_count }})</span>
        </a>
    </div>
    @if (!empty($category->children_tree) && $category->children_tree->count() > 0)
        @include('pages.products.partials.category-tree', [
            'categories' => $category->children_tree,
            'selectedSlug' => $selectedSlug ?? null,
            'baseRoute' => $baseRoute,
            'useQuery' => $useQuery ?? false,
            'level' => $level + 1,
        ])
    @endif
@endforeach
