<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin - Essencial Pro')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="{{ asset('favicon.ico') }}" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Rubik:wght@500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body class="admin-body">
    @include('components.env-banner')
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                    <span class="admin-brand-badge">
                        <img src="{{ asset('img/logo_.png') }}" alt="Essencial Pro" style="width: 85%; height: 85%; object-fit: contain; padding: 2px;">
                    </span>
                    <span>
                        <div class="admin-brand-title">Essencial Pro</div>
                        <div class="admin-brand-subtitle">Painel Admin</div>
                    </span>
                </a>
            </div>

            <nav class="admin-nav">
                <div class="admin-nav-section">Menu</div>
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
                <a class="admin-nav-link @if (request()->routeIs('admin.coupons.*')) active @endif" href="{{ route('admin.coupons.index') }}">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Cupons</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.promo-campaigns.*')) active @endif" href="{{ route('admin.promo-campaigns.index') }}">
                    <i class="bi bi-megaphone"></i>
                    <span>Campanhas</span>
                </a>

                <div class="admin-nav-section">Atendimento</div>
                <a class="admin-nav-link @if (request()->routeIs('admin.customers.*')) active @endif" href="{{ route('admin.customers.index') }}">
                    <i class="bi bi-people"></i>
                    <span>Clientes</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.quotes.*')) active @endif" href="{{ route('admin.quotes.index') }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Orçamentos</span>
                </a>
                <a class="admin-nav-link @if (request()->routeIs('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-receipt"></i>
                    <span>Pedidos</span>
                </a>

                <div class="admin-nav-section">Site</div>
                <a class="admin-nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Ver site</span>
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                @if (auth()->check())
                    <div class="admin-user-chip">
                        <div class="admin-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                        <div>
                            <div class="admin-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                            <div class="admin-user-role">Administrador</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="admin-btn-logout" type="submit">
                            <i class="bi bi-box-arrow-left"></i> Sair
                        </button>
                    </form>
                @endif
            </div>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <div class="admin-topbar-title">@yield('page_title', 'Admin')</div>
                    @hasSection('page_subtitle')
                        <div class="admin-topbar-subtitle">@yield('page_subtitle')</div>
                    @endif
                </div>
            </header>

            <main class="admin-main">
                @include('admin.partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    @include('admin.partials.delete-modal')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @stack('scripts')
</body>

</html>
