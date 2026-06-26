@extends('layouts.admin')

@section('title', 'Admin - Novo Produto')
@section('page_title', 'Novo Produto')
@section('page_subtitle', 'Adicionar produto ao catálogo')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Novo Produto',
        'subtitle' => 'Preencha os dados para cadastrar um novo produto',
        'actions' => '<a href="' . route('admin.products.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products.partials.form', ['product' => null])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar produto
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
