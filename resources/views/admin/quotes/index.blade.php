@extends('layouts.admin')

@section('title', 'Admin - Orçamentos')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Orçamentos</h3>
        <div class="d-flex gap-2">
            <a class="btn btn-sm {{ $status === null ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.quotes.index') }}">Todos</a>
            <a class="btn btn-sm {{ $status === 'pending' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.quotes.index', ['status' => 'pending']) }}">Pendentes</a>
            <a class="btn btn-sm {{ $status === 'responded' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.quotes.index', ['status' => 'responded']) }}">Respondidos</a>
            <a class="btn btn-sm {{ $status === 'cancelled' ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.quotes.index', ['status' => 'cancelled']) }}">Cancelados</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Itens</th>
                        <th>Logos</th>
                        <th>Status</th>
                        <th>Criado em</th>
                        <th style="width: 190px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quotes as $quote)
                        <tr>
                            <td>{{ $quote->id }}</td>
                            <td class="fw-medium">
                                {{ $quote->contact_name }}
                                @if ($quote->client_type === 'company' && $quote->company_name)
                                    <div class="text-muted small">{{ $quote->company_name }}</div>
                                @endif
                            </td>
                            <td>{{ $quote->email }}</td>
                            <td>
                                @if ($quote->client_type === 'company')
                                    <span class="badge bg-info text-dark">Empresa</span>
                                @else
                                    <span class="badge bg-secondary">Particular</span>
                                @endif
                            </td>
                            <td>{{ $quote->items_count }}</td>
                            <td>{{ $quote->logos_count }}</td>
                            <td>
                                @if ($quote->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                @elseif ($quote->status === 'responded')
                                    <span class="badge bg-success">Respondido</span>
                                @else
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $quote->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.show', $quote) }}">Ver</a>
                                <form class="d-inline" method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" onsubmit="return confirm('Remover este orçamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                Nenhum orçamento encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $quotes->links() }}
    </div>
@endsection

