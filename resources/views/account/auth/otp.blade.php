<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Official OTP Verification</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(rgba(12,90,60,.85), rgba(12,90,60,.85)),
        url('img/farmer.jpg');
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
      box-shadow: 0 25px 60px rgba(0,0,0,.35);
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
      <img src="img/uplogo.png" alt="Logo"
           style="width:120px; height:120px; object-fit:contain;">
     </div>

        <h5 class="text-center mb-4 fw-bold">
          Official Mobile OTP Verification
        </h5>

        <!-- Mobile Number -->
        <div class="mb-3">
          <label class="form-label text-muted">Mobile Number</label>
          <input type="text" class="form-control" placeholder="Enter registered mobile number">
		  <button class="btn btn-outline-main">Get OTP</button>
        </div>


        <!-- OTP + Verify -->
        <div class="mb-4 d-flex gap-2">
          <input type="text" class="form-control" placeholder="Enter OTP">
          <button class="btn btn-outline-main">Verify</button>
        </div>

        <!-- Login -->
        <button class="btn btn-main w-100">
          Login
        </button>

      </div>
    </div>

  </div>
</div>

</body>
</html>
