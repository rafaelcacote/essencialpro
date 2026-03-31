@extends('layouts.admin')

@section('title', 'Admin - Pedido ' . $order->order_number)

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h3 class="mb-1">Pedido {{ $order->order_number }}</h3>
            <div class="text-muted">Criado em {{ $order->created_at?->format('d/m/Y H:i') }}</div>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Itens do pedido</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produto</th>
                                    <th>Variacao</th>
                                    <th>Qtd.</th>
                                    <th>Preco unitario</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_title }}</td>
                                        <td>
                                            Cor: {{ $item->selected_color ?: '-' }}<br>
                                            Tamanho: {{ $item->selected_size ?: '-' }}
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>R$ {{ number_format((float) $item->unit_price, 2, ',', '.') }}</td>
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
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Atualizar status</h5>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf
                        @method('PUT')
                        <select class="form-select mb-3" name="status" required>
                            @foreach (['pending','confirmed','processing','shipped','completed','cancelled'] as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary w-100">Salvar</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Cliente</h5>
                    <p class="mb-1"><strong>Nome:</strong> {{ $order->contact_name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                    <p class="mb-1"><strong>Telefone:</strong> {{ $order->phone ?: '-' }}</p>
                    <p class="mb-0"><strong>Total:</strong> R$ {{ number_format((float) $order->grand_total, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
