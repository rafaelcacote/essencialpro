@extends('layouts.app')

@section('title', 'Pedido Confirmado - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Pedido Confirmado'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-2">Pedido recebido com sucesso!</h4>
                    <p class="mb-3">Numero do pedido: <strong>{{ $order->order_number }}</strong></p>
                    <p class="text-muted">Acompanhe atualizacoes na sua area do cliente.</p>
                    <a href="{{ route('account.orders.show', $order) }}" class="btn btn-primary">Ver pedido</a>
                    <a href="{{ route('product') }}" class="btn btn-outline-secondary">Continuar comprando</a>
                </div>
            </div>
        </div>
    </div>
@endsection
