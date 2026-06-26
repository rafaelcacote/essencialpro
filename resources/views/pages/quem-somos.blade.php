@extends('layouts.app')

@section('title', 'Sobre Nós - Essencial Pro')

@push('styles')
<style>
    .ep-about-tagline {
        display: inline-block;
        background: linear-gradient(135deg, rgba(255, 94, 20, 0.12) 0%, rgba(255, 94, 20, 0.05) 100%);
        border: 1px solid rgba(255, 94, 20, 0.25);
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.25rem;
    }
    .ep-about-hero-img {
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(11, 28, 62, 0.15);
    }
    .ep-about-hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .ep-about-hero-text p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    .ep-about-hero-text p:last-child {
        margin-bottom: 0;
    }
    .ep-about-sectors {
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
        margin-top: 1.25rem;
    }
    .ep-about-sector {
        background: #f0f3f8;
        border-radius: 50px;
        padding: 0.35rem 0.85rem;
        font-size: 0.82rem;
        font-weight: 500;
        color: #0b1c3e;
    }
    .ep-about-mv {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin: 4rem 0;
    }
    .ep-about-mv-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 2rem 2.25rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
    }
    .ep-about-mv-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 32px rgba(11, 28, 62, 0.1);
    }
    .ep-about-mv-card.is-mission {
        border-top: 4px solid var(--primary);
    }
    .ep-about-mv-card.is-vision {
        border-top: 4px solid #0b1c3e;
    }
    .ep-about-mv-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .ep-about-mv-card.is-mission .ep-about-mv-icon {
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
    }
    .ep-about-mv-card.is-vision .ep-about-mv-icon {
        background: rgba(11, 28, 62, 0.08);
        color: #0b1c3e;
    }
    .ep-about-mv-card h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0b1c3e;
        margin-bottom: 0.85rem;
    }
    .ep-about-mv-card p {
        color: #4a5568;
        line-height: 1.75;
        margin: 0;
    }
    .ep-about-section-title {
        text-align: center;
        max-width: 640px;
        margin: 0 auto 2.5rem;
    }
    .ep-about-section-title h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #0b1c3e;
        margin-bottom: 0.5rem;
    }
    .ep-about-section-title p {
        color: #5a6478;
        margin: 0;
        line-height: 1.65;
    }
    .ep-about-values {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.25rem;
        margin-bottom: 4rem;
    }
    .ep-about-value {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        color: #fff;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.15);
        transition: transform 0.25s ease;
    }
    .ep-about-value:hover {
        transform: translateY(-4px);
    }
    .ep-about-value-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.85rem;
    }
    .ep-about-value h3 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.65rem;
    }
    .ep-about-value p {
        font-size: 0.88rem;
        color: #b8c9e1;
        line-height: 1.55;
        margin: 0;
    }
    .ep-about-products {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 4rem;
    }
    .ep-about-product {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 12px;
        padding: 1rem 1.15rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .ep-about-product:hover {
        border-color: rgba(255, 94, 20, 0.35);
        box-shadow: 0 4px 16px rgba(11, 28, 62, 0.06);
    }
    .ep-about-product-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .ep-about-product span {
        font-size: 0.92rem;
        font-weight: 500;
        color: #0b1c3e;
        line-height: 1.4;
    }
    .ep-about-commitment {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 3rem 2.5rem;
        color: #c8d5e8;
        text-align: center;
        margin-bottom: 3rem;
    }
    .ep-about-commitment h2 {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.25rem;
    }
    .ep-about-commitment p {
        max-width: 720px;
        margin: 0 auto 1rem;
        line-height: 1.8;
        font-size: 1.02rem;
    }
    .ep-about-commitment p:last-of-type {
        margin-bottom: 0;
    }
    .ep-about-closing {
        display: inline-block;
        margin-top: 2rem;
        padding-top: 1.75rem;
        border-top: 1px solid rgba(255, 255, 255, 0.12);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--primary);
        letter-spacing: 0.3px;
    }
    .ep-about-contact {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
    }
    .ep-about-contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
    }
    .ep-about-contact-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }
    .ep-about-contact-item small {
        display: block;
        color: #5a6478;
        font-size: 0.82rem;
        margin-bottom: 0.15rem;
    }
    .ep-about-contact-item strong,
    .ep-about-contact-item a {
        color: #0b1c3e;
        font-size: 1rem;
        text-decoration: none;
    }
    .ep-about-contact-item a:hover {
        color: var(--primary);
    }
    @media (max-width: 991px) {
        .ep-about-mv,
        .ep-about-values,
        .ep-about-products {
            grid-template-columns: 1fr;
        }
        .ep-about-values {
            grid-template-columns: repeat(2, 1fr);
        }
        .ep-about-products {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 575px) {
        .ep-about-values,
        .ep-about-products,
        .ep-about-contact {
            grid-template-columns: 1fr;
        }
        .ep-about-commitment {
            padding: 2rem 1.25rem;
        }
        .ep-about-mv-card {
            padding: 1.5rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Sobre Nós', 'quicklink' => true])

<div class="container-xxl py-5">
    <div class="container">

        {{-- Hero --}}
        <div class="row g-5 align-items-center mb-2">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="ep-about-hero-img" style="min-height: 220px;">
                            <img src="{{ asset('img/home_sections/sobre-nos-equipe.png') }}" alt="Equipa Essencial Pro">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ep-about-hero-img mb-3" style="min-height: 130px;">
                            <img src="{{ asset('img/home_sections/equipamentos-protecao.png') }}" alt="Equipamentos de proteção">
                        </div>
                        <div class="ep-about-hero-img" style="min-height: 130px;">
                            <img src="{{ asset('img/home_sections/vestuario-trabalho.png') }}" alt="Vestuário profissional">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="ep-about-hero-text">
                    <p class="fw-medium text-uppercase text-primary mb-2">Sobre Nós</p>
                    <div class="ep-about-tagline">Essencial para o seu dia. Profissional para o seu negócio.</div>
                    <p>
                        A Essencial Pro nasceu com o propósito de fornecer Equipamentos de Proteção Individual (EPIs),
                        calçado de segurança, vestuário profissional e soluções de proteção para empresas e profissionais
                        que valorizam qualidade, conforto e segurança no seu dia a dia.
                    </p>
                    <p>
                        Trabalhamos para disponibilizar produtos que cumprem elevados padrões de qualidade, acompanhando
                        as exigências dos diferentes setores de atividade, desde a indústria e construção civil até à
                        logística, manutenção, saúde, hotelaria e serviços.
                    </p>
                    <div class="ep-about-sectors">
                        <span class="ep-about-sector">Indústria</span>
                        <span class="ep-about-sector">Construção Civil</span>
                        <span class="ep-about-sector">Logística</span>
                        <span class="ep-about-sector">Manutenção</span>
                        <span class="ep-about-sector">Saúde</span>
                        <span class="ep-about-sector">Hotelaria</span>
                        <span class="ep-about-sector">Serviços</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Missão & Visão --}}
        <div class="ep-about-mv">
            <div class="ep-about-mv-card is-mission wow fadeInUp" data-wow-delay="0.25s">
                <div class="ep-about-mv-icon"><i class="bi bi-bullseye"></i></div>
                <h2>A Nossa Missão</h2>
                <p>
                    A nossa missão é contribuir para ambientes de trabalho mais seguros, disponibilizando produtos fiáveis,
                    um atendimento próximo e um serviço eficiente que responda às necessidades dos nossos clientes.
                </p>
            </div>
            <div class="ep-about-mv-card is-vision wow fadeInUp" data-wow-delay="0.3s">
                <div class="ep-about-mv-icon"><i class="bi bi-eye"></i></div>
                <h2>A Nossa Visão</h2>
                <p>
                    Pretendemos afirmar a Essencial Pro como uma referência no fornecimento de EPIs e vestuário profissional
                    em Portugal e, futuramente, expandir a nossa presença para outros mercados europeus, mantendo sempre o
                    compromisso com a qualidade, a inovação e a confiança.
                </p>
            </div>
        </div>

        {{-- Valores --}}
        <div class="ep-about-section-title wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Os Nossos Valores</p>
            <h2>O que nos define</h2>
        </div>
        <div class="ep-about-values">
            <div class="ep-about-value wow fadeInUp" data-wow-delay="0.15s">
                <div class="ep-about-value-icon"><i class="bi bi-award"></i></div>
                <h3>Qualidade</h3>
                <p>Selecionamos produtos de fabricantes reconhecidos, garantindo elevados padrões de segurança, conforto e durabilidade.</p>
            </div>
            <div class="ep-about-value wow fadeInUp" data-wow-delay="0.2s">
                <div class="ep-about-value-icon"><i class="bi bi-handshake"></i></div>
                <h3>Compromisso</h3>
                <p>Valorizamos relações duradouras com clientes, fornecedores e parceiros, baseadas na transparência e na confiança.</p>
            </div>
            <div class="ep-about-value wow fadeInUp" data-wow-delay="0.25s">
                <div class="ep-about-value-icon"><i class="bi bi-person-badge"></i></div>
                <h3>Profissionalismo</h3>
                <p>Prestamos um serviço responsável, procurando responder de forma rápida e eficaz às necessidades de cada cliente.</p>
            </div>
            <div class="ep-about-value wow fadeInUp" data-wow-delay="0.3s">
                <div class="ep-about-value-icon"><i class="bi bi-shield-check"></i></div>
                <h3>Segurança</h3>
                <p>Acreditamos que a proteção dos profissionais é essencial para um ambiente de trabalho mais seguro e produtivo.</p>
            </div>
        </div>

        {{-- Produtos --}}
        <div class="ep-about-section-title wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Catálogo</p>
            <h2>O Que Pode Encontrar na Essencial Pro</h2>
        </div>
        <div class="ep-about-products wow fadeInUp" data-wow-delay="0.15s">
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-shield-check"></i></div>
                <span>Equipamentos de Proteção Individual (EPIs)</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-box-seam"></i></div>
                <span>Calçado de Segurança</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-person-badge"></i></div>
                <span>Vestuário Profissional</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-brightness-high"></i></div>
                <span>Vestuário de Alta Visibilidade</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-wind"></i></div>
                <span>Proteção Respiratória, Auditiva e Visual</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-hand-index-thumb"></i></div>
                <span>Luvas de Proteção</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-shield"></i></div>
                <span>Capacetes e Proteção da Cabeça</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-arrow-down-circle"></i></div>
                <span>Proteção Antiqueda</span>
            </div>
            <div class="ep-about-product">
                <div class="ep-about-product-icon"><i class="bi bi-brush"></i></div>
                <span>Personalização de vestuário profissional para empresas</span>
            </div>
        </div>

        {{-- Compromisso --}}
        <div class="ep-about-commitment wow fadeInUp" data-wow-delay="0.2s">
            <h2>O Nosso Compromisso</h2>
            <p>
                Na Essencial Pro procuramos oferecer uma experiência de compra simples, segura e transparente,
                aliando produtos de qualidade a um serviço de apoio dedicado.
            </p>
            <p>
                Mais do que fornecer equipamentos, queremos ser um parceiro de confiança para profissionais e empresas,
                contribuindo diariamente para locais de trabalho mais seguros.
            </p>
            <div class="ep-about-closing">Essencial para o seu dia. Profissional para o seu negócio.</div>
        </div>

        {{-- Contacto --}}
        <div class="ep-about-contact wow fadeInUp" data-wow-delay="0.25s">
            <div class="ep-about-contact-item">
                <div class="ep-about-contact-icon"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <small>Email</small>
                    <a href="mailto:essencialprotection@gmail.com"><strong>essencialprotection@gmail.com</strong></a>
                </div>
            </div>
            <div class="ep-about-contact-item">
                <div class="ep-about-contact-icon"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <small>Telefone</small>
                    <a href="tel:+351922026198"><strong>+351 922 026 198</strong></a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
