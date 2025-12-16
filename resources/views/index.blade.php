<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Farmer Registry – Login</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== COMMON THEME (You can change colors later) ===== */
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(rgba(12, 90, 60, .85), rgba(12, 90, 60, .85)), url('https://images.unsplash.com/photo-1501004318641-b39e6451bec6');
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

            .top-nav a {
                display: inline-block;
                margin: 6px 8px;
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
        <strong class="nic-logo">NIC</strong>
        <a href="dashboard.php">Dashboard</a>
        <a href="#">Check Enrollment Status</a>
        <a href="#">Login with CSC</a>
        <a href="#">Farmer Grievance</a>
    </div>
    <!-- ===== LOGIN SECTION ===== -->
    <div class="container-fluid py-5">
        <div class="row align-items-center justify-content-center min-vh-100">

            <!-- LEFT CONTENT -->
            <div class="col-lg-6 col-md-7 text-center text-md-start mb-4 mb-md-0 px-5">
                <h1 class="fw-bold display-5">Agri Stack</h1>
                <h3 class="fw-semibold">Uttar Pradesh Farmer Registry</h3>
                <p class="mt-3 w-75">Farmer Registry has been started as an important initiative for the farmers in the
                    state of Uttar Pradesh. Under this system, a unique farmer ID (Farmer ID) will be created for each
                    farmer.HELPDESK 0522 2317003</p>
            </div>

            <!-- RIGHT LOGIN CARD -->
            <div class="col-lg-4 col-md-5 d-flex justify-content-center">
                <div class="login-card w-100">
                    <div class="text-center mb-3">
                        <strong class="fs-5">Log In as</strong><br>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <div id="officialBtn" class="role-btn active" onclick="setRole('official')">Official</div>
                            <div id="farmerBtn" class="role-btn" onclick="setRole('farmer')">Farmer</div>
                        </div>
                    </div>
                    <form action="{{ route('login') }}" method="POST" novalidate>
                        @csrf

                        {{-- USERNAME / EMAIL --}}
                        <div class="mb-3">
                            <input id="username" name="email" type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Insert User ID / Email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-2">
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <a href="#" class="small text-success d-block mb-3">
                            Forgot Password?
                        </a>

                        {{-- CAPTCHA --}}
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

                            @if ($errors->has('g-recaptcha-response'))
                                <small class="text-danger">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </small>
                            @endif
                        </div>

                        {{-- SUBMIT --}}
                        <button type="submit" class="btn btn-main w-100 mt-2">
                            Log In
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- ===== JS ===== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function setRole(role) {
            const officialBtn = document.getElementById('officialBtn');
            const farmerBtn = document.getElementById('farmerBtn');
            const username = document.getElementById('username');
            const createBtn = document.getElementById('createBtn');

            if (role === 'official') {
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



</body>

</html>
