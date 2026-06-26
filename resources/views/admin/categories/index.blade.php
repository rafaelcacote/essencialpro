@extends('layouts.admin')

@section('title', 'Admin - Categorias')
@section('page_title', 'Categorias')
@section('page_subtitle', 'Organizar estrutura do catálogo')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Categorias',
        'subtitle' => $categories->count() . ' categorias cadastradas',
        'actions' => '<a href="' . route('admin.categories.create') . '" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nova categoria</a>',
    ])

    <div class="admin-card">
        @if ($categories->isEmpty())
            <div class="admin-empty">
                <div class="admin-empty__icon"><i class="bi bi-folder"></i></div>
                <div class="admin-empty__title">Nenhuma categoria cadastrada</div>
                <p class="admin-empty__text">Crie categorias para organizar seus produtos.</p>
            </div>
        @else
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Slug</th>
                            <th>Categoria Pai</th>
                            <th>Produtos</th>
                            <th>Ordem</th>
                            <th>Status</th>
                            <th style="width: 160px;"></th>
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
@endsection
