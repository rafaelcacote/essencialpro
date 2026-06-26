@extends('layouts.admin')

@section('title', 'Admin - Editar Produto')
@section('page_title', 'Editar Produto')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Editar Produto',
        'meta' => 'Página pública: <a href="' . url('/product/' . $product->slug) . '" target="_blank">' . url('/product/' . $product->slug) . '</a>',
        'actions' => '<a href="' . route('admin.products.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products.partials.form', ['product' => $product])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar alterações
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
