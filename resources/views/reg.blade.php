<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Register - LocalServices</title>
  <meta name="description" content="Create your LocalServices account.">

  <link href="{{ asset('img/reg.jfif') }}" rel="icon">
  <link href="{{ asset('img/reg.jfif') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">

  <style>
    :root {
      --accent: #ef6a3b;
      --accent-2: #f5a75c;
      --ink: #f7f5f2;
      --muted: rgba(247, 245, 242, 0.72);
      --line: rgba(255, 255, 255, 0.16);
      --card: rgba(6, 8, 12, 0.58);
      --input: rgba(255, 255, 255, 0.06);
      --error: #ff7676;
      --ok: #43d487;
    }

    * {
      box-sizing: border-box;
    }

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
      background: linear-gradient(125deg, rgba(8, 9, 12, 0.84), rgba(8, 9, 12, 0.55)), url('{{ asset('img/reg.jfif') }}') center/cover no-repeat;
      transform: scale(1.03);
      z-index: -3;
      transition: transform 0.25s ease-out;
      will-change: transform;
    }

    .bg-grain {
      position: fixed;
      inset: 0;
      background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px);
      background-size: 3px 3px;
      opacity: 0.32;
      z-index: -2;
      pointer-events: none;
    }

    .orb {
      position: fixed;
      border-radius: 50%;
      filter: blur(90px);
      z-index: -1;
      opacity: 0.22;
      animation: orbit 14s ease-in-out infinite alternate;
      pointer-events: none;
    }

    .orb.one {
      width: 380px;
      height: 380px;
      right: -80px;
      top: -80px;
      background: rgba(239, 106, 59, 0.7);
    }

    .orb.two {
      width: 300px;
      height: 300px;
      left: -90px;
      bottom: -80px;
      animation-delay: -4s;
      background: rgba(245, 167, 92, 0.55);
    }

    @keyframes orbit {
      from { transform: translate(0, 0) scale(1); }
      to { transform: translate(36px, 28px) scale(1.08); }
    }

    .page {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 28px 16px;
    }

    .register-shell {
      width: min(1100px, 100%);
      display: grid;
      grid-template-columns: 0.95fr 1.2fr;
      border: 1px solid var(--line);
      border-radius: 30px;
      backdrop-filter: blur(16px);
      background: linear-gradient(145deg, rgba(255,255,255,0.07), rgba(255,255,255,0.02));
      box-shadow: 0 32px 80px rgba(0, 0, 0, 0.45);
      overflow: hidden;
    }

    .left-pane {
      padding: 44px;
      border-right: 1px solid var(--line);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: linear-gradient(180deg, rgba(8, 10, 14, 0.44), rgba(8, 10, 14, 0.15));
    }

    .brand {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--ink);
      font-weight: 800;
      letter-spacing: 0.2px;
    }

    .brand i {
      color: var(--accent);
      font-size: 1.2rem;
    }

    .hero-title {
      margin: 28px 0 14px;
      font-family: "Playfair Display", serif;
      font-size: clamp(2rem, 3.6vw, 3.1rem);
      line-height: 1.05;
    }

    .hero-title .accent {
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-text {
      color: var(--muted);
      max-width: 34ch;
      line-height: 1.65;
    }

    .feature-list {
      display: grid;
      gap: 14px;
      margin-top: 26px;
    }

    .feature {
      display: grid;
      grid-template-columns: 26px auto;
      gap: 12px;
      align-items: start;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .feature i {
      color: var(--accent-2);
    }

    .right-pane {
      padding: 42px;
      background: var(--card);
    }

    .title-wrap h2 {
      margin: 0;
      font-weight: 800;
      font-size: 1.85rem;
    }

    .title-wrap p {
      margin: 8px 0 0;
      color: var(--muted);
    }

    .alert {
      border-radius: 12px;
      border: 0;
      margin-top: 18px;
      margin-bottom: 0;
    }

    .form-area {
      margin-top: 22px;
    }

    .profile-upload {
      display: flex;
      justify-content: center;
      margin-bottom: 18px;
    }

    .avatar-wrap {
      position: relative;
      width: 116px;
      height: 116px;
      border-radius: 50%;
      border: 2px solid rgba(239, 106, 59, 0.7);
      overflow: hidden;
      background: rgba(255,255,255,0.06);
      box-shadow: 0 8px 20px rgba(0,0,0,0.28);
      display: grid;
      place-items: center;
    }

    .avatar-wrap i {
      font-size: 2.2rem;
      color: rgba(255,255,255,0.35);
    }

    .avatar-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .avatar-btn {
      position: absolute;
      right: 3px;
      bottom: 3px;
      width: 34px;
      height: 34px;
      border-radius: 50%;
      border: 2px solid rgba(10, 13, 18, 0.95);
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      display: grid;
      place-items: center;
      cursor: pointer;
    }

    .avatar-btn i {
      font-size: 0.95rem;
      color: #fff;
    }

    .field {
      margin-bottom: 14px;
    }

    .field label {
      display: block;
      margin-bottom: 7px;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      color: rgba(247, 245, 242, 0.58);
      font-weight: 700;
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap > i {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      color: rgba(255,255,255,0.35);
      pointer-events: none;
    }

    .form-control {
      min-height: 48px;
      padding-left: 42px;
      padding-right: 42px;
      border-radius: 14px;
      border: 1px solid var(--line);
      background: var(--input);
      color: var(--ink);
      transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    .form-control::placeholder {
      color: rgba(247,245,242,0.45);
    }

    .form-control:focus {
      background: rgba(255,255,255,0.08);
      border-color: rgba(239, 106, 59, 0.95);
      box-shadow: 0 0 0 4px rgba(239, 106, 59, 0.14);
      color: var(--ink);
    }

    .toggle-pass {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: rgba(255,255,255,0.55);
    }

    .strength {
      margin-top: 8px;
    }

    .strength-bar {
      height: 8px;
      border-radius: 20px;
      background: rgba(255,255,255,0.12);
      overflow: hidden;
    }

    .strength-fill {
      height: 100%;
      width: 0;
      transition: width .25s ease, background-color .25s ease;
      background: var(--error);
    }

    .strength-text {
      font-size: 0.8rem;
      margin-top: 5px;
      color: rgba(247,245,242,0.62);
    }

    .hint {
      font-size: 0.8rem;
      margin-top: 6px;
      color: var(--muted);
      min-height: 18px;
    }

    .hint.error {
      color: var(--error);
    }

    .hint.ok {
      color: var(--ok);
    }

    .btn-register {
      margin-top: 10px;
      width: 100%;
      border: none;
      border-radius: 14px;
      padding: 13px 18px;
      color: #fff;
      font-weight: 800;
      letter-spacing: 0.6px;
      text-transform: uppercase;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      box-shadow: 0 14px 30px rgba(239, 106, 59, 0.28);
      transition: transform 0.2s ease, box-shadow 0.2s ease, filter .2s ease;
    }

    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 34px rgba(239, 106, 59, 0.32);
      filter: brightness(1.04);
    }

    .btn-register:disabled {
      opacity: 0.8;
      cursor: not-allowed;
    }

    .btn-register .spinner-border {
      width: 1rem;
      height: 1rem;
      border-width: 0.14rem;
      margin-right: 8px;
      vertical-align: -2px;
      display: none;
    }

    .footer-line {
      margin-top: 14px;
      text-align: center;
      color: var(--muted);
      font-size: 0.9rem;
    }

    .footer-line a {
      color: var(--accent-2);
      text-decoration: none;
      font-weight: 700;
    }

    @media (max-width: 991px) {
      .register-shell {
        grid-template-columns: 1fr;
      }

      .left-pane {
        display: none;
      }

      .right-pane {
        padding: 30px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="bg-scene" id="bgScene"></div>
  <div class="bg-grain"></div>
  <div class="orb one"></div>
  <div class="orb two"></div>

  <main class="page">
    <section class="register-shell" data-aos="zoom-in" data-aos-duration="800">
      <aside class="left-pane">
        <div>
          <a href="{{ url('/') }}" class="brand"><i class="bi bi-house-heart-fill"></i> LocalServices</a>
          <h1 class="hero-title">Book trusted help with <span class="accent">one account</span>.</h1>
          <p class="hero-text">Create your profile to discover nearby professionals, manage bookings, and track every service in one place.</p>

          <div class="feature-list">
            <div class="feature"><i class="bi bi-shield-check"></i><span>Verified providers and secure profile data.</span></div>
            <div class="feature"><i class="bi bi-lightning-charge"></i><span>Fast booking flow with clear service history.</span></div>
            <div class="feature"><i class="bi bi-stars"></i><span>Personalized recommendations based on your needs.</span></div>
          </div>
        </div>

        <small class="text-white-50">&copy; 2026 LocalServices</small>
      </aside>

      <div class="right-pane">
        <div class="title-wrap">
          <h2>Create Account</h2>
          <p>Complete your details to start booking services.</p>
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

        <form id="mainRegisterForm" class="form-area" method="POST" action="{{ route('register.user') }}" enctype="multipart/form-data" novalidate>
          @csrf
          <input type="hidden" id="registerCaptchaToken" name="captcha_token">
          <input type="text" name="website" tabindex="-1" autocomplete="off" class="d-none" aria-hidden="true">

          <div class="profile-upload">
            <div class="avatar-wrap" id="avatarWrap">
              <img id="avatarImage" alt="Profile preview" style="display:none;">
              <i class="bi bi-person-fill" id="avatarIcon"></i>
              <label class="avatar-btn" for="profileInput">
                <i class="bi bi-camera-fill"></i>
                <input type="file" id="profileInput" name="image" accept="image/*" hidden>
              </label>
            </div>
          </div>

          <div class="row g-2">
            <div class="col-md-6 field">
              <label for="name">Full Name</label>
              <div class="input-wrap">
                <i class="bi bi-person-fill"></i>
                <input id="name" name="name" type="text" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
              </div>
            </div>

            <div class="col-md-6 field">
              <label for="email">Email</label>
              <div class="input-wrap">
                <i class="bi bi-envelope-fill"></i>
                <input id="email" name="email" type="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="address">Address (Optional)</label>
            <div class="input-wrap">
              <i class="bi bi-geo-alt-fill"></i>
              <input id="address" name="address" type="text" class="form-control" placeholder="Street, city, state" value="{{ old('address') }}">
            </div>
          </div>

          <div class="row g-2">
            <div class="col-md-6 field">
              <label for="password">Password</label>
              <div class="input-wrap">
                <i class="bi bi-lock-fill"></i>
                <input id="password" name="password" type="password" class="form-control" placeholder="Create password" required>
                <i class="bi bi-eye-slash toggle-pass" data-target="password"></i>
              </div>

              <div class="strength">
                <div class="strength-bar">
                  <div class="strength-fill" id="strengthFill"></div>
                </div>
                <div class="strength-text" id="strengthText">Use at least 6 characters.</div>
              </div>
            </div>

            <div class="col-md-6 field">
              <label for="password_confirmation">Confirm Password</label>
              <div class="input-wrap">
                <i class="bi bi-lock-fill"></i>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Repeat password" required>
                <i class="bi bi-eye-slash toggle-pass" data-target="password_confirmation"></i>
              </div>
              <div class="hint" id="confirmHint"></div>
            </div>
          </div>

          <button type="submit" class="btn-register" id="submitBtn">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span id="btnText">Send OTP</span>
          </button>

          <p class="footer-line">Already have an account? <a href="{{ url('/login') }}">Sign in</a></p>
        </form>
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

      const profileInput = document.getElementById('profileInput');
      const avatarImage = document.getElementById('avatarImage');
      const avatarIcon = document.getElementById('avatarIcon');
      if (profileInput && avatarImage && avatarIcon) {
        profileInput.addEventListener('change', function () {
          const file = this.files && this.files[0];
          if (!file) return;

          const reader = new FileReader();
          reader.onload = function (evt) {
            avatarImage.src = evt.target.result;
            avatarImage.style.display = 'block';
            avatarIcon.style.display = 'none';
          };
          reader.readAsDataURL(file);
        });
      }

      document.querySelectorAll('.toggle-pass').forEach(function (icon) {
        icon.addEventListener('click', function () {
          const target = document.getElementById(this.dataset.target);
          if (!target) return;
          const toText = target.type === 'password';
          target.type = toText ? 'text' : 'password';
          this.classList.toggle('bi-eye', toText);
          this.classList.toggle('bi-eye-slash', !toText);
        });
      });

      const passwordInput = document.getElementById('password');
      const confirmInput = document.getElementById('password_confirmation');
      const strengthFill = document.getElementById('strengthFill');
      const strengthText = document.getElementById('strengthText');
      const confirmHint = document.getElementById('confirmHint');

      function strengthScore(value) {
        let score = 0;
        if (value.length >= 6) score += 1;
        if (/[A-Z]/.test(value)) score += 1;
        if (/[0-9]/.test(value)) score += 1;
        if (/[^A-Za-z0-9]/.test(value)) score += 1;
        return score;
      }

      function paintStrength(score) {
        const widths = ['0%', '25%', '50%', '75%', '100%'];
        const labels = ['Too weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const colors = ['#ff7676', '#ff9f5a', '#ffd166', '#87d37c', '#43d487'];
        strengthFill.style.width = widths[score];
        strengthFill.style.backgroundColor = colors[score];
        strengthText.textContent = labels[score];
      }

      function validateMatch() {
        const pass = passwordInput.value;
        const conf = confirmInput.value;

        if (!conf) {
          confirmHint.textContent = '';
          confirmHint.className = 'hint';
          return false;
        }

        if (pass === conf) {
          confirmHint.textContent = 'Passwords match.';
          confirmHint.className = 'hint ok';
          return true;
        }

        confirmHint.textContent = 'Passwords do not match.';
        confirmHint.className = 'hint error';
        return false;
      }

      if (passwordInput) {
        passwordInput.addEventListener('input', function () {
          paintStrength(strengthScore(this.value));
          validateMatch();
        });
      }

      if (confirmInput) {
        confirmInput.addEventListener('input', validateMatch);
      }

      const form = document.getElementById('mainRegisterForm');
      const submitBtn = document.getElementById('submitBtn');
      const btnText = document.getElementById('btnText');
      const recaptchaSiteKey = @json(env('RECAPTCHA_SITE_KEY', ''));
      const captchaTokenInput = document.getElementById('registerCaptchaToken');

      if (form && submitBtn) {
        form.addEventListener('submit', async function (event) {
          const pass = passwordInput ? passwordInput.value : '';
          const score = strengthScore(pass);
          const matched = validateMatch();

          if (score < 1 || !matched) {
            event.preventDefault();
            return;
          }

          if (recaptchaSiteKey && captchaTokenInput && window.grecaptcha) {
            event.preventDefault();
            try {
              const token = await window.grecaptcha.execute(recaptchaSiteKey, { action: 'register' });
              captchaTokenInput.value = token;
            } catch (error) {
              captchaTokenInput.value = '';
            }
          }

          submitBtn.disabled = true;
          submitBtn.querySelector('.spinner-border').style.display = 'inline-block';
          if (btnText) btnText.textContent = 'Sending OTP...';
          if (event.defaultPrevented) {
            form.submit();
          }
        });
      }
    })();
  </script>
</body>

</html>
