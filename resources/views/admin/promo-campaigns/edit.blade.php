@extends('layouts.admin')

@section('title', 'Admin - Editar Campanha')
@section('page_title', 'Editar Campanha')
@section('page_subtitle', 'Atualizar popup promocional')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Editar Campanha',
        'subtitle' => $campaign->title,
        'actions' => '<a href="' . route('admin.promo-campaigns.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.promo-campaigns.update', $campaign) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.promo-campaigns.partials.form', ['campaign' => $campaign, 'coupons' => $coupons])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar alterações
            </button>
            <a href="{{ route('admin.promo-campaigns.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
