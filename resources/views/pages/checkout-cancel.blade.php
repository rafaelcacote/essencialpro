@extends('layouts.app')

@section('title', 'Pagamento Cancelado - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Pagamento Cancelado'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5 text-center">

                            <div class="mb-4">
                                <i class="fa fa-ban fa-4x text-secondary"></i>
                            </div>
                            <h4 class="mb-2">Pagamento cancelado</h4>
                            <p class="text-muted mb-1">
                                Cancelou o pagamento do pedido <strong>{{ $order->order_number }}</strong>.
                            </p>
                            <p class="text-muted mb-4">
                                O seu pedido foi guardado. Pode retomar o pagamento a qualquer momento.
                            </p>

                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('checkout.create') }}" class="btn btn-primary">
                                    Retomar pagamento
                                </a>
                                <a href="{{ route('product') }}" class="btn btn-outline-secondary">
                                    Continuar a comprar
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
