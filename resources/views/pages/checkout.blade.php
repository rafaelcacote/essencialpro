@extends('layouts.app')

@section('title', 'Checkout - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Finalizar Pedido'])

    <div class="container-xxl py-5">
        <div class="container">
            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="mb-3">Dados do comprador</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nome</label>
                                        <input class="form-control" name="contact_name" value="{{ old('contact_name', auth()->user()->name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Telefone</label>
                                        <input class="form-control" name="phone" value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Empresa</label>
                                        <input class="form-control" name="company_name" value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIF/Contribuinte</label>
                                        <input class="form-control" name="tax_id" value="{{ old('tax_id') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pais</label>
                                        <input class="form-control" name="country" value="{{ old('country', 'Brasil') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Endereco</label>
                                        <input class="form-control" name="address" value="{{ old('address') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">CEP</label>
                                        <input class="form-control" name="postal_code" value="{{ old('postal_code') }}">
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Cidade</label>
                                        <input class="form-control" name="city" value="{{ old('city') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Observacoes</label>
                                        <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @php
                            $subtotal = $cart->items->sum(fn ($item) => ((float) ($item->product?->price ?? 0)) * $item->quantity);
                        @endphp
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3">Resumo do pedido</h5>
                                @foreach ($cart->items as $item)
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span>{{ $item->product?->title }} x {{ $item->quantity }}</span>
                                        <span>R$ {{ number_format(((float) ($item->product?->price ?? 0)) * $item->quantity, 2, ',', '.') }}</span>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Total</strong>
                                    <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Confirmar pedido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
