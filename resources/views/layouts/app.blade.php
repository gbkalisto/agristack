{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('img/agristack-favicon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--plugins-->
    <link href="{{ asset('theme') }}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('theme') }}/css/pace.min.css" rel="stylesheet">
    <script src="{{ asset('theme') }}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('theme') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('theme') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('theme') }}/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('theme') }}/css/dark-theme.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/semi-dark.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/css/header-colors.css">
    <link rel="theme-link" href="https://codervent.com/rocker/demo/vertical/index.html">
    <link href="{{ asset('theme') }}/plugins/fancy-file-uploader/fancy_fileupload.css" rel="stylesheet" />
    <title>{{ config('app.name', 'Agitstack') }}</title>
    <style>
        .btn i {
            margin-right: 0px !important;
        }

        .input-group-text.text-danger {
            border-color: #dc3545 !important;
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->


        {{-- sidebar here --}}
        @include('layouts.partials.sidebar')

        <!--end sidebar wrapper -->
        <!--start header -->

        {{-- header here --}}
        @include('layouts.partials.header')
        <!--end header -->
        <!--start page wrapper -->

        {{-- main page here --}}

        <div class="page-wrapper">
            {{-- @include('layouts.partials.flash-messages') --}}
            @yield('content')
        </div>


        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        {{-- footer here --}}
        @include('layouts.partials.footer')

    </div>
    <!--end wrapper-->


    <!--start switcher-->
    @include('layouts.partials.theme-customizer')
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('theme') }}/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('theme') }}/js/jquery.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('theme') }}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('theme') }}/plugins/chartjs/js/chart.js"></script>
    <script src="{{ asset('theme') }}/js/index.js"></script>
    <script src="{{ asset('theme') }}/js/custom.js"></script>
    <!--app JS-->
    <script src="{{ asset('theme') }}/js/app.js"></script>
    <script src="{{ asset('theme') }}/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
    <script src="{{ asset('theme') }}/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
    <script src="{{ asset('theme') }}/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
    <script src="{{ asset('theme') }}/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
    <script>
        // new PerfectScrollbar(".app-container")
    </script>
</body>

<script>
    'undefined' === typeof _trfq || (window._trfq = []);
    'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
        'tccl.baseHost': 'secureserver.net'
    }, {
        'ap': 'cpsh-oh'
    }, {
        'server': 'p3plzcpnl509132'
    }, {
        'dcenter': 'p3'
    }, {
        'cp_id': '10399385'
    }, {
        'cp_cl': '8'
    }) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
</script>
<script src='{{ asset('theme') }}/signals/js/clients/scc-c2/scc-c2.min.js'></script>


@stack('scripts')


</html>
