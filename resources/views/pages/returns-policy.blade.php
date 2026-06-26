@extends('layouts.app')

@section('title', 'Trocas, Devoluções e Reembolsos - Essencial Pro')

@push('styles')
<style>
    .ep-returns-intro {
        max-width: 720px;
        margin: 0 auto 2.5rem;
        text-align: center;
    }
    .ep-returns-intro p {
        color: #5a6478;
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 0;
    }
    .ep-returns-updated {
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
    .ep-returns-updated i {
        color: var(--primary);
    }
    .ep-returns-highlights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 3rem;
    }
    .ep-returns-highlight {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        color: #fff;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.18);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .ep-returns-highlight:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(11, 28, 62, 0.24);
    }
    .ep-returns-highlight-icon {
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
    .ep-returns-highlight strong {
        display: block;
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        color: #fff;
    }
    .ep-returns-highlight span {
        font-size: 0.88rem;
        color: #b8c9e1;
        line-height: 1.45;
    }
    .ep-returns-section {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 2rem 2.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: box-shadow 0.2s ease;
    }
    .ep-returns-section:hover {
        box-shadow: 0 6px 24px rgba(11, 28, 62, 0.08);
    }
    .ep-returns-section.is-warning {
        border-color: rgba(255, 94, 20, 0.2);
        background: linear-gradient(180deg, #fff 0%, #fffaf7 100%);
    }
    .ep-returns-section-header {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        margin-bottom: 1.15rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0f3f8;
    }
    .ep-returns-section-number {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .ep-returns-section-icon {
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
    .ep-returns-section-header h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #0b1c3e;
        margin: 0;
        letter-spacing: 0.2px;
    }
    .ep-returns-section p {
        color: #4a5568;
        line-height: 1.75;
        margin-bottom: 0.85rem;
    }
    .ep-returns-section p:last-of-type {
        margin-bottom: 0;
    }
    .ep-returns-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0;
    }
    .ep-returns-list li {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        color: #4a5568;
        line-height: 1.65;
        margin-bottom: 0.65rem;
    }
    .ep-returns-list li i {
        color: var(--primary);
        margin-top: 0.2rem;
        flex-shrink: 0;
    }
    .ep-returns-list li:last-child {
        margin-bottom: 0;
    }
    .ep-returns-note {
        display: flex;
        align-items: flex-start;
        gap: 0.65rem;
        background: rgba(255, 94, 20, 0.08);
        border-left: 3px solid var(--primary);
        border-radius: 0 8px 8px 0;
        padding: 0.85rem 1rem;
        margin-top: 1rem;
        color: #4a5568;
        font-size: 0.95rem;
        line-height: 1.65;
    }
    .ep-returns-note i {
        color: var(--primary);
        margin-top: 0.15rem;
        flex-shrink: 0;
    }
    .ep-returns-contact {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 2.25rem 2.5rem;
        color: #c8d5e8;
        text-align: center;
        margin-top: 2rem;
    }
    .ep-returns-contact h3 {
        color: #fff;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    .ep-returns-contact p {
        margin-bottom: 1.25rem;
        line-height: 1.7;
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
    }
    .ep-returns-contact a {
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
    .ep-returns-contact a:hover {
        background: #e04f0a;
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 991px) {
        .ep-returns-highlights {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575px) {
        .ep-returns-section {
            padding: 1.5rem 1.25rem;
        }
        .ep-returns-contact {
            padding: 1.75rem 1.25rem;
        }
        .ep-returns-section-header h2 {
            font-size: 1.05rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Trocas, Devoluções e Reembolsos', 'quicklink' => true])

<div class="container-xxl py-5">
    <div class="container">
        <div class="ep-returns-intro wow fadeInUp" data-wow-delay="0.1s">
            <div class="ep-returns-updated">
                <i class="bi bi-calendar3"></i>
                Última atualização: Junho de 2026
            </div>
            <p class="fw-medium text-uppercase text-primary mb-2">Política de devoluções</p>
            <h1 class="display-6 mb-4">Transparência em cada etapa da sua compra</h1>
            <p>
                Conheça as condições para trocas, devoluções e reembolsos na Essencial Pro.
                Trabalhamos para garantir um processo claro, justo e em conformidade com a legislação aplicável.
            </p>
        </div>

        <div class="ep-returns-highlights wow fadeInUp" data-wow-delay="0.2s">
            <div class="ep-returns-highlight">
                <div class="ep-returns-highlight-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                <strong>14 dias</strong>
                <span>Direito de livre resolução para clientes particulares</span>
            </div>
            <div class="ep-returns-highlight">
                <div class="ep-returns-highlight-icon"><i class="bi bi-palette"></i></div>
                <strong>Personalizados</strong>
                <span>Condições específicas para artigos personalizados</span>
            </div>
            <div class="ep-returns-highlight">
                <div class="ep-returns-highlight-icon"><i class="bi bi-credit-card"></i></div>
                <strong>Reembolso</strong>
                <span>Processado após receção e inspeção do artigo</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.25s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">1</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-shield-check"></i></div>
                        <h2>Direito de Livre Resolução</h2>
                    </div>
                    <p>
                        Nos termos da legislação aplicável ao comércio eletrónico, o cliente particular dispõe de
                        <strong>14 dias</strong> após a receção da encomenda para exercer o direito de livre resolução,
                        sem necessidade de indicar qualquer motivo.
                    </p>
                    <p>Para que a devolução seja aceite, o produto deverá:</p>
                    <ul class="ep-returns-list">
                        <li><i class="bi bi-check2-circle"></i><span>Encontrar-se sem sinais de utilização;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Estar na embalagem original;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Conter etiquetas, acessórios e documentação original;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Estar em condições de revenda.</span></li>
                    </ul>
                </div>

                <div class="ep-returns-section is-warning wow fadeInUp" data-wow-delay="0.3s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">2</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-brush"></i></div>
                        <h2>Produtos Personalizados</h2>
                    </div>
                    <p>
                        Por se tratarem de artigos produzidos ou personalizados de acordo com as especificações do cliente,
                        <strong>não são aceites devoluções, trocas ou reembolsos</strong> de produtos personalizados através de:
                    </p>
                    <ul class="ep-returns-list">
                        <li><i class="bi bi-x-circle"></i><span>Bordado;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>DTF (Direct to Film);</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Impressão personalizada;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Aplicação de logótipos;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Nomes, textos ou imagens fornecidas pelo cliente;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Qualquer outra personalização solicitada pelo cliente.</span></li>
                    </ul>
                    <div class="ep-returns-note">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Exceto em casos de defeito de fabrico ou erro imputável à Essencial Pro.</span>
                    </div>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.35s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">3</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-building"></i></div>
                        <h2>Encomendas Empresariais (B2B)</h2>
                    </div>
                    <p>
                        As encomendas realizadas por empresas, profissionais ou entidades para fins comerciais estão sujeitas
                        a condições específicas. Após aprovação de orçamento, amostras digitais, maquetes ou personalizações,
                        <strong>não serão aceites cancelamentos, devoluções ou reembolsos</strong> de artigos produzidos,
                        encomendados ou personalizados especificamente para o cliente.
                    </p>
                    <p>Recomendamos a verificação cuidadosa de:</p>
                    <ul class="ep-returns-list">
                        <li><i class="bi bi-check2-circle"></i><span>Quantidades;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Tamanhos;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Cores;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Personalizações;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Dados da empresa;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Logótipos enviados.</span></li>
                    </ul>
                    <div class="ep-returns-note">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span>A aprovação final do cliente constitui autorização para produção.</span>
                    </div>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.4s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">4</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-patch-exclamation"></i></div>
                        <h2>Produtos Defeituosos ou Enviados Incorretamente</h2>
                    </div>
                    <p>
                        Caso receba um produto com defeito de fabrico ou diferente do encomendado, deverá contactar-nos no
                        prazo máximo de <strong>14 dias</strong> após a receção da encomenda.
                    </p>
                    <p>
                        Após análise e validação da situação, a Essencial Pro procederá à substituição do produto ou ao
                        respetivo reembolso, <strong>sem custos adicionais</strong> para o cliente.
                    </p>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.45s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">5</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-envelope-paper"></i></div>
                        <h2>Processo de Devolução</h2>
                    </div>
                    <p>
                        Para solicitar uma devolução, troca ou análise de ocorrência, o cliente deverá contactar-nos através do email:
                        <a href="mailto:essencialprotection@gmail.com" class="text-primary fw-semibold">essencialprotection@gmail.com</a>
                    </p>
                    <p>Indicando:</p>
                    <ul class="ep-returns-list">
                        <li><i class="bi bi-check2-circle"></i><span>Número da encomenda;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Nome do cliente;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Motivo da solicitação;</span></li>
                        <li><i class="bi bi-check2-circle"></i><span>Fotografias do produto, quando aplicável.</span></li>
                    </ul>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.5s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">6</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-cash-coin"></i></div>
                        <h2>Reembolsos</h2>
                    </div>
                    <p>
                        Após receção e inspeção do artigo devolvido, o reembolso será processado através do mesmo método
                        de pagamento utilizado na compra.
                    </p>
                    <p>
                        O prazo de processamento poderá variar consoante a instituição bancária ou método de pagamento utilizado.
                    </p>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.55s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">7</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-truck"></i></div>
                        <h2>Custos de Devolução</h2>
                    </div>
                    <p>
                        Salvo erro da Essencial Pro, defeito de fabrico ou envio incorreto, os custos de devolução
                        ficam a cargo do cliente.
                    </p>
                </div>

                <div class="ep-returns-section wow fadeInUp" data-wow-delay="0.6s">
                    <div class="ep-returns-section-header">
                        <div class="ep-returns-section-number">8</div>
                        <div class="ep-returns-section-icon"><i class="bi bi-slash-circle"></i></div>
                        <h2>Recusa de Devoluções</h2>
                    </div>
                    <p>A Essencial Pro reserva-se o direito de recusar devoluções de produtos que:</p>
                    <ul class="ep-returns-list">
                        <li><i class="bi bi-x-circle"></i><span>Apresentem sinais de utilização;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Tenham sido lavados ou alterados;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Não se encontrem na embalagem original;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Não incluam etiquetas originais;</span></li>
                        <li><i class="bi bi-x-circle"></i><span>Sejam produtos personalizados ou produzidos por encomenda.</span></li>
                    </ul>
                </div>

                <div class="ep-returns-contact wow fadeInUp" data-wow-delay="0.65s">
                    <h3>Precisa solicitar uma devolução ou troca?</h3>
                    <p>
                        A nossa equipa está disponível para analisar o seu pedido e orientá-lo em todo o processo.
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
