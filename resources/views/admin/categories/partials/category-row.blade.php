<tr>
    <td>
        @if ($level > 0)
            <span class="text-muted">{{ str_repeat('— ', $level) }}</span>
        @endif
        <strong>{{ $category->name }}</strong>
    </td>
    <td><code>{{ $category->slug }}</code></td>
    <td>
        @if ($category->parent)
            <span class="badge bg-info">{{ $category->parent->name }}</span>
        @else
            <span class="text-muted">—</span>
        @endif
    </td>
    <td>
        <span class="badge bg-secondary">{{ $category->products_count }}</span>
    </td>
    <td>{{ $category->sort_order }}</td>
    <td>
        @if ($category->is_active)
            <span class="badge bg-success">Ativo</span>
        @else
            <span class="badge bg-secondary">Inativo</span>
        @endif
    </td>
    <td class="text-end">
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit', $category) }}">Editar</a>
        <form class="d-inline" method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Remover esta categoria?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
        </form>
    </td>
</tr>
@foreach ($category->activeChildren->sortBy('sort_order') as $child)
    @include('admin.categories.partials.category-row', ['category' => $child, 'level' => $level + 1])
@endforeach
