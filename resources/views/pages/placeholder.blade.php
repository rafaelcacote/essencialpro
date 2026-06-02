@extends('layouts.app')

@section('title', $title . ' - Essencial Pro')

@section('content')
    @include('components.page-header', ['title' => $title])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="text-muted mb-0">Conteúdo em desenvolvimento.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
