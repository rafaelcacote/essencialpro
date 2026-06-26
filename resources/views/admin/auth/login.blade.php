@extends('layouts.admin-auth')

@section('title', 'Admin - Login')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Acesso Administrativo</h1>
            <p class="auth-subheading">Entre com suas credenciais de administrador</p>

            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="auth-field-label" for="email">E-mail</label>
                    <div class="auth-input-wrap">
                        <i class="bi bi-envelope auth-input-icon" aria-hidden="true"></i>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="admin@essencialpro.com"
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
                        <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember" @checked(old('remember'))>
                        <label class="form-check-label" for="remember">Manter conectado</label>
                    </div>
                </div>

                <button class="btn btn-primary auth-submit-btn w-100" type="submit" id="submitBtn">
                    <span class="btn-text">Entrar</span>
                    <span class="btn-spinner d-none">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Entrando...
                    </span>
                </button>
            </form>

            <div class="auth-security-note">
                <i class="bi bi-shield-lock" aria-hidden="true"></i>
                <span>Esta área é exclusiva para administradores. Todas as tentativas de acesso são registradas.</span>
            </div>
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
        var form = document.getElementById('loginForm');
        var btn = document.getElementById('submitBtn');

        if (toggle && input && icon) {
            toggle.addEventListener('click', function () {
                var isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isPassword);
                icon.classList.toggle('bi-eye-slash', isPassword);
                toggle.setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
            });
        }

        if (form && btn) {
            form.addEventListener('submit', function () {
                var btnText = btn.querySelector('.btn-text');
                var btnSpinner = btn.querySelector('.btn-spinner');

                btn.disabled = true;
                btnText.classList.add('d-none');
                btnSpinner.classList.remove('d-none');
            });
        }
    })();
</script>
@endpush
