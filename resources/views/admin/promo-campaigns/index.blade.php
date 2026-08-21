@extends('layouts.admin')

@section('title', 'Admin - Campanhas')
@section('page_title', 'Campanhas')
@section('page_subtitle', 'Popups promocionais do site')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Campanhas promocionais',
        'subtitle' => $campaigns->total() . ' campanhas cadastradas',
        'actions' => '<a href="' . route('admin.promo-campaigns.create') . '" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Nova campanha</a>',
    ])

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Cupom</th>
                        <th>Audiência</th>
                        <th>Validade</th>
                        <th>Status</th>
                        <th style="width: 180px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($campaigns as $campaign)
                        <tr>
                            <td style="width: 120px;">
                                <img src="{{ asset($campaign->image_path) }}" alt="{{ $campaign->title }}" style="max-width: 100px; max-height: 56px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $campaign->title }}</div>
                                <div class="small text-muted">{{ $campaign->button_text }}</div>
                            </td>
                            <td>
                                @if ($campaign->coupon)
                                    <code>{{ $campaign->coupon->code }}</code>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="small text-muted">
                                @switch($campaign->audience)
                                    @case('guests') Visitantes @break
                                    @case('first_purchase') 1ª compra @break
                                    @default Todos
                                @endswitch
                            </td>
                            <td class="small text-muted">
                                @if ($campaign->starts_at || $campaign->ends_at)
                                    {{ $campaign->starts_at?->format('d/m/Y') ?? '…' }}
                                    →
                                    {{ $campaign->ends_at?->format('d/m/Y') ?? '…' }}
                                @else
                                    Sem limite
                                @endif
                            </td>
                            <td>
                                @if ($campaign->is_active)
                                    <span class="admin-badge admin-badge--success">Ativa</span>
                                @else
                                    <span class="admin-badge admin-badge--secondary">Inativa</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.promo-campaigns.edit', $campaign) }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.promo-campaigns.destroy', $campaign) }}"
                                          class="admin-delete-form"
                                          data-confirm-title="Excluir campanha"
                                          data-confirm-message="Tem certeza que deseja remover esta campanha?"
                                          data-confirm-item="{{ $campaign->title }}">
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
                            <td colspan="7" class="admin-table-empty">
                                <i class="bi bi-megaphone"></i>
                                <div class="fw-semibold mb-1">Nenhuma campanha cadastrada</div>
                                <div class="small">Crie um popup com imagem, botão e cupom associado.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($campaigns->hasPages())
        <div class="admin-pagination">
            {{ $campaigns->links() }}
        </div>
    @endif
@endsection
