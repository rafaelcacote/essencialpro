@extends('layouts.app')

@section('title', 'Termos e Condições - Essencial Pro')

@push('styles')
<style>
    .ep-terms-intro {
        max-width: 720px;
        margin: 0 auto 2.5rem;
        text-align: center;
    }
    .ep-terms-intro p {
        color: #5a6478;
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 0;
    }
    .ep-terms-company {
        background: linear-gradient(145deg, #0b1c3e 0%, #122a52 100%);
        border-radius: 14px;
        padding: 2rem 2.25rem;
        color: #c8d5e8;
        margin-bottom: 3rem;
        box-shadow: 0 8px 28px rgba(11, 28, 62, 0.18);
    }
    .ep-terms-company-title {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1.25rem;
        text-align: center;
    }
    .ep-terms-company-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem 2.5rem;
    }
    .ep-terms-company-col {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }
    .ep-terms-company-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    .ep-terms-company-item i {
        color: var(--primary);
        font-size: 1.1rem;
        margin-top: 0.15rem;
        flex-shrink: 0;
    }
    .ep-terms-company-item strong {
        display: block;
        color: #fff;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 0.2rem;
    }
    .ep-terms-company-item span,
    .ep-terms-company-item a {
        color: #b8c9e1;
        font-size: 0.95rem;
        line-height: 1.5;
        text-decoration: none;
    }
    .ep-terms-company-item a:hover {
        color: var(--primary);
    }
    .ep-terms-highlights {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
        margin-bottom: 3rem;
    }
    .ep-terms-highlight {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 1.5rem 1.25rem;
        text-align: center;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .ep-terms-highlight:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(11, 28, 62, 0.1);
    }
    .ep-terms-highlight-icon {
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
    .ep-terms-highlight strong {
        display: block;
        font-size: 1rem;
        font-weight: 700;
        color: #0b1c3e;
        margin-bottom: 0.3rem;
    }
    .ep-terms-highlight span {
        font-size: 0.85rem;
        color: #5a6478;
        line-height: 1.45;
    }
    .ep-terms-section {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 1.75rem 2rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 16px rgba(11, 28, 62, 0.05);
        transition: box-shadow 0.2s ease;
    }
    .ep-terms-section:hover {
        box-shadow: 0 6px 24px rgba(11, 28, 62, 0.08);
    }
    .ep-terms-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.85rem;
    }
    .ep-terms-section-number {
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
    .ep-terms-section-icon {
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
    .ep-terms-section-header h2 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0b1c3e;
        margin: 0;
    }
    .ep-terms-section p {
        color: #4a5568;
        line-height: 1.75;
        margin: 0;
        padding-left: 2.5rem;
    }
    .ep-terms-section p a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }
    .ep-terms-section p a:hover {
        text-decoration: underline;
    }
    .ep-terms-payment-list {
        list-style: none;
        padding: 0;
        margin: 0.75rem 0 0 2.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .ep-terms-payment-list li {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #f0f3f8;
        border-radius: 50px;
        padding: 0.35rem 0.85rem;
        font-size: 0.88rem;
        font-weight: 500;
        color: #0b1c3e;
    }
    .ep-terms-payment-list li i {
        color: var(--primary);
        font-size: 0.85rem;
    }
    .ep-terms-footer-note {
        background: linear-gradient(135deg, #0b1c3e 0%, #152d55 100%);
        border-radius: 14px;
        padding: 2rem 2.25rem;
        color: #c8d5e8;
        text-align: center;
        margin-top: 2rem;
    }
    .ep-terms-footer-note h3 {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.65rem;
    }
    .ep-terms-footer-note p {
        margin-bottom: 0;
        line-height: 1.7;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .ep-terms-footer-note a {
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
    }
    .ep-terms-footer-note a:hover {
        text-decoration: underline;
    }
    @media (max-width: 991px) {
        .ep-terms-highlights,
        .ep-terms-company-grid {
            grid-template-columns: 1fr;
        }
    }
    @media (max-width: 575px) {
        .ep-terms-section {
            padding: 1.35rem 1.15rem;
        }
        .ep-terms-section p,
        .ep-terms-payment-list {
            padding-left: 0;
            margin-left: 0;
        }
        .ep-terms-company {
            padding: 1.5rem 1.25rem;
        }
    }
</style>
@endpush

@section('content')
@include('components.page-header', ['title' => 'Termos e Condições', 'quicklink' => true])

<div class="container-xxl py-5">
    <div class="container">
        <div class="ep-terms-intro wow fadeInUp" data-wow-delay="0.1s">
            <p class="fw-medium text-uppercase text-primary mb-2">Informação legal</p>
            <h1 class="display-6 mb-4">Termos e Condições Essencial Pro</h1>
            <p>
                Consulte as condições que regulam a utilização do nosso website e a realização de encomendas
                na loja online da Essencial Pro.
            </p>
        </div>

        <div class="ep-terms-company wow fadeInUp" data-wow-delay="0.15s">
            <div class="ep-terms-company-title">Dados da Entidade</div>
            <div class="ep-terms-company-grid">
                <div class="ep-terms-company-col">
                    <div class="ep-terms-company-item">
                        <i class="bi bi-person-badge"></i>
                        <div>
                            <strong>Titular (ENI)</strong>
                            <span>Célio Barbosa da Silva</span>
                        </div>
                    </div>
                    <div class="ep-terms-company-item">
                        <i class="bi bi-shop"></i>
                        <div>
                            <strong>Nome Comercial</strong>
                            <span>Essencial Pro</span>
                        </div>
                    </div>
                    <div class="ep-terms-company-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <strong>Morada</strong>
                            <span>Travessa Professora Adélia Campos, 42, Serafão, 4820-770</span>
                        </div>
                    </div>
                </div>
                <div class="ep-terms-company-col">
                    <div class="ep-terms-company-item">
                        <i class="bi bi-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <a href="mailto:essencialprotection@gmail.com">essencialprotection@gmail.com</a>
                        </div>
                    </div>
                    <div class="ep-terms-company-item">
                        <i class="bi bi-card-text"></i>
                        <div>
                            <strong>NIF</strong>
                            <span>326876715</span>
                        </div>
                    </div>
                    <div class="ep-terms-company-item">
                        <i class="bi bi-telephone"></i>
                        <div>
                            <strong>Telefone</strong>
                            <a href="tel:+351922026198">+351 922 026 198</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ep-terms-highlights wow fadeInUp" data-wow-delay="0.2s">
            <div class="ep-terms-highlight">
                <div class="ep-terms-highlight-icon"><i class="bi bi-shield-check"></i></div>
                <strong>EPIs &amp; Vestuário</strong>
                <span>Equipamentos de proteção para profissionais e empresas</span>
            </div>
            <div class="ep-terms-highlight">
                <div class="ep-terms-highlight-icon"><i class="bi bi-percent"></i></div>
                <strong>Preços sem IVA</strong>
                <span>IVA discriminado antes da confirmação da encomenda</span>
            </div>
            <div class="ep-terms-highlight">
                <div class="ep-terms-highlight-icon"><i class="bi bi-lock"></i></div>
                <strong>Pagamentos seguros</strong>
                <span>MB WAY, Multibanco, Cartão e outros métodos</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.25s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">1</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-shop"></i></div>
                        <h2>Objeto</h2>
                    </div>
                    <p>
                        A Essencial Pro dedica-se à comercialização online de equipamentos de proteção individual (EPIs),
                        calçado de segurança, vestuário profissional e acessórios de proteção destinados a profissionais e empresas.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.28s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">2</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-globe"></i></div>
                        <h2>Campo de Aplicação</h2>
                    </div>
                    <p>
                        As presentes Condições Gerais regulam a utilização do website da Essencial Pro e aplicam-se
                        a todas as encomendas efetuadas através da loja online.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.31s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">3</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-pencil-square"></i></div>
                        <h2>Modificação das Condições Gerais de Venda</h2>
                    </div>
                    <p>
                        A Essencial Pro reserva-se o direito de alterar os presentes Termos e Condições a qualquer momento,
                        sendo as alterações publicadas no website.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.34s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">4</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-image"></i></div>
                        <h2>Características dos Produtos</h2>
                    </div>
                    <p>
                        As imagens dos produtos têm caráter ilustrativo. Poderão existir pequenas diferenças de cor,
                        acabamento ou apresentação relativamente ao produto entregue.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.37s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">5</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-tag"></i></div>
                        <h2>Preços</h2>
                    </div>
                    <p>
                        Os preços apresentados no website da Essencial Pro são indicados <em>sem IVA</em>, salvo indicação expressa em contrário.
                    </p>
                    <p>
                        O IVA será aplicado à taxa legal em vigor e apresentado de forma discriminada durante o processo de compra,
                        antes da confirmação da encomenda.
                    </p>
                    <p>
                        A Essencial Pro reserva-se o direito de alterar os preços dos produtos a qualquer momento, sem aviso prévio.
                        No entanto, as alterações de preço não afetarão encomendas já confirmadas e pagas pelo cliente.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.4s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">6</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-cart-check"></i></div>
                        <h2>Pedido de Encomenda</h2>
                    </div>
                    <p>
                        A realização de uma encomenda implica a aceitação integral dos presentes Termos e Condições.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.43s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">7</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-boxes"></i></div>
                        <h2>Disponibilidade dos Produtos</h2>
                    </div>
                    <p>
                        Todos os produtos apresentados encontram-se sujeitos à disponibilidade de stock.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.46s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">8</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-credit-card"></i></div>
                        <h2>Pagamento</h2>
                    </div>
                    <p>
                        A Essencial Pro disponibiliza métodos de pagamento seguros, incluindo MB WAY, Multibanco,
                        Cartão Bancário e outros meios disponibilizados no website.
                    </p>
                    <ul class="ep-terms-payment-list">
                        <li><i class="bi bi-phone"></i> MB WAY</li>
                        <li><i class="bi bi-bank"></i> Multibanco</li>
                        <li><i class="bi bi-credit-card-2-front"></i> Cartão Bancário</li>
                    </ul>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.49s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">9</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-award"></i></div>
                        <h2>Garantias</h2>
                    </div>
                    <p>
                        Todos os produtos comercializados beneficiam das garantias previstas pela legislação portuguesa aplicável.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.52s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">10</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-exclamation-triangle"></i></div>
                        <h2>Responsabilidade</h2>
                    </div>
                    <p>
                        A Essencial Pro não poderá ser responsabilizada por atrasos, falhas ou interrupções resultantes
                        de fatores externos ao seu controlo.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.55s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">11</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-c-circle"></i></div>
                        <h2>Propriedade Intelectual</h2>
                    </div>
                    <p>
                        Todos os conteúdos do website, incluindo textos, imagens, logótipos e elementos gráficos,
                        são propriedade da Essencial Pro ou dos respetivos titulares de direitos.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.58s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">12</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-journal-text"></i></div>
                        <h2>Lei Aplicável</h2>
                    </div>
                    <p>
                        Os presentes Termos e Condições regem-se pela legislação portuguesa em vigor.
                    </p>
                </div>

                <div class="ep-terms-section wow fadeInUp" data-wow-delay="0.61s">
                    <div class="ep-terms-section-header">
                        <div class="ep-terms-section-number">13</div>
                        <div class="ep-terms-section-icon"><i class="bi bi-people"></i></div>
                        <h2>Resolução Alternativa de Litígios</h2>
                    </div>
                    <p>
                        Em caso de litígio de consumo, o consumidor poderá recorrer a uma Entidade de Resolução
                        Alternativa de Litígios de Consumo. Mais informações disponíveis em
                        <a href="https://www.consumidor.gov.pt" target="_blank" rel="noopener noreferrer">www.consumidor.gov.pt</a>.
                    </p>
                </div>

                <div class="ep-terms-footer-note wow fadeInUp" data-wow-delay="0.65s">
                    <h3>Dúvidas sobre os nossos termos?</h3>
                    <p>
                        Estamos disponíveis para esclarecer qualquer questão através do email
                        <a href="mailto:essencialprotection@gmail.com">essencialprotection@gmail.com</a>
                        ou pelo telefone <a href="tel:+351922026198">+351 922 026 198</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
