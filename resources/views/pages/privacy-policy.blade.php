@extends('layouts.app')

@section('title', 'Política de Privacidade - Essencial Pro')

@push('styles')
<style>
    .ep-privacy-intro {
        max-width: 720px;
        margin: 0 auto 2.5rem;
        text-align: center;
    }
    .ep-privacy-intro p {
        color: #5a6478;
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 0;
    }
    .ep-privacy-updated {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: #f0f3f8;
        color: #5a6478;
        font-size: 0.88rem;
        font-weight: 500;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        margin-bottom: 1.25rem;
    }
    .ep-privacy-updated i {
        color: var(--primary);
    }
    .ep-privacy-rgpd {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 1.75rem 2rem;
        color: #c8d5e8;
        margin-bottom: 3rem;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.18);
    }
    .ep-privacy-rgpd-icon {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .ep-privacy-rgpd p {
        margin: 0;
        line-height: 1.7;
        font-size: 0.98rem;
    }
    .ep-privacy-highlights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 3rem;
    }
    .ep-privacy-highlight {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 1.5rem 1.25rem;
        text-align: center;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .ep-privacy-highlight:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(11, 28, 62, 0.1);
    }
    .ep-privacy-highlight-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }
    .ep-privacy-highlight strong {
        display: block;
        font-size: 1rem;
        font-weight: 700;
        color: #0b1c3e;
        margin-bottom: 0.3rem;
    }
    .ep-privacy-highlight span {
        font-size: 0.85rem;
        color: #5a6478;
        line-height: 1.45;
    }
    .ep-privacy-section {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 1.75rem 2rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: box-shadow 0.2s ease;
    }
    .ep-privacy-section:hover {
        box-shadow: 0 6px 24px rgba(11, 28, 62, 0.08);
    }
    .ep-privacy-section.is-rights {
        border-color: rgba(255, 94, 20, 0.2);
        background: linear-gradient(180deg, #fff 0%, #fffaf7 100%);
    }
    .ep-privacy-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.85rem;
    }
    .ep-privacy-section-number {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.88rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .ep-privacy-section-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: rgba(255, 94, 20, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        flex-shrink: 0;
    }
    .ep-privacy-section-header h2 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0b1c3e;
        margin: 0;
    }
    .ep-privacy-section p {
        color: #4a5568;
        line-height: 1.75;
        margin: 0;
        padding-left: 2.5rem;
    }
    .ep-privacy-tags {
        list-style: none;
        padding: 0;
        margin: 0.85rem 0 0 2.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.45rem;
    }
    .ep-privacy-tags li {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #f0f3f8;
        border-radius: 50px;
        padding: 0.35rem 0.85rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: #0b1c3e;
    }
    .ep-privacy-tags li i {
        color: var(--primary);
        font-size: 0.8rem;
    }
    .ep-privacy-rights-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.65rem;
        margin: 0.85rem 0 0 2.5rem;
    }
    .ep-privacy-right {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 94, 20, 0.08);
        border-radius: 8px;
        padding: 0.6rem 0.85rem;
        font-size: 0.88rem;
        font-weight: 500;
        color: #0b1c3e;
    }
    .ep-privacy-right i {
        color: var(--primary);
        flex-shrink: 0;
    }
    .ep-privacy-company {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 2rem 2.25rem;
        color: #c8d5e8;
        margin-top: 2rem;
    }
    .ep-privacy-company-title {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.25rem;
        text-align: center;
    }
    .ep-privacy-company-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        text-align: center;
    }
    .ep-privacy-company-item i {
        color: var(--primary);
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    .ep-privacy-company-item strong {
        display: block;
        color: #fff;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.25rem;
    }
    .ep-privacy-company-item span,
    .ep-privacy-company-item a {
        color: #b8c9e1;
        font-size: 0.95rem;
        text-decoration: none;
    }
    .ep-privacy-company-item a:hover {
        color: var(--primary);
    }
    .ep-privacy-contact-cta {
        text-align: center;
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .ep-privacy-contact-cta a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        padding: 0.7rem 1.4rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .ep-privacy-contact-cta a:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .ep-privacy-highlights,
        .ep-privacy-rights-grid,
        .ep-privacy-company-grid {
            grid-template-columns: 1fr;
        }
        .ep-privacy-rgpd {
            flex-direction: column;
            text-align: center;
        }
    }
    @media (max-width: 575px) {
        .ep-privacy-section {
            padding: 1.35rem 1.15rem;
        }
        .ep-privacy-section p,
        .ep-privacy-tags,
        .ep-privacy-rights-grid {
            padding-left: 0;
            margin-left: 0;
        }
        .ep-privacy-company {
            padding: 1.5rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Política de Privacidade'])

<div class="container-xxl py-5">
    <div class="container">
        <div class="ep-privacy-intro wow fadeInUp" data-wow-delay="0.1s">
            <div class="ep-privacy-updated">
                <i class="bi bi-calendar3"></i>
                Última atualização: 24 de junho de 2026
            </div>
            <p class="fw-medium text-uppercase text-primary mb-2">Proteção de dados</p>
            <h1 class="display-6 mb-4">A sua privacidade é a nossa prioridade</h1>
            <p>
                A Essencial Pro respeita a privacidade dos seus clientes e compromete-se a proteger os dados pessoais
                recolhidos através deste website.
            </p>
        </div>

        <div class="ep-privacy-rgpd wow fadeInUp" data-wow-delay="0.15s">
            <div class="ep-privacy-rgpd-icon"><i class="bi bi-shield-lock"></i></div>
            <p>
                Em conformidade com o <strong style="color: #fff;">Regulamento Geral sobre a Proteção de Dados (RGPD)</strong>
                e restante legislação aplicável, garantimos o tratamento responsável e transparente das suas informações pessoais.
            </p>
        </div>

        <div class="ep-privacy-highlights wow fadeInUp" data-wow-delay="0.2s">
            <div class="ep-privacy-highlight">
                <div class="ep-privacy-highlight-icon"><i class="bi bi-lock"></i></div>
                <strong>Dados protegidos</strong>
                <span>Tratamento seguro e em conformidade legal</span>
            </div>
            <div class="ep-privacy-highlight">
                <div class="ep-privacy-highlight-icon"><i class="bi bi-eye-slash"></i></div>
                <strong>Sem venda de dados</strong>
                <span>Não cedemos dados a terceiros para fins comerciais</span>
            </div>
            <div class="ep-privacy-highlight">
                <div class="ep-privacy-highlight-icon"><i class="bi bi-person-check"></i></div>
                <strong>Os seus direitos</strong>
                <span>Acesso, retificação, apagamento e mais</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.25s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">1</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-building"></i></div>
                        <h2>Quem é o responsável pelo tratamento dos seus dados pessoais?</h2>
                    </div>
                    <p>
                        A Essencial Pro é a entidade responsável pelo tratamento dos dados pessoais recolhidos através deste website.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.28s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">2</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-database"></i></div>
                        <h2>Que dados pessoais recolhemos?</h2>
                    </div>
                    <p>Recolhemos os seguintes tipos de informação:</p>
                    <ul class="ep-privacy-tags">
                        <li><i class="bi bi-person"></i> Nome completo</li>
                        <li><i class="bi bi-envelope"></i> E-mail</li>
                        <li><i class="bi bi-telephone"></i> Telefone</li>
                        <li><i class="bi bi-geo-alt"></i> Morada de faturação e entrega</li>
                        <li><i class="bi bi-mailbox"></i> Código postal</li>
                        <li><i class="bi bi-globe"></i> País</li>
                        <li><i class="bi bi-card-text"></i> NIF</li>
                        <li><i class="bi bi-cart"></i> Dados de encomendas</li>
                        <li><i class="bi bi-chat-left-text"></i> Formulários de contacto</li>
                    </ul>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.31s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">3</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-gear"></i></div>
                        <h2>Para que utilizamos os seus dados pessoais?</h2>
                    </div>
                    <p>
                        Processamento e gestão de encomendas, emissão de faturas, entrega de produtos, apoio ao cliente,
                        gestão de pedidos de informação, cumprimento de obrigações legais e melhoria dos serviços prestados.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.34s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">4</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-journal-check"></i></div>
                        <h2>Qual a base legal para o tratamento dos seus dados?</h2>
                    </div>
                    <p>
                        Execução de contratos, cumprimento de obrigações legais, consentimento do utilizador quando aplicável
                        e interesse legítimo da Essencial Pro.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.37s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">5</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-clock-history"></i></div>
                        <h2>Durante quanto tempo conservamos os seus dados?</h2>
                    </div>
                    <p>
                        Os dados pessoais serão conservados apenas durante o período necessário para cumprir as finalidades
                        para as quais foram recolhidos e para satisfazer obrigações legais, contabilísticas e fiscais.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.4s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">6</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-share"></i></div>
                        <h2>Com quem partilhamos os seus dados pessoais?</h2>
                    </div>
                    <p>
                        Os dados poderão ser partilhados com transportadoras, prestadores de serviços de pagamento,
                        plataformas de faturação e entidades públicas quando exigido por lei.
                        <strong> A Essencial Pro não vende nem cede dados pessoais a terceiros para fins comerciais.</strong>
                    </p>
                </div>

                <div class="ep-privacy-section is-rights wow fadeInUp" data-wow-delay="0.43s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">7</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-hand-index-thumb"></i></div>
                        <h2>Quais são os seus direitos?</h2>
                    </div>
                    <div class="ep-privacy-rights-grid">
                        <div class="ep-privacy-right"><i class="bi bi-eye"></i> Acesso</div>
                        <div class="ep-privacy-right"><i class="bi bi-pencil"></i> Retificação</div>
                        <div class="ep-privacy-right"><i class="bi bi-trash"></i> Apagamento</div>
                        <div class="ep-privacy-right"><i class="bi bi-pause-circle"></i> Limitação</div>
                        <div class="ep-privacy-right"><i class="bi bi-arrow-left-right"></i> Portabilidade</div>
                        <div class="ep-privacy-right"><i class="bi bi-x-circle"></i> Oposição</div>
                    </div>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.46s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">8</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-cookie"></i></div>
                        <h2>Utilização de Cookies</h2>
                    </div>
                    <p>
                        O website poderá utilizar cookies para melhorar a experiência de navegação, analisar estatísticas
                        de utilização e assegurar o correto funcionamento da plataforma.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.49s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">9</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <h2>Alterações à Política de Privacidade</h2>
                    </div>
                    <p>
                        A Essencial Pro reserva-se o direito de atualizar ou alterar a presente Política de Privacidade
                        sempre que necessário.
                    </p>
                </div>

                <div class="ep-privacy-section wow fadeInUp" data-wow-delay="0.52s">
                    <div class="ep-privacy-section-header">
                        <div class="ep-privacy-section-number">10</div>
                        <div class="ep-privacy-section-icon"><i class="bi bi-envelope-paper"></i></div>
                        <h2>Exercício dos seus direitos</h2>
                    </div>
                    <p>
                        Para exercer qualquer dos seus direitos relativamente aos seus dados pessoais, poderá utilizar os
                        meios de contacto disponibilizados na
                        <a href="{{ route('support') }}" class="text-primary fw-semibold">página de Suporte</a> do website.
                    </p>
                </div>

                <div class="ep-privacy-company wow fadeInUp" data-wow-delay="0.55s">
                    <div class="ep-privacy-company-title">Dados da Empresa — Essencial Pro</div>
                    <div class="ep-privacy-company-grid">
                        <div class="ep-privacy-company-item">
                            <i class="bi bi-building"></i>
                            <strong>Empresa</strong>
                            <span>Essencial Pro</span>
                        </div>
                        <div class="ep-privacy-company-item">
                            <i class="bi bi-envelope"></i>
                            <strong>Email</strong>
                            <a href="mailto:essencialprotection@gmail.com">essencialprotection@gmail.com</a>
                        </div>
                        <div class="ep-privacy-company-item">
                            <i class="bi bi-telephone"></i>
                            <strong>Telefone</strong>
                            <a href="tel:+351922026198">+351 922 026 198</a>
                        </div>
                    </div>
                    <div class="ep-privacy-contact-cta">
                        <a href="{{ route('support') }}">
                            <i class="bi bi-headset"></i>
                            Ir para a página de Suporte
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
