@php
    /** @var \App\Models\PromoCampaign|null $campaign */
    /** @var \Illuminate\Support\Collection<int, \App\Models\Coupon> $coupons */
@endphp

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-megaphone me-2"></i> Dados da campanha</h2>
            </div>
            <div class="admin-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Título interno</label>
                        <input class="form-control" name="title" value="{{ old('title', $campaign?->title) }}" required maxlength="255" placeholder="Primeira compra - 10%">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Texto do botão</label>
                        <input class="form-control" name="button_text" value="{{ old('button_text', $campaign?->button_text ?? 'DESBLOQUEIE O SEU DESCONTO') }}" required maxlength="120">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL do botão</label>
                        <input class="form-control" name="button_url" value="{{ old('button_url', $campaign?->button_url ?? '/') }}" required maxlength="255" placeholder="/">
                        <div class="form-text">Ex.: / para continuar a comprar. O cupom fica guardado; login só no checkout.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Audiência</label>
                        <select class="form-select" name="audience" required>
                            <option value="guests" @selected(old('audience', $campaign?->audience ?? 'guests') === 'guests')>Só visitantes (sem login)</option>
                            <option value="first_purchase" @selected(old('audience', $campaign?->audience) === 'first_purchase')>Visitantes e clientes sem 1ª compra</option>
                            <option value="all" @selected(old('audience', $campaign?->audience) === 'all')>Todos</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cupom associado</label>
                        <select class="form-select" name="coupon_id">
                            <option value="">Sem cupom</option>
                            @foreach ($coupons as $coupon)
                                <option value="{{ $coupon->id }}" @selected((string) old('coupon_id', $campaign?->coupon_id) === (string) $coupon->id)>
                                    {{ $coupon->code }} — {{ $coupon->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Início</label>
                        <input type="datetime-local" class="form-control" name="starts_at"
                            value="{{ old('starts_at', optional($campaign?->starts_at)->format('Y-m-d\\TH:i')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fim</label>
                        <input type="datetime-local" class="form-control" name="ends_at"
                            value="{{ old('ends_at', optional($campaign?->ends_at)->format('Y-m-d\\TH:i')) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Imagem do modal {{ $campaign ? '(trocar)' : '' }}</label>
                        <input class="form-control" type="file" name="image" accept="image/*" {{ $campaign ? '' : 'required' }}>
                        <div class="form-text">JPG/PNG recomendado. No mobile o botão fica abaixo da imagem.</div>
                    </div>

                    @if ($campaign)
                        <div class="col-12">
                            <div class="border rounded p-3 bg-white">
                                <div class="text-muted small mb-2">Imagem atual</div>
                                <img src="{{ asset($campaign->image_path) }}" alt="{{ $campaign->title }}" style="max-height: 180px; max-width: 100%; object-fit: contain;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-toggle-on me-2"></i> Publicação</h2>
            </div>
            <div class="admin-card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $campaign?->is_active ?? false))>
                    <label class="form-check-label" for="is_active">Campanha ativa (mostra no site)</label>
                </div>
                <div class="form-text mt-2">
                    Só pode haver uma campanha ativa de cada vez. Ao ativar esta, as outras são desativadas automaticamente.
                </div>
            </div>
        </div>
    </div>
</div>
