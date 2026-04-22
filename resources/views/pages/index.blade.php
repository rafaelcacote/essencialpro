@extends('layouts.app')

@section('title', 'Essencial Pro - Equipamentos de Segurança do Trabalho')

@push('styles')
<style>
    .lista-imagens-strip {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .lista-imagens-strip .lista-imagens-inner {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.75rem clamp(1rem, 4vw, 4rem);
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .lista-imagens-strip .lista-imagens-inner img {
        flex: 0 0 auto;
        height: clamp(64px, 11vw, 160px);
        width: clamp(64px, 11vw, 160px);
        object-fit: contain;
    }
    .safety-priority-banner {
        background: #f1f1f3;
        width: 100%;
    }
    .safety-priority-banner .banner-content {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        padding: 1rem clamp(1rem, 4vw, 4rem);
    }
    .safety-priority-banner .banner-square {
        width: 32px;
        height: 32px;
        background: #f97316;
        flex: 0 0 32px;
    }
    .safety-priority-banner .banner-title {
        margin: 0;
        color: #0f172a;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.1;
        font-size: clamp(1.15rem, 2.2vw, 2.2rem);
    }
    .safety-priority-banner .banner-subtitle {
        margin: 0.25rem 0 0;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-size: clamp(0.7rem, 1.1vw, 0.95rem);
    }
    @media (min-width: 992px) {
        .lista-imagens-strip .lista-imagens-inner {
            overflow-x: visible;
            justify-content: space-evenly;
            gap: clamp(1.5rem, 2.5vw, 3rem);
        }
    }
    .priority-categories {
        background: #efefef;
        padding: clamp(1rem, 2vw, 1.75rem) clamp(0.75rem, 2vw, 2rem);
        margin-bottom: 2rem;
    }
    .priority-categories-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: clamp(0.85rem, 1.6vw, 1.5rem);
        width: 100%;
    }
    .priority-card {
        background: #fff;
        padding: 0.6rem;
    }
    .priority-card-image {
        width: 100%;
        aspect-ratio: 16 / 10;
        object-fit: cover;
        display: block;
    }
    .priority-card-caption {
        text-align: center;
        padding: 0.6rem 0.2rem 0.15rem;
    }
    .priority-card-title {
        margin: 0;
        color: #f97316;
        font-size: clamp(0.85rem, 1vw, 1rem);
        font-weight: 800;
        text-transform: uppercase;
    }
    .priority-card-subtitle {
        margin: 0.15rem 0 0;
        color: #6b7280;
        font-size: clamp(0.72rem, 0.9vw, 0.88rem);
    }
    .custom-brand-banner {
        width: 100%;
        margin: 1.5rem 0 0;
        text-align: center;
        position: relative;
    }
    .custom-brand-banner img {
        width: 100%;
        height: auto;
        display: block;
    }
    .custom-brand-cta {
        position: absolute;
        left: clamp(4rem, 12vw, 10rem);
        bottom: clamp(5rem, 12.8vw, 10.4rem);
        display: inline-block;
        margin-top: 0;
        background: #f97316;
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.95rem 2.2rem;
        font-weight: 800;
        font-size: clamp(0.95rem, 1.15vw, 1.1rem);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-decoration: none;
        box-shadow: 0 10px 22px rgba(249, 115, 22, 0.35);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        z-index: 2;
    }
    .custom-brand-cta:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(234, 88, 12, 0.38);
    }
    .custom-brand-cta:focus-visible {
        outline: 3px solid rgba(249, 115, 22, 0.3);
        outline-offset: 2px;
    }
    .featured-banner-fullbleed {
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
    }
    .partners-section {
        background: #f8fafc;
    }
    .partners-section .partners-section-inner {
        padding: clamp(2.25rem, 4vw, 3.5rem) 0;
    }
    .partners-section .partners-strip {
        background: #fff;
        border-radius: 14px;
        padding: clamp(0.6rem, 1.2vw, 1rem);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }
    @media (max-width: 991.98px) {
        .priority-categories-grid {
            grid-template-columns: 1fr;
        }
        .custom-brand-cta {
            left: 1rem;
            bottom: 1rem;
            font-size: 0.82rem;
            padding: 0.7rem 1.25rem;
        }
    }
</style>
@endpush

@php
    $listaImagensDir = public_path('img/lista_imagens');
    $listaImagensUrls = \Illuminate\Support\Facades\File::isDirectory($listaImagensDir)
        ? collect(\Illuminate\Support\Facades\File::files($listaImagensDir))
            ->filter(fn ($f) => in_array(strtolower($f->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true))
            ->sortBy(fn ($f) => \Illuminate\Support\Str::lower($f->getFilename()))
            ->map(fn ($f) => asset('img/lista_imagens/'.$f->getFilename()))
            ->values()
        : collect();
@endphp

@section('content')

<!-- Carousel Start -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-start">
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Segurança do Trabalho</p>
                                <h1 class="display-1 text-white mb-5 animated slideInRight">Essencial Pro - Sua Segurança em Primeiro Lugar</h1>
                                <a href="{{ route('service') }}" class="btn btn-primary py-3 px-5 animated slideInRight">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/images/calcados.png') }}" alt="Calçados">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-start">
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Nossos Produtos</p>
                                <h1 class="display-1 text-white mb-5 animated slideInRight">Calçados de Segurança</h1>
                                <a href="{{ route('product') }}" class="btn btn-primary py-3 px-5 animated slideInRight">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/images/equipamentos.png') }}" alt="Equipamentos de Segurança">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-start">
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Nossos Produtos</p>
                                <h1 class="display-1 text-white mb-5 animated slideInRight">Equipamentos de Segurança</h1>
                                <a href="{{ route('product') }}" class="btn btn-primary py-3 px-5 animated slideInRight">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/images/acessorios.jpg') }}" alt="Acessórios">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 text-start">
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Nossos Produtos</p>
                                <h1 class="display-1 text-white mb-5 animated slideInRight">Acessórios</h1>
                                <a href="{{ route('product') }}" class="btn btn-primary py-3 px-5 animated slideInRight">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->

@if ($listaImagensUrls->isNotEmpty())
    <div class="container-xxl pt-5 pb-0">
        <div class="container">
            <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="fw-medium text-uppercase text-primary mb-2">Catálogo</p>
                <h2 class="display-5 mb-0 text-nowrap">Nossos Produtos</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 lista-imagens-strip mb-4">
        <div class="container-fluid px-3 px-lg-5 lista-imagens-inner">
            @foreach ($listaImagensUrls as $url)
                <img src="{{ $url }}" alt="" loading="lazy">
            @endforeach
        </div>
    </div>
    <div class="container-fluid px-0 mb-4 safety-priority-banner">
        <div class="banner-content">
            <span class="banner-square" aria-hidden="true"></span>
            <div>
                <h3 class="banner-title">A SEGURANCA E A NOSSA PRIORIDADE</h3>
                <p class="banner-subtitle">UNIFORMES DE TRABALHO E EPIS</p>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 priority-categories">
        <div class="priority-categories-grid">
            <div class="priority-card">
                <img class="priority-card-image" src="{{ asset('img/home_sections/equipamentos-protecao.png') }}" alt="Equipamentos de proteção">
                <div class="priority-card-caption">
                    <h4 class="priority-card-title">Equipamentos de Protecao</h4>
                    <p class="priority-card-subtitle">As melhores solucoes para seguranca no trabalho.</p>
                </div>
            </div>
            <div class="priority-card">
                <img class="priority-card-image" src="{{ asset('img/home_sections/calcado-seguranca.png') }}" alt="Calçado de segurança">
                <div class="priority-card-caption">
                    <h4 class="priority-card-title">Calcado de Seguranca</h4>
                    <p class="priority-card-subtitle">Conforto e resistencia para o dia a dia.</p>
                </div>
            </div>
            <div class="priority-card">
                <img class="priority-card-image" src="{{ asset('img/home_sections/vestuario-trabalho.png') }}" alt="Vestuário de trabalho">
                <div class="priority-card-caption">
                    <h4 class="priority-card-title">Vestuario de Trabalho</h4>
                    <p class="priority-card-subtitle">Uniformes que unem protecao e desempenho.</p>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Featured Products Start -->
@if (!empty($featuredProducts) && $featuredProducts->count())
<div class="container-xxl py-5 mb-2">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Produtos em Destaque</p>
            <h1 class="display-5 mb-4 text-nowrap">Confira nossos destaques</h1>
        </div>

        <div class="owl-carousel featured-products-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($featuredProducts as $fp)
                @php
                    $img = $fp->cover_image_url ?: asset('img/service-1.jpg');
                    $excerpt = \Illuminate\Support\Str::limit((string) $fp->description, 90);
                @endphp
                <div class="service-item">
                    <img class="img-fluid" src="{{ $img }}" alt="{{ $fp->title }}">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ $img }}" alt="{{ $fp->title }}">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">{{ $fp->title }}</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">{{ $excerpt }}</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('products.show', $fp) }}">Ver Detalhes</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="custom-brand-banner featured-banner-fullbleed wow fadeInUp" data-wow-delay="0.15s">
        <img src="{{ asset('img/home_sections/personalizamos-sua-marca.png') }}" alt="Personalizamos sua marca">
        <a href="{{ route('contact') }}" class="custom-brand-cta">Solicite o seu orcamento</a>
    </div>
</div>
@endif
<!-- Featured Products End -->


<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="position-relative me-lg-4">
                    <img class="img-fluid w-100" src="{{ asset('img/feature.jpg') }}" alt="">
                    <span class="position-absolute top-50 start-100 translate-middle bg-white rounded-circle d-none d-lg-block" style="width: 120px; height: 120px;"></span>
                    <button type="button" class="btn-play" data-bs-toggle="modal"
                        data-src="https://www.youtube.com/embed/WAkl88qoO38" data-bs-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <p class="fw-medium text-uppercase text-primary mb-2">Por Que Escolher a Essencial Pro!</p>
                <h1 class="display-5 mb-4">Razões Para Escolher Nossos Produtos!</h1>
                <p class="mb-4">A Essencial Pro oferece equipamentos de segurança certificados, com qualidade comprovada e preços competitivos. Trabalhamos com as melhores marcas do mercado para garantir a proteção dos profissionais.</p>
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <span class="text-white" style="font-size: 22px;">🧵</span>
                            </div>
                            <div class="ms-4">
                                <h4>Qualidade Premium</h4>
                                <span>Materiais e acabamentos de alto padrão para maior durabilidade, conforto e segurança.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <span class="text-white" style="font-size: 22px;">👥</span>
                            </div>
                            <div class="ms-4">
                                <h4>Entrega Rápida</h4>
                                <span>Agilidade no atendimento e no envio para você receber o que precisa sem demora.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <span class="text-white" style="font-size: 22px;">👕</span>
                            </div>
                            <div class="ms-4">
                                <h4>Empresas de Todos os Setores</h4>
                                <span>Soluções para diferentes áreas: indústria, construção, logística, serviços e mais.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- Project Start -->
<!-- <div class="container-fluid bg-dark pt-5 pb-5 mb-5 px-0">
    <div class="text-center mx-auto pt-4 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Nossos Produtos</p>
            <h1 class="display-5 text-white mb-5">Equipamentos de Segurança para Todos os Segmentos</h1>
    </div>
    <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/calcado.jpeg') }}" alt="Calçados de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Calçados de Segurança</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/capacete.jpeg') }}" alt="Capacetes de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Capacetes</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/colete1.jpeg') }}" alt="Coletes de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Coletes</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/luvas.jpeg') }}" alt="Luvas de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Luvas de Proteção</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/mascara.jpeg') }}" alt="Máscaras de proteção respiratória">
            <div class="project-title">
                <h5 class="text-primary mb-0">Máscaras</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/oculos.jpeg') }}" alt="Óculos de proteção">
            <div class="project-title">
                <h5 class="text-primary mb-0">Óculos de Proteção</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/equipamentos_carrossel/protetor.jpeg') }}" alt="Protetores de segurança">
            <div class="project-title">
                <h5 class="text-primary mb-0">Protetores</h5>
            </div>
        </a>
    </div>
</div> -->
<!-- Project End -->


<!-- Our Products Start 
<div class="container-xxl py-5 mb-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 650px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Nossos Produtos</p>
            <h2 class="display-6 mb-3 text-uppercase" style="letter-spacing: 2px;">NOSSOS PRODUTOS</h2>
            <div class="mx-auto bg-primary" style="width: 90px; height: 3px;"></div>
        </div>

        <div class="row gy-5 gx-4">
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/calcados.png') }}" alt="Calçados">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/calcados.png') }}" alt="Calçados">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Calçados</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Botas e calçados de segurança com conforto, resistência e proteção para o dia a dia.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/equipamentos.png') }}" alt="Equipamentos de Proteção">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/equipamentos.png') }}" alt="Equipamentos de Proteção">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Equipamentos de Proteção</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">EPIs para proteção individual: auditiva, visual, respiratória, anti-queda e mais.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/vestuario.png') }}" alt="Vestuário de Trabalho">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/vestuario.png') }}" alt="Vestuário de Trabalho">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Vestuário de Trabalho</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Roupa profissional para diferentes setores: resistência, conforto e boa apresentação.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item h-100">
                    <img class="img-fluid" src="{{ asset('img/images/acessorios.jpg') }}" alt="Acessórios">
                    <div class="service-img">
                        <img class="img-fluid" src="{{ asset('img/images/acessorios.jpg') }}" alt="Acessórios">
                    </div>
                    <div class="service-detail">
                        <div class="service-title">
                            <hr class="w-25">
                            <h3 class="mb-0">Acessórios</h3>
                            <hr class="w-25">
                        </div>
                        <div class="service-text">
                            <p class="text-white mb-0">Complementos essenciais: malas, joelheiras, iluminação, primeiros socorros e outros.</p>
                        </div>
                    </div>
                    <a class="btn btn-light" href="{{ route('product') }}">Ver Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>
Our Products End -->

    

<!-- Products Partners Start -->
<div class="container-fluid px-0 partners-section">
    <div class="container-xxl partners-section-inner">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Produtos Parceiros</p>
            <h2 class="display-6 mb-0">Produtos Parceiros</h2>
        </div>

        <div class="partners-strip wow fadeInUp" data-wow-delay="0.1s">
            <div class="partners-strip-inner">
                @if (!empty($partners) && $partners->count())
                    @foreach ($partners as $partner)
                        <div class="partner-logo">
                            @if ($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener">
                                    <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}">
                                </a>
                            @else
                                <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}">
                            @endif
                        </div>
                    @endforeach
                @else
                    {{-- Placeholder enquanto não houver cadastros --}}
                    @for ($i = 0; $i < 5; $i++)
                        <div class="partner-logo @if ($i >= 3) d-none d-md-block @endif @if ($i >= 4) d-none d-lg-block @endif">
                            <div class="partner-logo-placeholder">
                                <i class="bi bi-image"></i>
                                <div>Logo</div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- Products Partners End -->


<!-- Video Modal Start -->
<div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                        allow="autoplay"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Modal End -->


{{-- Service section moved to top (below carousel) --}}




@endsection

