@extends('layouts.auth')

@section('title', 'Nova palavra-passe - Essencial Pro')

@section('content')
    <div class="w-100" style="max-width: 420px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h4 text-center mb-4 fw-bold">Definir nova palavra-passe</h1>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nova palavra-passe</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar palavra-passe</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Guardar nova palavra-passe</button>
                </form>
            </div>
        </div>
        <p class="text-center mt-4 mb-0">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none">← Voltar ao site</a>
        </p>
    </div>
@endsection
