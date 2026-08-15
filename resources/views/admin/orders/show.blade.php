@extends('layouts.admin')

@section('title', 'Admin - Pedido ' . $order->order_number)
@section('page_title', 'Pedido ' . $order->order_number)
@section('page_subtitle', 'Criado em ' . $order->created_at?->format('d/m/Y H:i'))

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
        $badgeClass = match($order->status) {
            'completed' => 'admin-badge--success',
            'cancelled' => 'admin-badge--danger',
            'pending' => 'admin-badge--warning',
            'shipped', 'processing' => 'admin-badge--info',
            default => 'admin-badge--secondary',
        };
    @endphp

    @include('admin.partials.page-header', [
        'title' => $order->order_number,
        'subtitle' => $order->contact_name,
        'meta' => 'Status: <span class="admin-badge ' . $badgeClass . '">' . ($statusLabels[$order->status] ?? $order->status) . '</span> · Total: <strong>' . number_format((float) $order->grand_total, 2, ',', '.') . ' €</strong>',
        'actions' => '<a href="' . route('admin.orders.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-bag me-2"></i> Itens do Pedido</h2>
                </div>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Variação</th>
                                <th>Qtd.</th>
                                <th>Preço unit.</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product_title }}</td>
                                    <td class="text-muted small">
                                        Cor: {{ $item->selected_color ?: '—' }}<br>
                                        Tamanho: {{ $item->selected_size ?: '—' }}
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format((float) $item->unit_price, 2, ',', '.') }} €</td>
                                    <td class="fw-semibold">{{ number_format((float) $item->line_total, 2, ',', '.') }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="admin-card-footer text-end">
                    <div class="d-flex flex-column align-items-end gap-1 mb-2 small text-muted">
                        <div>Subtotal: <strong class="text-dark">{{ number_format((float) $order->subtotal, 2, ',', '.') }} €</strong></div>
                        <div>Envio: <strong class="text-dark">{{ (float) $order->shipping_total > 0 ? number_format((float) $order->shipping_total, 2, ',', '.') . ' €' : 'Gratuito' }}</strong></div>
                        <div>IVA: <strong class="text-dark">{{ number_format((float) ($order->tax_total ?? 0), 2, ',', '.') }} €</strong></div>
                    </div>
                    <span class="text-muted me-2">Total do pedido:</span>
                    <strong class="fs-5">{{ number_format((float) $order->grand_total, 2, ',', '.') }} €</strong>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card admin-sidebar-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-arrow-repeat me-2"></i> Atualizar Status</h2>
                </div>
                <div class="admin-card-body">
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf
                        @method('PUT')
                        <label class="form-label">Status do pedido</label>
                        <select class="form-select mb-3" name="status" required>
                            @foreach ($statusLabels as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-check-lg"></i> Salvar status
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-person me-2"></i> Cliente</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-detail-grid" style="grid-template-columns: 1fr;">
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Nome</div>
                            <div class="admin-detail-item__value">{{ $order->contact_name }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Email</div>
                            <div class="admin-detail-item__value">
                                <a href="mailto:{{ $order->email }}">{{ $order->email }}</a>
                            </div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Telefone</div>
                            <div class="admin-detail-item__value">{{ $order->phone ?: '—' }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Total</div>
                            <div class="admin-detail-item__value fw-bold text-primary">
                                {{ number_format((float) $order->grand_total, 2, ',', '.') }} €
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
