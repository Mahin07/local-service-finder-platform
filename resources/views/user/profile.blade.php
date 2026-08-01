<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Profile - LocalServices</title>
  <meta name="description" content="View your LocalServices profile.">

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
      --accent-color: #f15a24;
      --accent-hover: #d64511;
      --accent-soft: #fff0e6;
      --glass-bg: rgba(255, 255, 255, 0.1);
      --glass-line: rgba(255, 255, 255, 0.14);
      --ink-dark: #1f1714;
      --muted-copy: rgba(255, 255, 255, 0.72);
    }

    body.profile-page {
      background:
        linear-gradient(140deg, rgba(5, 8, 14, 0.94), rgba(14, 19, 28, 0.85)),
        url('{{ asset('img/WhatsApp Image 2026-03-28 at 7.10.33 PM.jpeg') }}') center/cover fixed no-repeat;
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
    }

    body.profile-page::before {
      content: "";
      position: fixed;
      inset: 0;
      background:
        radial-gradient(circle at 12% 15%, rgba(241, 90, 36, 0.22), transparent 24%),
        radial-gradient(circle at 88% 18%, rgba(255, 198, 154, 0.16), transparent 20%),
        radial-gradient(circle at 70% 80%, rgba(241, 90, 36, 0.12), transparent 18%);
      pointer-events: none;
      z-index: 0;
    }

    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0;
      height: 4px;
      z-index: 10000;
      background: linear-gradient(90deg, #ff8e54, #f15a24, #ffd09b);
      box-shadow: 0 0 18px rgba(241, 90, 36, 0.4);
      transition: width 0.12s linear;
    }

    .cursor-glow {
      position: fixed;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.18), rgba(241, 90, 36, 0.04) 46%, transparent 72%);
      pointer-events: none;
      z-index: 1;
      transform: translate(-50%, -50%);
      filter: blur(10px);
      opacity: 0;
      transition: opacity 0.24s ease;
    }

    .cursor-glow.is-visible {
      opacity: 1;
    }

    .profile-shell {
      padding: 150px 0 72px;
      position: relative;
      z-index: 2;
    }

    .profile-shell::before {
      content: "";
      position: absolute;
      inset: 18px 0 auto 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(241, 90, 36, 0.18), transparent);
    }

    .profile-card,
    .profile-side,
    .info-card {
      background: var(--glass-bg);
      border: 1px solid var(--glass-line);
      backdrop-filter: blur(18px);
      border-radius: 30px;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.25);
    }

    .profile-card {
      padding: 34px;
      position: relative;
      overflow: hidden;
    }

    .profile-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        linear-gradient(135deg, rgba(255,255,255,0.12), transparent 28%, transparent 72%, rgba(241, 90, 36, 0.08)),
        linear-gradient(180deg, rgba(255,255,255,0.04), transparent);
      pointer-events: none;
    }

    .profile-card > * {
      position: relative;
      z-index: 1;
    }

    .profile-side,
    .info-card {
      padding: 28px;
      height: 100%;
    }

    .profile-badge-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 18px;
    }

    .profile-chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: 999px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.1);
      color: rgba(255,255,255,0.78);
      font-size: 0.76rem;
      font-weight: 700;
      letter-spacing: 0.04em;
    }

    .profile-avatar {
      width: 138px;
      height: 138px;
      border-radius: 50%;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, rgba(241, 90, 36, 0.95), rgba(214, 69, 17, 0.95));
      color: #fff;
      font-size: 2.4rem;
      font-weight: 800;
      text-transform: uppercase;
      border: 4px solid rgba(255, 255, 255, 0.18);
      box-shadow: 0 18px 35px rgba(241, 90, 36, 0.28);
    }

    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.15);
      color: #ffd1bf;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .hero-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
      background-size: 76px 76px;
      mask-image: linear-gradient(180deg, rgba(0,0,0,0.85), transparent);
      opacity: 0.38;
      pointer-events: none;
    }

    .profile-name {
      font-size: clamp(2rem, 4vw, 3.1rem);
      font-weight: 900;
      color: #fff;
      margin: 18px 0 10px;
    }

    .profile-sub {
      color: rgba(255, 255, 255, 0.76);
      font-size: 1.02rem;
      line-height: 1.8;
      margin-bottom: 24px;
    }

    .hero-stat-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      margin-top: 26px;
    }

    .hero-stat {
      padding: 15px 16px;
      border-radius: 20px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.1);
      backdrop-filter: blur(12px);
      transition: transform 0.32s ease, border-color 0.32s ease;
    }

    .hero-stat:hover {
      transform: translateY(-4px);
      border-color: rgba(255,255,255,0.2);
    }

    .hero-stat strong {
      display: block;
      color: #fff;
      font-size: 1.45rem;
      line-height: 1;
      margin-bottom: 6px;
    }

    .hero-stat span {
      color: rgba(255,255,255,0.68);
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .meta-list {
      display: grid;
      gap: 14px;
    }

    .meta-item,
    .stat-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 16px 18px;
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.06);
      border: 1px solid rgba(255, 255, 255, 0.08);
      transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease;
    }

    .meta-item:hover,
    .stat-item:hover {
      transform: translateY(-3px);
      border-color: rgba(241, 90, 36, 0.18);
      background: rgba(255, 255, 255, 0.08);
    }

    .meta-item i,
    .stat-item i {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(241, 90, 36, 0.14);
      color: var(--accent-color);
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .meta-item strong,
    .stat-item strong {
      display: block;
      color: #fff;
      margin-bottom: 4px;
      font-size: 0.95rem;
    }

    .meta-item span,
    .stat-item span {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.94rem;
    }

    .info-card {
      position: relative;
      overflow: hidden;
    }

    .info-card::after {
      content: "";
      position: absolute;
      inset: auto -40px -40px auto;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.14), transparent 68%);
      pointer-events: none;
    }

    .membership-card {
      position: relative;
      overflow: hidden;
      padding: 26px;
      border-radius: 28px;
      background:
        linear-gradient(135deg, rgba(255, 164, 114, 0.18), rgba(255,255,255,0.08)),
        rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.12);
      box-shadow: 0 20px 44px rgba(0, 0, 0, 0.22);
    }

    .membership-card::before {
      content: "";
      position: absolute;
      inset: auto -30px -30px auto;
      width: 140px;
      height: 140px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.26), transparent 70%);
    }

    .membership-tier {
      font-size: 0.76rem;
      font-weight: 700;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: #ffd0b8;
    }

    .membership-title {
      color: #fff;
      font-size: 1.45rem;
      font-weight: 800;
      margin: 10px 0 8px;
    }

    .membership-copy {
      color: rgba(255,255,255,0.72);
      line-height: 1.7;
      margin-bottom: 18px;
    }

    .membership-points {
      display: grid;
      gap: 12px;
    }

    .membership-point {
      display: flex;
      gap: 12px;
      align-items: flex-start;
      color: rgba(255,255,255,0.82);
      font-size: 0.93rem;
    }

    .membership-point i {
      color: #ffbf98 !important;
      margin-top: 2px;
    }

    .quick-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
    }

    .quick-card {
      display: block;
      padding: 18px;
      border-radius: 22px;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.08);
      text-decoration: none;
      transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease;
    }

    .quick-card:hover {
      transform: translateY(-4px);
      border-color: rgba(241, 90, 36, 0.22);
      background: rgba(255,255,255,0.09);
    }

    .quick-card i {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(241, 90, 36, 0.14);
      color: var(--accent-color);
      font-size: 1.08rem;
      margin-bottom: 14px;
    }

    .quick-card strong {
      display: block;
      color: #fff;
      margin-bottom: 6px;
      font-size: 0.97rem;
    }

    .quick-card span {
      color: rgba(255,255,255,0.68);
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .timeline-list {
      display: grid;
      gap: 14px;
    }

    .timeline-entry {
      position: relative;
      padding: 0 0 0 24px;
    }

    .timeline-entry::before {
      content: "";
      position: absolute;
      left: 6px;
      top: 4px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--accent-color);
      box-shadow: 0 0 0 8px rgba(241, 90, 36, 0.1);
    }

    .timeline-entry::after {
      content: "";
      position: absolute;
      left: 10px;
      top: 18px;
      bottom: -16px;
      width: 1px;
      background: rgba(255,255,255,0.12);
    }

    .timeline-entry:last-child::after {
      display: none;
    }

    .timeline-entry strong {
      display: block;
      color: #fff;
      margin-bottom: 4px;
      font-size: 0.95rem;
    }

    .timeline-entry span {
      display: block;
      color: rgba(255,255,255,0.68);
      font-size: 0.89rem;
      line-height: 1.6;
    }

    .action-row {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-top: 28px;
    }

    .action-row a,
    .action-row button {
      min-width: 160px;
    }

    .btn-soft {
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.16);
      background: rgba(255, 255, 255, 0.06);
    }

    .btn-soft:hover {
      color: #fff;
      background: rgba(255, 255, 255, 0.1);
    }

    .magnetic {
      transition: transform 0.18s ease;
      will-change: transform;
    }

    .section-title {
      color: #fff;
      font-size: 1.15rem;
      font-weight: 800;
      margin-bottom: 18px;
    }

    .mini-note {
      color: rgba(255, 255, 255, 0.66);
      font-size: 0.9rem;
    }

    .fade-rise {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .fade-rise.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .edit-toggle-wrap {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 16px;
    }

    .edit-panel {
      display: none;
    }

    .edit-panel.is-open {
      display: block;
    }

    @media (max-width: 991px) {
      .profile-shell {
        padding-top: 130px;
      }

      .profile-card,
      .profile-side,
      .info-card {
        padding: 24px;
      }

      .hero-stat-grid {
        grid-template-columns: 1fr;
      }

      .quick-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 1199px) {
      .mobile-nav-toggle {
        z-index: 10001;
      }

      .mobile-nav-active .navmenu {
        background: rgba(9, 12, 18, 0.75) !important;
      }

      .navmenu ul {
        inset: 70px 12px 12px 12px;
        border-radius: 14px;
        padding: 12px;
        background: #151a22 !important;
        border: 1px solid rgba(255, 255, 255, 0.12);
      }

      .mobile-nav-active .navmenu > ul {
        display: block !important;
      }

      .navmenu ul li {
        width: 100%;
      }

      .navmenu ul li > a,
      .navmenu ul li > form > .nav-link {
        display: block;
        width: 100%;
        border-radius: 10px;
        padding: 12px 14px;
      }

      .navmenu ul li > form > .nav-link {
        text-align: left;
        border: 0;
        background: transparent;
        color: #fff !important;
      }

      .navmenu ul li > a {
        color: #fff !important;
      }
    }

    @media (max-width: 767.98px) {
      .topbar {
        display: none !important;
      }

      .branding {
        min-height: 62px;
      }

      .profile-shell {
        padding-top: 92px !important;
      }

      .sitename {
        font-size: 1.25rem;
      }

      .profile-name {
        font-size: 1.75rem;
      }

      .hero-user-meta,
      .profile-badge-row,
      .action-row {
        width: 100%;
      }

      .action-row .btn {
        width: 100%;
      }

      .edit-toggle-wrap {
        justify-content: stretch;
      }

      .edit-toggle-wrap .btn {
        width: 100%;
      }
    }

    @media (hover: none), (pointer: coarse) {
      .cursor-glow,
      .scroll-progress {
        display: none !important;
      }
    }

    /* Clean Premium Redesign */
    body.profile-page {
      background: linear-gradient(180deg, #f7f8fb 0%, #ffffff 100%) !important;
    }

    body.profile-page::before,
    .hero-grid,
    .cursor-glow,
    .scroll-progress {
      display: none !important;
    }

    .profile-shell {
      padding-top: 118px;
    }

    .profile-card,
    .profile-side,
    .info-card,
    .membership-card {
      background: #fff !important;
      border: 1px solid #e8edf3 !important;
      box-shadow: 0 12px 34px rgba(17, 24, 39, 0.06) !important;
      backdrop-filter: none !important;
    }

    .eyebrow {
      background: #fff2ea !important;
      color: #b6471f !important;
      border: 1px solid #ffd8c4;
    }

    .profile-name,
    .section-title,
    .meta-item strong,
    .stat-item strong,
    .quick-card strong,
    .timeline-entry strong,
    .membership-title {
      color: #111827 !important;
    }

    .profile-sub,
    .meta-item span,
    .stat-item span,
    .quick-card span,
    .timeline-entry span,
    .mini-note,
    .membership-copy,
    .membership-point {
      color: #64748b !important;
    }

    .profile-chip {
      background: #f8fafc !important;
      color: #334155 !important;
      border-color: #e2e8f0 !important;
    }

    .hero-stat {
      background: #f8fafc !important;
      border-color: #e2e8f0 !important;
    }

    .hero-stat strong {
      color: #111827 !important;
    }

    .hero-stat span {
      color: #64748b !important;
    }

    .meta-item,
    .stat-item,
    .quick-card {
      background: #f8fafc !important;
      border-color: #e2e8f0 !important;
    }

    .meta-item i,
    .stat-item i,
    .quick-card i {
      background: #fff2ea !important;
      color: #d45b26 !important;
    }

    .quick-card:hover,
    .meta-item:hover,
    .stat-item:hover {
      transform: translateY(-2px);
      border-color: #fed7c3 !important;
      background: #ffffff !important;
    }

    .membership-card {
      background: linear-gradient(180deg, #fff 0%, #fff7f2 100%) !important;
    }

    .membership-tier {
      color: #b45309 !important;
    }

    .membership-point i {
      color: #d45b26 !important;
    }

    .timeline-entry::after {
      background: #e2e8f0 !important;
    }

    .timeline-entry::before {
      box-shadow: 0 0 0 7px rgba(241, 90, 36, 0.15) !important;
    }

    .info-card::after,
    .membership-card::before {
      opacity: 0.35;
    }

    #user-edit-panel .form-label {
      color: #111827 !important;
    }

    #user-edit-panel .form-control {
      background: #f8fafc;
      border: 1px solid #dbe3ed;
      color: #0f172a;
    }

    #user-edit-panel .form-control:focus {
      border-color: #f15a24;
      box-shadow: 0 0 0 0.2rem rgba(241, 90, 36, 0.16);
    }
  </style>
</head>

<body class="profile-page">
  @php
    $user = Auth::user();
    $avatar = $user->image ? asset($user->image) : null;
    $initials = collect(explode(' ', trim($user->name ?? 'User')))
        ->filter()
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');
  @endphp
  @php
    $user = $user ?? Auth::user();
    $totalBookings = $totalBookings ?? $user->bookings()->count();
    $approvedBookings = $approvedBookings ?? $user->bookings()->where('status', 'approved')->count();
    $finishedBookings = $finishedBookings ?? $user->bookings()->where('status', 'finished')->count();
    $latestBooking = $latestBooking ?? $user->bookings()->with(['provider', 'providerService'])->latest()->first();
  @endphp

  <div class="scroll-progress" id="scroll-progress"></div>
  <div class="cursor-glow" id="cursor-glow"></div>

  @include('user.partials.header')

  <main class="profile-shell">
    <div class="container">
      @if (session('success'))
        <div class="alert alert-success fade-rise">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger fade-rise">Please check the form and correct the highlighted fields.</div>
      @endif

      <div class="row g-4 align-items-stretch">
        <div class="col-lg-8">
          <section class="profile-card fade-rise" data-aos="fade-up">
            <div class="hero-grid"></div>
            <span class="eyebrow"><i class="bi bi-person-badge"></i> Account Profile</span>
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-4 mt-4">
              <div class="profile-avatar">
                @if ($avatar)
                  <img src="{{ $avatar }}" alt="{{ $user->name }}">
                @else
                  {{ $initials }}
                @endif
              </div>
              <div>
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-sub">Your LocalServices identity hub with account details, trust signals, and a richer overview that matches the premium feel of the rest of the platform.</p>
                <div class="profile-badge-row">
                  <span class="profile-chip"><i class="bi bi-shield-check"></i>{{ ucfirst($user->status ?: 'active') }}</span>
                  <span class="profile-chip"><i class="bi bi-envelope-check"></i>{{ $user->email_verified_at ? 'Verified email' : 'Verification pending' }}</span>
                  <span class="profile-chip"><i class="bi bi-stars"></i>Premium profile view</span>
                </div>
                <div class="action-row">
                  <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-3 magnetic">Back to Dashboard</a>
                  <a href="{{ route('user.bookings') }}" class="btn btn-soft px-4 py-3 magnetic">Open My Bookings</a>
                  <a href="{{ route('home') }}" class="btn btn-soft px-4 py-3 magnetic">Open Homepage</a>
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
                <span>Finished Services</span>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-4">
          <aside class="profile-side fade-rise" data-aos="fade-left">
            <p class="section-title mb-4">Account Snapshot</p>
            <div class="meta-list">
              <div class="stat-item">
                <i class="bi bi-patch-check"></i>
                <div>
                  <strong>Status</strong>
                  <span>{{ $user->status ?: 'Active user' }}</span>
                </div>
              </div>
              <div class="stat-item">
                <i class="bi bi-envelope-check"></i>
                <div>
                  <strong>Email Verification</strong>
                  <span>{{ $user->email_verified_at ? 'Verified' : 'Not verified yet' }}</span>
                </div>
              </div>
              <div class="stat-item">
                <i class="bi bi-calendar2-check"></i>
                <div>
                  <strong>Member Since</strong>
                  <span>{{ optional($user->created_at)->format('d M Y') ?: 'Recently joined' }}</span>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-7">
          <section class="info-card fade-rise" data-aos="fade-up">
            <p class="section-title">Personal Details</p>
            <div class="meta-list">
              <div class="meta-item">
                <i class="bi bi-person"></i>
                <div>
                  <strong>Full Name</strong>
                  <span>{{ $user->name }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-envelope"></i>
                <div>
                  <strong>Email Address</strong>
                  <span>{{ $user->email }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-geo-alt"></i>
                <div>
                  <strong>Address</strong>
                  <span>{{ $user->address ?: 'No address saved yet.' }}</span>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-5">
          <section class="info-card fade-rise" data-aos="fade-up" data-aos-delay="100">
            <p class="section-title">Profile Media</p>
            <div class="meta-list">
              <div class="meta-item">
                <i class="bi bi-image"></i>
                <div>
                  <strong>Profile Photo</strong>
                  <span>{{ $user->image ? 'Uploaded and linked to your account.' : 'No custom image uploaded yet.' }}</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-shield-lock"></i>
                <div>
                  <strong>Security</strong>
                  <span>Your session is protected and this page is available only to authenticated users.</span>
                </div>
              </div>
              <div class="meta-item">
                <i class="bi bi-pencil-square"></i>
                <div>
                  <strong>Next Step</strong>
                  <span>Add profile editing later without changing this design structure.</span>
                </div>
              </div>
            </div>
            <p class="mini-note mt-4 mb-0">This page is intentionally display-only for now. It uses your real stored user values rather than placeholder content.</p>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-5">
          <section class="membership-card fade-rise" data-aos="fade-up">
            <div class="membership-tier">LocalServices Circle</div>
            <div class="membership-title">Priority Customer Profile</div>
            <p class="membership-copy">Your profile is styled as an active customer identity with faster booking follow-up, simpler record access, and a polished control center across the platform.</p>
            <div class="membership-points">
              <div class="membership-point">
                <i class="bi bi-patch-check-fill"></i>
                <span>{{ $user->email_verified_at ? 'Verified email improves provider trust at first contact.' : 'Complete email verification to strengthen trust signals for providers.' }}</span>
              </div>
              <div class="membership-point">
                <i class="bi bi-receipt-cutoff"></i>
                <span>{{ $finishedBookings > 0 ? 'You can already collect premium service bills from completed bookings.' : 'Finished bookings will unlock premium invoice downloads here.' }}</span>
              </div>
              <div class="membership-point">
                <i class="bi bi-lightning-charge-fill"></i>
                <span>{{ $totalBookings > 0 ? 'You have an active service history that makes future bookings faster.' : 'Start with your first booking to build your service history.' }}</span>
              </div>
            </div>
          </section>
        </div>

        <div class="col-lg-7">
          <section class="info-card fade-rise" data-aos="fade-up" data-aos-delay="80">
            <p class="section-title">Quick Access</p>
            <div class="quick-grid">
              <a href="{{ route('services.directory') }}" class="quick-card magnetic">
                <i class="bi bi-grid"></i>
                <strong>Explore Services</strong>
                <span>Browse new providers and premium services near your city.</span>
              </a>
              <a href="{{ route('user.bookings') }}" class="quick-card magnetic">
                <i class="bi bi-journal-check"></i>
                <strong>Booking Hub</strong>
                <span>Track statuses, contact providers, and download completed bills.</span>
              </a>
              <a href="{{ route('dashboard') }}" class="quick-card magnetic">
                <i class="bi bi-columns-gap"></i>
                <strong>Open Dashboard</strong>
                <span>Return to your main user dashboard with categories and experts.</span>
              </a>
              <a href="{{ route('home') }}" class="quick-card magnetic">
                <i class="bi bi-house-heart"></i>
                <strong>Brand Homepage</strong>
                <span>Jump back to the premium landing experience of the project.</span>
              </a>
            </div>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-12">
          <section class="info-card fade-rise" data-aos="fade-up" data-aos-delay="120">
            <p class="section-title">Recent Activity</p>
            <div class="timeline-list">
              <div class="timeline-entry">
                <strong>Account created on {{ optional($user->created_at)->format('d M Y') ?: 'recently' }}</strong>
                <span>Your LocalServices profile is now part of the premium customer experience flow.</span>
              </div>
              <div class="timeline-entry">
                <strong>{{ $user->email_verified_at ? 'Email verification completed' : 'Email verification is pending' }}</strong>
                <span>{{ $user->email_verified_at ? 'Your account has an additional trust signal for providers and account recovery.' : 'Once verified, providers see a stronger trust signal from your account.' }}</span>
              </div>
              <div class="timeline-entry">
                <strong>{{ $latestBooking ? 'Latest booking captured in your history' : 'No booking activity yet' }}</strong>
                <span>
                  @if ($latestBooking)
                    {{ ($latestBooking->providerService?->title ?? $latestBooking->service?->name ?? 'Service request') }} with {{ $latestBooking->provider?->name ?? 'a provider' }} is currently {{ $latestBooking->status }}.
                  @else
                    Book your first service to unlock a richer activity timeline and invoice history.
                  @endif
                </span>
              </div>
            </div>
          </section>
        </div>
      </div>

      <div class="row g-4 mt-1">
        <div class="col-lg-12">
          <div class="edit-toggle-wrap fade-rise">
            <button type="button" class="btn btn-primary magnetic" data-edit-toggle="user-edit-panel">Edit Profile</button>
          </div>
          <section class="info-card fade-rise edit-panel" id="user-edit-panel" data-aos="fade-up" data-aos-delay="140">
            <p class="section-title">Edit Your Profile</p>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row g-4">
              @csrf
              <div class="col-md-6">
                <label class="form-label text-white fw-semibold">Full Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label text-white fw-semibold">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-8">
                <label class="form-label text-white fw-semibold">Address</label>
                <textarea name="address" rows="4" class="form-control @error('address') is-invalid @enderror" placeholder="Your current address">{{ old('address', $user->address) }}</textarea>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-lg-4">
                <label class="form-label text-white fw-semibold">Profile Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p class="mini-note mt-3 mb-0">Upload a square photo in `jpg`, `png`, or `webp` format to refresh your profile look.</p>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary px-4 py-3 magnetic">Save Profile Changes</button>
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

