<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin - Login')</title>
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
    <div class="auth-shell">
        <aside class="auth-brand-panel auth-brand-panel--admin" aria-hidden="true">
            <div class="auth-brand-content">
                <span class="auth-admin-badge">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    Área restrita
                </span>
                <img src="{{ asset('img/logo_new.jpeg') }}" alt="Essencial Pro" class="auth-brand-logo">
                <h2 class="auth-brand-title">Painel <span>Administrativo</span></h2>
                <p class="auth-brand-text">Gerencie produtos, pedidos e conteúdo do site com segurança. Acesso exclusivo para administradores autorizados.</p>
                <ul class="auth-brand-features">
                    <li><i class="fas fa-user-shield"></i> Acesso protegido e monitorado</li>
                    <li><i class="fas fa-box"></i> Gestão de catálogo e pedidos</li>
                    <li><i class="fas fa-chart-line"></i> Controle centralizado da operação</li>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
