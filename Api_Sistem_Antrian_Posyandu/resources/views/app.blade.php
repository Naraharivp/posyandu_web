<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Untuk Tugas PUI">
    <meta name="author" content="Dimas">
    <title>ADMIN | @yield('title', 'Posyandu')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
</head>
<body class="nav-fixed">
    @guest
        @yield('body')
    @else
        @if (Auth::user()->role == 'useru')
            @yield('body')
        @else
            @include('dashboard.partials.navbar')
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    @include('dashboard.partials.sidebar')
                </div>
                <div id="layoutSidenav_content">
                    <div class="alert position-fixed end-0 mt-4 me-4" role="alert">
                        @include('flash::message')
                    </div>
                    <main>
                        @yield('header')
                        <div class="container-xl px-4 mt-n10">
                            @yield('body')
                        </div>
                    </main>
                </div>
            </div>
        @endif
    @endguest

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous" defer></script>
    <script src="{{ asset('js/datatables/datatables-simple-demo.js') }}" defer></script>
</body>
</html>
