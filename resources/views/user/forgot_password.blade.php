<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - LocalServices</title>
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <style>
    :root {
      --accent: #ef6a3b;
      --accent-2: #f4ad64;
      --ink: #f8f6f3;
      --muted: rgba(248, 246, 243, 0.72);
      --line: rgba(255, 255, 255, 0.16);
      --card: rgba(8, 10, 14, 0.7);
      --input: rgba(255, 255, 255, 0.08);
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

    .card-shell {
      width: min(560px, 100%);
      border: 1px solid var(--line);
      border-radius: 24px;
      background: var(--card);
      backdrop-filter: blur(12px);
      box-shadow: 0 26px 60px rgba(0, 0, 0, 0.42);
      padding: 30px;
    }

    .icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      margin-bottom: 14px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      box-shadow: 0 10px 24px rgba(239, 106, 59, 0.35);
      font-size: 1.45rem;
    }

    .title { margin: 0; font-weight: 800; }
    .sub { margin-top: 8px; color: var(--muted); }

    .form-control {
      min-height: 48px;
      border-radius: 12px;
      border: 1px solid var(--line);
      background: var(--input);
      color: var(--ink);
    }

    .form-control:focus {
      border-color: rgba(239, 106, 59, 0.95);
      box-shadow: 0 0 0 4px rgba(239, 106, 59, 0.14);
      background: rgba(255, 255, 255, 0.1);
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
      letter-spacing: 0.6px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
    }

    @media (max-width: 575.98px) {
      .card-shell {
        padding: 20px;
        border-radius: 16px;
      }

      .title {
        font-size: 1.45rem;
      }
    }
  </style>
</head>
<body>
  <div class="card-shell">
    <div class="icon"><i class="bi bi-shield-lock"></i></div>
    <h1 class="title">Reset your password</h1>
    <p class="sub">Enter your account email and we will send you a secure reset link.</p>

    @if (session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger mt-3">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="mt-4">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label text-white-50 text-uppercase small">Email address</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" placeholder="name@example.com" required>
      </div>
      <button type="submit" class="btn-main">Send reset link</button>
    </form>

    <p class="mt-3 mb-0 text-center text-white-50">
      Remembered your password?
      <a href="{{ route('login') }}" class="text-warning text-decoration-none">Back to login</a>
    </p>
  </div>
</body>
</html>
