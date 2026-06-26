@extends('layouts.admin')

@section('title', 'Admin - Produtos')
@section('page_title', 'Produtos')
@section('page_subtitle', 'Gerenciar catálogo de produtos')

@section('content')
    @php
        $subtitle = $products->total() > 0
            ? 'Mostrando ' . $products->firstItem() . ' a ' . $products->lastItem() . ' de ' . $products->total() . ' produtos'
            : 'Nenhum produto cadastrado';
        $actions = '<a href="' . route('admin.products.create') . '" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo produto</a>';
    @endphp

    @include('admin.partials.page-header', [
        'title' => 'Produtos',
        'subtitle' => $subtitle,
        'actions' => $actions,
    ])

    <div class="admin-card admin-filter-bar">
        <div class="admin-card-body">
            <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Buscar</label>
                    <input type="text" name="q" class="form-control" placeholder="Título, código ou slug..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Categoria</label>
                    <select name="category_id" class="form-select">
                        <option value="">Todas as categorias</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Todos</option>
                        <option value="active" @selected(request('status') === 'active')>Ativos</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inativos</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Imagem</th>
                        <th>Título</th>
                        <th>Código</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th style="width: 120px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @if ($product->cover_image_url)
                                    <img src="{{ $product->cover_image_url }}" alt="{{ $product->title }}" class="admin-table-img">
                                @else
                                    <div class="admin-table-img-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td><span class="fw-semibold">{{ $product->title }}</span></td>
                            <td class="text-muted">{{ $product->code ?? '—' }}</td>
                            <td><code>{{ $product->slug }}</code></td>
                            <td>
                                @if ($product->is_active)
                                    <span class="admin-badge admin-badge--success"><i class="bi bi-check-circle"></i> Ativo</span>
                                @else
                                    <span class="admin-badge admin-badge--secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary admin-btn-icon" href="{{ route('admin.products.edit', $product) }}" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.products.destroy', $product) }}"
                                          class="admin-delete-form"
                                          data-confirm-title="Excluir produto"
                                          data-confirm-message="Tem certeza que deseja remover este produto do catálogo?"
                                          data-confirm-item="{{ $product->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger admin-btn-icon" type="submit" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-empty">
                                <i class="bi bi-bag"></i>
                                <div class="fw-semibold mb-1">Nenhum produto cadastrado</div>
                                <div class="small">Comece adicionando seu primeiro produto ao catálogo.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($products->hasPages())
        <div class="admin-pagination">
            {{ $products->links() }}
        </div>
    @endif
@endsection
