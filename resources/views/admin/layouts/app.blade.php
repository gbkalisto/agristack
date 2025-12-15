<!doctype html>
<html lang="{{ $settings['default_language'] ?? 'en' }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon"
        href="{{ asset('storage').'/'.$settings['favicon'] ?? asset('theme/images/favicon-32x32.png') }}"
        type="image/png">
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
    <title>{{ $settings['site_name'] ?? 'Admin Panel' }} - @yield('title')</title>
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
        @include('admin.layouts.partials.sidebar')

        <!--end sidebar wrapper -->
        <!--start header -->

        {{-- header here --}}
        @include('admin.layouts.partials.header')
        <!--end header -->
        <!--start page wrapper -->

        {{-- main page here --}}

        <div class="page-wrapper">
            @include('admin.layouts.partials.flash-messages')
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
        @include('admin.layouts.partials.footer')

    </div>
    <!--end wrapper-->


    <!--start switcher-->
    @include('admin.layouts.partials.theme-customizer')
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
<script>
    $('.fancy-file-upload').FancyFileUpload({
        maxfilesize: 1000000
    });
    // initilaze spinner
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('.submit-btn');
                const submitText = form.querySelector('.submit-text');
                const submitSpinner = form.querySelector('.submit-spinner');

                if (submitBtn && submitSpinner && submitText) {
                    submitBtn.disabled = true;
                    submitSpinner.classList.remove('d-none');
                    submitText.textContent = ' ';
                }
            });
        });
    });
</script>


@stack('scripts')


</html>
