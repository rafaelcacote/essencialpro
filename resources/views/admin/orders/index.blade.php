@extends('layouts.admin')

@section('title', 'Admin - Pedidos')
@section('page_title', 'Pedidos')
@section('page_subtitle', 'Pedidos realizados no site')

@section('content')
    @php
        $statusLabels = [
            'pending' => 'Pendente',
            'confirmed' => 'Confirmado',
            'processing' => 'Em processamento',
            'shipped' => 'Enviado',
            'completed' => 'Concluído',
            'cancelled' => 'Cancelado',
        ];
    @endphp

    @include('admin.partials.page-header', [
        'title' => 'Pedidos',
        'subtitle' => $orders->total() . ' pedidos encontrados',
        'actions' => '
            <form method="GET" class="d-flex gap-2 align-items-center">
                <input type="text" class="form-control form-control-sm" name="q" placeholder="Buscar..." value="' . e(request('q')) . '">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Todos status</option>' .
                    collect($statusLabels)->map(fn ($label, $key) =>
                        '<option value="' . $key . '"' . (request('status') === $key ? ' selected' : '') . '>' . $label . '</option>'
                    )->implode('') . '
                </select>
                <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Filtrar</button>
            </form>',
    ])

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Criado em</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td><span class="text-muted">#{{ $order->id }}</span></td>
                            <td><span class="fw-semibold">{{ $order->order_number }}</span></td>
                            <td>{{ $order->contact_name }}</td>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'completed' => 'admin-badge--success',
                                        'cancelled' => 'admin-badge--danger',
                                        'pending' => 'admin-badge--warning',
                                        'shipped', 'processing' => 'admin-badge--info',
                                        default => 'admin-badge--secondary',
                                    };
                                @endphp
                                <span class="admin-badge {{ $badgeClass }}">
                                    {{ $statusLabels[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ number_format((float) $order->grand_total, 2, ',', '.') }} €</td>
                            <td class="text-muted">{{ $order->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="admin-table-empty">
                                <i class="bi bi-receipt"></i>
                                <div class="fw-semibold mb-1">Nenhum pedido encontrado</div>
                                <div class="small">Os pedidos realizados no site aparecerão aqui.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($orders->hasPages())
        <div class="admin-pagination">
            {{ $orders->links() }}
        </div>
    @endif
@endsection
