@extends('layouts.app')

@section('title', 'Suporte - Essencial Pro')

@push('styles')
<style>
    .ep-support-intro {
        max-width: 720px;
        margin: 0 auto 3rem;
        text-align: center;
    }
    .ep-support-intro p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 0;
    }
    .ep-support-help-title {
        text-align: center;
        margin-bottom: 2rem;
    }
    .ep-support-help-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 3rem;
    }
    .ep-support-help-item {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 12px;
        padding: 1.1rem 1.25rem;
        text-decoration: none;
        color: inherit;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }
    .ep-support-help-item:hover {
        border-color: rgba(255, 94, 20, 0.35);
        box-shadow: 0 6px 20px rgba(11, 28, 62, 0.08);
        transform: translateY(-2px);
        color: inherit;
    }
    .ep-support-help-item.is-static {
        cursor: default;
    }
    .ep-support-help-item.is-static:hover {
        transform: none;
    }
    .ep-support-help-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .ep-support-help-item span {
        font-size: 0.95rem;
        font-weight: 600;
        color: #0b1c3e;
        line-height: 1.4;
    }
    .ep-support-channels {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 3rem;
    }
    .ep-support-channel {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 2rem 1.5rem;
        text-align: center;
        color: #c8d5e8;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.15);
    }
    .ep-support-channel-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .ep-support-channel h3 {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #b8c9e1;
        margin-bottom: 0.5rem;
    }
    .ep-support-channel a,
    .ep-support-channel strong {
        display: block;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        line-height: 1.5;
    }
    .ep-support-channel a:hover {
        color: var(--primary);
    }
    .ep-support-channel p {
        margin: 0;
        font-size: 0.95rem;
        color: #fff;
        line-height: 1.6;
    }
    .ep-support-channel small {
        display: block;
        margin-top: 0.35rem;
        color: #b8c9e1;
        font-size: 0.82rem;
    }
    .ep-support-closing {
        background: linear-gradient(135deg, rgba(255, 94, 20, 0.08) 0%, rgba(255, 94, 20, 0.03) 100%);
        border: 1px solid rgba(255, 94, 20, 0.2);
        border-radius: 14px;
        padding: 2rem 2.25rem;
        text-align: center;
    }
    .ep-support-closing p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 1rem;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }
    .ep-support-closing p:last-child {
        margin-bottom: 0;
    }
    .ep-support-closing strong {
        color: #0b1c3e;
    }
    .ep-support-contact-cta {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 2rem;
    }
    .ep-support-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .ep-support-btn-primary {
        background: var(--primary);
        color: #fff;
    }
    .ep-support-btn-primary:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    .ep-support-btn-whatsapp {
        background: #25d366;
        color: #fff;
    }
    .ep-support-btn-whatsapp:hover {
        background: #1ebe57;
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .ep-support-channels {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575px) {
        .ep-support-help-grid {
            grid-template-columns: 1fr;
        }
        .ep-support-closing {
            padding: 1.5rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Suporte', 'quicklink' => true])

<div class="container-xxl py-5">
    <div class="container">

        <div class="ep-support-intro wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Suporte</p>
            <h1 class="display-6 mb-4">Estamos aqui para ajudar</h1>
            <p>
                Na Essencial Pro, estamos disponíveis para prestar um serviço de apoio rápido, profissional e eficiente.
                Caso tenha alguma dúvida sobre os nossos produtos, encomendas ou serviços, a nossa equipa terá todo o
                gosto em ajudar.
            </p>
        </div>

        <div class="ep-support-help-title wow fadeInUp" data-wow-delay="0.15s">
            <p class="fw-medium text-uppercase text-primary mb-2">Apoio ao cliente</p>
            <h2 class="h3 fw-bold text-dark">Como podemos ajudar?</h2>
        </div>

        <div class="ep-support-help-grid wow fadeInUp" data-wow-delay="0.2s">
            <a href="{{ route('product') }}" class="ep-support-help-item">
                <div class="ep-support-help-icon"><i class="bi bi-box-seam"></i></div>
                <span>Informações sobre produtos</span>
            </a>
            <div class="ep-support-help-item is-static">
                <div class="ep-support-help-icon"><i class="bi bi-cart-check"></i></div>
                <span>Apoio na realização de encomendas</span>
            </div>
            <a href="{{ route('orders.track') }}" class="ep-support-help-item">
                <div class="ep-support-help-icon"><i class="bi bi-truck"></i></div>
                <span>Estado e acompanhamento de encomendas</span>
            </a>
            <a href="{{ route('returns-policy') }}" class="ep-support-help-item">
                <div class="ep-support-help-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                <span>Trocas e devoluções</span>
            </a>
            <a href="{{ route('personalization') }}" class="ep-support-help-item">
                <div class="ep-support-help-icon"><i class="bi bi-brush"></i></div>
                <span>Personalização de vestuário profissional</span>
            </a>
            <a href="{{ route('contact') }}" class="ep-support-help-item">
                <div class="ep-support-help-icon"><i class="bi bi-building"></i></div>
                <span>Orçamentos para empresas</span>
            </a>
            <div class="ep-support-help-item is-static">
                <div class="ep-support-help-icon"><i class="bi bi-credit-card"></i></div>
                <span>Questões relacionadas com pagamentos e faturação</span>
            </div>
        </div>

        <div class="text-center mb-3 wow fadeInUp" data-wow-delay="0.25s">
            <p class="fw-medium text-uppercase text-primary mb-2">Contacto</p>
            <h2 class="h3 fw-bold text-dark">Canais de Atendimento</h2>
        </div>

        <div class="ep-support-channels wow fadeInUp" data-wow-delay="0.3s">
            <div class="ep-support-channel">
                <div class="ep-support-channel-icon"><i class="bi bi-envelope-fill"></i></div>
                <h3>E-mail</h3>
                <a href="mailto:essencialprotection@gmail.com">essencialprotection@gmail.com</a>
            </div>
            <div class="ep-support-channel">
                <div class="ep-support-channel-icon"><i class="bi bi-telephone-fill"></i></div>
                <h3>Telefone</h3>
                <a href="tel:+351922026198">+351 922 026 198</a>
            </div>
            <div class="ep-support-channel">
                <div class="ep-support-channel-icon"><i class="bi bi-clock-fill"></i></div>
                <h3>Horário de Atendimento</h3>
                <p>Segunda a Sexta-feira</p>
                <strong>09:00 às 18:00</strong>
                <small>(dias úteis)</small>
            </div>
        </div>

        <div class="ep-support-closing wow fadeInUp" data-wow-delay="0.35s">
            <p>
                Procuramos responder a todos os pedidos com a maior brevidade possível, garantindo um acompanhamento
                próximo e uma solução adequada às necessidades de cada cliente.
            </p>
            <p>
                <strong>A satisfação dos nossos clientes é uma prioridade para a Essencial Pro.</strong>
                Trabalhamos diariamente para prestar um serviço de confiança, transparente e orientado para a melhor
                experiência de compra.
            </p>
            <div class="ep-support-contact-cta">
                <a href="mailto:essencialprotection@gmail.com" class="ep-support-btn ep-support-btn-primary">
                    <i class="bi bi-envelope-fill"></i>
                    Enviar email
                </a>
                <a href="https://wa.me/351922026198" target="_blank" rel="noopener noreferrer" class="ep-support-btn ep-support-btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
