@extends('layouts.admin')

@section('title', 'Admin - Novo Cupom')
@section('page_title', 'Novo Cupom')
@section('page_subtitle', 'Criar código de desconto')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Novo Cupom',
        'subtitle' => 'Defina o código, valor e regras de utilização',
        'actions' => '<a href="' . route('admin.coupons.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <form method="POST" action="{{ route('admin.coupons.store') }}">
        @csrf
        @include('admin.coupons.partials.form', ['coupon' => null])
        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-check-lg"></i> Salvar cupom
            </button>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
