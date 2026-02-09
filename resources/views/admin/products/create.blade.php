@extends('layouts.admin')

@section('title', 'Admin - Novo Produto')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Novo Produto</h3>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products.partials.form', ['product' => null])
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
@endsection

