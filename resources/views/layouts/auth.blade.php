<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Essencial Pro')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('components.env-banner')
    @if (session('status'))
        <div class="container position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050; max-width: 540px;">
            <div class="alert alert-success mb-0 shadow-sm border-0" style="border-radius: 10px;">{{ session('status') }}</div>
        </div>
    @endif

    <div class="auth-shell">
        <aside class="auth-brand-panel" aria-hidden="true">
            <div class="auth-brand-content">
                <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro" class="auth-brand-logo">
                <h2 class="auth-brand-title">Bem-vindo de volta à <span>Essencial Pro</span></h2>
                <p class="auth-brand-text">Acesse sua conta para acompanhar pedidos, gerenciar seu carrinho e encontrar os melhores equipamentos de proteção.</p>
                <ul class="auth-brand-features">
                    <li><i class="fas fa-shield-alt"></i> Produtos certificados e de qualidade</li>
                    <li><i class="fas fa-truck"></i> Acompanhe seus pedidos em tempo real</li>
                    <li><i class="fas fa-headset"></i> Suporte especializado</li>
                </ul>
            </div>
        </aside>

        <main class="auth-form-panel">
            <div class="auth-form-inner">
                <a href="{{ route('home') }}" class="auth-mobile-logo">
                    <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro">
                </a>
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
