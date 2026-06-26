@extends('layouts.app')

@section('title', 'Pagamento Falhado - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Pagamento Falhado'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5 text-center">

                            <div class="mb-4">
                                <i class="fa fa-times-circle fa-4x text-danger"></i>
                            </div>
                            <h4 class="mb-2 text-danger">Pagamento não concluído</h4>
                            <p class="text-muted mb-1">
                                O pagamento do pedido <strong>{{ $order->order_number }}</strong> não foi processado com sucesso.
                            </p>
                            <p class="text-muted mb-4">
                                O seu pedido está guardado. Pode tentar pagar novamente ou entrar em contacto connosco.
                            </p>

                            @if(session('error'))
                                <div class="alert alert-warning text-start">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('checkout.create') }}" class="btn btn-primary">
                                    Tentar novamente
                                </a>
                                <a href="{{ route('account.orders.show', $order) }}" class="btn btn-outline-secondary">
                                    Ver pedido
                                </a>
                                <a href="{{ route('contact') }}" class="btn btn-outline-secondary">
                                    Contactar suporte
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
