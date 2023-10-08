
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->

    @include('layouts.partials.style')

    <!-- endinject -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
</head>

<body>
<main class="main-content">

    @yield('content')

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
<div class="enable-dark-mode dark-trigger">
    <ul>
        <li>
            <a href="#">
                <i class="uil uil-moon"></i>
            </a>
        </li>
    </ul>
</div>
<!-- inject:js-->

@include('layouts.partials.script')

<!-- endinject-->
</body>

</html>
