@extends('layouts.admin')

@section('title', 'Admin - Editar Cupom')
@section('page_title', 'Editar Cupom')
@section('page_subtitle', 'Atualizar código e regras')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Editar Cupom',
        'subtitle' => $coupon->code,
        'actions' => '<a href="' . route('admin.coupons.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
        @csrf
        @method('PUT')
        @include('admin.coupons.partials.form', ['coupon' => $coupon])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar alterações
            </button>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
