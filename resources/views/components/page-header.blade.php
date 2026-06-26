<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn{{ !empty($quicklink) ? ' page-header--quicklinks' : '' }}" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="page-header-title text-white animated slideInRight">{{ $title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb animated slideInRight mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->




