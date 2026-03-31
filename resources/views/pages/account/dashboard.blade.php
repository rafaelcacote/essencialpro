@extends('layouts.app')

@section('title', 'Minha Conta - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Minha Conta'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Ola, {{ auth()->user()->name }}</h4>
                <a href="{{ route('account.orders') }}" class="btn btn-primary">Ver pedidos</a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Pedidos recentes</h5>
                    @if ($latestOrders->isEmpty())
                        <div class="text-muted">Voce ainda nao tem pedidos.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Pedido</th>
                                        <th>Status</th>
                                        <th>Data</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestOrders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                                            <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                                            <td>R$ {{ number_format((float) $order->grand_total, 2, ',', '.') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('account.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Detalhes</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
