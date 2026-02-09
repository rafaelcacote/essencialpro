@extends('layouts.admin')

@section('title', 'Admin - Produtos')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h3 class="mb-0">Produtos</h3>
            @if ($products->total() > 0)
                <small class="text-muted">
                    Mostrando {{ $products->firstItem() }} a {{ $products->lastItem() }} de {{ $products->total() }} produtos
                </small>
            @endif
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Novo produto
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small text-muted">Buscar</label>
                    <input type="text" name="q" class="form-control" placeholder="Título, código ou slug..." value="{{ request('q') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label small text-muted">Categoria</label>
                    <select name="category_id" class="form-select">
                        <option value="">— Todas —</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Status</label>
                    <select name="status" class="form-select">
                        <option value="">— Todos —</option>
                        <option value="active" @selected(request('status') === 'active')>Ativos</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inativos</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search me-1"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 80px;">Imagem</th>
                        <th>Título</th>
                        <th>Código</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th style="width: 180px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @if ($product->cover_image_url)
                                    <img src="{{ $product->cover_image_url }}" alt="{{ $product->title }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 4px;">
                                        <i class="fa fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-medium">{{ $product->title }}</td>
                            <td>{{ $product->code ?? '—' }}</td>
                            <td><code>{{ $product->slug }}</code></td>
                            <td>
                                @if ($product->is_active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product) }}" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form class="d-inline" method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Remover este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" title="Excluir">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Nenhum produto cadastrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($products->hasPages())
        <div class="mt-3 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif
@endsection

