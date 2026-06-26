@extends('layouts.admin')

@section('title', 'Admin - Editar Parceiro')
@section('page_title', 'Editar Parceiro')
@section('page_subtitle', 'Atualizar logo, link e ordem')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Editar Parceiro',
        'subtitle' => $partner->name,
        'actions' => '<a href="' . route('admin.partners.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.partners.partials.form', ['partner' => $partner])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar alterações
            </button>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
