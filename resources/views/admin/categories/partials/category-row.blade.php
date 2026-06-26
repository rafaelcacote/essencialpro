<tr>
    <td>
        @if ($level > 0)
            <span class="text-muted" style="opacity: 0.5;">{{ str_repeat('└ ', $level) }}</span>
        @endif
        <span class="fw-semibold">{{ $category->name }}</span>
    </td>
    <td><code>{{ $category->slug }}</code></td>
    <td>
        @if ($category->parent)
            <span class="admin-badge admin-badge--info">{{ $category->parent->name }}</span>
        @else
            <span class="text-muted">—</span>
        @endif
    </td>
    <td>
        <span class="admin-badge admin-badge--secondary">{{ $category->products_count }}</span>
    </td>
    <td class="text-muted">{{ $category->sort_order }}</td>
    <td>
        @if ($category->is_active)
            <span class="admin-badge admin-badge--success">Ativo</span>
        @else
            <span class="admin-badge admin-badge--secondary">Inativo</span>
        @endif
    </td>
    <td class="text-end">
        <div class="admin-actions">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit', $category) }}">
                <i class="bi bi-pencil"></i> Editar
            </a>
            <form method="POST"
                  action="{{ route('admin.categories.destroy', $category) }}"
                  class="admin-delete-form"
                  data-confirm-title="Excluir categoria"
                  data-confirm-message="Tem certeza que deseja remover esta categoria?"
                  data-confirm-item="{{ $category->name }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger admin-btn-icon" type="submit" title="Excluir">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
@foreach ($category->activeChildren->sortBy('sort_order') as $child)
    @include('admin.categories.partials.category-row', ['category' => $child, 'level' => $level + 1])
@endforeach
