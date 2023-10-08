
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->

    @include('layouts.partials.style')

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    @stack('css')
</head>

<body class="layout-light side-menu">
<div class="mobile-search">
    <form action="/" class="search-form">
        <img src="img/svg/search.svg" alt="search" class="svg">
        <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..." aria-label="Search">
    </form>
</div>
<div class="mobile-author-actions"></div>
@include('layouts.partials.header')
<main class="main-content">

@include('layouts.partials.sidebar')

    <div class="contents">

        @yield('content')

    </div>
@include('layouts.partials.footer')
</main>
<div id="overlayer">
    <div class="loader-overlay">
        <div class="dm-spin-dots spin-lg">
            <span class="spin-dot badge-dot dot-primary"></span>
            <span class="spin-dot badge-dot dot-primary"></span>
            <span class="spin-dot badge-dot dot-primary"></span>
            <span class="spin-dot badge-dot dot-primary"></span>
        </div>
    </div>
</div>
<div class="overlay-dark-sidebar"></div>
<div class="customizer-overlay"></div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBgYKHZB_QKKLWfIRaYPCadza3nhTAbv7c"></script>
<!-- inject:js-->
@include('layouts.partials.script')
@stack('js')
<!-- endinject-->
</body>

</html>
