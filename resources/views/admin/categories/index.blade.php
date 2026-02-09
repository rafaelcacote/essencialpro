@extends('layouts.admin')

@section('title', 'Admin - Categorias')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Categorias</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova categoria
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($categories->isEmpty())
                <div class="text-center py-4 text-muted">
                    Nenhuma categoria cadastrada ainda.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nome</th>
                                <th>Slug</th>
                                <th>Categoria Pai</th>
                                <th>Produtos</th>
                                <th>Ordem</th>
                                <th>Status</th>
                                <th style="width: 180px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rootCategories as $category)
                                @include('admin.categories.partials.category-row', ['category' => $category, 'level' => 0])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
