@extends('layouts.app')

@section('title', 'Política de Envios e Entregas - Essencial Pro')

@push('styles')
<style>
    .ep-shipping-intro {
        max-width: 720px;
        margin: 0 auto 3rem;
        text-align: center;
    }
    .ep-shipping-intro p {
        color: #5a6478;
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 0;
    }
    .ep-shipping-highlights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 3rem;
    }
    .ep-shipping-highlight {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        color: #fff;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.18);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .ep-shipping-highlight:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(11, 28, 62, 0.24);
    }
    .ep-shipping-highlight-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255, 94, 20, 0.15);
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 0.85rem;
    }
    .ep-shipping-highlight strong {
        display: block;
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        color: #fff;
    }
    .ep-shipping-highlight span {
        font-size: 0.88rem;
        color: #b8c9e1;
        line-height: 1.45;
    }
    .ep-shipping-section {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 2rem 2.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: box-shadow 0.2s ease;
    }
    .ep-shipping-section:hover {
        box-shadow: 0 6px 24px rgba(11, 28, 62, 0.08);
    }
    .ep-shipping-section-header {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-bottom: 1.15rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f3f8;
    }
    .ep-shipping-section-icon {
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
    .ep-shipping-section-header h2 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0b1c3e;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .ep-shipping-section p {
        color: #4a5568;
        line-height: 1.75;
        margin-bottom: 0.85rem;
    }
    .ep-shipping-section p:last-child,
    .ep-shipping-section ul:last-child {
        margin-bottom: 0;
    }
    .ep-shipping-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, rgba(255, 94, 20, 0.12) 0%, rgba(255, 94, 20, 0.06) 100%);
        border: 1px solid rgba(255, 94, 20, 0.25);
        border-radius: 50px;
        padding: 0.55rem 1.1rem;
        font-weight: 600;
        color: var(--primary);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }
    .ep-shipping-badge i {
        font-size: 1rem;
    }
    .ep-shipping-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0;
    }
    .ep-shipping-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        color: #4a5568;
        line-height: 1.65;
        margin-bottom: 0.65rem;
        padding-left: 0;
    }
    .ep-shipping-list li i {
        color: var(--primary);
        margin-top: 0.2rem;
        flex-shrink: 0;
    }
    .ep-shipping-contact {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 2.25rem 2.5rem;
        color: #c8d5e8;
        text-align: center;
        margin-top: 2rem;
    }
    .ep-shipping-contact h3 {
        color: #fff;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    .ep-shipping-contact p {
        margin-bottom: 1.25rem;
        line-height: 1.7;
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
    }
    .ep-shipping-contact a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: background 0.2s ease, transform 0.2s ease;
    }
    .ep-shipping-contact a:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .ep-shipping-highlights {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575px) {
        .ep-shipping-section {
            padding: 1.5rem 1.25rem;
        }
        .ep-shipping-contact {
            padding: 1.75rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Política de Envios e Entregas'])

<div class="container-xxl py-5">
    <div class="container">
        <div class="ep-shipping-intro wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Política de Envios e Entregas</p>
            <h1 class="display-6 mb-4">Entregas</h1>
            <p>
                Na Essencial Pro trabalhamos diariamente para garantir um serviço de entrega eficiente, seguro e de qualidade.
                Após a confirmação do pagamento, a sua encomenda será processada e preparada para expedição com a maior brevidade possível.
            </p>
        </div>

        <div class="ep-shipping-highlights wow fadeInUp" data-wow-delay="0.2s">
            <div class="ep-shipping-highlight">
                <div class="ep-shipping-highlight-icon"><i class="bi bi-clock-history"></i></div>
                <strong>Prazo de Entrega</strong>
                <span>7 a 10 dias úteis após confirmação do pagamento</span>
            </div>
            <div class="ep-shipping-highlight">
                <div class="ep-shipping-highlight-icon"><i class="bi bi-truck"></i></div>
                <strong>Transportadora GLS</strong>
                <span>Entrega fiável com rastreamento sempre que disponível</span>
            </div>
            <div class="ep-shipping-highlight">
                <div class="ep-shipping-highlight-icon"><i class="bi bi-tag"></i></div>
                <strong>Custos de Envio</strong>
                <span>Calculados e apresentados antes da confirmação da compra</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.25s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-clock-history"></i></div>
                        <h2>Prazo de Entrega</h2>
                    </div>
                    <p>
                        O prazo estimado de entrega é de <strong>7 a 10 dias úteis</strong> após a confirmação do pagamento.
                    </p>
                    <p>
                        Em situações excecionais, nomeadamente devido a fatores logísticos, disponibilidade de stock ou outros
                        motivos alheios à Essencial Pro, este prazo poderá sofrer alterações, sendo o cliente devidamente informado.
                    </p>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.28s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-truck"></i></div>
                        <h2>Transportadora GLS</h2>
                    </div>
                    <p>
                        As encomendas são expedidas através da <strong>GLS</strong>, garantindo um serviço de entrega fiável
                        e com rastreamento sempre que disponível.
                    </p>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.31s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-cash-coin"></i></div>
                        <h2>Custos de Envio</h2>
                    </div>
                    <p>
                        Os custos de envio variam consoante o destino da encomenda e são apresentados de forma clara
                        antes da confirmação da compra.
                    </p>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.34s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-geo-alt"></i></div>
                        <h2>Portugal Continental</h2>
                    </div>
                    <ul class="ep-shipping-list">
                        <li>
                            <i class="bi bi-check2-circle"></i>
                            <span><strong>5,90 € + IVA</strong> para encomendas de valor inferior a 80,00 €.</span>
                        </li>
                        <li>
                            <i class="bi bi-check2-circle"></i>
                            <span>Portes gratuitos em encomendas de valor igual ou superior a <strong>80,00 €</strong> (válido exclusivamente para Portugal Continental).</span>
                        </li>
                    </ul>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.37s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-water"></i></div>
                        <h2>Madeira e Açores</h2>
                    </div>
                    <p>
                        Os custos de envio são calculados de acordo com o destino da encomenda e apresentados durante o processo de compra.
                    </p>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.4s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-globe-europe-africa"></i></div>
                        <h2>Espanha e Restantes Países da União Europeia</h2>
                    </div>
                    <p>
                        Efetuamos envios para diversos países da União Europeia. Os custos de envio variam consoante o país de destino
                        e serão calculados automaticamente, sendo apresentados antes da confirmação da encomenda.
                    </p>
                </div>

                <div class="ep-shipping-section wow fadeInUp" data-wow-delay="0.43s">
                    <div class="ep-shipping-section-header">
                        <div class="ep-shipping-section-icon"><i class="bi bi-info-circle"></i></div>
                        <h2>Informações de Entrega</h2>
                    </div>
                    <p>
                        Após a expedição da encomenda, o cliente poderá acompanhar o estado da entrega através do código
                        de rastreamento disponibilizado pela transportadora, sempre que aplicável.
                    </p>
                    <p>
                        Todas as encomendas são cuidadosamente preparadas e embaladas para garantir que os produtos cheguem
                        ao destino em perfeitas condições.
                    </p>
                    <p>
                        No momento da receção, recomendamos que o cliente verifique o estado da embalagem e dos produtos entregues.
                        Caso detete qualquer dano, erro ou falta de artigos na encomenda, deverá contactar a Essencial Pro através do
                        e-mail <a href="mailto:essencialprotection@gmail.com" class="text-primary fw-semibold">essencialprotection@gmail.com</a>,
                        preferencialmente no prazo máximo de <strong>72 horas</strong> após a receção, anexando fotografias da ocorrência
                        sempre que possível, para que possamos analisar e resolver a situação com a maior brevidade.
                    </p>
                    <p>
                        A Essencial Pro compromete-se a prestar todo o apoio necessário para garantir a melhor experiência
                        de compra aos seus clientes.
                    </p>
                </div>

                <div class="ep-shipping-contact wow fadeInUp" data-wow-delay="0.48s">
                    <h3>Precisa de ajuda com a sua encomenda?</h3>
                    <p>
                        Se tiver alguma dúvida sobre a sua encomenda ou necessitar de apoio, contacte-nos através do e-mail abaixo.
                        A nossa equipa terá todo o gosto em ajudar.
                    </p>
                    <a href="mailto:essencialprotection@gmail.com">
                        <i class="bi bi-envelope-fill"></i>
                        essencialprotection@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
