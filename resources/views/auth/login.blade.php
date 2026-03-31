@extends('layouts.auth')

@section('title', 'Entrar - Essencial Pro')

@section('content')
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 text-center mb-4 fw-bold">Entrar</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
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
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Lembrar de mim</label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                </form>
                <div class="d-flex justify-content-between mt-3 small">
                    <a href="{{ route('register') }}">Criar conta</a>
                    <a href="{{ route('password.request') }}">Esqueci a senha</a>
                </div>
            </div>
        </div>
        <p class="text-center mt-4 mb-0">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">← Voltar ao site</a>
        </p>
    </div>
@endsection
