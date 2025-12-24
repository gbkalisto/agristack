<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Official OTP Verification</title>
    <link rel="icon" type="image/png" href="img/agristack-favicon.png">
    <link rel="favicon" type="image/png" href="img/agristack-favicon.png">
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
                <div class="otp-card">

                    <div class="text-center mb-3">
                        <img src="{{ asset('img/uplogo.png') }}" alt="Logo"
                            style="width:120px;height:120px;object-fit:contain;">
                    </div>

                    <h5 class="text-center mb-4 fw-bold">
                        Official Mobile OTP Verification
                    </h5>

                    <!-- Mobile -->
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label text-muted">Mobile Number</label>
                            <input type="tel" id="mobile" class="form-control @error('mobile') is-invalid @enderror"
                                placeholder="Enter registered mobile number" maxlength="10" inputmode="numeric">

                            <small class="text-danger d-none" id="mobileError"></small>
                        </div>


                        <button class="btn btn-outline-main mt-2" id="sendOtp">
                            Get OTP
                        </button>
                    </div>

                    <!-- OTP -->
                    <div class="mb-3">
                        <div class="d-flex gap-2">
                            <input type="text" id="otp" class="form-control" placeholder="Enter OTP"
                                maxlength="6" disabled>

                            <button class="btn btn-outline-main" id="verifyOtp" disabled>
                                Verify
                            </button>
                        </div>

                        <small class="text-danger d-none" id="otpError"></small>
                    </div>

                    <!-- Login -->
                    <button class="btn btn-main w-100" id="loginBtn" disabled>
                        Login
                    </button>

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
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // Elements
    const mobileInput = document.getElementById('mobile');
    const otpInput = document.getElementById('otp');
    const sendOtpBtn = document.getElementById('sendOtp');
    const verifyOtpBtn = document.getElementById('verifyOtp');
    const loginBtn = document.getElementById('loginBtn');

    const mobileError = document.getElementById('mobileError');
    const otpError = document.getElementById('otpError');

    // Helpers
    function showError(el, msg) {
        el.textContent = msg;
        el.classList.remove('d-none');
    }

    function hideError(el) {
        el.textContent = '';
        el.classList.add('d-none');
    }

    // Mobile input: allow only digits
    mobileInput.addEventListener('input', () => {
        mobileInput.value = mobileInput.value.replace(/\D/g, '');
    });

    // SEND OTP
    sendOtpBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const mobile = mobileInput.value.trim();
        hideError(mobileError);

        if (!mobile) {
            showError(mobileError, 'Mobile number is required');
            return;
        }

        if (!/^[0-9]\d{9}$/.test(mobile)) {
            showError(mobileError, 'Enter a valid 10-digit mobile number');
            return;
        }

        fetch('/account/send-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    mobile
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    otpInput.disabled = false;
                    verifyOtpBtn.disabled = false;
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            });
    });

    // VERIFY OTP
    verifyOtpBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const mobile = mobileInput.value.trim();
        const otp = otpInput.value.trim();
        hideError(otpError);

        if (!otp) {
            showError(otpError, 'OTP is required');
            return;
        }

        if (!/^\d{6}$/.test(otp)) {
            showError(otpError, 'OTP must be 6 digits');
            return;
        }

        fetch('/account/otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    mobile,
                    otp
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    iziToast.success({
                        title: 'Success',
                        message: 'OTP verified successfully. You can now login.',
                        position: 'topRight'
                    });

                    loginBtn.disabled = false;
                    mobileInput.readOnly = true;
                    otpInput.readOnly = true;
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            });
    });

    // LOGIN
    loginBtn.addEventListener('click', function() {
        window.location.href = '/account/dashboard';
    });
</script>


</html>
