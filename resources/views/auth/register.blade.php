@extends('layouts.auth')

@section('title', 'Cadastro - Essencial Pro')

@section('content')
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 text-center mb-4 fw-bold">Criar conta</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
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
                    <div class="mb-3">
                        <label class="form-label">Confirmar senha</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
                </form>
                <div class="mt-3 text-center small">
                    <a href="{{ route('login') }}">Já tenho conta</a>
                </div>
            </div>
        </div>
        <p class="text-center mt-4 mb-0">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">← Voltar ao site</a>
        </p>
    </div>
@endsection
