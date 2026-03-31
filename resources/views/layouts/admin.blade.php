<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin - Essencial Pro')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                    <span class="admin-brand-badge">
                        <img src="{{ asset('img/logo_.png') }}" alt="Essencial Pro" style="width: 85%; height: 85%; object-fit: contain; padding: 2px;">
                    </span>
                    <span>
                        <div class="admin-brand-title">Essencial Pro</div>
                        <div class="admin-brand-subtitle">Gerenciamento Site</div>
                    </span>
                </a>
            </div>

            <nav class="admin-nav">
                <a class="admin-nav-link @if (request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.products.*')) active @endif" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-bag"></i>
                    <span>Produtos</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.categories.*')) active @endif" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-folder"></i>
                    <span>Categorias</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.partners.*')) active @endif" href="{{ route('admin.partners.index') }}">
                    <i class="bi bi-award"></i>
                    <span>Parceiros</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.quotes.*')) active @endif" href="{{ route('admin.quotes.index') }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Orçamentos</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-receipt"></i>
                    <span>Pedidos</span>
                </a>
                <a class="admin-nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Ver site</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                @if (auth()->check())
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-outline-light w-100" type="submit">
                            <i class="fa fa-sign-out-alt me-1"></i> Sair
                        </button>
                    </form>
                @endif
            </div>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <div class="admin-topbar-title">@yield('page_title', 'Admin')</div>
                    <div class="admin-topbar-subtitle">@yield('page_subtitle')</div>
                </div>
            </header>

            <main class="admin-main">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>

