<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - LocalServices</title>
  <meta name="description" content="Access your LocalServices account.">

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">

  <style>
    :root {
      --accent: #ef6a3b;
      --accent-2: #f4ad64;
      --ink: #f8f6f3;
      --muted: rgba(248, 246, 243, 0.72);
      --line: rgba(255, 255, 255, 0.16);
      --card: rgba(8, 10, 14, 0.62);
      --input: rgba(255, 255, 255, 0.07);
      --error: #ff8a8a;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      color: var(--ink);
      font-family: "Manrope", sans-serif;
      background: #0a0d12;
      overflow-x: hidden;
    }

    .bg-scene {
      position: fixed;
      inset: 0;
      background: linear-gradient(120deg, rgba(7, 9, 12, 0.84), rgba(7, 9, 12, 0.52)), url('{{ asset('img/login.jpeg') }}') center/cover no-repeat;
      transform: scale(1.03);
      z-index: -3;
      transition: transform .25s ease-out;
      will-change: transform;
    }

    .bg-grain {
      position: fixed;
      inset: 0;
      background-image: radial-gradient(rgba(255,255,255,.03) 1px, transparent 1px);
      background-size: 3px 3px;
      opacity: .3;
      z-index: -2;
      pointer-events: none;
    }

    .orb {
      position: fixed;
      border-radius: 50%;
      filter: blur(90px);
      opacity: .2;
      z-index: -1;
      pointer-events: none;
      animation: drift 12s ease-in-out infinite alternate;
    }

    .orb.one { width: 360px; height: 360px; top: -90px; right: -80px; background: rgba(239, 106, 59, .68); }
    .orb.two { width: 290px; height: 290px; left: -80px; bottom: -80px; background: rgba(244, 173, 100, .58); animation-delay: -4s; }

    @keyframes drift {
      from { transform: translate(0, 0) scale(1); }
      to { transform: translate(32px, 24px) scale(1.08); }
    }

    .page {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 28px 16px;
    }

    .auth-shell {
      width: min(1040px, 100%);
      display: grid;
      grid-template-columns: 1fr 1.1fr;
      border: 1px solid var(--line);
      border-radius: 30px;
      overflow: hidden;
      backdrop-filter: blur(14px);
      background: linear-gradient(145deg, rgba(255,255,255,.07), rgba(255,255,255,.02));
      box-shadow: 0 30px 80px rgba(0,0,0,.46);
    }

    .left {
      padding: 44px;
      border-right: 1px solid var(--line);
      background: linear-gradient(180deg, rgba(8,10,14,.42), rgba(8,10,14,.16));
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .brand {
      color: var(--ink);
      text-decoration: none;
      font-weight: 800;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .brand i { color: var(--accent); }

    .hero-title {
      margin: 26px 0 12px;
      line-height: 1.06;
      font-size: clamp(2rem, 3.6vw, 3.05rem);
      font-family: "Playfair Display", serif;
    }

    .hero-title .accent {
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-text { color: var(--muted); line-height: 1.65; max-width: 34ch; }

    .points { margin-top: 24px; display: grid; gap: 12px; }

    .point {
      color: var(--muted);
      display: grid;
      grid-template-columns: 24px auto;
      gap: 10px;
      align-items: start;
      font-size: .95rem;
    }

    .point i { color: var(--accent-2); }

    .right {
      padding: 40px;
      background: var(--card);
    }

    .head h2 { margin: 0; font-size: 1.85rem; font-weight: 800; }
    .head p { margin: 8px 0 0; color: var(--muted); }

    .mode-switch {
      margin-top: 18px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      padding: 8px;
      border-radius: 18px;
      background: rgba(255,255,255,.05);
      border: 1px solid var(--line);
    }

    .mode-option {
      border: 1px solid transparent;
      background: transparent;
      color: var(--muted);
      border-radius: 14px;
      padding: 12px 14px;
      text-align: left;
      transition: .2s ease;
    }

    .mode-option strong {
      display: block;
      color: var(--ink);
      font-size: .95rem;
    }

    .mode-option span {
      display: block;
      font-size: .8rem;
      margin-top: 3px;
    }

    .mode-option.active {
      background: linear-gradient(135deg, rgba(239,106,59,.22), rgba(244,173,100,.18));
      border-color: rgba(239,106,59,.35);
      box-shadow: inset 0 0 0 1px rgba(239,106,59,.08);
    }

    .mode-option.active span {
      color: var(--ink);
    }

    .alert { margin-top: 16px; border: 0; border-radius: 12px; }

    .field { margin-top: 14px; }

    .field label {
      display: block;
      margin-bottom: 7px;
      font-size: .75rem;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      color: rgba(248,246,243,.58);
      font-weight: 700;
    }

    .input-wrap { position: relative; }

    .input-wrap > i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255,255,255,.35);
      pointer-events: none;
    }

    .form-control {
      min-height: 48px;
      border-radius: 14px;
      border: 1px solid var(--line);
      background: var(--input);
      color: var(--ink);
      padding-left: 42px;
      padding-right: 40px;
    }

    .form-control::placeholder { color: rgba(248,246,243,.46); }

    .form-control:focus {
      background: rgba(255,255,255,.08);
      border-color: rgba(239,106,59,.95);
      box-shadow: 0 0 0 4px rgba(239,106,59,.14);
      color: var(--ink);
    }

    .toggle-pass {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: rgba(255,255,255,.55);
    }

    .row-meta {
      margin-top: 12px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      color: var(--muted);
      font-size: .9rem;
    }

    .form-check-input {
      background-color: transparent;
      border-color: var(--line);
    }

    .form-check-input:checked {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .meta-link {
      color: var(--accent-2);
      text-decoration: none;
      font-weight: 700;
    }

    .btn-login {
      margin-top: 16px;
      width: 100%;
      border: 0;
      border-radius: 14px;
      padding: 13px 18px;
      font-weight: 800;
      color: #fff;
      letter-spacing: .6px;
      text-transform: uppercase;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      box-shadow: 0 14px 30px rgba(239,106,59,.28);
      transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 34px rgba(239,106,59,.32);
      filter: brightness(1.04);
    }

    .btn-login:disabled { opacity: .82; cursor: not-allowed; }

    .btn-login .spinner-border {
      width: 1rem;
      height: 1rem;
      border-width: .14rem;
      margin-right: 8px;
      vertical-align: -2px;
      display: none;
    }

    .helper {
      margin-top: 14px;
      color: var(--muted);
      font-size: .9rem;
      text-align: center;
    }

    .helper a {
      color: var(--accent-2);
      text-decoration: none;
      font-weight: 700;
    }

    .error-note {
      color: var(--error);
      font-size: .82rem;
      margin-top: 6px;
      min-height: 18px;
    }

    @media (max-width: 991px) {
      .auth-shell { grid-template-columns: 1fr; }
      .left { display: none; }
      .right { padding: 30px 20px; }
    }
  </style>
</head>

<body>
  @php
    $selectedLoginType = old('login_type', $loginType ?? 'user');
    $isProviderLogin = $selectedLoginType === 'provider';
  @endphp

  <div class="bg-scene" id="bgScene"></div>
  <div class="bg-grain"></div>
  <div class="orb one"></div>
  <div class="orb two"></div>

  <main class="page">
    <section class="auth-shell" data-aos="zoom-in" data-aos-duration="800">
      <aside class="left">
        <div>
          <a href="{{ url('/') }}" class="brand"><i class="bi bi-house-heart-fill"></i> LocalServices</a>
          <h1 class="hero-title">Welcome back to your <span class="accent">service hub</span>.</h1>
          <p class="hero-text">Sign in to manage bookings, connect with providers, and track your service history in one place.</p>

          <div class="points">
            <div class="point"><i class="bi bi-shield-check"></i><span>Secure login with protected sessions.</span></div>
            <div class="point"><i class="bi bi-lightning-charge"></i><span>Fast access to active and past bookings.</span></div>
            <div class="point"><i class="bi bi-stars"></i><span>Premium service experience from one dashboard.</span></div>
          </div>
        </div>

        <small class="text-white-50">&copy; 2026 LocalServices</small>
      </aside>

      <div class="right">
        <div class="head">
          <h2 id="loginHeading">{{ $isProviderLogin ? 'Provider Sign In' : 'Sign In' }}</h2>
          <p id="loginSubtext">{{ $isProviderLogin ? 'Access your provider dashboard and account status.' : 'Enter your account credentials.' }}</p>
        </div>

        <div class="mode-switch" role="tablist" aria-label="Login type">
          <button type="button" class="mode-option{{ $isProviderLogin ? '' : ' active' }}" data-login-type="user" data-action="{{ route('login.user') }}">
            <strong>Login as User</strong>
            <span>Bookings, profile, and account access</span>
          </button>
          <button type="button" class="mode-option{{ $isProviderLogin ? ' active' : '' }}" data-login-type="provider" data-action="{{ route('provider.login.submit') }}">
            <strong>Login as Provider</strong>
            <span>Provider dashboard and approval status</span>
          </button>
        </div>

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

        <form id="masterAuthForm" method="POST" action="{{ $isProviderLogin ? route('provider.login.submit') : route('login.user') }}" novalidate>
          @csrf
          <input type="hidden" id="loginTypeInput" name="login_type" value="{{ $selectedLoginType }}">
          <input type="hidden" id="loginCaptchaToken" name="captcha_token">
          <input type="text" name="website" tabindex="-1" autocomplete="off" class="d-none" aria-hidden="true">

          <div class="field">
            <label for="email">Email</label>
            <div class="input-wrap">
              <i class="bi bi-envelope-fill"></i>
              <input id="email" type="email" name="email" class="form-control" placeholder="account@localservices.com" value="{{ old('email') }}" required>
            </div>
          </div>

          <div class="field">
            <label for="mainPassInput">Password</label>
            <div class="input-wrap">
              <i class="bi bi-shield-lock-fill"></i>
              <input id="mainPassInput" type="password" name="password" class="form-control" placeholder="Enter password" required>
              <i class="bi bi-eye-slash toggle-pass" id="mainPassToggle"></i>
            </div>
            <div class="error-note" id="capsHint"></div>
          </div>

          <div class="row-meta">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="authPersist" name="remember">
              <label class="form-check-label ms-2" for="authPersist">Remember me</label>
            </div>
            <a
              href="{{ $isProviderLogin ? 'mailto:support@localservices.com?subject=Provider%20Password%20Reset%20Help' : route('password.request') }}"
              class="meta-link"
              id="forgotPasswordLink"
            >
              Forgot password?
            </a>
          </div>

          <button type="submit" class="btn-login" id="submitBtn">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span id="btnText">Authorize Access</span>
          </button>
        </form>

        <p class="helper">
          <a href="{{ route('home') }}">Back to homepage</a>
          &nbsp;|&nbsp;
          <span id="helperCopy">
            {!! $isProviderLogin
              ? 'Want to join as provider? <a href="' . route('provider.register') . '">Create provider account</a>'
              : 'New user? <a href="' . route('register') . '">Create account</a>' !!}
          </span>
        </p>
      </div>
    </section>
  </main>

  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  @if(env('RECAPTCHA_SITE_KEY'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
  @endif

  <script>
    (function () {
      'use strict';

      if (window.AOS) {
        AOS.init({ duration: 800, once: true, easing: 'ease-out-cubic' });
      }

      const bgScene = document.getElementById('bgScene');
      window.addEventListener('mousemove', function (e) {
        if (!bgScene) return;
        const x = (e.clientX / window.innerWidth - 0.5) * 1.8;
        const y = (e.clientY / window.innerHeight - 0.5) * 1.8;
        bgScene.style.transform = `scale(1.03) translate(${x}px, ${y}px)`;
      });

      const passToggle = document.getElementById('mainPassToggle');
      const passInput = document.getElementById('mainPassInput');

      if (passToggle && passInput) {
        passToggle.addEventListener('click', function () {
          const hidden = passInput.type === 'password';
          passInput.type = hidden ? 'text' : 'password';
          this.classList.toggle('bi-eye', hidden);
          this.classList.toggle('bi-eye-slash', !hidden);
        });

        const capsHint = document.getElementById('capsHint');
        passInput.addEventListener('keyup', function (e) {
          if (!capsHint) return;
          capsHint.textContent = e.getModifierState && e.getModifierState('CapsLock') ? 'Caps Lock is ON' : '';
        });
      }

      const form = document.getElementById('masterAuthForm');
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const loginTypeInput = document.getElementById('loginTypeInput');
      const loginHeading = document.getElementById('loginHeading');
      const loginSubtext = document.getElementById('loginSubtext');
      const helperCopy = document.getElementById('helperCopy');
      const forgotPasswordLink = document.getElementById('forgotPasswordLink');
      const modeOptions = document.querySelectorAll('.mode-option');
      const recaptchaSiteKey = @json(env('RECAPTCHA_SITE_KEY', ''));
      const captchaTokenInput = document.getElementById('loginCaptchaToken');

      modeOptions.forEach(function (option) {
        option.addEventListener('click', function () {
          const loginType = this.dataset.loginType;
          const action = this.dataset.action;

          modeOptions.forEach((btn) => btn.classList.remove('active'));
          this.classList.add('active');

          if (form) {
            form.action = action;
          }

          if (loginTypeInput) {
            loginTypeInput.value = loginType;
          }

          if (loginHeading) {
            loginHeading.textContent = loginType === 'provider' ? 'Provider Sign In' : 'Sign In';
          }

          if (loginSubtext) {
            loginSubtext.textContent = loginType === 'provider'
              ? 'Access your provider dashboard and account status.'
              : 'Enter your account credentials.';
          }

          if (helperCopy) {
            helperCopy.innerHTML = loginType === 'provider'
              ? 'Want to join as provider? <a href=\"{{ route('provider.register') }}\">Create provider account</a>'
              : 'New user? <a href=\"{{ route('register') }}\">Create account</a>';
          }

          if (forgotPasswordLink) {
            forgotPasswordLink.href = loginType === 'provider'
              ? 'mailto:support@localservices.com?subject=Provider%20Password%20Reset%20Help'
              : '{{ route('password.request') }}';
          }
        });
      });

      if (form && submitBtn) {
        form.addEventListener('submit', async function (event) {
          if (
            recaptchaSiteKey &&
            loginTypeInput &&
            loginTypeInput.value === 'user' &&
            captchaTokenInput &&
            window.grecaptcha
          ) {
            event.preventDefault();
            try {
              const token = await window.grecaptcha.execute(recaptchaSiteKey, { action: 'login' });
              captchaTokenInput.value = token;
            } catch (error) {
              captchaTokenInput.value = '';
            }
          }

          submitBtn.disabled = true;
          submitBtn.querySelector('.spinner-border').style.display = 'inline-block';
          if (btnText) btnText.textContent = 'Authorizing...';
          if (event.defaultPrevented) {
            form.submit();
          }
        });
      }
    })();
  </script>
</body>

</html>
