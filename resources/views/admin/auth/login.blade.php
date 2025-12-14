<!doctype html>
<html lang="{{ $settings['default_language'] ?? 'en' }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ $settings['favicon'] ?? asset('theme/images/favicon-32x32.png') }}" type="image/png">
    <!--plugins-->
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
    <title>{{ $settings['site_name'] ?? 'Admin Panel' }}</title>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body">
                                <img src="{{ asset('theme') }}/images/login-images/login-cover.svg"
                                    class="img-fluid auth-img-cover-login" width="650" alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">

                                    {{-- <div class="mb-3 text-center">
                                        <img src="{{ $settings['logo'] ? asset('storage') . '/' . $settings['logo'] : asset('theme/images/logo-icon.png') }}"
                                            width="50%" alt="">
                                    </div> --}}
                                    <div class="text-center mb-4">
                                        {{-- <h5 class="">{{ $settings['site_name'] ?? 'Admin Panel' }}'s Admin</h5> --}}
                                        <p class="mb-0">Please log in to your account</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3 needs-validation" novalidate
                                            action="{{ route('admin.login.submit') }}" method="POST">
                                            @csrf
                                            @php
                                                $prefilledEmail = old('email');
                                                if (!$prefilledEmail && Cookie::has('admin_email')) {
                                                    try {
                                                        $prefilledEmail = decrypt(Cookie::get('admin_email'));
                                                    } catch (\Exception $e) {
                                                        $prefilledEmail = ''; // fallback if decryption fails
                                                    }
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="bsValidation4" name="email" placeholder="Email" required
                                                    value="{{ $prefilledEmail }}">
                                                @error('email')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                             @php
                                                $prefilledPassword = old('password');
                                                if (!$prefilledPassword && Cookie::has('admin_password')) {
                                                    try {
                                                        $prefilledPassword = decrypt(Cookie::get('admin_password'));
                                                    } catch (\Exception $e) {
                                                        $prefilledPassword = ''; // fallback if decryption fails
                                                    }
                                                }
                                            @endphp
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="bsValidation5"
                                                        value="{{ $prefilledPassword }}"
                                                        placeholder="Enter Password" required>
                                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                                        id="bsValidation5"><i class='bx bx-hide'></i>
                                                    </a>
                                                    @error('password')
                                                        <div class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="remember" type="checkbox"
                                                        id="flexSwitchCheckChecked"
                                                        {{ $prefilledEmail ? 'checked' : '' }}>

                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"> <a
                                                    href="auth-cover-forgot-password.html">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center ">
                                                    <p class="mb-0">Don't have an account yet? <a
                                                            href="auth-cover-signup.html">Sign up here</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="login-separater text-center mb-5"> <span>OR SIGN IN WITH</span>
                                        <hr>
                                    </div>
                                    <div class="list-inline contacts-social text-center">
                                        <a href="javascript:;"
                                            class="list-inline-item bg-facebook text-white border-0 rounded-3"><i
                                                class="bx bxl-facebook"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-twitter text-white border-0 rounded-3"><i
                                                class="bx bxl-twitter"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-google text-white border-0 rounded-3"><i
                                                class="bx bxl-google"></i></a>
                                        <a href="javascript:;"
                                            class="list-inline-item bg-linkedin text-white border-0 rounded-3"><i
                                                class="bx bxl-linkedin"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>


    <script src="{{ asset('theme') }}/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('theme') }}/js/jquery.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('theme') }}/plugins/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/validation/validation-script.js"></script>
    <!--Password show & hide js -->
    <script src="{{ asset('theme') }}/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
