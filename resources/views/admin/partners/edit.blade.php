@extends('layouts.admin')

@section('title', 'Admin - Editar Parceiro')
@section('page_title', 'Editar Parceiro')
@section('page_subtitle', 'Atualizar logo, link e ordem')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Editar Parceiro</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.partners.partials.form', ['partner' => $partner])
        <button class="btn btn-primary" type="submit">Salvar alterações</button>
    </form>
@endsection

