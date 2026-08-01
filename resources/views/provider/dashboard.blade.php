<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Provider Dashboard</title>
  <meta name="description" content="Provider dashboard for LocalServices.">

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

    .dash-card {
      background: #fff;
      border-radius: 20px;
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    }

    .stat-pill {
      border-radius: 16px;
      border: 1px solid rgba(0,0,0,0.06);
      padding: 14px;
      background: #fff7f2;
      box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .provider-hero {
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:20px;
      flex-wrap:wrap;
      margin-bottom:18px;
    }

    .provider-hero-meta {
      display:flex;
      align-items:center;
      gap:18px;
      flex-wrap:wrap;
    }

    .provider-photo {
      width:88px;
      height:88px;
      border-radius:50%;
      overflow:hidden;
      display:flex;
      align-items:center;
      justify-content:center;
      background:linear-gradient(135deg, #f15a24, #f6a16f);
      color:#fff;
      font-size:28px;
      font-weight:700;
      box-shadow:0 12px 24px rgba(241,90,36,.22);
      border:3px solid rgba(241,90,36,.18);
      flex-shrink:0;
    }

    .provider-photo img {
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
    }

    .badge-soft {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-weight: 600;
      background: rgba(241, 90, 36, 0.12);
      color: var(--accent-color);
      border: 1px solid rgba(241, 90, 36, 0.2);
    }

    .timeline {
      display: grid;
      gap: 12px;
    }

    .timeline-item {
      padding: 14px;
      border-radius: 14px;
      border: 1px solid rgba(0,0,0,0.06);
      background: #fff;
    }

    .message {
      padding: 12px;
      border-radius: 12px;
      background: #f7f7f7;
    }

    .schedule-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 12px 0;
      border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    .schedule-row:last-child { border-bottom: none; }
  </style>
</head>
<body class="provider-dashboard">
  @php
    $dashboardProvider = $provider ?? auth('provider')->user();
    $providerInitials = collect(explode(' ', trim($dashboardProvider->name ?? 'Provider')))
      ->filter()
      ->take(2)
      ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
      ->implode('');
  @endphp

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
  <li><a href="{{ route('provider.dashboard') }}" class="active">Provider Dashboard</a></li>
  <li><a href="{{ route('provider.bookings.index') }}">Bookings</a></li>
  <li><a href="{{ route('provider.profile') }}">Profile</a></li>
  @if ($dashboardProvider->status === 'approved')
    <li><a href="{{ route('provider.services.index') }}">Add Your Services</a></li>
  @endif
  <li><a href="{{ route('provider.register') }}">Become a Provider</a></li>
  <li>
    <form method="POST" action="{{ route('provider.logout') }}" class="m-0">
      @csrf
      <button type="submit" class="btn btn-link nav-link px-0" style="color: var(--nav-color); text-decoration: none;">Logout</button>
    </form>
  </li>
</ul>          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="main">
    <section class="section pt-5">
      <div class="container" data-aos="fade-up">
        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (!empty($statusNotice))
          <div class="alert {{ $dashboardProvider->status === 'approved' ? 'alert-success' : ($dashboardProvider->status === 'rejected' ? 'alert-danger' : 'alert-warning') }}">
            {{ $statusNotice }}
          </div>
        @endif

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="dash-card p-4 mb-4">
              <div class="provider-hero">
                <div class="provider-hero-meta">
                  <div class="provider-photo">
                    @if ($dashboardProvider->image)
                      <img src="{{ asset($dashboardProvider->image) }}" alt="{{ $dashboardProvider->name }}">
                    @else
                      {{ $providerInitials }}
                    @endif
                  </div>
                  <div>
                    <h3 class="fw-bold mb-1">Welcome back, {{ $dashboardProvider->name }}</h3>
                    <p class="text-muted mb-0">Track your provider profile, recent bookings, and account status from one place.</p>
                  </div>
                </div>
                <span class="badge-soft">Provider dashboard</span>
              </div>
              <div class="row g-3">
                <div class="col-md-3">
                  <div class="stat-pill">
                    <div class="text-muted small">Total bookings</div>
                    <div class="fw-bold fs-4">{{ $stats['total_bookings'] ?? 0 }}</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="stat-pill">
                    <div class="text-muted small">Pending requests</div>
                    <div class="fw-bold fs-4">{{ $stats['pending_bookings'] ?? 0 }}</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="stat-pill">
                    <div class="text-muted small">Approved jobs</div>
                    <div class="fw-bold fs-4">{{ $stats['approved_bookings'] ?? 0 }}</div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="stat-pill">
                    <div class="text-muted small">Live services</div>
                    <div class="fw-bold fs-4">{{ $stats['published_services'] ?? 0 }}</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="dash-card p-4 mb-4">
              <h5 class="fw-bold mb-3">Recent bookings</h5>
              <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('provider.bookings.index') }}" class="btn btn-outline-dark btn-sm">View all bookings</a>
              </div>
              @forelse (($bookings ?? collect()) as $booking)
                <div class="schedule-row">
                  <div>
                    <strong>{{ $booking->providerService?->title ?? ('Booking #' . $booking->id) }}</strong>
                    <div class="text-muted small">
                      {{ $booking->user?->name ?? 'Customer' }} - {{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Date not selected' }}
                    </div>
                  </div>
                  <span class="badge-soft">{{ ucfirst($booking->status) }}</span>
                </div>
              @empty
                <p class="text-muted mb-0">No bookings have been assigned to this provider yet.</p>
              @endforelse
            </div>

            <div class="dash-card p-4">
              <h5 class="fw-bold mb-3">Provider activity</h5>
              <div class="timeline">
                <div class="timeline-item">
                  <strong>Service category</strong>
                  <div class="text-muted small">{{ $dashboardProvider->service ?: 'Not set yet' }}</div>
                </div>
                <div class="timeline-item">
                  <strong>Current city</strong>
                  <div class="text-muted small">{{ $dashboardProvider->city }}</div>
                </div>
                <div class="timeline-item">
                  <strong>Experience</strong>
                  <div class="text-muted small">{{ $dashboardProvider->experience ?: 'No experience details added yet.' }}</div>
                </div>
              </div>
            </div>

            @if ($dashboardProvider->status === 'approved')
              <div class="dash-card p-4 mt-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                  <div>
                    <h5 class="fw-bold mb-1">Published services</h5>
                    <div class="text-muted small">These services can now appear on the user dashboard.</div>
                  </div>
                  <a href="{{ route('provider.services.index') }}" class="btn btn-primary btn-sm">Manage Services</a>
                </div>
                @forelse (($providerServices ?? collect()) as $serviceItem)
                  <div class="schedule-row">
                    <div>
                      <strong>{{ $serviceItem->title }}</strong>
                      <div class="text-muted small">{{ $serviceItem->category }} - {{ $serviceItem->city }}</div>
                    </div>
                    <span class="badge-soft">{{ $serviceItem->is_active ? 'Live' : 'Hidden' }}</span>
                  </div>
                @empty
                  <p class="text-muted mb-0">Your account is approved. Add your first service to start appearing on the user side.</p>
                @endforelse
              </div>
            @endif
          </div>

          <div class="col-lg-4">
            <div class="dash-card p-4 mb-4">
              <h5 class="fw-bold mb-3">Quick profile</h5>
              <div class="d-grid gap-2 text-muted small">
                <div><strong class="text-dark">Email:</strong> {{ $dashboardProvider->email }}</div>
                <div><strong class="text-dark">Phone:</strong> {{ $dashboardProvider->phone }}</div>
                <div><strong class="text-dark">Status:</strong> {{ ucfirst($dashboardProvider->status) }}</div>
                <div><strong class="text-dark">Subscription:</strong> {{ ucfirst($dashboardProvider->subscription_status) }}</div>
              </div>
            </div>

            <div class="dash-card p-4 mb-4">
              <h5 class="fw-bold mb-3">Account notes</h5>
              <div class="d-grid gap-2">
                <div class="message">
                  <strong>Verification</strong>
                  <div class="text-muted small">Your profile is currently {{ strtolower($dashboardProvider->status) }} in the provider review flow.</div>
                </div>
                <div class="message">
                  <strong>Photo</strong>
                  <div class="text-muted small">{{ $dashboardProvider->image ? 'Profile photo uploaded successfully.' : 'No provider photo uploaded yet.' }}</div>
                </div>
                <div class="message">
                  <strong>Next step</strong>
                  <div class="text-muted small">
                    @if ($dashboardProvider->status === 'approved')
                      Your account is approved. Use the Add Your Services page to publish the services users can discover.
                    @elseif ($dashboardProvider->status === 'rejected')
                      Please contact admin if you want this application reviewed again.
                    @else
                      Keep your service details updated so admins can review your account faster.
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="dash-card p-4">
              <h5 class="fw-bold mb-3">Availability snapshot</h5>
              <div class="text-muted small d-grid gap-2">
                <div>Account created: <strong class="text-dark">{{ optional($dashboardProvider->created_at)->format('d M Y') ?: 'Recently' }}</strong></div>
                <div>Guard: <strong class="text-dark">Provider</strong></div>
                <div><a href="{{ route('provider.bookings.index') }}" class="btn btn-outline-dark btn-sm mt-2">Review booking requests</a></div>
                @if ($dashboardProvider->status === 'approved')
                  <div><a href="{{ route('provider.services.index') }}" class="btn btn-primary btn-sm mt-2">Add Your Services</a></div>
                @endif
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
    })();
  </script>
</body>
</html>

