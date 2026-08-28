@extends('layouts.auth')

@section('title', 'Registo - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Criar conta</h1>
            <p class="auth-subheading">Preencha os dados para começar</p>

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="auth-field-label" for="name">Nome</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-person auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="O seu nome completo"
                            required
                            autofocus
                            autocomplete="name"
                        >
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="auth-field-label" for="email">E-mail</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-envelope auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="o-seu@email.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="auth-field-label" for="password">Palavra-passe</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-lock auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="auth-field-label" for="password_confirmation">Confirmar palavra-passe</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-lock-fill auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="••••••••"
                            required
                            autocomplete="new-password"
                        >
                    </div>
                </div>

                @if (filled(config('services.turnstile.site_key')))
                    <div class="mb-3 auth-turnstile">
                        <div
                            class="cf-turnstile"
                            data-sitekey="{{ config('services.turnstile.site_key') }}"
                            data-theme="light"
                            data-size="flexible"
                            data-language="pt-PT"
                        ></div>
                        @error('cf-turnstile-response')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <button class="btn btn-primary auth-submit-btn w-100" type="submit">
                    Registar
                </button>
            </form>

            <div class="auth-divider">ou</div>

            <p class="auth-footer-link mb-0">
                Já tem conta? <a href="{{ route('login') }}">Iniciar sessão</a>
            </p>
        </div>
    </div>

    <div class="auth-back-wrap">
        <a href="{{ route('home') }}" class="auth-back-link">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            Voltar ao site
        </a>
    </div>
@endsection

@if (filled(config('services.turnstile.site_key')))
    @push('scripts')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endif
