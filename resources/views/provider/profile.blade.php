<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Provider Profile - LocalServices</title>
  <meta name="description" content="View your LocalServices provider profile.">

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
<style>
  :root {
    --accent-color: #e85622;
    --accent-soft: #fff0e6;
    --ink-dark: #241914;
    --muted-copy: #6f625c;
  }

  body.provider-profile-page {
    background:
      linear-gradient(140deg, rgba(255, 250, 247, 0.94), rgba(255, 244, 237, 0.88)),
      url('{{ asset('img/restaurant/showcase-2.webp') }}') center/cover fixed no-repeat;
    min-height: 100vh;
    overflow-x: hidden;
    position: relative;
  }

  body.provider-profile-page::before {
    content: "";
    position: fixed;
    inset: 0;
    background:
      radial-gradient(circle at 10% 18%, rgba(241, 90, 36, 0.13), transparent 24%),
      radial-gradient(circle at 88% 20%, rgba(255, 196, 154, 0.28), transparent 18%),
      radial-gradient(circle at 78% 82%, rgba(241, 90, 36, 0.09), transparent 18%);
    pointer-events: none;
    z-index: 0;
  }

  .scroll-progress { background: linear-gradient(90deg, #ff9a67, #e85622, #ffc28f); box-shadow: 0 0 18px rgba(232, 86, 34, 0.28); }
  .cursor-glow { background: radial-gradient(circle, rgba(241, 90, 36, 0.14), rgba(241, 90, 36, 0.03) 46%, transparent 72%); }
  .cursor-glow.is-visible { opacity: 1; }
  .profile-shell { padding: 150px 0 72px; position: relative; z-index: 2; }

  .glass-card, .membership-card {
    background: rgba(255, 255, 255, 0.78);
    border: 1px solid rgba(104, 70, 55, 0.12);
    backdrop-filter: blur(18px);
    border-radius: 30px;
    box-shadow: 0 24px 60px rgba(69, 37, 22, 0.12);
  }

  .hero-card { padding: 34px; position: relative; overflow: hidden; }
  .hero-card::before { content: ""; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(255,255,255,0.72), transparent 28%, transparent 72%, rgba(241, 90, 36, 0.06)), linear-gradient(180deg, rgba(255,255,255,0.32), transparent); pointer-events: none; }
  .hero-grid { position: absolute; inset: 0; background-image: linear-gradient(rgba(102,70,54,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(102,70,54,0.06) 1px, transparent 1px); background-size: 76px 76px; mask-image: linear-gradient(180deg, rgba(0,0,0,0.85), transparent); opacity: 0.36; pointer-events: none; }
  .hero-card > * { position: relative; z-index: 1; }

  .eyebrow, .provider-chip { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
  .eyebrow { background: rgba(241, 90, 36, 0.12); color: #b83e17; }
  .provider-chip { background: rgba(255,255,255,0.62); border: 1px solid rgba(104,70,55,0.12); color: #5f4e45; }
  .provider-avatar { width: 142px; height: 142px; border-radius: 50%; overflow: hidden; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #f15a24, #d64511); color: #fff; font-size: 2.5rem; font-weight: 800; text-transform: uppercase; border: 4px solid rgba(255,255,255,0.86); box-shadow: 0 18px 35px rgba(241,90,36,0.22); }
  .provider-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .provider-name { font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: var(--ink-dark); margin: 18px 0 10px; }
  .provider-sub { color: var(--muted-copy); font-size: 1.02rem; line-height: 1.8; margin-bottom: 22px; }
  .provider-badges { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 16px; }

  .hero-stat-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; margin-top: 26px; }
  .hero-stat { padding: 15px 16px; border-radius: 20px; background: rgba(255,255,255,0.68); border: 1px solid rgba(104,70,55,0.11); backdrop-filter: blur(12px); transition: transform 0.32s ease, border-color 0.32s ease; }
  .hero-stat:hover { transform: translateY(-4px); border-color: rgba(232,86,34,0.34); }
  .hero-stat strong { display: block; color: var(--ink-dark); font-size: 1.45rem; line-height: 1; margin-bottom: 6px; }
  .hero-stat span { color: #7a6a61; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.08em; }

  .section-title { color: var(--ink-dark); font-size: 1.15rem; font-weight: 800; margin-bottom: 18px; }
  .meta-list, .timeline-list, .membership-points { display: grid; gap: 14px; }
  .meta-item, .timeline-entry, .membership-point { display: flex; gap: 14px; align-items: flex-start; padding: 16px 18px; border-radius: 22px; background: rgba(255,255,255,0.58); border: 1px solid rgba(104,70,55,0.1); transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease; }
  .meta-item:hover, .timeline-entry:hover, .membership-point:hover { transform: translateY(-3px); border-color: rgba(241,90,36,0.26); background: rgba(255,255,255,0.84); }
  .meta-item i, .timeline-entry i, .membership-point i, .quick-card i { width: 44px; height: 44px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; background: rgba(241,90,36,0.12); color: var(--accent-color); font-size: 1.08rem; flex-shrink: 0; }
  .meta-item strong, .timeline-entry strong, .membership-point strong { display: block; color: var(--ink-dark); margin-bottom: 4px; font-size: 0.95rem; }
  .meta-item span, .timeline-entry span, .membership-point span, .quick-card span { color: var(--muted-copy); font-size: 0.93rem; line-height: 1.65; }

  .membership-card { padding: 28px; position: relative; overflow: hidden; background: linear-gradient(135deg, rgba(255,164,114,0.22), rgba(255,255,255,0.82)), rgba(255,255,255,0.78); }
  .membership-card::before { content: ""; position: absolute; inset: auto -30px -30px auto; width: 140px; height: 140px; border-radius: 50%; background: radial-gradient(circle, rgba(241,90,36,0.19), transparent 70%); }
  .membership-title { color: var(--ink-dark); font-size: 1.42rem; font-weight: 800; margin: 10px 0 8px; }
  .membership-copy { color: var(--muted-copy); line-height: 1.7; margin-bottom: 16px; }

  .quick-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
  .quick-card { display: block; padding: 18px; border-radius: 22px; background: rgba(255,255,255,0.58); border: 1px solid rgba(104,70,55,0.1); text-decoration: none; transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease; }
  .quick-card:hover { transform: translateY(-4px); border-color: rgba(241,90,36,0.3); background: rgba(255,255,255,0.86); }
  .quick-card strong { display: block; color: var(--ink-dark); margin-bottom: 6px; font-size: 0.97rem; }
  .mini-note { color: #7a6a61; font-size: 0.9rem; }
  .action-row { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px; }
  .magnetic { transition: transform 0.18s ease; will-change: transform; }
  .fade-rise { opacity: 0; transform: translateY(24px); transition: opacity 0.7s ease, transform 0.7s ease; }
  .fade-rise.is-visible { opacity: 1; transform: translateY(0); }
  .edit-toggle-wrap { display: flex; justify-content: flex-end; margin-bottom: 16px; }
  .edit-panel { display: none; }
  .edit-panel.is-open { display: block; }

  @media (max-width: 991px) { .profile-shell { padding-top: 130px; } .hero-stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .quick-grid { grid-template-columns: 1fr; } }
  @media (max-width: 767px) { .hero-stat-grid { grid-template-columns: 1fr; } .hero-card, .glass-card, .membership-card { padding: 24px; } }
</style>

<body class="provider-profile-page">
  @php
    $provider = $provider ?? auth('provider')->user();
    $avatar = $provider->image ? asset($provider->image) : null;
    $initials = collect(explode(' ', trim($provider->name ?? 'Provider')))
      ->filter()
      ->take(2)
      ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
      ->implode('');
  @endphp

  <div class="scroll-progress" id="scroll-progress"></div>
  <div class="cursor-glow" id="cursor-glow"></div>

  <header id="header" class="header fixed-top">
    <div class="topbar d-flex align-items-center dark-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:support@localservices.com">support@localservices.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
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
            <li><a href="{{ route('provider.dashboard') }}">Provider Dashboard</a></li>
            <li><a href="{{ route('provider.bookings.index') }}">Bookings</a></li>
            <li><a href="{{ route('provider.profile') }}" class="active">Profile</a></li>
            @if ($provider->status === 'approved')
              <li><a href="{{ route('provider.services.index') }}">Add Your Services</a></li>
            @endif
            <li>
              <form method="POST" action="{{ route('provider.logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link nav-link px-0" style="color: var(--nav-color); text-decoration: none;">Logout</button>
              </form>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </div>
  </header>

  <main class="profile-shell">
    <div class="container">
      @if (session('success'))
        <div class="alert alert-success fade-rise">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger fade-rise">Please check the form and correct the highlighted fields.</div>
      @endif

      <div class="row g-4">
        <div class="col-lg-8">
          <section class="glass-card hero-card fade-rise" data-aos="fade-up">
            <div class="hero-grid"></div>
            <span class="eyebrow"><i class="bi bi-person-badge"></i> Provider Identity</span>
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-4 mt-4">
              <div class="provider-avatar">
                @if ($avatar)
                  <img src="{{ $avatar }}" alt="{{ $provider->name }}">
                @else
                  {{ $initials }}
                @endif
              </div>
              <div>
                <h1 class="provider-name">{{ $provider->name }}</h1>
                <p class="provider-sub">Your professional LocalServices profile with live trust signals, platform readiness, and a sharper premium identity that matches the rest of the product experience.</p>
                <div class="provider-badges">
                  <span class="provider-chip"><i class="bi bi-patch-check"></i>{{ ucfirst($provider->status) }}</span>
                  <span class="provider-chip"><i class="bi bi-briefcase"></i>{{ $provider->service ?: 'General provider' }}</span>
                  <span class="provider-chip"><i class="bi bi-geo-alt"></i>{{ $provider->city }}</span>
                </div>
                <div class="action-row">
                  <a href="{{ route('provider.dashboard') }}" class="btn btn-primary px-4 py-3 magnetic">Back to Dashboard</a>
                  <a href="{{ route('provider.bookings.index') }}" class="btn btn-outline-light px-4 py-3 magnetic">Open Bookings</a>
                  @if ($provider->status === 'approved')
                    <a href="{{ route('provider.services.index') }}" class="btn btn-outline-light px-4 py-3 magnetic">Manage Services</a>
                  @endif
                </div>
              </div>
            </div>

            <div class="hero-stat-grid">
              <div class="hero-stat">
                <strong data-counter="{{ $totalBookings }}">0</strong>
                <span>Total Bookings</span>
              </div>
              <div class="hero-stat">
                <strong data-counter="{{ $approvedBookings }}">0</strong>
                <span>Approved Jobs</span>
              </div>
              <div class="hero-stat">
                <strong data-counter="{{ $finishedBookings }}">0</strong>
                <span>Finished Jobs</span>
              </div>
              <div class="hero-stat">
                <strong data-counter="{{ $liveServices }}">0</strong>
                <span>Live Services</span>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-4">
          <section class="glass-card p-4 fade-rise" data-aos="fade-left">
            <p class="section-title">Provider Snapshot</p>
            <div class="meta-list">
              <div class="meta-item">
                <i class="bi bi-envelope"></i>
                <div>
                  <strong>Email Address</strong>
                  <span>{{ $provider->email }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-telephone"></i>
                <div>
                  <strong>Phone Number</strong>
                  <span>{{ $provider->phone }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-credit-card-2-front"></i>
                <div>
                  <strong>Subscription</strong>
                  <span>{{ ucfirst($provider->subscription_status ?: 'unpaid') }}</span>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-7">
          <section class="glass-card p-4 fade-rise" data-aos="fade-up">
            <p class="section-title">Professional Details</p>
            <div class="meta-list">
              <div class="meta-item">
                <i class="bi bi-tools"></i>
                <div>
                  <strong>Primary Service</strong>
                  <span>{{ $provider->service ?: 'No primary service added yet.' }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-award"></i>
                <div>
                  <strong>Experience</strong>
                  <span>{{ $provider->experience ?: 'No experience details added yet.' }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-geo"></i>
                <div>
                  <strong>Operating City</strong>
                  <span>{{ $provider->city }}</span>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-5">
          <section class="membership-card fade-rise" data-aos="fade-up" data-aos-delay="80">
            <div class="eyebrow"><i class="bi bi-stars"></i> Provider Circle</div>
            <div class="membership-title">Professional Presence Card</div>
            <p class="membership-copy">This profile works like your premium identity hub for platform trust, customer confidence, and service readiness.</p>
            <div class="membership-points">
              <div class="membership-point">
                <i class="bi bi-patch-check-fill"></i>
                <div>
                  <strong>Approval Flow</strong>
                  <span>{{ $provider->status === 'approved' ? 'Your account is approved and visible to customers through active services.' : 'Complete approval to unlock your full public provider presence.' }}</span>
                </div>
              </div>
              <div class="membership-point">
                <i class="bi bi-lightning-charge-fill"></i>
                <div>
                  <strong>Booking Momentum</strong>
                  <span>{{ $totalBookings > 0 ? 'You already have incoming booking activity that strengthens your provider footprint.' : 'Publish more services to start building booking momentum faster.' }}</span>
                </div>
              </div>
              <div class="membership-point">
                <i class="bi bi-broadcast-pin"></i>
                <div>
                  <strong>Visibility</strong>
                  <span>{{ $liveServices > 0 ? 'Your live services are ready to appear in customer discovery flows.' : 'Activate services to become more visible across the customer side.' }}</span>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-6">
          <section class="glass-card p-4 fade-rise" data-aos="fade-up" data-aos-delay="100">
            <p class="section-title">Quick Access</p>
            <div class="quick-grid">
              <a href="{{ route('provider.dashboard') }}" class="quick-card magnetic">
                <i class="bi bi-columns-gap"></i>
                <strong>Dashboard</strong>
                <span>Return to your main provider control center.</span>
              </a>
              <a href="{{ route('provider.bookings.index') }}" class="quick-card magnetic">
                <i class="bi bi-journal-check"></i>
                <strong>Booking Requests</strong>
                <span>Approve and manage incoming customer requests.</span>
              </a>
              @if ($provider->status === 'approved')
                <a href="{{ route('provider.services.index') }}" class="quick-card magnetic">
                  <i class="bi bi-grid"></i>
                  <strong>Live Services</strong>
                  <span>Create and refine the services customers discover.</span>
                </a>
              @endif
              <a href="{{ route('home') }}" class="quick-card magnetic">
                <i class="bi bi-house-heart"></i>
                <strong>Brand Homepage</strong>
                <span>Jump back to the polished customer-facing experience.</span>
              </a>
            </div>
          </section>
        </div>

        <div class="col-lg-6">
          <section class="glass-card p-4 fade-rise" data-aos="fade-up" data-aos-delay="120">
            <p class="section-title">Recent Activity</p>
            <div class="timeline-list">
              <div class="timeline-entry">
                <i class="bi bi-person-plus"></i>
                <div>
                  <strong>Provider account created on {{ optional($provider->created_at)->format('d M Y') ?: 'recently' }}</strong>
                  <span>Your provider journey is now part of the LocalServices marketplace identity system.</span>
                </div>
              </div>
              <div class="timeline-entry">
                <i class="bi bi-receipt"></i>
                <div>
                  <strong>{{ $latestBooking ? 'Latest booking captured' : 'No booking activity yet' }}</strong>
                  <span>
                    @if ($latestBooking)
                      {{ $latestBooking->user?->name ?? 'A customer' }} booked {{ $latestBooking->providerService?->title ?? 'a service' }} and it is currently {{ $latestBooking->status }}.
                    @else
                      As soon as a customer books one of your services, it will appear in your activity timeline here.
                    @endif
                  </span>
                </div>
              </div>
              <div class="timeline-entry">
                <i class="bi bi-box-seam"></i>
                <div>
                  <strong>{{ $latestService ? 'Latest published service' : 'No services published yet' }}</strong>
                  <span>
                    @if ($latestService)
                      {{ $latestService->title }} is your latest service listing and is currently {{ $latestService->is_active ? 'live' : 'hidden' }}.
                    @else
                      Add a service to strengthen your visibility and discovery across the customer side.
                    @endif
                  </span>
                </div>
              </div>
            </div>
            <p class="mini-note mt-4 mb-0">This page is display-focused for now and uses your real provider account values, booking data, and service counts.</p>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-12">
          <div class="edit-toggle-wrap fade-rise">
            <button type="button" class="btn btn-primary magnetic" data-edit-toggle="provider-edit-panel">Edit Profile</button>
          </div>
          <section class="glass-card p-4 fade-rise edit-panel" id="provider-edit-panel" data-aos="fade-up" data-aos-delay="140">
            <p class="section-title">Edit Provider Profile</p>
            <form method="POST" action="{{ route('provider.profile.update') }}" enctype="multipart/form-data" class="row g-4">
              @csrf

              <div class="col-md-6">
                <label class="form-label text-white fw-semibold">Provider Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $provider->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label text-white fw-semibold">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $provider->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label text-white fw-semibold">Phone Number</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $provider->phone) }}" required>
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label text-white fw-semibold">City</label>
                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $provider->city) }}" required>
                @error('city')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-4">
                <label class="form-label text-white fw-semibold">Primary Service</label>
                <input type="text" name="service" class="form-control @error('service') is-invalid @enderror" value="{{ old('service', $provider->service) }}" required>
                @error('service')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-8">
                <label class="form-label text-white fw-semibold">Experience</label>
                <input type="text" name="experience" class="form-control @error('experience') is-invalid @enderror" value="{{ old('experience', $provider->experience) }}" placeholder="5 years, certified technician, etc.">
                @error('experience')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-4">
                <label class="form-label text-white fw-semibold">Profile Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p class="mini-note mt-3 mb-0">Upload a sharper provider photo to improve customer trust and profile presence.</p>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary px-4 py-3 magnetic">Save Provider Changes</button>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </main>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script>
    (function () {
      'use strict';

      if (window.AOS) {
        AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic' });
      }

      const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
      if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', function () {
          document.body.classList.toggle('mobile-nav-active');
          this.classList.toggle('bi-list');
          this.classList.toggle('bi-x');
        });
      }

      const progress = document.getElementById('scroll-progress');
      const cursorGlow = document.getElementById('cursor-glow');
      const revealItems = document.querySelectorAll('.fade-rise');
      const magneticItems = document.querySelectorAll('.magnetic');
      const counters = document.querySelectorAll('[data-counter]');
      const editToggles = document.querySelectorAll('[data-edit-toggle]');

      function updateProgress() {
        if (!progress) return;
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const percent = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;
        progress.style.width = `${Math.min(percent, 100)}%`;
      }

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.16 });

      revealItems.forEach((item) => observer.observe(item));

      magneticItems.forEach((item) => {
        item.addEventListener('mousemove', (event) => {
          if (window.innerWidth < 992) return;
          const rect = item.getBoundingClientRect();
          const x = event.clientX - rect.left - rect.width / 2;
          const y = event.clientY - rect.top - rect.height / 2;
          item.style.transform = `translate(${x * 0.08}px, ${y * 0.08}px)`;
        });

        item.addEventListener('mouseleave', () => {
          item.style.transform = '';
        });
      });

      document.addEventListener('mousemove', (event) => {
        if (!cursorGlow || window.innerWidth < 992) return;
        cursorGlow.classList.add('is-visible');
        cursorGlow.style.left = `${event.clientX}px`;
        cursorGlow.style.top = `${event.clientY}px`;
      });

      document.addEventListener('mouseleave', () => {
        cursorGlow?.classList.remove('is-visible');
      });

      counters.forEach((counter) => {
        const target = Number(counter.getAttribute('data-counter')) || 0;
        const start = performance.now();
        const duration = 1100;

        function animate(now) {
          const progressValue = Math.min((now - start) / duration, 1);
          counter.textContent = Math.round(target * (1 - Math.pow(1 - progressValue, 3)));
          if (progressValue < 1) {
            requestAnimationFrame(animate);
          }
        }

        requestAnimationFrame(animate);
      });

      editToggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {
          const panel = document.getElementById(toggle.getAttribute('data-edit-toggle'));
          if (!panel) return;
          panel.classList.toggle('is-open');
          toggle.textContent = panel.classList.contains('is-open') ? 'Close Edit Form' : 'Edit Profile';
        });
      });

      updateProgress();
      window.addEventListener('scroll', updateProgress, { passive: true });
    })();
  </script>
</body>
</html>
