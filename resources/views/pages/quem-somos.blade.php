@extends('layouts.app')

@section('title', 'Quem Somos - Essencial Pro')

@section('content')
@include('components.page-header', ['title' => 'Quem Somos'])

<!-- Quem Somos Start -->
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
                <p class="fw-medium text-uppercase text-primary mb-2">Quem Somos</p>
                <h1 class="display-5 mb-4">Essencial Pro — Segurança e Qualidade</h1>
                <p class="mb-4">
                    A Essencial Pro atua com foco em equipamentos e soluções para segurança no trabalho, oferecendo produtos
                    selecionados para diferentes setores e necessidades.
                </p>
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0 bg-primary p-4">
                        <h1 class="display-2">+</h1>
                        <h5 class="text-white">Qualidade</h5>
                        <h5 class="text-white">no atendimento</h5>
                    </div>
                    <div class="ms-4">
                        <p><i class="fa fa-check text-primary me-2"></i>Calçados e botas de segurança</p>
                        <p><i class="fa fa-check text-primary me-2"></i>EPIs e proteção individual</p>
                        <p><i class="fa fa-check text-primary me-2"></i>Vestuário profissional</p>
                        <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Acessórios e complementos</p>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-primary">
                                <i class="fa fa-envelope-open text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-2">Email</p>
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
                                <p class="mb-2">Telefone</p>
                                <h5 class="mb-0">+012 345 6789</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quem Somos End -->
@endsection

