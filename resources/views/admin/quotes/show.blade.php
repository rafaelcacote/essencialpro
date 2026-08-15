@extends('layouts.admin')

@section('title', 'Admin - Orçamento #' . $quote->id)
@section('page_title', 'Orçamento #' . $quote->id)
@section('page_subtitle', 'Criado em ' . $quote->created_at?->format('d/m/Y H:i'))

@section('content')
    @php
        $statusBadge = match($quote->status) {
            'pending' => '<span class="admin-badge admin-badge--warning">Pendente</span>',
            'responded' => '<span class="admin-badge admin-badge--success">Respondido</span>',
            default => '<span class="admin-badge admin-badge--danger">Cancelado</span>',
        };
    @endphp

    @include('admin.partials.page-header', [
        'title' => $quote->contact_name,
        'subtitle' => $quote->email,
        'meta' => 'Status: ' . $statusBadge,
        'actions' => '<a href="' . route('admin.quotes.index') . '" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>',
    ])

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-person me-2"></i> Dados do Cliente</h2>
                </div>
                <div class="admin-card-body">
                    <div class="admin-detail-grid">
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Tipo</div>
                            <div class="admin-detail-item__value">{{ $quote->client_type === 'company' ? 'Empresa' : 'Particular' }}</div>
                        </div>
                        @if ($quote->client_type === 'company')
                            <div class="admin-detail-item">
                                <div class="admin-detail-item__label">Empresa</div>
                                <div class="admin-detail-item__value">{{ $quote->company_name ?? '—' }}</div>
                            </div>
                        @endif
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Nome</div>
                            <div class="admin-detail-item__value">{{ $quote->contact_name }}</div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Email</div>
                            <div class="admin-detail-item__value"><a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></div>
                        </div>
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Telefone</div>
                            <div class="admin-detail-item__value">{{ $quote->phone }}</div>
                        </div>
                        @if ($quote->tax_id)
                            <div class="admin-detail-item">
                                <div class="admin-detail-item__label">NIF / Contribuinte</div>
                                <div class="admin-detail-item__value">{{ $quote->tax_id }}</div>
                            </div>
                        @endif
                    </div>

                    @if ($quote->address || $quote->postal_code || $quote->city || $quote->country)
                    <hr class="admin-divider">

                    <h3 class="admin-card-title mb-3"><i class="bi bi-geo-alt me-2"></i> Morada</h3>
                    <div class="admin-detail-grid">
                        @if ($quote->address)
                        <div class="admin-detail-item" style="grid-column: 1 / -1;">
                            <div class="admin-detail-item__label">Morada</div>
                            <div class="admin-detail-item__value">{{ $quote->address }}</div>
                        </div>
                        @endif
                        @if ($quote->postal_code)
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Código Postal</div>
                            <div class="admin-detail-item__value">{{ $quote->postal_code }}</div>
                        </div>
                        @endif
                        @if ($quote->city)
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">Cidade</div>
                            <div class="admin-detail-item__value">{{ $quote->city }}</div>
                        </div>
                        @endif
                        @if ($quote->country)
                        <div class="admin-detail-item">
                            <div class="admin-detail-item__label">País</div>
                            <div class="admin-detail-item__value">{{ $quote->country }}</div>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if ($quote->notes)
                        <hr class="admin-divider">
                        <h3 class="admin-card-title mb-3"><i class="bi bi-sticky me-2"></i> Notas</h3>
                        <div class="admin-notes-box">{!! nl2br(e($quote->notes)) !!}</div>
                    @endif
                </div>
            </div>

            <div class="admin-card mt-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-bag me-2"></i> Produtos Pretendidos</h2>
                </div>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Referência</th>
                                <th>Quantidade</th>
                                <th>Cor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quote->items as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product_name }}</td>
                                    <td class="text-muted">{{ $item->reference ?? '—' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->color ?? '—' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($quote->logos->isNotEmpty())
                <div class="admin-card mt-4">
                    <div class="admin-card-header">
                        <h2 class="admin-card-title"><i class="bi bi-image me-2"></i> Logotipos</h2>
                    </div>
                    <div class="admin-card-body">
                        <div class="row g-3">
                            @foreach ($quote->logos as $logo)
                                <div class="col-md-4">
                                    <div class="admin-logo-card">
                                        <a href="{{ asset($logo->file_path) }}" target="_blank">
                                            <img src="{{ asset($logo->file_path) }}" alt="Logo">
                                        </a>
                                        <div class="admin-logo-card__body">
                                            <div><span class="text-muted">Localização:</span> {{ $logo->location ?? '—' }}</div>
                                            <div><span class="text-muted">Peças:</span> {{ $logo->pieces ?? '—' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="admin-card admin-sidebar-card">
                <div class="admin-card-header">
                    <h2 class="admin-card-title"><i class="bi bi-arrow-repeat me-2"></i> Atualizar Status</h2>
                </div>
                <div class="admin-card-body">
                    <form method="POST" action="{{ route('admin.quotes.update', $quote) }}">
                        @csrf
                        @method('PUT')

                        <label class="form-label">Status do orçamento</label>
                        <select class="form-select mb-3" name="status" required>
                            <option value="pending" @selected($quote->status === 'pending')>Pendente</option>
                            <option value="responded" @selected($quote->status === 'responded')>Respondido</option>
                            <option value="cancelled" @selected($quote->status === 'cancelled')>Cancelado</option>
                        </select>

                        <button class="btn btn-primary w-100" type="submit">
                            <i class="bi bi-check-lg"></i> Atualizar status
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-card mt-4">
                <div class="admin-card-header">
                    <h2 class="admin-card-title text-danger"><i class="bi bi-trash me-2"></i> Zona de perigo</h2>
                </div>
                <div class="admin-card-body">
                    <p class="text-muted small mb-3">Esta ação é irreversível. O orçamento será removido permanentemente.</p>
                    <form method="POST"
                          action="{{ route('admin.quotes.destroy', $quote) }}"
                          class="admin-delete-form"
                          data-confirm-title="Excluir orçamento"
                          data-confirm-message="Tem certeza que deseja remover este orçamento permanentemente?"
                          data-confirm-item="{{ $quote->contact_name }} — #{{ $quote->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100" type="submit">
                            <i class="bi bi-trash"></i> Excluir orçamento
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
