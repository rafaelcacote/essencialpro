@extends('layouts.admin')

@section('title', 'Admin - Novo Parceiro')
@section('page_title', 'Novo Parceiro')
@section('page_subtitle', 'Cadastrar logo para aparecer na home')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Novo Parceiro</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.partners.partials.form', ['partner' => null])
        <button class="btn btn-primary" type="submit">Salvar</button>
    </form>
@endsection

