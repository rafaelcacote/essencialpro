@extends('layouts.admin')

@section('title', 'Admin - Editar Categoria')
@section('page_title', 'Editar Categoria')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Editar Categoria',
        'subtitle' => $category->name,
        'actions' => '<a href="' . route('admin.categories.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        @include('admin.categories.partials.form', ['category' => $category])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar alterações
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
