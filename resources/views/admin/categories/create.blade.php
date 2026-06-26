@extends('layouts.admin')

@section('title', 'Admin - Nova Categoria')
@section('page_title', 'Nova Categoria')
@section('page_subtitle', 'Criar categoria no catálogo')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Nova Categoria',
        'subtitle' => 'Organize seus produtos em categorias',
        'actions' => '<a href="' . route('admin.categories.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        @include('admin.categories.partials.form', ['category' => null])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar categoria
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
