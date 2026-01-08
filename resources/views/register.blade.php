<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Farmer Registry – Registration</title>
    <link rel="icon" type="image/png" href="img/agristack-favicon.png">
    <link rel="favicon" type="image/png" href="img/agristack-favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/theme/css/style.css') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    <!-- ===== TOP NAV ===== -->
    <div class="top-nav">
        <a href="/"><img src="img/niclogo.png" alt="NIC Logo" class="nic-logo-img"></a>
        <a href="{{ route('registration') }}">Farmer Registration</a>
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
                    <form method="POST" action="{{ route('registration') }}" id="registerForm" novalidate>
                        @csrf

                        <div class="text-center mb-3">
                            <img src="{{ asset('img/uplogo.png') }}" alt="Logo"
                                style="width:120px; height:120px; object-fit:contain;">
                        </div>

                        <div class="text-center mb-3">
                            <strong class="fs-5">Farmer Registration</strong>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <input type="number" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Enter mobile number" value="{{ old('phone') }}" maxlength="10" required>

                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter password" required>

                                <span class="input-group-text" style="cursor:pointer"
                                    onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm password" required>

                                <span class="input-group-text" style="cursor:pointer"
                                    onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-main w-100 mt-2">
                            Register
                        </button>
                        <a href="/" class="small text-success d-block mb-3">Login</a>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <!-- ===== JS ===== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let phone = document.getElementById('phone').value.trim();
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('password_confirmation').value;

            // Phone validation
            // if (!/^[6-9]\d{9}$/.test(phone)) {
            //     e.preventDefault();
            //     iziToast.error({
            //         title: 'Invalid Mobile',
            //         message: 'Enter valid 10-digit Indian mobile number',
            //         position: 'topRight'
            //     });
            //     return;
            // }

            // Password match check
            if (password !== confirmPassword) {
                e.preventDefault();
                iziToast.error({
                    title: 'Password Mismatch',
                    message: 'Password and Confirm Password must match',
                    position: 'topRight'
                });
                return;
            }
        });

        // Toggle password visibility
        function togglePassword(inputId, el) {
            const input = document.getElementById(inputId);
            const icon = el.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        @if (session()->has('success'))
            iziToast.success({
                title: 'Success',
                message: "{{ session('success') }}",
                position: 'topRight',
                timeout: 4000,
                progressBar: true
            });
        @endif

        @if (session()->has('error'))
            iziToast.error({
                title: 'Error',
                message: "{{ session('error') }}",
                position: 'topRight',
                timeout: 4000
            });
        @endif

        @if (session()->has('warning'))
            iziToast.warning({
                title: 'Warning',
                message: "{{ session('warning') }}",
                position: 'topRight'
            });
        @endif
    </script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                iziToast.error({
                    title: 'Validation Error',
                    message: "{{ $error }}",
                    position: 'topRight'
                });
            @endforeach
        </script>
    @endif



</body>

</html>
