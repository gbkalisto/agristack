<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Farmer Registry – Login</title>
    <link rel="icon" type="image/png" href="img/agristack-favicon.png">
    <link rel="favicon" type="image/png" href="img/agristack-favicon.png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== COMMON THEME (You can change colors later) ===== */
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(rgba(12, 90, 60, .85), rgba(12, 90, 60, .85)), url('img/farmer.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            color: #ffffff;
        }

        .top-nav {
            padding: 14px 50px;
            font-size: 17px;
            background: transparent;
        }

        .top-nav a {
            color: #ffd84d;
            /* yellow like govt site */
            text-decoration: none;
            margin-right: 20px;
            font-weight: 600;
        }

        .top-nav a:hover {
            color: #ffea80;
            text-decoration: underline;
        }

        .nic-logo {
            margin-right: 30px;
            /* NIC ke baad space */
            display: inline-block;
        }

        .nic-logo-img {
            height: 45px;
            width: auto;
            margin-right: 30px;
            vertical-align: middle;
        }


        .login-card {
            background: #ffffff;
            color: #2c2c2c;
            border-radius: 28px;
            padding: 34px 32px;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35);
        }

        .role-btn {
            border: 1px solid #ccc;
            padding: 6px 18px;
            border-radius: 6px;
            cursor: pointer;
            background: #f5f5f5;
            font-size: 14px;
        }

        .role-btn.active {
            background: #28c76f;
            color: #ffffff;
            border-color: #28c76f;
        }

        .form-control {
            font-size: 14px;
            padding: 10px;
        }

        .btn-main {
            background: #28c76f;
            color: #ffffff;
            border: none;
            font-weight: 500;
        }

        .btn-main:disabled {
            background: #ccc;
        }

        .create-btn {
            border: 1.5px solid #28c76f;
            color: #28c76f;
            background: #ffffff;
            font-weight: 500;
        }

        /* ===== DASHBOARD ===== */
        .card-kpi {
            border-radius: 14px;
            color: #fff;
            padding: 20px;
            font-weight: 600;
        }

        .bg1 {
            background: linear-gradient(135deg, #9b8df3, #bfa7ff);
        }

        .bg2 {
            background: linear-gradient(135deg, #ff7eb3, #ffb6d5);
        }

        .bg3 {
            background: linear-gradient(135deg, #fbc531, #ffeaa7);
        }

        /* ===== MOBILE FIX (LOGIN CENTER) ===== */
        @media (max-width: 768px) {
            body {
                background-attachment: fixed;
            }

            .top-nav {
                text-align: center;
                padding: 12px 20px;
            }

            /* NIC LOGO */
            .nic-logo-img {
                height: 38px;
                display: block;
                margin: 0 auto 10px auto;
                /* center + नीचे gap */
            }

            /* MENU LINKS – NIC LOGO KE NICHE */
            .top-nav a {
                display: block;
                /* यही main change है */
                margin: 6px 0;
                font-size: 13px;
            }

            .login-card {
                margin: 0 auto;
                border-radius: 22px;
                padding: 28px 22px;
            }

            .container-fluid {
                padding-top: 30px;
            }

            .col-lg-6 p {
                width: 100% !important;
            }
        }
    </style>
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
                    <form method="POST" id="loginForm" novalidate>
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
                                placeholder="Insert User ID / Email" value="{{ old('username') }}">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <input type="password" name="password" id="password"
                                class="form-control  @error('password') is-invalid @enderror"
                                placeholder="Enter password" required>
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
                                placeholder="Enter Captcha" value="{{ old('captcha') }}" required>
                            @error('captcha')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-main w-100 mt-2" onClick="handleLogin()">Log In</button>
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
        function setRole(role) {
            const officialBtn = document.getElementById('officialBtn');
            const farmerBtn = document.getElementById('farmerBtn');
            const username = document.getElementById('username');
            const createBtn = document.getElementById('createBtn');

            if (role === 'official') {
                $("#loginForm").attr("action", "{{ route('account.login') }}");
                officialBtn.classList.add('active');
                farmerBtn.classList.remove('active');
                username.placeholder = 'Insert User ID / Email';
                createBtn.classList.add('d-none');
            } else {
                farmerBtn.classList.add('active');
                officialBtn.classList.remove('active');
                username.placeholder = 'Insert Registered Mobile Number';
                createBtn.classList.remove('d-none');
            }
        }
    </script>


    <script>
        let currentRole = 'official';
        $("#loginForm").attr("action", "{{ route('account.login') }}");

        function setRole(role) {
            currentRole = role;

            const officialBtn = document.getElementById('officialBtn');
            const farmerBtn = document.getElementById('farmerBtn');
            const username = document.getElementById('username');
            const createBtn = document.getElementById('createBtn');

            if (role === 'official') {
                $("#loginForm").attr("action", "{{ route('account.login') }}");
                officialBtn.classList.add('active');
                farmerBtn.classList.remove('active');
                username.placeholder = 'Insert User ID / Email';
                createBtn.classList.add('d-none');
            } else {
                $("#loginForm").attr("action", "{{ route('login') }}");
                farmerBtn.classList.add('active');
                officialBtn.classList.remove('active');
                username.placeholder = 'Insert Registered Mobile Number';
                createBtn.classList.remove('d-none');
            }
        }

        function handleLogin() {
            if (currentRole === 'official') {
                // ✅ Official → OTP page
                window.location.href = 'officialotp.php';
            } else {
                // ✅ Farmer → direct page (abhi example)
                window.location.href = 'farmerotp.php';
                // baad me jo page bologe yahan change kar dena
            }
        }

        function reloadCaptcha() {
            document.getElementById('captchaImage').src =
                "{{ route('captcha') }}?" + Date.now();
        }
    </script>







</body>

</html>
