@extends('layouts.admin')

@section('title', 'Admin - Nova Categoria')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Nova Categoria</h3>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        @include('admin.categories.partials.form', ['category' => null])
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
@endsection
