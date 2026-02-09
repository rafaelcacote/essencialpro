@php
    /** @var \App\Models\Partner|null $partner */
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <div class="fw-bold mb-1">Corrija os campos abaixo:</div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Nome</label>
                        <input class="form-control" name="name" value="{{ old('name', $partner?->name) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Ordem</label>
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $partner?->sort_order ?? 0) }}" min="0" max="9999">
                        <div class="form-text">Menor ordem aparece primeiro.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Site (opcional)</label>
                        <input class="form-control" name="website_url" value="{{ old('website_url', $partner?->website_url) }}" placeholder="https://...">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Logo {{ $partner ? '(trocar)' : '' }}</label>
                        <input class="form-control" type="file" name="logo" accept="image/*" {{ $partner ? '' : 'required' }}>
                        <div class="form-text">Sugestão: PNG com fundo transparente ou JPG.</div>
                    </div>

                    @if ($partner)
                        <div class="col-12">
                            <div class="border rounded p-3 bg-white">
                                <div class="text-muted small mb-2">Logo atual</div>
                                <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}" style="max-height: 70px; max-width: 220px; object-fit: contain;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Publicação</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $partner?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Ativo (aparece na home)</label>
                </div>
            </div>
        </div>
    </div>
</div>

