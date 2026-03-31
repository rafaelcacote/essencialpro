@extends('layouts.app')

@section('title', 'Carrinho - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => 'Carrinho de Compras'])

    <div class="container-xxl py-5">
        <div class="container">
            @if ($cart->items->isEmpty())
                <div class="alert alert-info">
                    Seu carrinho esta vazio. <a href="{{ route('product') }}">Ver produtos</a>.
                </div>
            @else
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produto</th>
                                            <th>Variacao</th>
                                            <th>Qtd.</th>
                                            <th>Preco</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->items as $item)
                                            @php $unitPrice = (float) ($item->product?->price ?? 0); @endphp
                                            <tr>
                                                <td>
                                                    <div class="fw-medium">{{ $item->product?->title ?? 'Produto indisponivel' }}</div>
                                                    @if ($item->product)
                                                        <a href="{{ route('products.show', $item->product) }}" class="small">Ver produto</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="small text-muted">
                                                        Cor: {{ $item->selected_color ?: '-' }}<br>
                                                        Tamanho: {{ $item->selected_size ?: '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('cart.items.update', $item) }}" class="d-flex gap-2">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" min="1" max="1000" name="quantity" value="{{ $item->quantity }}" class="form-control form-control-sm" style="width: 80px;">
                                                        <button class="btn btn-sm btn-outline-primary" type="submit">OK</button>
                                                    </form>
                                                </td>
                                                <td>R$ {{ number_format($unitPrice, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($unitPrice * $item->quantity, 2, ',', '.') }}</td>
                                                <td class="text-end">
                                                    <form method="POST" action="{{ route('cart.items.destroy', $item) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger" type="submit">Remover</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        @php
                            $subtotal = $cart->items->sum(fn ($item) => ((float) ($item->product?->price ?? 0)) * $item->quantity);
                        @endphp
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3">Resumo</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                </div>
                                <div class="small text-muted mb-3">Frete e pagamento definidos apos confirmacao do pedido.</div>
                                @auth
                                    <a href="{{ route('checkout.create') }}" class="btn btn-primary w-100 mb-2">Finalizar Pedido</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Entrar para Finalizar</a>
                                @endauth
                                <form method="POST" action="{{ route('cart.clear') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger w-100">Limpar carrinho</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
