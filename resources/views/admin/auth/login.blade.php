@extends('layouts.admin-auth')

@section('title', 'Admin - Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo_.png') }}" alt="Essencial Pro" class="img-fluid" style="max-height: 80px;">
                    </div>
                    <h4 class="mb-3 text-center">Acesso Administrativo</h4>
                    <p class="text-muted mb-4 text-center">Entre com um usuário cadastrado no sistema.</p>

                    <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember" @checked(old('remember'))>
                            <label class="form-check-label" for="remember">Manter conectado</label>
                        </div>

                        <button class="btn btn-primary w-100" type="submit" id="submitBtn">
                            <span class="btn-text">Entrar</span>
                            <span class="btn-spinner d-none">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Entrando...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const btnText = btn.querySelector('.btn-text');
            const btnSpinner = btn.querySelector('.btn-spinner');
            
            btn.disabled = true;
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');
        });
    </script>
    @endpush
@endsection

