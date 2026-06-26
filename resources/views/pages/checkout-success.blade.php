@extends('layouts.app')

@section('title', 'Pedido Confirmado - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Pedido Recebido'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5 text-center">

                            @if($order->payment_status === 'paid')
                                <div class="mb-4">
                                    <i class="fa fa-check-circle fa-4x text-success"></i>
                                </div>
                                <h4 class="mb-2 text-success">Pagamento confirmado!</h4>
                                <p class="text-muted mb-1">O seu pedido foi pago e está a ser processado.</p>
                            @else
                                <div class="mb-4">
                                    <i class="fa fa-clock fa-4x text-warning"></i>
                                </div>
                                <h4 class="mb-2">Pedido recebido!</h4>
                                <p class="text-muted mb-1">O pagamento está a ser processado. Receberá uma confirmação assim que for validado.</p>
                            @endif

                            <p class="mb-4">
                                Número do pedido: <strong>{{ $order->order_number }}</strong>
                            </p>

                            @if($order->items->isNotEmpty())
                                <div class="table-responsive mb-4 text-start">
                                    <table class="table table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Produto</th>
                                                <th class="text-center">Qtd.</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->product_title }}
                                                        @if($item->selected_color)
                                                            <small class="text-muted d-block">Cor: {{ $item->selected_color }}</small>
                                                        @endif
                                                        @if($item->selected_size)
                                                            <small class="text-muted d-block">Tamanho: {{ $item->selected_size }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-end">{{ number_format($item->line_total, 2, ',', '.') }} €</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-end">Total</th>
                                                <th class="text-end">{{ number_format($order->grand_total, 2, ',', '.') }} €</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endif

                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('account.orders.show', $order) }}" class="btn btn-primary">
                                    Ver detalhes do pedido
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
