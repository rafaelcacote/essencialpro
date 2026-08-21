@extends('layouts.admin')

@section('title', 'Admin - Clientes')
@section('page_title', 'Clientes')
@section('page_subtitle', 'Contas registadas no site')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Clientes',
        'subtitle' => $customers->total() . ' clientes encontrados',
        'actions' => '
            <form method="GET" class="d-flex gap-2 align-items-center flex-wrap">
                <input type="text" class="form-control form-control-sm" name="q" placeholder="Nome ou e-mail..." value="' . e(request('q')) . '">
                <select name="verified" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    <option value="1"' . (request('verified') === '1' ? ' selected' : '') . '>E-mail verificado</option>
                    <option value="0"' . (request('verified') === '0' ? ' selected' : '') . '>Por verificar</option>
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
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Conta</th>
                        <th>Pedidos</th>
                        <th>Registado em</th>
                        <th style="width: 100px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td><span class="text-muted">#{{ $customer->id }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $customer->name }}</div>
                            </td>
                            <td class="text-muted">{{ $customer->email }}</td>
                            <td>
                                @if ($customer->email_verified_at)
                                    <span class="admin-badge admin-badge--success">Verificado</span>
                                @else
                                    <span class="admin-badge admin-badge--warning">Por verificar</span>
                                @endif
                            </td>
                            <td>{{ $customer->orders_count }}</td>
                            <td class="text-muted">{{ $customer->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="admin-table-empty">
                                <i class="bi bi-people"></i>
                                <div class="fw-semibold mb-1">Nenhum cliente encontrado</div>
                                <div class="small">Os clientes que se registarem no site aparecerão aqui.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($customers->hasPages())
        <div class="admin-pagination">
            {{ $customers->links() }}
        </div>
    @endif
@endsection
