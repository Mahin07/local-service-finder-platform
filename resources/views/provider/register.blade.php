<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Become a Provider</title>
  <meta name="description" content="Apply to become a verified LocalServices provider.">

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <style>
    :root {
      --accent-color: #f15a24;
      --accent-hover: #d64511;
      --section-bg-light: #fdf7f4;
    }

    #preloader { display: none !important; }

    body {
      background: linear-gradient(180deg, #fffaf7 0%, #ffffff 100%);
    }

    .btn-primary {
      background-color: var(--accent-color) !important;
      border-color: var(--accent-color) !important;
      color: #fff !important;
      box-shadow: 0 16px 30px rgba(241, 90, 36, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-primary:hover {
      background-color: var(--accent-hover) !important;
      border-color: var(--accent-hover) !important;
      transform: translateY(-2px);
      box-shadow: 0 20px 40px rgba(214, 69, 17, 0.25);
    }

    .btn-outline-light {
      border-color: rgba(255,255,255,0.5) !important;
      color: #fff !important;
    }

    .hero-panel {
      background: linear-gradient(180deg, rgba(0,0,0,0.6), rgba(0,0,0,0.3)),
        url('{{ asset('img\service4.jfif') }}') center/cover no-repeat;
      border-radius: 24px;
      color: #fff;
      padding: 46px;
      position: relative;
      overflow: hidden;
    }

    .hero-panel::after {
      content: "";
      position: absolute;
      width: 320px;
      height: 320px;
      right: -120px;
      top: -120px;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.35), transparent 70%);
      filter: blur(2px);
    }

    .info-card {
      background: #fff;
      border-radius: 22px;
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 16px 40px rgba(0,0,0,0.08);
      transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .info-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    }

    .step-card {
      background: #fff;
      border-radius: 18px;
      border: 1px solid rgba(0,0,0,0.06);
      padding: 18px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.06);
      transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .step-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 30px rgba(0,0,0,0.1);
    }

    .badge-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-weight: 600;
      background: rgba(241, 90, 36, 0.1);
      color: var(--accent-color);
      border: 1px solid rgba(241, 90, 36, 0.2);
    }

    .form-wrap {
      background: linear-gradient(180deg, rgba(255, 250, 247, 0.6), rgba(255, 255, 255, 0.95));
      border-radius: 26px;
      border: 1px solid rgba(0,0,0,0.05);
      padding: 8px;
      box-shadow: 0 18px 45px rgba(0,0,0,0.08);
    }

    .form-shell {
      border-radius: 22px;
      background: #fff;
      padding: 28px;
    }

    .form-title {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 18px;
    }

    .form-steps {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 22px;
    }

    .form-step {
      padding: 6px 12px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.08);
      border: 1px solid rgba(241, 90, 36, 0.2);
      color: var(--accent-color);
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-weight: 600;
    }

    .avatar-upload {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
      padding: 14px;
      border-radius: 16px;
      background: rgba(241, 90, 36, 0.06);
      border: 1px dashed rgba(241, 90, 36, 0.3);
    }

    .avatar-circle {
      width: 78px;
      height: 78px;
      border-radius: 50%;
      overflow: hidden;
      border: 3px solid rgba(241, 90, 36, 0.35);
      background: #fff;
      display: grid;
      place-items: center;
      flex-shrink: 0;
    }

    .avatar-circle img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
    }

    .avatar-circle .placeholder {
      color: var(--accent-color);
      font-size: 1.4rem;
    }

    .avatar-text {
      display: grid;
      gap: 4px;
    }

    .avatar-text strong {
      font-size: 1rem;
    }

    .field-icon {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      color: #b76b47;
      font-size: 1rem;
      pointer-events: none;
    }

    .field-wrap {
      position: relative;
    }

    .field-wrap input,
    .field-wrap select,
    .field-wrap textarea {
      padding-left: 40px;
    }

    .form-note {
      background: #fff7f2;
      border-radius: 14px;
      border: 1px solid rgba(241, 90, 36, 0.2);
      padding: 12px 14px;
      font-size: 0.9rem;
    }

    .upload-drop {
      border-radius: 16px;
      border: 1px dashed rgba(0,0,0,0.18);
      padding: 14px;
      background: #fbfbfb;
    }

    .stats-strip {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
      margin-top: 18px;
    }

    .stat-pill {
      background: rgba(255,255,255,0.14);
      border: 1px solid rgba(255,255,255,0.3);
      border-radius: 14px;
      padding: 10px 12px;
      color: #fff;
      font-size: 0.85rem;
    }

    @media (max-width: 991px) {
      .stats-strip { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body class="provider-page">

  <header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center dark-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:support@localservices.com">support@localservices.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
          <h1 class="sitename">LocalServices</h1>
        </a>
        <nav id="navmenu" class="navmenu">
<ul>
  <li><a href="{{ route('home') }}">Home</a></li>
  <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
  <li><a href="{{ route('profile') }}">Profile</a></li>
  <li><a href="{{ route('provider.register') }}" class="btn btn-primary px-3 py-2" style="color:#fff;">Become a Provider</a></li>
  <li><a href="{{ route('provider.login') }}">Provider Login</a></li>
</ul>          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <section class="section pt-5">
      <div class="container" data-aos="fade-up">
        <div class="hero-panel mb-4">
          <div class="row g-4 align-items-center">
            <div class="col-lg-12">
              <span class="badge-pill"><i class="bi bi-stars"></i> Join our verified network</span>
              <h2 class="display-5 fw-bold mt-3">Become a LocalServices Provider</h2>
              <p class="lead text-white-50">Grow your business with premium customers, fair pricing, and a trusted marketplace built on quality.</p>
              <div class="d-flex flex-wrap gap-3 mt-4">
                <a href="#apply" class="btn btn-primary btn-lg">Start application</a>
                <a href="#requirements" class="btn btn-outline-light btn-lg">View requirements</a>
              </div>
              <div class="stats-strip">
                <div class="stat-pill"><strong>48 hrs</strong><br><small>Avg approval time</small></div>
                <div class="stat-pill"><strong>4.9+</strong><br><small>Provider rating</small></div>
                <div class="stat-pill"><strong>+32%</strong><br><small>Monthly growth</small></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="requirements" class="section light-background">
      <div class="container" data-aos="fade-up">
        <div class="row g-4">
          <div class="col-lg-7">
            <div class="info-card p-4">
              <h4 class="fw-bold mb-3">Why providers choose LocalServices</h4>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="step-card h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-award-fill text-accent"></i> Premium clients</h6>
                    <p class="text-muted small mb-0">Work with customers who value quality and clear pricing.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="step-card h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-bar-chart-line-fill text-accent"></i> Steady demand</h6>
                    <p class="text-muted small mb-0">Get matched with nearby requests that fit your skills.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="step-card h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-shield-check text-accent"></i> Verified network</h6>
                    <p class="text-muted small mb-0">We protect your reputation with verified, vetted bookings.</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="step-card h-100">
                    <h6 class="fw-bold mb-2"><i class="bi bi-clock-history text-accent"></i> Fast payouts</h6>
                    <p class="text-muted small mb-0">Weekly payouts and transparent service fees.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="info-card p-4">
              <h5 class="fw-bold mb-3">Minimum requirements</h5>
              <ul class="text-muted small d-grid gap-2 list-unstyled">
                <li><i class="bi bi-check-circle text-accent"></i> Valid business registration or license</li>
                <li><i class="bi bi-check-circle text-accent"></i> 2+ years of experience</li>
                <li><i class="bi bi-check-circle text-accent"></i> Liability insurance (if applicable)</li>
                <li><i class="bi bi-check-circle text-accent"></i> Background screening approval</li>
              </ul>
              <div class="p-3 bg-light rounded-3 mt-3">
                <strong>Tip:</strong> Upload certificates to speed up verification.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="apply" class="section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center g-4">
          <div class="col-lg-10">
            <div class="form-wrap">
              <div class="form-shell">
                <div class="form-title">
                  <div>
                    <h3 class="fw-bold mb-1">Provider application</h3>
                    <p class="text-muted mb-0">Tell us about your business and we will follow up within 24 hours.</p>
                  </div>
                  <span class="form-step">Step 1 of 2</span>
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

                <div class="form-steps">
                  <span class="form-step">Business info</span>
                  <span class="form-step">Verification</span>
                  <span class="form-step">Profile setup</span>
                </div>
                <div class="avatar-upload">
                  <div class="avatar-circle">
                    <i class="bi bi-camera-fill placeholder"></i>
                    <img id="provider-avatar-preview" alt="Provider profile preview">
                  </div>
                  <div class="avatar-text">
                    <strong>Upload provider photo</strong>
                    <span class="text-muted small">Circle profile image shown to customers.</span>
                  </div>
                </div>
                <form class="row g-3" method="POST" action="{{ route('provider.register.submit') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="col-md-6">
                    <label class="form-label">Full name</label>
                    <div class="field-wrap">
                      <i class="bi bi-person field-icon"></i>
                      <input type="text" name="name" class="form-control" placeholder="Your full name" value="{{ old('name', auth()->user()?->name) }}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Primary service</label>
                    <div class="field-wrap">
                      <i class="bi bi-briefcase field-icon"></i>
                      <select class="form-select" name="service" required>
                        <option value="">Choose service</option>
                        <option value="Cleaning" @selected(old('service') === 'Cleaning')>Cleaning</option>
                        <option value="Plumbing" @selected(old('service') === 'Plumbing')>Plumbing</option>
                        <option value="Electrical" @selected(old('service') === 'Electrical')>Electrical</option>
                        <option value="HVAC" @selected(old('service') === 'HVAC')>HVAC</option>
                        <option value="Carpentry" @selected(old('service') === 'Carpentry')>Carpentry</option>
                        <option value="Landscaping" @selected(old('service') === 'Landscaping')>Landscaping</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="field-wrap">
                      <i class="bi bi-lock field-icon"></i>
                      <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email address</label>
                    <div class="field-wrap">
                      <i class="bi bi-envelope field-icon"></i>
                      <input type="email" name="email" class="form-control" placeholder="you@email.com" value="{{ old('email', auth()->user()?->email) }}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone number</label>
                    <div class="field-wrap">
                      <i class="bi bi-telephone field-icon"></i>
                      <input type="tel" name="phone" class="form-control" placeholder="+1 555 555 5555" value="{{ old('phone') }}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Primary city</label>
                    <div class="field-wrap">
                      <i class="bi bi-geo-alt field-icon"></i>
                      <input type="text" name="city" class="form-control" placeholder="City you serve" value="{{ old('city') }}" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Tell us about your experience</label>
                    <div class="field-wrap">
                      <i class="bi bi-chat-left-text field-icon"></i>
                      <textarea name="experience" class="form-control" rows="3" placeholder="Years of experience and specialties">{{ old('experience') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Confirm password</label>
                    <div class="field-wrap">
                      <i class="bi bi-shield-lock field-icon"></i>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat your password" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Upload provider photo</label>
                    <div class="upload-drop">
                      <input type="file" class="form-control" id="provider-photo" name="image" accept="image/*">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-note">We review applications within 24-48 hours. Keep your inbox ready for onboarding steps.</div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3">Submit application</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container py-5 border-bottom border-white-10">
      <div class="row align-items-center">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h2 class="sitename mb-3">LocalServices</h2>
          <p class="text-white-50">Premium professional care for modern homeowners. Available anytime, anywhere.</p>
        </div>
        <div class="col-lg-4 mb-4 mb-lg-0 text-center">
          <div class="d-flex justify-content-center gap-3">
            <a href="#" class="app-btn btn-sm"><i class="bi bi-apple"></i> Store</a>
            <a href="#" class="app-btn btn-sm"><i class="bi bi-play-fill"></i> Play</a>
          </div>
        </div>
        <div class="col-lg-4 text-lg-end">
          <div class="social-links d-flex justify-content-center justify-content-lg-end gap-3">
            <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
            <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-4 text-center">
      <p class="mb-0 small text-white-50">&copy; 2026 LocalServices Inc. Quality Certified. <a href="#" class="text-accent">Privacy Policy</a> | <a href="#" class="text-accent">Terms</a></p>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>

  <script>
    (function() {
      "use strict";

      function toggleScrolled() {
        const body = document.querySelector('body');
        window.scrollY > 100 ? body.classList.add('scrolled') : body.classList.remove('scrolled');
      }
      document.addEventListener('scroll', toggleScrolled);
      window.addEventListener('load', toggleScrolled);

      const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
      if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', function() {
          document.querySelector('body').classList.toggle('mobile-nav-active');
          this.classList.toggle('bi-list');
          this.classList.toggle('bi-x');
        });
      }

      window.addEventListener('load', () => {
        if (window.AOS) {
          AOS.init({ duration: 600, easing: 'ease-in-out', once: true });
        }
      });

      const photoInput = document.getElementById('provider-photo');
      const preview = document.getElementById('provider-avatar-preview');
      const placeholder = document.querySelector('.avatar-circle .placeholder');
      if (photoInput && preview) {
        photoInput.addEventListener('change', (e) => {
          const file = e.target.files && e.target.files[0];
          if (!file) return;
          const url = URL.createObjectURL(file);
          preview.src = url;
          preview.style.display = 'block';
          if (placeholder) placeholder.style.display = 'none';
        });
      }
    })();
  </script>
</body>
</html>
