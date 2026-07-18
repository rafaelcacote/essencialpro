@extends('layouts.auth')

@section('title', 'Verificar e-mail - Essencial Pro')

@section('content')
    <div class="auth-card">
        <div class="auth-card-body">
            <h1 class="auth-heading">Verifique o seu e-mail</h1>
            <p class="auth-subheading">
                Obrigado por se registar! Antes de continuar, confirme o seu endereço de e-mail através da ligação que lhe enviámos.
                Se não recebeu o e-mail, podemos enviar outro.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success">
                    Foi enviada uma nova ligação de verificação para o endereço de e-mail indicado no registo.
                </div>
            @endif

            <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn btn-primary auth-submit-btn" type="submit">
                        Reenviar e-mail de verificação
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
