<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Official OTP Verification</title>
    <link rel="icon" type="image/png" href="{{ asset('/') }}img/agristack-favicon.png">
    <link rel="favicon" type="image/png" href="{{ asset('/') }}img/agristack-favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(rgba(12, 90, 60, .85), rgba(12, 90, 60, .85)),
                url({{ asset('img/farmer.jpg') }});
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            color: #ffffff;
        }

        .otp-card {
            background: #ffffff;
            color: #2c2c2c;
            border-radius: 28px;
            padding: 34px 32px;
            max-width: 420px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .35);
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

        .btn-outline-main {
            border: 1.5px solid #28c76f;
            color: #28c76f;
            background: #ffffff;
            font-size: 13px;
            padding: 8px 12px;
        }

        @media (max-width: 768px) {
            .otp-card {
                margin: 0 auto;
                border-radius: 22px;
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="otp-card p-4 shadow rounded">

                    <div class="text-center mb-3">
                        <img src="{{ asset('img/uplogo.png') }}" alt="Logo"
                            style="width:120px;height:120px;object-fit:contain;">
                    </div>

                    <h5 class="text-center mb-4 fw-bold">
                        Official Mobile OTP Verification
                    </h5>

                    {{-- OTP FORM --}}
                    <form method="POST" action="{{ route('farmer.otp.verify') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Enter OTP</label>
                            <input type="text" name="otp" class="form-control @error('otp') is-invalid @enderror"
                                placeholder="Enter 6 digit OTP" maxlength="6">

                            @error('otp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Resend OTP -->
                        <div class="mb-3 text-end">
                            <small>
                                Didn’t receive OTP?
                                <a href="#" class="text-primary">
                                    Send again
                                </a>
                            </small>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-main">
                                Verify OTP
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- ===== JS ===== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
</body>
<script>
    // Mobile input: allow only digits
    mobileInput.addEventListener('input', () => {
        mobileInput.value = mobileInput.value.replace(/\D/g, '');
    });
</script>


</html>
