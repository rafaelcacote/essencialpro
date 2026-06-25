@extends('layouts.app')

@section('title', 'Personalização - Essencial Pro')

@push('styles')
<style>
    .ep-pers-hero {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(11, 28, 62, 0.15);
        margin-bottom: 3rem;
    }
    .ep-pers-hero img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
    }
    .ep-pers-intro {
        max-width: 760px;
        margin: 0 auto 3rem;
        text-align: center;
    }
    .ep-pers-intro p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    .ep-pers-intro p:last-child {
        margin-bottom: 0;
    }
    .ep-pers-services-title {
        text-align: center;
        margin-bottom: 2rem;
    }
    .ep-pers-services {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 3.5rem;
    }
    .ep-pers-service {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        color: #fff;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.15);
        transition: transform 0.25s ease;
    }
    .ep-pers-service:hover {
        transform: translateY(-4px);
    }
    .ep-pers-service-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin-bottom: 0.85rem;
    }
    .ep-pers-service strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.4;
    }
    .ep-pers-steps {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    .ep-pers-step {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 2rem 1.75rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        height: 100%;
    }
    .ep-pers-step:hover {
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.1);
        transform: translateY(-3px);
    }
    .ep-pers-step-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 0.85rem;
        border-bottom: 2px solid #f0f3f8;
    }
    .ep-pers-step-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .ep-pers-step h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0b1c3e;
        margin: 0;
    }
    .ep-pers-step p {
        color: #4a5568;
        line-height: 1.75;
        margin: 0;
    }
    .ep-pers-cta {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 2.5rem 2rem;
        color: #c8d5e8;
        text-align: center;
    }
    .ep-pers-cta h3 {
        color: #fff;
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0.85rem;
    }
    .ep-pers-cta p {
        max-width: 640px;
        margin: 0 auto 1.5rem;
        line-height: 1.75;
    }
    .ep-pers-cta-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.75rem;
    }
    .ep-pers-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease, color 0.2s ease;
    }
    .ep-pers-cta-btn-primary {
        background: var(--primary);
        color: #fff;
    }
    .ep-pers-cta-btn-primary:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    .ep-pers-cta-btn-outline {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255, 255, 255, 0.35);
    }
    .ep-pers-cta-btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .ep-pers-services {
            grid-template-columns: repeat(2, 1fr);
        }
        .ep-pers-steps {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575px) {
        .ep-pers-services {
            grid-template-columns: 1fr;
        }
        .ep-pers-hero img {
            height: 200px;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Personalização'])

<div class="container-xxl py-5">
    <div class="container">

        <div class="ep-pers-hero wow fadeInUp" data-wow-delay="0.1s">
            <img src="{{ asset('img/home_sections/personalizamos-sua-marca.png') }}" alt="Personalização de vestuário profissional Essencial Pro">
        </div>

        <div class="ep-pers-intro wow fadeInUp" data-wow-delay="0.15s">
            <p class="fw-medium text-uppercase text-primary mb-2">Personalização</p>
            <h1 class="display-6 mb-4">A sua marca no vestuário profissional</h1>
            <p>
                Na Essencial Pro, disponibilizamos um serviço de personalização de vestuário profissional e equipamentos têxteis,
                permitindo que empresas reforcem a sua identidade visual e apresentem uma imagem mais profissional perante
                clientes e colaboradores.
            </p>
            <p>
                A personalização pode ser realizada através de diferentes técnicas, de acordo com o tipo de produto e a necessidade
                do cliente, garantindo um acabamento de elevada qualidade e durabilidade.
            </p>
        </div>

        <div class="ep-pers-services-title wow fadeInUp" data-wow-delay="0.2s">
            <p class="fw-medium text-uppercase text-primary mb-2">Serviços</p>
            <h2 class="h3 fw-bold text-dark">Serviços de Personalização</h2>
        </div>

        <div class="ep-pers-services wow fadeInUp" data-wow-delay="0.25s">
            <div class="ep-pers-service">
                <div class="ep-pers-service-icon"><i class="bi bi-scissors"></i></div>
                <strong>Bordado</strong>
            </div>
            <div class="ep-pers-service">
                <div class="ep-pers-service-icon"><i class="bi bi-layers"></i></div>
                <strong>Estampagem / Transfer</strong>
            </div>
            <div class="ep-pers-service">
                <div class="ep-pers-service-icon"><i class="bi bi-printer"></i></div>
                <strong>Impressão em vestuário profissional</strong>
            </div>
            <div class="ep-pers-service">
                <div class="ep-pers-service-icon"><i class="bi bi-brush"></i></div>
                <strong>Personalização com logótipos, nomes e identificação da empresa</strong>
            </div>
        </div>

        <div class="ep-pers-steps">
            <div class="ep-pers-step wow fadeInUp" data-wow-delay="0.3s">
                <div class="ep-pers-step-header">
                    <div class="ep-pers-step-icon"><i class="bi bi-list-check"></i></div>
                    <h3>Como funciona?</h3>
                </div>
                <p>
                    Após o pedido de orçamento, a nossa equipa analisa o tipo de artigo, a quantidade pretendida e o ficheiro
                    do logótipo ou imagem a aplicar. Sempre que necessário, será apresentada uma proposta antes do início da produção.
                </p>
            </div>
            <div class="ep-pers-step wow fadeInUp" data-wow-delay="0.35s">
                <div class="ep-pers-step-header">
                    <div class="ep-pers-step-icon"><i class="bi bi-clock-history"></i></div>
                    <h3>Prazos</h3>
                </div>
                <p>
                    Os prazos de produção variam consoante a quantidade de artigos, o tipo de personalização e a disponibilidade
                    dos produtos. O prazo estimado será sempre comunicado ao cliente antes da confirmação da encomenda.
                </p>
            </div>
            <div class="ep-pers-step wow fadeInUp" data-wow-delay="0.4s">
                <div class="ep-pers-step-header">
                    <div class="ep-pers-step-icon"><i class="bi bi-award"></i></div>
                    <h3>Qualidade e Acompanhamento</h3>
                </div>
                <p>
                    Trabalhamos para garantir um acabamento profissional, resistente e adequado às exigências do ambiente de trabalho,
                    assegurando que cada projeto responde às expectativas dos nossos clientes.
                </p>
            </div>
        </div>

        <div class="ep-pers-cta wow fadeInUp" data-wow-delay="0.45s">
            <h3>Pedido de Orçamento</h3>
            <p>
                Para solicitar um orçamento de personalização, entre em contacto com a Essencial Pro através dos meios
                disponibilizados na página de Suporte. A nossa equipa terá todo o gosto em ajudar a encontrar a solução
                mais adequada para a sua empresa.
            </p>
            <div class="ep-pers-cta-actions">
                <a href="{{ route('support') }}" class="ep-pers-cta-btn ep-pers-cta-btn-primary">
                    <i class="bi bi-chat-dots"></i>
                    Ir para a página de Suporte
                </a>
                <a href="mailto:essencialprotection@gmail.com" class="ep-pers-cta-btn ep-pers-cta-btn-outline">
                    <i class="bi bi-envelope-fill"></i>
                    essencialprotection@gmail.com
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
