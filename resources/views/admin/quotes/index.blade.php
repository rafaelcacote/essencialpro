@extends('layouts.admin')

@section('title', 'Admin - Orçamentos')
@section('page_title', 'Orçamentos')
@section('page_subtitle', 'Solicitações de orçamento dos clientes')

@section('content')
    @php
        $tabs = [
            null => 'Todos',
            'pending' => 'Pendentes',
            'responded' => 'Respondidos',
            'cancelled' => 'Cancelados',
        ];
        $tabHtml = '<div class="admin-filter-tabs">';
        foreach ($tabs as $key => $label) {
            $active = $status === $key ? 'active' : '';
            $url = $key === null ? route('admin.quotes.index') : route('admin.quotes.index', ['status' => $key]);
            $tabHtml .= '<a class="admin-filter-tab ' . $active . '" href="' . $url . '">' . $label . '</a>';
        }
        $tabHtml .= '</div>';
    @endphp

    @include('admin.partials.page-header', [
        'title' => 'Orçamentos',
        'subtitle' => $quotes->total() . ' registros encontrados',
        'actions' => $tabHtml,
    ])

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Itens</th>
                        <th>Logos</th>
                        <th>Status</th>
                        <th>Criado em</th>
                        <th style="width: 160px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quotes as $quote)
                        <tr>
                            <td><span class="text-muted">#{{ $quote->id }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $quote->contact_name }}</div>
                                @if ($quote->client_type === 'company' && $quote->company_name)
                                    <div class="text-muted small">{{ $quote->company_name }}</div>
                                @endif
                            </td>
                            <td class="text-muted">{{ $quote->email }}</td>
                            <td>
                                @if ($quote->client_type === 'company')
                                    <span class="admin-badge admin-badge--info">Empresa</span>
                                @else
                                    <span class="admin-badge admin-badge--secondary">Particular</span>
                                @endif
                            </td>
                            <td>{{ $quote->items_count }}</td>
                            <td>{{ $quote->logos_count }}</td>
                            <td>
                                @if ($quote->status === 'pending')
                                    <span class="admin-badge admin-badge--warning">Pendente</span>
                                @elseif ($quote->status === 'responded')
                                    <span class="admin-badge admin-badge--success">Respondido</span>
                                @else
                                    <span class="admin-badge admin-badge--danger">Cancelado</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $quote->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.quotes.show', $quote) }}">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.quotes.destroy', $quote) }}"
                                          class="admin-delete-form"
                                          data-confirm-title="Excluir orçamento"
                                          data-confirm-message="Tem certeza que deseja remover este orçamento?"
                                          data-confirm-item="{{ $quote->contact_name }} — #{{ $quote->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger admin-btn-icon" type="submit" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="admin-table-empty">
                                <i class="bi bi-chat-dots"></i>
                                <div class="fw-semibold mb-1">Nenhum orçamento encontrado</div>
                                <div class="small">Os orçamentos enviados pelo site aparecerão aqui.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($quotes->hasPages())
        <div class="admin-pagination">
            {{ $quotes->links() }}
        </div>
    @endif
@endsection
