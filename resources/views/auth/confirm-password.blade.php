@extends('layouts.auth')

@section('title', 'Confirmar Senha - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Confirmar senha</h1>
            <p class="auth-subheading">
                Esta é uma área segura. Confirme sua senha antes de continuar.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="auth-field-label" for="password">Senha</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-lock auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary auth-submit-btn w-100" type="submit">
                    Confirmar
                </button>
            </form>
        </div>
    </div>

    <div class="auth-back-wrap">
        <a href="{{ route('home') }}" class="auth-back-link">
            <i class="bi bi-arrow-left" aria-hidden="true"></i>
            Voltar ao site
        </a>
    </div>
@endsection
