@extends('layouts.admin')

@section('title', 'Admin - Cupons')
@section('page_title', 'Cupons')
@section('page_subtitle', 'Códigos de desconto')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Cupons',
        'subtitle' => $coupons->total() . ' cupons cadastrados',
        'actions' => '<a href="' . route('admin.coupons.create') . '" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo cupom</a>',
    ])

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Desconto</th>
                        <th>Regras</th>
                        <th>Validade</th>
                        <th>Usos</th>
                        <th>Status</th>
                        <th style="width: 180px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupons as $coupon)
                        <tr>
                            <td><code class="fw-semibold">{{ $coupon->code }}</code></td>
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->label() }}</td>
                            <td class="small text-muted">
                                @if ($coupon->first_order_only)
                                    <div>1ª compra</div>
                                @endif
                                @if ($coupon->min_subtotal)
                                    <div>Mín. {{ number_format((float) $coupon->min_subtotal, 2, ',', '.') }} €</div>
                                @endif
                                @if (! $coupon->first_order_only && ! $coupon->min_subtotal)
                                    —
                                @endif
                            </td>
                            <td class="small text-muted">
                                @if ($coupon->starts_at || $coupon->ends_at)
                                    {{ $coupon->starts_at?->format('d/m/Y') ?? '…' }}
                                    →
                                    {{ $coupon->ends_at?->format('d/m/Y') ?? '…' }}
                                @else
                                    Sem limite
                                @endif
                            </td>
                            <td class="text-muted">
                                {{ $coupon->used_count }}
                                @if ($coupon->usage_limit)
                                    / {{ $coupon->usage_limit }}
                                @endif
                            </td>
                            <td>
                                @if ($coupon->is_active)
                                    <span class="admin-badge admin-badge--success">Ativo</span>
                                @else
                                    <span class="admin-badge admin-badge--secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.coupons.edit', $coupon) }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.coupons.destroy', $coupon) }}"
                                          class="admin-delete-form"
                                          data-confirm-title="Excluir cupom"
                                          data-confirm-message="Tem certeza que deseja remover este cupom?"
                                          data-confirm-item="{{ $coupon->code }}">
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
                            <td colspan="8" class="admin-table-empty">
                                <i class="bi bi-ticket-perforated"></i>
                                <div class="fw-semibold mb-1">Nenhum cupom cadastrado</div>
                                <div class="small">Crie cupons para campanhas e descontos no checkout.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($coupons->hasPages())
        <div class="admin-pagination">
            {{ $coupons->links() }}
        </div>
    @endif
@endsection
