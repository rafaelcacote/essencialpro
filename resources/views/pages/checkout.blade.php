@extends('layouts.app')

@section('title', 'Checkout - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Finalizar Pedido'])

    <div class="container-xxl py-5">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    Reveja os campos assinalados antes de continuar.
                </div>
            @endif

            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h5 class="mb-3">Dados do comprador</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nome</label>
                                        <input class="form-control" name="contact_name" value="{{ old('contact_name', auth()->user()->name) }}" required>
                                        @error('contact_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Telefone <span id="phone-required" class="text-danger">*</span></label>
                                        <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+351 912 345 678">
                                        <div class="form-text">Obrigatório para pagamento por MB WAY.</div>
                                        @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Empresa</label>
                                        <input class="form-control" name="company_name" value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIF/Contribuinte</label>
                                        <input class="form-control" name="tax_id" value="{{ old('tax_id') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">País</label>
                                        <input class="form-control" name="country" value="{{ old('country', 'Portugal') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Endereço</label>
                                        <input class="form-control" name="address" value="{{ old('address') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Código postal</label>
                                        <input class="form-control" name="postal_code" value="{{ old('postal_code') }}" required>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="form-label">Cidade</label>
                                        <input class="form-control" name="city" value="{{ old('city') }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Observacoes</label>
                                        <textarea class="form-control" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3">Método de pagamento</h5>
                                <div class="vstack gap-2">
                                    <label class="border rounded p-3 d-flex align-items-center gap-3">
                                        <input class="form-check-input mt-0" type="radio" name="payment_method" value="multibanco" @checked(old('payment_method', 'multibanco') === 'multibanco')>
                                        <span><strong>Multibanco</strong><small class="d-block text-muted">Receba uma entidade e referência para pagar no Multibanco ou homebanking.</small></span>
                                    </label>
                                    <label class="border rounded p-3 d-flex align-items-center gap-3">
                                        <input class="form-check-input mt-0" type="radio" name="payment_method" value="mbway" @checked(old('payment_method') === 'mbway')>
                                        <span><strong>MB WAY</strong><small class="d-block text-muted">Receba uma notificação no telemóvel para confirmar o pagamento.</small></span>
                                    </label>
                                    <label class="border rounded p-3 d-flex align-items-center gap-3">
                                        <input class="form-check-input mt-0" type="radio" name="payment_method" value="credit_card" @checked(old('payment_method') === 'credit_card')>
                                        <span><strong>Cartão de crédito/débito</strong><small class="d-block text-muted">Será redirecionado para o formulário seguro da EuPago.</small></span>
                                    </label>
                                </div>
                                @error('payment_method') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @php
                            $subtotal = $cart->items->sum(fn ($item) => ((float) ($item->product?->price ?? 0)) * $item->quantity);
                        @endphp
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3">Resumo do pedido</h5>
                                @foreach ($cart->items as $item)
                                    <div class="d-flex justify-content-between small mb-2">
                                        <span>{{ $item->product?->title }} x {{ $item->quantity }}</span>
                                        <span>{{ number_format(((float) ($item->product?->price ?? 0)) * $item->quantity, 2, ',', '.') }} €</span>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="d-flex justify-content-between mb-3">
                                    <strong>Total</strong>
                                    <strong>{{ number_format($subtotal, 2, ',', '.') }} €</strong>
                                </div>
                                <p class="small text-muted">Pagamentos processados de forma segura pela EuPago.</p>
                                <button type="submit" class="btn btn-primary w-100">Confirmar e pagar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const phone = document.querySelector('[name="phone"]');
        const required = document.getElementById('phone-required');
        const methods = document.querySelectorAll('[name="payment_method"]');

        const updatePhoneRequirement = () => {
            const mbway = document.querySelector('[name="payment_method"]:checked')?.value === 'mbway';
            phone.required = mbway;
            required.classList.toggle('d-none', !mbway);
        };

        methods.forEach((method) => method.addEventListener('change', updatePhoneRequirement));
        updatePhoneRequirement();
    })();
</script>
@endpush
