@extends('layouts.auth')

@section('title', 'Recuperar Senha - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Recuperar senha</h1>
            <p class="auth-subheading">Informe seu email para receber o link de redefinição</p>

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="auth-field-label" for="email">Email</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-envelope auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="seu@email.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary auth-submit-btn w-100" type="submit">
                    Enviar link
                </button>
            </form>

            <div class="auth-divider">ou</div>

            <p class="auth-footer-link mb-0">
                Lembrou a senha? <a href="{{ route('login') }}">Voltar ao login</a>
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
