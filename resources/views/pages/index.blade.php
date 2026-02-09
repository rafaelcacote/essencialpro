@extends('layouts.app')

@section('title', 'Essencial Pro - Equipamentos de Segurança do Trabalho')

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
                                <p class="fs-5 fw-medium text-primary text-uppercase animated slideInRight">Equipamentos de Segurança do Trabalho</p>
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
<!-- Project Start -->
<div class="container-fluid bg-dark pt-5 pb-5 mb-5 px-0">
    <div class="text-center mx-auto pt-4 wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <!-- <p class="fw-medium text-uppercase text-primary mb-2">Nossos Produtos</p> -->
            <h1 class="display-5 text-white mb-5">Equipamentos de Segurança para Todos os Segmentos</h1>
    </div>
    <div class="owl-carousel project-carousel wow fadeIn" data-wow-delay="0.1s">
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-1.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Botas de Segurança</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-2.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Calçados Especiais</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-3.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Abafadores</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-4.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">EPIs Diversos</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-5.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Equipamentos</h5>
            </div>
        </a>
        <a class="project-item" href="">
            <img class="img-fluid" src="{{ asset('img/project-6.jpg') }}" alt="">
            <div class="project-title">
                <h5 class="text-primary mb-0">Proteção Individual</h5>
            </div>
        </a>
    </div>
</div>
<!-- Project End -->

<!-- Our Products Start -->
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
<!-- Our Products End -->

<!-- Scan&Fit Banner Start -->
<div class="container-fluid scanfit-banner py-3 mt-5 mb-5">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-lg-3 text-center text-lg-start">
                <a href="{{ route('scanfit') }}" class="scanfit-brand d-inline-block text-decoration-none">
                    <div class="scanfit-logo">
                        <span class="scanfit-logo-scan">SCAN</span><span class="scanfit-logo-amp">&amp;</span><span class="scanfit-logo-fit">FIT</span>
                    </div>
                    <div class="scanfit-tagline">Unique comfort experience.</div>
                </a>
            </div>

            <div class="col-lg-6 text-center text-lg-start">
                <div class="scanfit-title">CADA PÉ O SEU CONFORTO</div>
                <div class="scanfit-subtitle">Faça um escaneamento 3D dos seus pés pelo app e escolha o sapato de trabalho ideal para você.</div>
            </div>

            <div class="col-lg-3 text-center text-lg-end">
                <a href="{{ route('scanfit') }}" class="btn btn-primary px-4 py-2 scanfit-cta">SAIBA MAIS</a>
            </div>
        </div>
    </div>
</div>
<!-- Scan&Fit Banner End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="row gx-3 h-100">
                    <div class="col-6 align-self-start wow fadeInUp" data-wow-delay="0.1s">
                        <img class="img-fluid" src="{{ asset('img/about-1.jpg') }}">
                    </div>
                    <div class="col-6 align-self-end wow fadeInDown" data-wow-delay="0.1s">
                        <img class="img-fluid" src="{{ asset('img/about-2.jpg') }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="fw-medium text-uppercase text-primary mb-2">Sobre Nós</p>
                <h1 class="display-5 mb-4">Essencial Pro - Especialistas em Segurança do Trabalho</h1>
                <p class="mb-4">A Essencial Pro é especializada em equipamentos de segurança do trabalho, oferecendo produtos de alta qualidade para proteger profissionais em diversos segmentos. Trabalhamos com botas de segurança, calçados especiais, abafadores de ouvidos e diversos outros equipamentos de proteção individual (EPI).</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary p-4">
                        <h1 class="display-2">25</h1>
                        <h5 class="text-white">Years of</h5>
                        <h5 class="text-white">Experience</h5>
                    </div>
                    <div class="ms-4">
                        <p><i class="fa fa-check text-primary me-2"></i>Botas de Segurança</p>
                        <p><i class="fa fa-check text-primary me-2"></i>Calçados de Segurança</p>
                        <p><i class="fa fa-check text-primary me-2"></i>Abafadores de Ouvidos</p>
                        <p><i class="fa fa-check text-primary me-2"></i>Equipamentos de Proteção</p>
                        <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>EPIs Certificados</p>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-envelope-open text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-2">Email us</p>
                                <h5 class="mb-0">info@example.com</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-phone-alt text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-2">Call us</p>
                                <h5 class="mb-0">+012 345 6789</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Facts Start -->
<div class="container-fluid facts my-5 p-5">
    <div class="row g-5">
        <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
            <div class="text-center border p-5">
                <i class="fa fa-certificate fa-3x text-white mb-3"></i>
                <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">25</h1>
                <span class="fs-5 fw-semi-bold text-white">Years Experience</span>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.3s">
            <div class="text-center border p-5">
                <i class="fa fa-users-cog fa-3x text-white mb-3"></i>
                <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">135</h1>
                <span class="fs-5 fw-semi-bold text-white">Team Members</span>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.5s">
            <div class="text-center border p-5">
                <i class="fa fa-users fa-3x text-white mb-3"></i>
                <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">957</h1>
                <span class="fs-5 fw-semi-bold text-white">Happy Clients</span>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 wow fadeIn" data-wow-delay="0.7s">
            <div class="text-center border p-5">
                <i class="fa fa-check-double fa-3x text-white mb-3"></i>
                <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">1839</h1>
                <span class="fs-5 fw-semi-bold text-white">Projects Done</span>
            </div>
        </div>
    </div>
</div>
<!-- Facts End -->

<!-- Featured Products Start -->
@if (!empty($featuredProducts) && $featuredProducts->count())
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Produtos em Destaque</p>
            <h1 class="display-5 mb-4">Confira nossos destaques</h1>
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

<!-- Partners Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto pb-4 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Marcas Parceiras</p>
            <h2 class="display-6 mb-0">Marcas Parceiras</h2>
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
<!-- Partners End -->


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




<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="fw-medium text-uppercase text-primary mb-2">Depoimentos</p>
            <h1 class="display-5 mb-5">O Que Nossos Clientes Dizem!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('img/testimonial-1.jpg') }}">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Excelente qualidade nos produtos da Essencial Pro. As botas de segurança são muito confortáveis e resistentes. Recomendo para todas as empresas que buscam segurança e qualidade.</p>
                    <h5 class="mb-1">João Silva</h5>
                    <span class="fst-italic">Engenheiro de Segurança</span>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('img/testimonial-2.jpg') }}">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Excelente qualidade nos produtos da Essencial Pro. As botas de segurança são muito confortáveis e resistentes. Recomendo para todas as empresas que buscam segurança e qualidade.</p>
                    <h5 class="mb-1">João Silva</h5>
                    <span class="fst-italic">Engenheiro de Segurança</span>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <div class="testimonial-img position-relative">
                    <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('img/testimonial-3.jpg') }}">
                    <div class="btn-square bg-primary rounded-circle">
                        <i class="fa fa-quote-left text-white"></i>
                    </div>
                </div>
                <div class="testimonial-text text-center rounded p-4">
                    <p>Excelente qualidade nos produtos da Essencial Pro. As botas de segurança são muito confortáveis e resistentes. Recomendo para todas as empresas que buscam segurança e qualidade.</p>
                    <h5 class="mb-1">João Silva</h5>
                    <span class="fst-italic">Engenheiro de Segurança</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection

