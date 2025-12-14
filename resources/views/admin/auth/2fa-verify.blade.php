<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('theme') }}/images/favicon-32x32.png" type="image/png">
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
    <title>Admin - Two-Factor Authentication</title>


</head>

<body class="">
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box">
                <div class="card-body">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="{{ asset('theme') }}/images/icons/forgot-2.png" width="100" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Two-Factor Authentication</h4>
                        <p class="text-muted">Enter the 6-digit code from your <b>Google Authenticator</b> App</p>
                        <form action="{{ route('admin.2fa.verify.store') }}" method="POST">
                            @csrf
                            <div class="my-4">
                                <label class="form-label">Enter code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    maxlength="6" name="code" id="code" placeholder="123456" />
                                @error('code')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Verify</button>
                                <a href="{{ route('admin.login') }}" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Back to
                                    Login</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->

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
</body>

<script src='{{ asset('theme') }}/signals/js/clients/scc-c2/scc-c2.min.js'></script>
<script>
    setTimeout(function() {
        const alertEl = document.getElementById('autoFadeAlert');
        if (alertEl) {
            alertEl.classList.remove('show'); // starts fade-out
            setTimeout(() => {
                let alert = bootstrap.Alert.getOrCreateInstance(alertEl);
                alert.close(); // removes it completely
            }, 200); // wait for fade animation to complete
        }
    }, 2000); // fades after 3 seconds

    document.getElementById('code').addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, ''); // Remove non-digit characters
    });
</script>


</html>
