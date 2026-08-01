<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Email OTP Verification - LocalServices</title>
  <meta name="description" content="Verify your email OTP to complete registration.">

  <link href="{{ asset('img/login.jpeg') }}" rel="icon">
  <link href="{{ asset('img/login.jpeg') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <style>
    :root {
      --accent: #ef6a3b;
      --accent-2: #f4ad64;
      --ink: #f8f6f3;
      --muted: rgba(248, 246, 243, 0.72);
      --line: rgba(255, 255, 255, 0.16);
      --card: rgba(8, 10, 14, 0.62);
      --input: rgba(255, 255, 255, 0.07);
    }

    body {
      margin: 0;
      min-height: 100vh;
      color: var(--ink);
      font-family: "Manrope", sans-serif;
      background: linear-gradient(120deg, rgba(7, 9, 12, 0.84), rgba(7, 9, 12, 0.52)), url('{{ asset('img/login.jpeg') }}') center/cover no-repeat;
      display: grid;
      place-items: center;
      padding: 16px;
    }

    .card {
      width: min(520px, 100%);
      border: 1px solid var(--line);
      border-radius: 22px;
      background: var(--card);
      backdrop-filter: blur(12px);
      box-shadow: 0 24px 60px rgba(0,0,0,0.4);
      padding: 28px;
      color: var(--ink);
    }

    .title {
      margin: 0;
      font-size: 1.8rem;
      font-weight: 800;
    }

    .sub {
      margin-top: 8px;
      color: var(--muted);
    }

    .icon {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      margin-bottom: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      box-shadow: 0 10px 26px rgba(239,106,59,.3);
      font-size: 1.4rem;
    }

    .form-label {
      font-size: .78rem;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: rgba(248,246,243,.62);
      font-weight: 700;
    }

    .form-control {
      min-height: 50px;
      border-radius: 12px;
      border: 1px solid var(--line);
      background: var(--input);
      color: var(--ink);
      font-size: 1.35rem;
      font-weight: 800;
      letter-spacing: 8px;
      text-align: center;
    }

    .form-control:focus {
      background: rgba(255,255,255,.09);
      border-color: rgba(239,106,59,.95);
      box-shadow: 0 0 0 4px rgba(239,106,59,.14);
      color: var(--ink);
    }

    .btn-main {
      width: 100%;
      border: 0;
      border-radius: 12px;
      padding: 12px 14px;
      color: #fff;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: .6px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
    }

    .btn-link-lite {
      border: 1px solid var(--line);
      background: rgba(255,255,255,0.05);
      color: var(--ink);
      border-radius: 12px;
      padding: 11px 14px;
      width: 100%;
      font-weight: 700;
      margin-top: 10px;
    }

    .alert {
      border-radius: 12px;
      border: 0;
    }

    .small-note {
      margin-top: 12px;
      color: var(--muted);
      font-size: .88rem;
    }

    @media (max-width: 575.98px) {
      .card {
        padding: 20px;
        border-radius: 16px;
      }

      .title {
        font-size: 1.45rem;
      }

      .form-control {
        font-size: 1.05rem;
        letter-spacing: 4px;
      }
    }
  </style>
</head>

<body>
  <div class="card">
    <div class="icon"><i class="bi bi-envelope-check"></i></div>
    <h1 class="title">Verify Email OTP</h1>
    <p class="sub">Enter the 6-digit code sent to your email to complete registration.</p>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register.verify_otp') }}">
      @csrf
      <div class="mb-3">
        <label for="otp" class="form-label">OTP Code</label>
        <input type="text" id="otp" name="otp" maxlength="6" class="form-control" value="{{ old('otp') }}" placeholder="000000" inputmode="numeric" required>
      </div>

      <button type="submit" class="btn-main">Verify OTP</button>
    </form>

    <form method="POST" action="{{ route('register.resend_otp') }}">
      @csrf
      <button type="submit" class="btn-link-lite">Resend OTP</button>
    </form>

    <p class="small-note">OTP expires in 10 minutes. If expired, register again.</p>
  </div>

  <script>
    const otpInput = document.getElementById('otp');
    if (otpInput) {
      otpInput.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
      });
    }
  </script>
</body>

</html>
