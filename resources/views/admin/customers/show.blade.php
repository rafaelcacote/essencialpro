@extends('layouts.admin')

@section('title', 'Admin - Cliente ' . $customer->name)
@section('page_title', $customer->name)
@section('page_subtitle', 'Registado em ' . $customer->created_at?->format('d/m/Y H:i'))

@section('content')
    @php
        $verifiedBadge = $customer->email_verified_at
            ? '<span class="admin-badge admin-badge--success">E-mail verificado</span>'
            : '<span class="admin-badge admin-badge--warning">E-mail por verificar</span>';
        $statusLabels = [
            'pending' => 'Pendente',
            'confirmed' => 'Confirmado',
            'processing' => 'Em processamento',
            'shipped' => 'Enviado',
            'completed' => 'Concluído',
            'cancelled' => 'Cancelado',
        ];
        $quoteStatusLabels = [
            'pending' => 'Pendente',
            'responded' => 'Respondido',
            'cancelled' => 'Cancelado',
        ];
        $hasContact = $latestOrder && (
            $latestOrder->phone
            || $latestOrder->company_name
            || $latestOrder->tax_id
            || $latestOrder->address
            || $latestOrder->postal_code
            || $latestOrder->city
            || $latestOrder->country
        );
    @endphp

    @include('admin.partials.page-header', [
        'title' => $customer->name,
        'subtitle' => $customer->email,
        'meta' => $verifiedBadge . ' · ' . $orders->total() . ' pedido(s)',
        'actions' => '<a href="' . route('admin.customers.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-person me-2"></i> Dados da conta</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-detail-grid">
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Nome</div>
                            <div class="admin-detail-item__value">{{ $customer->name }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">E-mail</div>
                            <div class="admin-detail-item__value">
                                <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                            </div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Estado da conta</div>
                            <div class="admin-detail-item__value">
                                {!! $verifiedBadge !!}
                            </div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">E-mail verificado em</div>
                            <div class="admin-detail-item__value">
                                {{ $customer->email_verified_at?->format('d/m/Y H:i') ?? '—' }}
                            </div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Registado em</div>
                            <div class="admin-detail-item__value">{{ $customer->created_at?->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Última atualização</div>
                            <div class="admin-detail-item__value">{{ $customer->updated_at?->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($hasContact)
                <div class="admin-card mt-4">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title"><i class="bi bi-geo-alt me-2"></i> Últimos dados de contacto</h2>
                    </div>
                    <div class="admin-card-body">
                        <p class="text-muted small mb-3">Informação recolhida no pedido mais recente do cliente.</p>
                        <div class="admin-detail-grid">
                            @if ($latestOrder->company_name)
                                <div class="admin-detail-item">
                                    <div class="admin-detail-item__label">Empresa</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->company_name }}</div>
                                </div>
                            @endif
                            <div class="admin-detail-item">
                                <div class="admin-detail-item__label">Nome no pedido</div>
                                <div class="admin-detail-item__value">{{ $latestOrder->contact_name }}</div>
                            </div>
                            <div class="admin-detail-item">
                                <div class="admin-detail-item__label">Telefone</div>
                                <div class="admin-detail-item__value">{{ $latestOrder->phone ?: '—' }}</div>
                            </div>
                            @if ($latestOrder->tax_id)
                                <div class="admin-detail-item">
                                    <div class="admin-detail-item__label">NIF / Contribuinte</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->tax_id }}</div>
                                </div>
                            @endif
                            @if ($latestOrder->address)
                                <div class="admin-detail-item" style="grid-column: 1 / -1;">
                                    <div class="admin-detail-item__label">Morada</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->address }}</div>
                                </div>
                            @endif
                            @if ($latestOrder->postal_code)
                                <div class="admin-detail-item">
                                    <div class="admin-detail-item__label">Código Postal</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->postal_code }}</div>
                                </div>
                            @endif
                            @if ($latestOrder->city)
                                <div class="admin-detail-item">
                                    <div class="admin-detail-item__label">Cidade</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->city }}</div>
                                </div>
                            @endif
                            @if ($latestOrder->country)
                                <div class="admin-detail-item">
                                    <div class="admin-detail-item__label">País</div>
                                    <div class="admin-detail-item__value">{{ $latestOrder->country }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="admin-card mt-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-receipt me-2"></i> Pedidos</h2>
                </div>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="fw-semibold">{{ $order->order_number }}</td>
                                    <td>
                                        <span class="admin-badge admin-badge--secondary">
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
                                    <td colspan="5" class="admin-table-empty">
                                        <i class="bi bi-receipt"></i>
                                        <div class="fw-semibold mb-1">Nenhum pedido</div>
                                        <div class="small">Este cliente ainda não fez compras no site.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($orders->hasPages())
                    <div class="admin-card-footer">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>

            @if ($quotes->isNotEmpty())
                <div class="admin-card mt-4">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title"><i class="bi bi-chat-dots me-2"></i> Orçamentos</h2>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Contacto</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotes as $quote)
                                    <tr>
                                        <td class="text-muted">#{{ $quote->id }}</td>
                                        <td>
                                            <div class="fw-semibold">{{ $quote->contact_name }}</div>
                                            @if ($quote->company_name)
                                                <div class="text-muted small">{{ $quote->company_name }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $quoteStatusLabels[$quote->status] ?? $quote->status }}</td>
                                        <td class="text-muted">{{ $quote->created_at?->format('d/m/Y H:i') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.quotes.show', $quote) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="admin-card admin-sidebar-card mb-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-bar-chart me-2"></i> Resumo</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-detail-grid" style="grid-template-columns: 1fr;">
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Pedidos</div>
                            <div class="admin-detail-item__value">{{ $orders->total() }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Total pago</div>
                            <div class="admin-detail-item__value fw-bold text-primary">
                                {{ number_format((float) $spentTotal, 2, ',', '.') }} €
                            </div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Orçamentos</div>
                            <div class="admin-detail-item__value">{{ $quotes->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-envelope me-2"></i> Contacto rápido</h2>
                </div>
                <div class="admin-card-body">
                    <a class="btn btn-primary w-100" href="mailto:{{ $customer->email }}">
                        <i class="bi bi-envelope"></i> Enviar e-mail
                    </a>
                    @if ($latestOrder?->phone)
                        <a class="btn btn-outline-secondary w-100 mt-2" href="tel:{{ $latestOrder->phone }}">
                            <i class="bi bi-telephone"></i> {{ $latestOrder->phone }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
