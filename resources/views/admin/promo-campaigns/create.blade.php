@extends('layouts.admin')

@section('title', 'Admin - Nova Campanha')
@section('page_title', 'Nova Campanha')
@section('page_subtitle', 'Popup promocional com imagem e cupom')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Nova Campanha',
        'subtitle' => 'A imagem aparece num modal quando a campanha está ativa',
        'actions' => '<a href="' . route('admin.promo-campaigns.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.promo-campaigns.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.promo-campaigns.partials.form', ['campaign' => null, 'coupons' => $coupons])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar campanha
            </button>
            <a href="{{ route('admin.promo-campaigns.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
