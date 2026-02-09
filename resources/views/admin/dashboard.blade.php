@extends('layouts.admin')

@section('title', 'Admin - Dashboard')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Dashboard</h3>
            <div class="text-muted">Visão geral do site</div>
        </div>
        <a class="btn btn-outline-primary" href="{{ route('home') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right me-1"></i> Ver site
        </a>
    </div>

    <div class="row g-3">
        <div class="col-md-6 col-xl-3">
            <div class="card admin-stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Produtos cadastrados</div>
                            <div class="display-6 fw-bold mb-0">{{ $totalProducts }}</div>
                        </div>
                        <div class="admin-stat-icon bg-primary text-white">
                            <i class="bi bi-bag"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Ativos: {{ $activeProducts }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card admin-stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Destaques (home)</div>
                            <div class="display-6 fw-bold mb-0">{{ $featuredProducts }}</div>
                        </div>
                        <div class="admin-stat-icon bg-warning text-dark">
                            <i class="bi bi-stars"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Produtos marcados como destaque</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card admin-stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Orçamentos</div>
                            <div class="display-6 fw-bold mb-0">{{ $totalQuotes }}</div>
                        </div>
                        <div class="admin-stat-icon bg-dark text-white">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Pendentes: {{ $pendingQuotes }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card admin-stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Mensagens novas</div>
                            <div class="display-6 fw-bold mb-0">{{ $pendingQuotes }}</div>
                        </div>
                        <div class="admin-stat-icon bg-success text-white">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Orçamentos pendentes</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <div class="fw-bold">Mensagens novas (orçamentos pendentes)</div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.index', ['status' => 'pending']) }}">
                        Ver todos
                    </a>
                </div>
                <div class="card-body">
                    @if ($latestPendingQuotes->isEmpty())
                        <div class="text-muted">Nenhuma mensagem nova.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
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
                                            <td>{{ $q->id }}</td>
                                            <td class="fw-medium">
                                                {{ $q->contact_name }}
                                                @if ($q->client_type === 'company' && $q->company_name)
                                                    <div class="text-muted small">{{ $q->company_name }}</div>
                                                @endif
                                            </td>
                                            <td>{{ $q->email }}</td>
                                            <td class="text-muted">{{ $q->created_at?->format('d/m/Y H:i') }}</td>
                                            <td class="text-end">
                                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.show', $q) }}">Abrir</a>
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

        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <div class="fw-bold">Produtos recentes</div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.index') }}">Ver todos</a>
                </div>
                <div class="card-body">
                    @if ($latestProducts->isEmpty())
                        <div class="text-muted">Nenhum produto cadastrado ainda.</div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach ($latestProducts as $p)
                                <div class="list-group-item d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="fw-medium">{{ $p->title }}</div>
                                        <div class="text-muted small">
                                            <code>{{ $p->slug }}</code>
                                            @if ($p->is_featured)
                                                <span class="badge bg-warning text-dark ms-1">Destaque</span>
                                            @endif
                                            @if (!$p->is_active)
                                                <span class="badge bg-secondary ms-1">Inativo</span>
                                            @endif
                                        </div>
                                    </div>
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.products.edit', $p) }}">Editar</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

