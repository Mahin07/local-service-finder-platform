<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Auth - LocalServices</title>

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  @if(!empty($recaptchaSiteKey))
    <script src="https://www.google.com/recaptcha/api.js?render={{ $recaptchaSiteKey }}"></script>
  @endif

  <style>
    :root {
      --accent: #ef6a3b;
      --accent-2: #f6b36d;
      --ink: #f7f4f1;
      --line: rgba(255, 255, 255, 0.16);
      --card: rgba(7, 10, 14, 0.72);
      --input: rgba(255, 255, 255, 0.08);
      --muted: rgba(247, 244, 241, 0.7);
    }

    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Segoe UI", Tahoma, sans-serif;
      color: var(--ink);
      background: linear-gradient(125deg, rgba(8, 9, 12, 0.85), rgba(8, 9, 12, 0.56)), url('{{ asset('img/restaurant/showcase-8.webp') }}') center/cover no-repeat fixed;
      display: grid;
      place-items: center;
      padding: 16px;
    }

    .auth-shell {
      width: min(1080px, 100%);
      min-height: 670px;
      border: 1px solid var(--line);
      border-radius: 28px;
      overflow: hidden;
      background: var(--card);
      backdrop-filter: blur(18px);
      display: grid;
      grid-template-columns: 1.02fr 1fr;
      box-shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
    }

    .side {
      padding: 38px;
      border-right: 1px solid var(--line);
      background: linear-gradient(180deg, rgba(0,0,0,0.15), rgba(0,0,0,0.35));
    }

    .side h1 {
      margin-top: 22px;
      font-size: clamp(2rem, 3.8vw, 3.2rem);
      line-height: 1.05;
    }

    .side h1 span {
      background: linear-gradient(140deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .side p { color: var(--muted); max-width: 38ch; }

    .panel {
      position: relative;
      padding: 30px;
      overflow: hidden;
    }

    .switcher {
      border: 1px solid var(--line);
      border-radius: 999px;
      padding: 4px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      margin-bottom: 18px;
      position: relative;
    }

    .switcher .glide {
      position: absolute;
      top: 4px;
      left: 4px;
      width: calc(50% - 4px);
      height: calc(100% - 8px);
      border-radius: 999px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      transition: transform .28s ease;
      z-index: 0;
    }

    .switcher button {
      background: transparent;
      border: 0;
      color: var(--ink);
      padding: 9px;
      border-radius: 999px;
      font-weight: 700;
      position: relative;
      z-index: 1;
    }

    .panel.register-mode .switcher .glide { transform: translateX(100%); }

    .forms {
      position: relative;
      min-height: 560px;
    }

    .form-card {
      position: absolute;
      inset: 0;
      opacity: 0;
      transform: translateX(34px);
      pointer-events: none;
      transition: opacity .28s ease, transform .28s ease;
      overflow-y: auto;
      padding-right: 4px;
    }

    .panel.login-mode #loginCard,
    .panel.register-mode #registerCard {
      opacity: 1;
      transform: translateX(0);
      pointer-events: auto;
    }

    .title { margin: 10px 0 6px; font-size: 1.75rem; font-weight: 800; }
    .sub { color: var(--muted); margin-bottom: 16px; }

    .field { margin-bottom: 12px; }
    .field label { font-size: .78rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: rgba(247,244,241,.6); }

    .input-wrap { position: relative; }
    .input-wrap i.icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,.4); }
    .input-wrap .toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: rgba(255,255,255,.5); }

    .form-control {
      border-radius: 12px;
      border: 1px solid var(--line);
      background: var(--input);
      color: #fff;
      min-height: 46px;
      padding-left: 40px;
      padding-right: 38px;
    }

    .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(239,106,59,.18); background: rgba(255,255,255,.1); color: #fff; }

    .btn-main {
      width: 100%;
      border: 0;
      border-radius: 12px;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      color: #fff;
      font-weight: 800;
      letter-spacing: .5px;
      text-transform: uppercase;
      padding: 12px;
      margin-top: 8px;
    }

    .btn-secondary-ghost {
      width: 100%;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: rgba(255,255,255,.04);
      color: #fff;
      font-weight: 700;
      padding: 10px;
      margin-top: 8px;
    }

    .small-note { color: var(--muted); font-size: .87rem; margin-top: 8px; }
    .passkey-note { color: #ffd7bf; font-size: .8rem; margin-top: 10px; }

    .alert { border-radius: 12px; border: 0; }

    .hidden-bot {
      position: absolute;
      left: -9999px;
      opacity: 0;
      height: 0;
      width: 0;
      pointer-events: none;
    }

    @media (max-width: 960px) {
      .auth-shell { grid-template-columns: 1fr; }
      .side { display: none; }
      .forms { min-height: 620px; }
    }
  </style>
</head>

<body>
  <section class="auth-shell">
    <aside class="side">
      <h1>Secure <span>Split Auth</span> Experience</h1>
      <p>Sign in or create your account from a single animated panel with built-in bot protection and email OTP verification.</p>
      <p class="small-note">Brute-force protection is active with Laravel throttling. Keep one browser tab for a stable session/captcha token flow.</p>
    </aside>

    <div class="panel {{ $mode === 'register' ? 'register-mode' : 'login-mode' }}" id="authPanel">
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

      <div class="switcher">
        <div class="glide"></div>
        <button type="button" id="toLogin">Login</button>
        <button type="button" id="toRegister">Register</button>
      </div>

      <div class="forms">
        <div class="form-card" id="loginCard">
          <h2 class="title">Welcome Back</h2>
          <p class="sub">Login securely with your password.</p>

          <form id="loginForm" method="POST" action="{{ route('login.user') }}">
            @csrf
            <input type="hidden" name="captcha_token" id="loginCaptchaToken">
            <input class="hidden-bot" type="text" name="website" tabindex="-1" autocomplete="off">

            <div class="field">
              <label>Email</label>
              <div class="input-wrap">
                <i class="bi bi-envelope-fill icon"></i>
                <input class="form-control" type="email" name="email" id="loginEmail" value="{{ old('email') }}" required>
              </div>
            </div>

            <div class="field">
              <label>Password</label>
              <div class="input-wrap">
                <i class="bi bi-shield-lock-fill icon"></i>
                <input class="form-control" type="password" name="password" id="loginPassword" required>
                <i class="bi bi-eye-slash toggle" data-toggle-password="loginPassword"></i>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
            </div>

            <button type="submit" class="btn-main">Login</button>
          </form>

          <hr class="my-3">
          <p class="passkey-note">Passkey beta has been disabled until full WebAuthn verification is added safely.</p>
        </div>

        <div class="form-card" id="registerCard">
          <h2 class="title">Create Account</h2>
          <p class="sub">Register and verify OTP by email.</p>

          <form id="registerForm" method="POST" action="{{ route('register.user') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="captcha_token" id="registerCaptchaToken">
            <input class="hidden-bot" type="text" name="website" tabindex="-1" autocomplete="off">

            <div class="field">
              <label>Full Name</label>
              <div class="input-wrap">
                <i class="bi bi-person-fill icon"></i>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
              </div>
            </div>

            <div class="field">
              <label>Email</label>
              <div class="input-wrap">
                <i class="bi bi-envelope-fill icon"></i>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
              </div>
            </div>

            <div class="field">
              <label>Address (Optional)</label>
              <div class="input-wrap">
                <i class="bi bi-geo-alt-fill icon"></i>
                <input class="form-control" type="text" name="address" value="{{ old('address') }}">
              </div>
            </div>

            <div class="field">
              <label>Profile Image (Optional)</label>
              <div class="input-wrap">
                <i class="bi bi-image-fill icon"></i>
                <input class="form-control" type="file" name="image" accept="image/*">
              </div>
            </div>

            <div class="field">
              <label>Password</label>
              <div class="input-wrap">
                <i class="bi bi-lock-fill icon"></i>
                <input class="form-control" type="password" name="password" id="registerPassword" required>
                <i class="bi bi-eye-slash toggle" data-toggle-password="registerPassword"></i>
              </div>
            </div>

            <div class="field">
              <label>Confirm Password</label>
              <div class="input-wrap">
                <i class="bi bi-lock-fill icon"></i>
                <input class="form-control" type="password" name="password_confirmation" id="registerPasswordConfirm" required>
                <i class="bi bi-eye-slash toggle" data-toggle-password="registerPasswordConfirm"></i>
              </div>
            </div>

            <button type="submit" class="btn-main">Send OTP</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script>
    (function () {
      const panel = document.getElementById('authPanel');
      const toLogin = document.getElementById('toLogin');
      const toRegister = document.getElementById('toRegister');
      const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const recaptchaKey = @json($recaptchaSiteKey ?? '');

      function setMode(mode) {
        panel.classList.toggle('login-mode', mode === 'login');
        panel.classList.toggle('register-mode', mode === 'register');
        history.replaceState({}, '', mode === 'register' ? '{{ route('register') }}' : '{{ route('login') }}');
      }

      toLogin.addEventListener('click', () => setMode('login'));
      toRegister.addEventListener('click', () => setMode('register'));

      document.querySelectorAll('[data-toggle-password]').forEach((el) => {
        el.addEventListener('click', function () {
          const input = document.getElementById(this.dataset.togglePassword);
          const hidden = input.type === 'password';
          input.type = hidden ? 'text' : 'password';
          this.classList.toggle('bi-eye', hidden);
          this.classList.toggle('bi-eye-slash', !hidden);
        });
      });

      async function captchaToken(action) {
        if (!recaptchaKey || !window.grecaptcha) {
          return '';
        }

        await new Promise((resolve) => grecaptcha.ready(resolve));
        return grecaptcha.execute(recaptchaKey, { action });
      }

      async function bindCaptchaSubmit(formId, tokenId, action) {
        const form = document.getElementById(formId);
        const tokenInput = document.getElementById(tokenId);

        form.addEventListener('submit', async function (e) {
          if (form.dataset.submitted === '1') return;
          e.preventDefault();

          const token = await captchaToken(action);
          tokenInput.value = token;
          form.dataset.submitted = '1';
          form.submit();
        });
      }

      bindCaptchaSubmit('loginForm', 'loginCaptchaToken', 'login');
      bindCaptchaSubmit('registerForm', 'registerCaptchaToken', 'register');

    })();
  </script>
</body>

</html>
