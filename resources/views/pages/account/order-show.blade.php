@extends('layouts.app')

@section('title', 'Detalhe do Pedido - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Pedido ' . $order->order_number])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Itens</h5>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Variacao</th>
                                            <th>Qtd.</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product_title }}</td>
                                                <td class="small text-muted">
                                                    Cor: {{ $item->selected_color ?: '-' }}<br>
                                                    Tamanho: {{ $item->selected_size ?: '-' }}
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>R$ {{ number_format((float) $item->line_total, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Resumo</h5>
                            <p class="mb-1"><strong>Status:</strong> {{ $order->status }}</p>
                            <p class="mb-1"><strong>Data:</strong> {{ $order->created_at?->format('d/m/Y H:i') }}</p>
                            <p class="mb-1"><strong>Total:</strong> R$ {{ number_format((float) $order->grand_total, 2, ',', '.') }}</p>
                            <hr>
                            <p class="mb-1"><strong>Contato:</strong> {{ $order->contact_name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                            <p class="mb-0"><strong>Telefone:</strong> {{ $order->phone ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
