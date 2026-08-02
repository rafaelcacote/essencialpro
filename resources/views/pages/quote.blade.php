@extends('layouts.app')

@section('title', 'Pedir Orçamento - Essencial Pro')

@push('styles')
<style>
    .ep-contact-intro {
        max-width: 720px;
        margin: 0 auto 2.5rem;
        text-align: center;
    }
    .ep-contact-intro p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 0;
    }
    .ep-contact-sidebar {
        position: sticky;
        top: 20px;
    }
    .ep-contact-card {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 2rem 1.75rem;
        color: #c8d5e8;
        margin-bottom: 1.25rem;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.15);
    }
    .ep-contact-card-title {
        color: #fff;
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .ep-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-bottom: 1.25rem;
    }
    .ep-contact-item:last-child {
        margin-bottom: 0;
    }
    .ep-contact-item-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .ep-contact-item strong {
        display: block;
        color: #fff;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.25rem;
    }
    .ep-contact-item span,
    .ep-contact-item a {
        color: #b8c9e1;
        font-size: 0.95rem;
        line-height: 1.5;
        text-decoration: none;
    }
    .ep-contact-item a:hover {
        color: var(--primary);
    }
    .ep-contact-actions {
        display: flex;
        flex-direction: column;
        gap: 0.65rem;
    }
    .ep-contact-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.7rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .ep-contact-action-btn-primary {
        background: var(--primary);
        color: #fff;
    }
    .ep-contact-action-btn-primary:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    .ep-contact-action-btn-whatsapp {
        background: #25d366;
        color: #fff;
    }
    .ep-contact-action-btn-whatsapp:hover {
        background: #1ebe57;
        color: #fff;
        transform: translateY(-2px);
    }
    .ep-contact-form-wrap {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 2rem 2.25rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
    }
    .ep-contact-form-header {
        margin-bottom: 1.75rem;
        padding-bottom: 1.25rem;
        border-bottom: 2px solid #f0f3f8;
    }
    .ep-contact-form-header h2 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0b1c3e;
        margin-bottom: 0.5rem;
    }
    .ep-contact-form-header p {
        color: #5a6478;
        margin: 0;
        line-height: 1.65;
    }
    .ep-quote-steps {
        list-style: none;
        padding: 0;
        margin: 0 0 1.25rem;
    }
    .ep-quote-steps li {
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
        margin-bottom: 0.9rem;
        color: #b8c9e1;
        font-size: 0.92rem;
        line-height: 1.45;
    }
    .ep-quote-steps li:last-child {
        margin-bottom: 0;
    }
    .ep-quote-step-num {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.2);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    @media (max-width: 991px) {
        .ep-contact-sidebar {
            position: relative;
            top: 0;
            margin-bottom: 2rem;
        }
    }
    @media (max-width: 575px) {
        .ep-contact-form-wrap {
            padding: 1.5rem 1.15rem;
        }
        .ep-contact-card {
            padding: 1.5rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Pedir Orçamento', 'quicklink' => true])

<div class="container-xxl py-5">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Não foi possível enviar o pedido.</strong> Verifique os campos assinalados e tente novamente.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="ep-contact-intro wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Orçamento</p>
            <h1 class="display-6 mb-4">Peça o seu orçamento</h1>
            <p>
                Indique os produtos pretendidos, quantidades e, se desejar, os logótipos para personalização.
                A nossa equipa analisa o pedido e responde por email.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="ep-contact-sidebar">
                    <div class="ep-contact-card">
                        <div class="ep-contact-card-title">Como funciona</div>
                        <ul class="ep-quote-steps">
                            <li>
                                <span class="ep-quote-step-num">1</span>
                                <span>Preencha os seus dados e os produtos pretendidos.</span>
                            </li>
                            <li>
                                <span class="ep-quote-step-num">2</span>
                                <span>Anexe logótipos se precisar de personalização.</span>
                            </li>
                            <li>
                                <span class="ep-quote-step-num">3</span>
                                <span>Receba a proposta por email em 24h a 48h.</span>
                            </li>
                        </ul>

                        <div class="ep-contact-item">
                            <div class="ep-contact-item-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <strong>Telefone</strong>
                                <a href="tel:+351922026198">+351 922 026 198</a>
                            </div>
                        </div>

                        <div class="ep-contact-item">
                            <div class="ep-contact-item-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <strong>E-mail</strong>
                                <a href="mailto:essencialprotection@gmail.com">essencialprotection@gmail.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="ep-contact-actions">
                        <a href="tel:+351922026198" class="ep-contact-action-btn ep-contact-action-btn-primary">
                            <i class="bi bi-telephone-fill"></i>
                            Ligar agora
                        </a>
                        <a href="https://wa.me/351922026198" target="_blank" rel="noopener noreferrer" class="ep-contact-action-btn ep-contact-action-btn-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.2s">
                <div class="ep-contact-form-wrap" id="formulario-orcamento">
                    @include('partials.quote-form', [
                        'formTitle' => 'Formulário de Orçamento',
                        'formSubtitle' => 'Campos marcados com * são obrigatórios. Os orçamentos são habitualmente respondidos entre 24h a 48h.',
                        'submitLabel' => 'Enviar Pedido de Orçamento',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
