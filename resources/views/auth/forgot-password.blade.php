@extends('layouts.auth')

@section('title', 'Recuperar Senha - Essencial Pro')

@section('content')
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 text-center mb-3 fw-bold">Recuperar senha</h1>
                <p class="text-muted small text-center mb-4">Informe seu email para receber o link de redefinição.</p>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Enviar link</button>
                </form>
                <div class="mt-3 text-center small">
                    <a href="{{ route('login') }}">Voltar ao login</a>
                </div>
            </div>
        </div>
        <p class="text-center mt-4 mb-0">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">← Voltar ao site</a>
        </p>
    </div>
@endsection
