@extends('layouts.app')

@section('title', 'Meus Pedidos - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Meus Pedidos'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    @if ($orders->isEmpty())
                        <div class="text-muted">Nenhum pedido encontrado.</div>
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
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                                            <td>{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                                            <td>R$ {{ number_format((float) $order->grand_total, 2, ',', '.') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('account.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $orders->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
