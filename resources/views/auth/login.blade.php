@extends('layouts.auth')

@section('title', 'Entrar - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Entrar</h1>
            <p class="auth-subheading">Acesse sua conta para continuar</p>

            <form method="POST" action="{{ route('login') }}" novalidate>
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
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

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
                        <button type="button" class="auth-password-toggle" id="togglePassword" aria-label="Mostrar senha">
                            <i class="bi bi-eye" id="togglePasswordIcon" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="auth-remember">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Lembrar de mim</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="auth-forgot-link">Esqueci a senha</a>
                </div>

                <button class="btn btn-primary auth-submit-btn w-100" type="submit">
                    Entrar
                </button>
            </form>

            <div class="auth-divider">ou</div>

            <p class="auth-footer-link mb-0">
                Ainda não tem conta? <a href="{{ route('register') }}">Criar conta</a>
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

@push('scripts')
<script>
    (function () {
        var toggle = document.getElementById('togglePassword');
        var input = document.getElementById('password');
        var icon = document.getElementById('togglePasswordIcon');

        if (!toggle || !input || !icon) {
            return;
        }

        toggle.addEventListener('click', function () {
            var isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
            toggle.setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
        });
    })();
</script>
@endpush
