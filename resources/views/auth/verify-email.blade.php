@extends('layouts.auth')

@section('title', 'Verificar Email - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Verifique seu email</h1>
            <p class="auth-subheading">
                Obrigado por se cadastrar! Antes de continuar, confirme seu endereço de email clicando no link que enviamos para você.
                Se não recebeu o email, podemos enviar outro.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success">
                    Um novo link de verificação foi enviado para o email informado no cadastro.
                </div>
            @endif

            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-primary auth-submit-btn" type="submit">
                        Reenviar email de verificação
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary auth-submit-btn">
                        Sair
                    </button>
                </form>
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
