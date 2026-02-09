@extends('layouts.admin')

@section('title', 'Admin - Editar Produto')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h3 class="mb-1">Editar Produto</h3>
            <div class="text-muted">
                Página pública: <a href="{{ url('/product/' . $product->slug) }}" target="_blank">{{ url('/product/' . $product->slug) }}</a>
            </div>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.products.partials.form', ['product' => $product])
        <button class="btn btn-primary" type="submit">Salvar alterações</button>
    </form>
@endsection

