@php
    /** @var \App\Models\Coupon|null $coupon */
@endphp

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-ticket-perforated me-2"></i> Dados do cupom</h2>
            </div>
            <div class="admin-card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Código</label>
                        <input class="form-control text-uppercase" name="code" value="{{ old('code', $coupon?->code) }}" required maxlength="50" placeholder="BEMVINDO10">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nome interno</label>
                        <input class="form-control" name="name" value="{{ old('name', $coupon?->name) }}" required maxlength="255" placeholder="Desconto primeira compra">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="type" required>
                            <option value="percent" @selected(old('type', $coupon?->type ?? 'percent') === 'percent')>Percentual (%)</option>
                            <option value="fixed" @selected(old('type', $coupon?->type) === 'fixed')>Valor fixo (€)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="value" value="{{ old('value', $coupon?->value ?? 10) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Subtotal mínimo (€)</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="min_subtotal" value="{{ old('min_subtotal', $coupon?->min_subtotal) }}" placeholder="Opcional">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Limite global de usos</label>
                        <input type="number" min="1" class="form-control" name="usage_limit" value="{{ old('usage_limit', $coupon?->usage_limit) }}" placeholder="Ilimitado">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Limite por utilizador</label>
                        <input type="number" min="1" class="form-control" name="usage_limit_per_user" value="{{ old('usage_limit_per_user', $coupon?->usage_limit_per_user ?? 1) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Início</label>
                        <input type="datetime-local" class="form-control" name="starts_at"
                            value="{{ old('starts_at', optional($coupon?->starts_at)->format('Y-m-d\\TH:i')) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Fim</label>
                        <input type="datetime-local" class="form-control" name="ends_at"
                            value="{{ old('ends_at', optional($coupon?->ends_at)->format('Y-m-d\\TH:i')) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2 class="admin-card-title"><i class="bi bi-toggle-on me-2"></i> Regras</h2>
            </div>
            <div class="admin-card-body">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $coupon?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Cupom ativo</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="first_order_only" value="1" id="first_order_only"
                        @checked(old('first_order_only', $coupon?->first_order_only ?? false))>
                    <label class="form-check-label" for="first_order_only">Apenas primeira compra</label>
                </div>
                @if ($coupon)
                    <div class="mt-3 small text-muted">
                        Já utilizado {{ $coupon->used_count }} {{ $coupon->used_count === 1 ? 'vez' : 'vezes' }}.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
