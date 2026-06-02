<div class="site-account-menu dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navAccountToggle">
    @guest
        <p class="site-account-menu__intro">
            Olá! Faça
            <a href="{{ route('login') }}">login</a>
            ou
            <a href="{{ route('register') }}">crie sua conta</a>
        </p>
    @else
        <p class="site-account-menu__intro">
            Olá, <strong>{{ auth()->user()->name }}</strong>
        </p>
    @endguest

    <ul class="site-account-menu__list list-unstyled mb-0">
        @guest
            <li>
                <a href="{{ route('login') }}" class="site-account-menu__item @if(request()->routeIs('login')) is-active @endif">
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                    <span>Entrar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="site-account-menu__item @if(request()->routeIs('register')) is-active @endif">
                    <i class="bi bi-person-plus" aria-hidden="true"></i>
                    <span>Criar Conta</span>
                </a>
            </li>
        @endguest

        <li>
            <a href="{{ route('account.orders') }}" class="site-account-menu__item @if(request()->routeIs('account.orders*', 'dashboard')) is-active @endif">
                <i class="bi bi-box-seam" aria-hidden="true"></i>
                <span>Meus Pedidos</span>
            </a>
        </li>
        <li>
            <a href="{{ route('orders.track') }}" class="site-account-menu__item @if(request()->routeIs('orders.track')) is-active @endif">
                <i class="bi bi-truck" aria-hidden="true"></i>
                <span>Acompanhar Pedido</span>
            </a>
        </li>
        <li>
            <a href="{{ route('wishlist') }}" class="site-account-menu__item @if(request()->routeIs('wishlist')) is-active @endif">
                <i class="bi bi-heart" aria-hidden="true"></i>
                <span>Lista de Desejos</span>
            </a>
        </li>

        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="site-account-menu__item site-account-menu__item--button w-100">
                        <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </li>
        @endguest
    </ul>
</div>
