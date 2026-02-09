@extends('layouts.admin')

@section('title', 'Admin - Orçamento #' . $quote->id)

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h3 class="mb-1">Orçamento #{{ $quote->id }}</h3>
            <div class="text-muted">Criado em {{ $quote->created_at?->format('d/m/Y H:i') }}</div>
        </div>
        <a href="{{ route('admin.quotes.index') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Dados do Cliente</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-muted small">Tipo</div>
                            <div class="fw-medium">{{ $quote->client_type === 'company' ? 'Empresa' : 'Particular' }}</div>
                        </div>
                        @if ($quote->client_type === 'company')
                            <div class="col-md-6">
                                <div class="text-muted small">Empresa</div>
                                <div class="fw-medium">{{ $quote->company_name ?? '—' }}</div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="text-muted small">Nome</div>
                            <div class="fw-medium">{{ $quote->contact_name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Email</div>
                            <div class="fw-medium"><a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Telefone</div>
                            <div class="fw-medium">{{ $quote->phone }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">NIF / Contribuinte</div>
                            <div class="fw-medium">{{ $quote->tax_id }}</div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-3">Morada</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="text-muted small">Morada</div>
                            <div class="fw-medium">{{ $quote->address }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Código Postal</div>
                            <div class="fw-medium">{{ $quote->postal_code }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">Cidade</div>
                            <div class="fw-medium">{{ $quote->city }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted small">País</div>
                            <div class="fw-medium">{{ $quote->country }}</div>
                        </div>
                    </div>

                    @if ($quote->notes)
                        <hr class="my-4">
                        <h5 class="mb-2">Notas</h5>
                        <div class="bg-light border rounded p-3">{!! nl2br(e($quote->notes)) !!}</div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="mb-3">Produtos Pretendidos</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produto</th>
                                    <th>Referência</th>
                                    <th>Quantidade</th>
                                    <th>Cor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quote->items as $item)
                                    <tr>
                                        <td class="fw-medium">{{ $item->product_name }}</td>
                                        <td>{{ $item->reference ?? '—' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->color ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($quote->logos->isNotEmpty())
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">Logotipos</h5>
                        <div class="row g-3">
                            @foreach ($quote->logos as $logo)
                                <div class="col-md-4">
                                    <div class="border rounded p-2 bg-white">
                                        <a href="{{ asset($logo->file_path) }}" target="_blank">
                                            <img class="img-fluid rounded mb-2" src="{{ asset($logo->file_path) }}" alt="Logo" style="height: 140px; width: 100%; object-fit: cover;">
                                        </a>
                                        <div class="small">
                                            <div><span class="text-muted">Localização:</span> {{ $logo->location ?? '—' }}</div>
                                            <div><span class="text-muted">Peças:</span> {{ $logo->pieces ?? '—' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Status</h5>
                    <form method="POST" action="{{ route('admin.quotes.update', $quote) }}">
                        @csrf
                        @method('PUT')

                        <select class="form-select mb-3" name="status" required>
                            <option value="pending" @selected($quote->status === 'pending')>Pendente</option>
                            <option value="responded" @selected($quote->status === 'responded')>Respondido</option>
                            <option value="cancelled" @selected($quote->status === 'cancelled')>Cancelado</option>
                        </select>

                        <button class="btn btn-primary w-100" type="submit">Atualizar status</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="mb-3">Ações</h5>
                    <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" onsubmit="return confirm('Remover este orçamento?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100" type="submit">Excluir orçamento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

