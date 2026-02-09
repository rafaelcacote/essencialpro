@extends('layouts.admin')

@section('title', 'Admin - Editar Categoria')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Editar Categoria</h3>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        @include('admin.categories.partials.form', ['category' => $category])
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
@endsection
