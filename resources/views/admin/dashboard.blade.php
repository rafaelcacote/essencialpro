@extends('layouts.admin')

@section('title', 'Admin - Dashboard')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Visão geral do site')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Bem-vindo ao painel',
        'subtitle' => 'Acompanhe produtos, orçamentos e pedidos em tempo real',
        'actions' => '<a class="btn btn-outline-primary btn-sm" href="' . route('home') . '" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Ver site</a>',
    ])

    <div class="admin-stat-grid">
        <div class="admin-stat-card admin-stat-card--primary">
            <div class="admin-stat-card__top">
                <div>
                    <div class="admin-stat-label">Produtos</div>
                    <div class="admin-stat-value">{{ $totalProducts }}</div>
                </div>
                <div class="admin-stat-icon admin-stat-icon--primary">
                    <i class="bi bi-bag"></i>
                </div>
            </div>
            <div class="admin-stat-footer">
                <strong>{{ $activeProducts }}</strong> ativos no catálogo
            </div>
        </div>

        <div class="admin-stat-card admin-stat-card--warning">
            <div class="admin-stat-card__top">
                <div>
                    <div class="admin-stat-label">Destaques</div>
                    <div class="admin-stat-value">{{ $featuredProducts }}</div>
                </div>
                <div class="admin-stat-icon admin-stat-icon--warning">
                    <i class="bi bi-stars"></i>
                </div>
            </div>
            <div class="admin-stat-footer">
                Produtos em destaque na home
            </div>
        </div>

        <div class="admin-stat-card admin-stat-card--dark">
            <div class="admin-stat-card__top">
                <div>
                    <div class="admin-stat-label">Orçamentos</div>
                    <div class="admin-stat-value">{{ $totalQuotes }}</div>
                </div>
                <div class="admin-stat-icon admin-stat-icon--dark">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
            <div class="admin-stat-footer">
                <strong>{{ $pendingQuotes }}</strong> aguardando resposta
            </div>
        </div>

        <a class="admin-stat-card admin-stat-card--success" href="{{ route('admin.orders.index') }}">
            <div class="admin-stat-card__top">
                <div>
                    <div class="admin-stat-label">Pedidos</div>
                    <div class="admin-stat-value">{{ $totalOrders }}</div>
                </div>
                <div class="admin-stat-icon admin-stat-icon--success">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
            <div class="admin-stat-footer">
                <strong>{{ $pendingOrders }}</strong> pendentes
            </div>
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title">
                        <i class="bi bi-envelope me-2 text-primary"></i>
                        Orçamentos pendentes
                    </h2>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.index', ['status' => 'pending']) }}">
                        Ver todos
                    </a>
                </div>
                @if ($latestPendingQuotes->isEmpty())
                    <div class="admin-empty">
                        <div class="admin-empty__icon"><i class="bi bi-inbox"></i></div>
                        <div class="admin-empty__title">Nenhuma mensagem nova</div>
                        <p class="admin-empty__text">Os orçamentos pendentes aparecerão aqui.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Email</th>
                                    <th>Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestPendingQuotes as $q)
                                    <tr>
                                        <td><span class="text-muted">#{{ $q->id }}</span></td>
                                        <td>
                                            <div class="fw-semibold">{{ $q->contact_name }}</div>
                                            @if ($q->client_type === 'company' && $q->company_name)
                                                <div class="text-muted small">{{ $q->company_name }}</div>
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ $q->email }}</td>
                                        <td class="text-muted">{{ $q->created_at?->format('d/m/Y H:i') }}</td>
                                        <td class="text-end">
                                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.show', $q) }}">
                                                <i class="bi bi-eye"></i> Abrir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-5">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title">
                        <i class="bi bi-clock-history me-2 text-primary"></i>
                        Pedidos recentes
                    </h2>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.orders.index', ['status' => 'pending']) }}">
                        Ver todos
                    </a>
                </div>
                @if ($latestPendingOrders->isEmpty())
                    <div class="admin-empty">
                        <div class="admin-empty__icon"><i class="bi bi-receipt"></i></div>
                        <div class="admin-empty__title">Nenhum pedido pendente</div>
                        <p class="admin-empty__text">Pedidos aguardando processamento aparecerão aqui.</p>
                    </div>
                @else
                    <ul class="admin-list">
                        @foreach ($latestPendingOrders as $o)
                            <li class="admin-list-item">
                                <div>
                                    <div class="admin-list-item__title">{{ $o->order_number }}</div>
                                    <div class="admin-list-item__meta">
                                        {{ $o->contact_name }} · {{ $o->created_at?->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.orders.show', $o) }}">
                                    Abrir
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
