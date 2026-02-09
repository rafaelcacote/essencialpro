@extends('layouts.admin')

@section('title', 'Admin - Parceiros')
@section('page_title', 'Parceiros')
@section('page_subtitle', 'Logos exibidos na home')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">Parceiros</h3>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Novo parceiro
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0 align-middle">
                <thead class="table-dark">
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
                            <td class="fw-medium">{{ $partner->name }}</td>
                            <td>
                                @if ($partner->website_url)
                                    <a href="{{ $partner->website_url }}" target="_blank">{{ $partner->website_url }}</a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $partner->sort_order }}</td>
                            <td>
                                @if ($partner->is_active)
                                    <span class="badge bg-success">Ativo</span>
                                @else
                                    <span class="badge bg-secondary">Inativo</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.partners.edit', $partner) }}">Editar</a>
                                <form class="d-inline" method="POST" action="{{ route('admin.partners.destroy', $partner) }}" onsubmit="return confirm('Remover este parceiro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Nenhum parceiro cadastrado ainda.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $partners->links() }}
    </div>
@endsection

