@extends('layouts.admin')

@section('title', 'Admin - Parceiros')
@section('page_title', 'Parceiros')
@section('page_subtitle', 'Logos exibidos na home')

@section('content')
    @include('admin.partials.page-header', [
        'title' => 'Parceiros',
        'subtitle' => $partners->total() . ' parceiros cadastrados',
        'actions' => '<a href="' . route('admin.partners.create') . '" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Novo parceiro</a>',
    ])

    <div class="admin-card">
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nome</th>
                        <th>Site</th>
                        <th>Ordem</th>
                        <th>Status</th>
                        <th style="width: 180px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partners as $partner)
                        <tr>
                            <td style="width: 140px;">
                                <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}" style="max-width: 120px; max-height: 44px; object-fit: contain;">
                            </td>
                            <td><span class="fw-semibold">{{ $partner->name }}</span></td>
                            <td>
                                @if ($partner->website_url)
                                    <a href="{{ $partner->website_url }}" target="_blank" class="text-decoration-none">
                                        <i class="bi bi-link-45deg"></i> {{ Str::limit($partner->website_url, 35) }}
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="text-muted">{{ $partner->sort_order }}</td>
                            <td>
                                @if ($partner->is_active)
                                    <span class="admin-badge admin-badge--success">Ativo</span>
                                @else
                                    <span class="admin-badge admin-badge--secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="admin-actions">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.partners.edit', $partner) }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.partners.destroy', $partner) }}"
                                          class="admin-delete-form"
                                          data-confirm-title="Excluir parceiro"
                                          data-confirm-message="Tem certeza que deseja remover este parceiro da home?"
                                          data-confirm-item="{{ $partner->name }}">
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
                            <td colspan="6" class="admin-table-empty">
                                <i class="bi bi-award"></i>
                                <div class="fw-semibold mb-1">Nenhum parceiro cadastrado</div>
                                <div class="small">Adicione logos de parceiros para exibir na home.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($partners->hasPages())
        <div class="admin-pagination">
            {{ $partners->links() }}
        </div>
    @endif
@endsection
