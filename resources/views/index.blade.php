<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Farmer Registry – Login</title>
    <link rel="icon" type="image/png" href="img/agristack-favicon.png">
    <link rel="favicon" type="image/png" href="img/agristack-favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/theme/css/style.css') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- ===== TOP NAV ===== -->
    <div class="top-nav">
        <img src="img/niclogo.png" alt="NIC Logo" class="nic-logo-img">
        <a href="#">Dashboard</a>
        <a href="#">Check Enrollment Status</a>
        <a href="#">Login with CSC</a>
        <a href="#">Farmer Grievance</a>
    </div>
    <!-- ===== LOGIN SECTION ===== -->
    <div class="container-fluid py-5">
        <div class="row align-items-center justify-content-center min-vh-100">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 col-md-7 text-center text-md-start mb-4 mb-md-0 px-5">
                <h1 class="fw-bold display-5"><img src="img/agristacklogo.png" alt="Logo"
                        style="width:50%; height:50%; object-fit:contain;"></h1>
                <h3 class="fw-semibold">Uttar Pradesh Farmer Registry</h3>
                <p class="mt-3 w-75">
                    <center>Farmer Registry has been started as an important initiative for the farmers in the state of
                        Uttar Pradesh. Under this system, a unique farmer ID (Farmer ID) will be created for each
                        farmer.HELPDESK 0522 2317003</center>
                </p>
            </div>

            <!-- RIGHT LOGIN CARD -->
            <div class="col-lg-4 col-md-5 d-flex justify-content-center">
                <div class="login-card w-100">
                    <form method="POST" action="{{ route('account.login.submit') }}" id="loginForm" novalidate>
                        @csrf
                        <div class="text-center mb-3">
                            <img src="img/uplogo.png" alt="Logo"
                                style="width:120px; height:120px; object-fit:contain;">
                        </div>

                        <div class="text-center mb-3">
                            <strong class="fs-5">Log In as</strong><br>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <div id="officialBtn" class="role-btn active" onClick="setRole('official')">Official
                                </div>
                                <div id="farmerBtn" class="role-btn" onClick="setRole('farmer')">Farmer</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input id="username" name="username" type="text"
                                class="form-control  @error('username') is-invalid @enderror" required
                                placeholder="Insert User ID / Email" autocomplete="off" value="{{ old('username') }}">
                            <div class="invalid-feedback"></div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input type="password" name="password" id="password"
                                class="form-control  @error('password') is-invalid @enderror"
                                placeholder="Enter password" autocomplete="off" required>
                            <div class="invalid-feedback"></div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <a href="#" class="small text-success d-block mb-3">Forgot Password?</a>

                        <div class="mb-3">
                            <label class="form-label text-muted">Captcha</label>

                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ route('captcha') }}" id="captchaImage" height="45">

                                <button type="button" class="btn btn-light" onclick="reloadCaptcha()">
                                    &#x21bb;
                                </button>
                            </div>

                            <input type="text" id="captcha" name="captcha"
                                class="form-control  @error('captcha') is-invalid @enderror mt-2"
                                placeholder="Enter Captcha" value="{{ old('captcha') }}" autocomplete="off" required>
                            <div class="invalid-feedback"></div>
                            @error('captcha')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <button class="btn btn-main w-100 mt-2" onClick="handleLogin()">Log In</button> --}}
                        <button type="submit" class="btn btn-main w-100 mt-2">Log In</button>
                        <a href="" id="createBtn" class="btn create-btn w-100 mt-3 d-none">Create New User
                            Account</a>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- ===== JS ===== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script>
        window.APP = {
            captchaUrl: "{{ route('captcha') }}",
            loginRoutes: {
                official: "{{ route('account.login.submit') }}",
                farmer: "{{ route('login') }}"
            }
        };
    </script>

    <script src="{{ asset('/theme/js/main.js') }}">
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        crossorigin = "anonymous"
        referrerpolicy = "no-referrer">
    </script>

</body>

</html>
