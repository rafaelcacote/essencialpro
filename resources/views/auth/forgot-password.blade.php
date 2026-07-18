@extends('layouts.auth')

@section('title', 'Recuperar palavra-passe - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Recuperar palavra-passe</h1>
            <p class="auth-subheading">Indique o seu e-mail para receber a ligação de redefinição</p>

            <form method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf

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

                <button class="btn btn-primary auth-submit-btn w-100" type="submit">
                    Enviar ligação
                </button>
            </form>

            <div class="auth-divider">ou</div>

            <p class="auth-footer-link mb-0">
                Lembrou-se da palavra-passe? <a href="{{ route('login') }}">Voltar ao início de sessão</a>
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
