@extends('layouts.admin')

@section('title', 'Admin - Novo Parceiro')
@section('page_title', 'Novo Parceiro')
@section('page_subtitle', 'Cadastrar logo para aparecer na home')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Novo Parceiro',
        'subtitle' => 'Adicione um logo de parceiro para a home',
        'actions' => '<a href="' . route('admin.partners.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.partners.partials.form', ['partner' => null])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar parceiro
            </button>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
