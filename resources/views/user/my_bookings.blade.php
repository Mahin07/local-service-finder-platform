<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - My Bookings</title>
  <meta name="description" content="View all your booked services, provider details, and booking status.">

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
      --accent-soft: #fff0e7;
      --ink-dark: #1f1714;
      --soft-border: rgba(31, 23, 20, 0.08);
      --muted-copy: #7a6f69;
    }

    body.user-bookings-page {
      background:
        radial-gradient(circle at top left, rgba(241, 90, 36, 0.12), transparent 26%),
        radial-gradient(circle at 88% 12%, rgba(255, 214, 153, 0.3), transparent 20%),
        linear-gradient(180deg, #fff9f5 0%, #fff 100%);
      color: var(--ink-dark);
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
    }

    .ambient-stage {
      position: fixed;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .ambient-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(8px);
      opacity: 0.42;
      animation: floatOrb 16s ease-in-out infinite;
    }

    .ambient-orb.one {
      width: 260px;
      height: 260px;
      top: 10%;
      left: -4%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.32), transparent 70%);
    }

    .ambient-orb.two {
      width: 320px;
      height: 320px;
      top: 38%;
      right: -6%;
      background: radial-gradient(circle, rgba(255, 206, 168, 0.55), transparent 70%);
      animation-delay: -5s;
    }

    .ambient-orb.three {
      width: 200px;
      height: 200px;
      bottom: 8%;
      left: 15%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.18), transparent 70%);
      animation-delay: -10s;
    }

    @keyframes floatOrb {
      0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
      50% { transform: translate3d(0, -18px, 0) scale(1.05); }
    }

    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0;
      height: 4px;
      z-index: 10000;
      background: linear-gradient(90deg, #ff8b4d, #f15a24, #ffd097);
      box-shadow: 0 0 18px rgba(241, 90, 36, 0.35);
      transition: width 0.14s linear;
    }

    .cursor-glow {
      position: fixed;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.16), rgba(241, 90, 36, 0.03) 45%, transparent 72%);
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

    .bookings-shell {
      padding: 116px 0 64px;
      position: relative;
      z-index: 2;
    }

    .bookings-shell::before {
      content: "";
      position: absolute;
      inset: 24px 0 auto 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(241, 90, 36, 0.16), transparent);
    }

    .hero-panel,
    .booking-card,
    .stat-card {
      border-radius: 24px;
      background: rgba(255,255,255,0.94);
      border: 1px solid var(--soft-border);
      box-shadow: 0 18px 42px rgba(31, 23, 20, 0.07);
    }

    .hero-panel {
      background:
        linear-gradient(135deg, rgba(241, 90, 36, 0.95), rgba(253, 151, 89, 0.88)),
        linear-gradient(180deg, #f15a24, #f15a24);
      color: #fff;
      overflow: hidden;
      position: relative;
    }

    .hero-panel::after {
      content: "";
      position: absolute;
      top: -80px;
      right: -40px;
      width: 240px;
      height: 240px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.28), transparent 70%);
    }

    .hero-panel::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
      background-size: 70px 70px;
      opacity: 0.16;
      pointer-events: none;
    }

    .hero-panel > * {
      position: relative;
      z-index: 1;
    }

    .hero-panel .spark-layer {
      position: absolute;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .spark {
      position: absolute;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.9), rgba(255,255,255,0));
      animation: driftSpark linear infinite;
      opacity: 0.75;
    }

    @keyframes driftSpark {
      from { transform: translate3d(0, 32px, 0) scale(0.6); opacity: 0; }
      14% { opacity: 0.75; }
      to { transform: translate3d(0, -240px, 0) scale(1.12); opacity: 0; }
    }

    .soft-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(255,255,255,0.16);
      border: 1px solid rgba(255,255,255,0.2);
      color: #fff;
      font-size: 0.76rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .hero-title {
      font-size: clamp(2rem, 4vw, 3.2rem);
      line-height: 0.98;
      letter-spacing: -0.03em;
    }

    .hero-copy {
      max-width: 58ch;
    }

    .hero-mini-stat {
      padding: 14px 16px;
      border-radius: 18px;
      background: rgba(255,255,255,0.16);
      border: 1px solid rgba(255,255,255,0.18);
      backdrop-filter: blur(12px);
      transition: transform 0.32s ease, border-color 0.32s ease;
    }

    .hero-mini-stat:hover {
      transform: translateY(-4px);
      border-color: rgba(255,255,255,0.28);
    }

    .hero-mini-stat .count {
      display: block;
      font-size: 1.65rem;
      line-height: 1;
      font-weight: 800;
      color: var(--ink-dark);
    }

    .hero-mini-stat .label {
      display: block;
      margin-top: 5px;
      font-size: 0.75rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(31, 23, 20, 0.62);
    }

    .status-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      font-size: 0.76rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .status-pill.pending {
      background: rgba(255, 193, 7, 0.12);
      color: #997404;
      border: 1px solid rgba(255, 193, 7, 0.22);
    }

    .status-pill.approved {
      background: rgba(25, 135, 84, 0.12);
      color: #0f6b43;
      border: 1px solid rgba(25, 135, 84, 0.22);
    }

    .status-pill.cancelled {
      background: rgba(220, 53, 69, 0.12);
      color: #9b2030;
      border: 1px solid rgba(220, 53, 69, 0.22);
    }

    .status-pill.finished {
      background: rgba(13, 110, 253, 0.12);
      color: #0b57c1;
      border: 1px solid rgba(13, 110, 253, 0.22);
    }

    .bookings-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 22px;
      align-items: start;
    }

    .filter-ribbon {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin: 0 0 22px;
    }

    .filter-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 14px;
      border-radius: 999px;
      background: rgba(255,255,255,0.88);
      border: 1px solid rgba(241, 90, 36, 0.1);
      color: #7a5644;
      font-size: 0.78rem;
      font-weight: 700;
      box-shadow: 0 12px 24px rgba(31, 23, 20, 0.04);
    }

    .booking-card {
      padding: 1rem !important;
      position: relative;
      overflow: hidden;
      transition: transform 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      transform-style: preserve-3d;
    }

    .booking-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 24px 52px rgba(31, 23, 20, 0.1);
      border-color: rgba(241, 90, 36, 0.18);
    }

    .booking-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.55), transparent 22%, transparent 72%, rgba(241, 90, 36, 0.05));
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
    }

    .booking-card:hover::before {
      opacity: 1;
    }

    .booking-card::after {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at var(--spot-x, 50%) var(--spot-y, 50%), rgba(241, 90, 36, 0.12), transparent 34%);
      opacity: 0;
      transition: opacity 0.25s ease;
      pointer-events: none;
    }

    .booking-card:hover::after {
      opacity: 1;
    }

    .booking-meta-top {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 12px;
    }

    .meta-chip {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 7px 10px;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 700;
      color: #7a5644;
      background: var(--accent-soft);
      border: 1px solid rgba(241, 90, 36, 0.12);
    }

    .detail-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-top: 14px;
    }

    .detail-box {
      padding: 10px 12px;
      border-radius: 14px;
      background: #fffaf7;
      border: 1px solid rgba(241, 90, 36, 0.08);
    }

    .detail-box span {
      display: block;
      font-size: 0.68rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #8a7f79;
      margin-bottom: 5px;
    }

    .detail-box strong {
      color: var(--ink-dark);
      font-size: 0.88rem;
    }

    .booking-image {
      width: 100%;
      height: 165px;
      object-fit: cover;
      border-radius: 18px;
      box-shadow: 0 14px 32px rgba(31, 23, 20, 0.12);
      transition: transform 0.45s ease;
    }

    .booking-card:hover .booking-image {
      transform: scale(1.05);
    }

    .booking-id-block {
      min-width: 88px;
      padding: 10px 12px;
      border-radius: 16px;
      background: #fffaf7;
      border: 1px solid rgba(241, 90, 36, 0.1);
    }

    .btn-stack {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: auto;
      padding-top: 16px;
    }

    .btn-stack .btn {
      border-radius: 999px;
      padding-inline: 14px;
      font-size: 0.82rem;
    }

    .booking-card-body {
      display: flex;
      flex-direction: column;
      flex: 1;
    }

    .booking-title {
      font-size: 1.1rem;
      line-height: 1.15;
    }

    .booking-description {
      color: var(--muted-copy);
      font-size: 0.9rem;
      line-height: 1.55;
      margin-bottom: 0;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .address-box {
      margin-top: 12px;
    }

    .address-box strong {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .fade-rise {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.72s ease, transform 0.72s ease;
    }

    .fade-rise.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .empty-state {
      text-align: center;
      padding: 48px 28px;
      border-radius: 26px;
      background: rgba(255,255,255,0.94);
      border: 1px solid var(--soft-border);
      box-shadow: 0 22px 50px rgba(31, 23, 20, 0.08);
    }

    .empty-state .btn {
      border-radius: 999px;
      padding-inline: 20px;
    }

    @media (max-width: 991.98px) {
      .bookings-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .booking-image {
        height: 180px;
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

      .main {
        padding-top: 74px;
      }

      .sitename {
        font-size: 1.25rem;
      }

      .bookings-grid {
        grid-template-columns: 1fr;
      }

      .hero-title {
        font-size: 1.7rem;
      }

      .hero-panel {
        padding: 1.2rem !important;
      }

      .detail-grid {
        grid-template-columns: 1fr;
      }

      .booking-card {
        padding: 1.15rem !important;
      }

      .booking-image {
        height: 190px;
      }

      .btn-stack .btn {
        width: 100%;
      }
    }

    @media (hover: none), (pointer: coarse) {
      .cursor-glow,
      .scroll-progress,
      .ambient-stage {
        display: none !important;
      }
    }

    /* Clean Premium Redesign */
    body.user-bookings-page {
      background: linear-gradient(180deg, #f7f8fb 0%, #ffffff 100%) !important;
    }

    .ambient-stage,
    .cursor-glow,
    .scroll-progress {
      display: none !important;
    }

    .bookings-shell {
      padding-top: 118px;
    }

    .hero-panel {
      background: #ffffff !important;
      color: #111827 !important;
      border: 1px solid #e8edf3 !important;
      box-shadow: 0 12px 34px rgba(17, 24, 39, 0.06) !important;
    }

    .hero-panel::before,
    .hero-panel::after,
    .spark-layer {
      display: none !important;
    }

    .hero-copy,
    .hero-panel .text-white-50 {
      color: #64748b !important;
    }

    .soft-pill {
      background: #fff2ea !important;
      border-color: #ffd8c4 !important;
      color: #b6471f !important;
    }

    .hero-mini-stat {
      background: #f8fafc !important;
      border-color: #e2e8f0 !important;
    }

    .hero-mini-stat .count {
      color: #0f172a !important;
    }

    .filter-pill {
      background: #fff !important;
      border-color: #e2e8f0 !important;
      color: #334155 !important;
      box-shadow: none !important;
    }

    .booking-card {
      background: #fff !important;
      border: 1px solid #e8edf3 !important;
      box-shadow: 0 12px 34px rgba(17, 24, 39, 0.06) !important;
      transform: none !important;
    }

    .booking-card::before,
    .booking-card::after {
      display: none !important;
    }

    .booking-card:hover {
      transform: none !important;
      border-color: #fed7c3 !important;
      box-shadow: 0 14px 36px rgba(17, 24, 39, 0.08) !important;
    }

    .booking-image {
      border-radius: 14px;
      box-shadow: none;
    }

    .booking-card:hover .booking-image {
      transform: none;
    }

    .booking-title,
    .detail-box strong,
    .booking-id-block .fw-bold {
      color: #0f172a;
    }

    .booking-description {
      color: #64748b;
    }

    .meta-chip {
      background: #f8fafc !important;
      border-color: #e2e8f0 !important;
      color: #475569 !important;
    }

    .detail-box,
    .booking-id-block {
      background: #f8fafc !important;
      border-color: #e2e8f0 !important;
    }

    .detail-box span,
    .booking-id-block .small {
      color: #64748b !important;
    }

    .btn-stack .btn {
      border-radius: 10px;
      font-weight: 600;
    }

    .status-pill.pending {
      background: #fff8e6;
      color: #8a5f00;
      border-color: #f9e2a2;
    }

    .status-pill.approved {
      background: #eafbf3;
      color: #166534;
      border-color: #bdeccf;
    }

    .status-pill.finished {
      background: #eaf2ff;
      color: #1d4ed8;
      border-color: #c6d9ff;
    }

    .status-pill.cancelled {
      background: #fff0f2;
      color: #be123c;
      border-color: #fecdd3;
    }
  </style>
</head>
<body class="user-bookings-page">
  <div class="ambient-stage" aria-hidden="true">
    <span class="ambient-orb one"></span>
    <span class="ambient-orb two"></span>
    <span class="ambient-orb three"></span>
  </div>
  <div class="scroll-progress" id="scroll-progress"></div>
  <div class="cursor-glow" id="cursor-glow"></div>
  @include('user.partials.header')

  <main class="main">
    <section class="bookings-shell">
      <div class="container">
        <div class="hero-panel p-4 p-lg-5 mb-4 fade-rise" data-aos="fade-up">
          <div class="spark-layer" id="hero-sparks"></div>
          <div class="row g-4 align-items-center">
            <div class="col-lg-8">
              <span class="soft-pill"><i class="bi bi-calendar-check"></i> Customer Booking Center</span>
              <h1 class="hero-title fw-bold mt-3 mb-2">Track every service you have booked</h1>
              <p class="hero-copy mb-0 text-white-50">See provider details, booking status, scheduled dates, your service address, and quick contact buttons from one cleaner, more focused page.</p>
            </div>
            <div class="col-lg-4">
              <div class="row g-3">
                <div class="col-6">
                  <div class="hero-mini-stat text-dark">
                    <div class="small text-muted">Total bookings</div>
                    <span class="count" data-counter="{{ $bookings->count() }}">0</span>
                    <span class="label">All requests</span>
                  </div>
                </div>
                <div class="col-6">
                  <div class="hero-mini-stat text-dark">
                    <div class="small text-muted">Approved</div>
                    <span class="count" data-counter="{{ $bookings->where('status', 'approved')->count() }}">0</span>
                    <span class="label">Ready to go</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @if ($bookings->isNotEmpty())
          <div class="filter-ribbon fade-rise">
            <span class="filter-pill"><i class="bi bi-stars"></i>{{ $bookings->count() }} total bookings</span>
            <span class="filter-pill"><i class="bi bi-check-circle"></i>{{ $bookings->where('status', 'approved')->count() }} approved</span>
            <span class="filter-pill"><i class="bi bi-patch-check"></i>{{ $bookings->where('status', 'finished')->count() }} finished</span>
          </div>
          <div class="bookings-grid">
            @foreach ($bookings as $booking)
              @php
                $providerPhone = $booking->provider?->phone;
                $providerWhatsApp = $providerPhone ? preg_replace('/\D+/', '', $providerPhone) : null;
                $imagePath = $booking->providerService?->image
                  ? asset($booking->providerService->image)
                  : ($booking->provider?->image ? asset($booking->provider->image) : asset('img/WhatsApp Image 2026-03-28 at 7.10.26 PM.jpeg'));
              @endphp
              <article class="booking-card fade-rise" data-aos="fade-up">
                <img src="{{ $imagePath }}" alt="{{ $booking->providerService?->title ?? $booking->service?->name ?? 'Booked service' }}" class="booking-image">
                <div class="booking-card-body">
                  <div class="d-flex justify-content-between align-items-start gap-2 mt-3">
                    <span class="status-pill {{ strtolower($booking->status) }}">
                      <i class="bi bi-stars"></i>{{ ucfirst($booking->status) }}
                    </span>
                    <div class="booking-id-block text-end">
                      <div class="small text-muted">ID</div>
                      <div class="fw-bold">#{{ $booking->id }}</div>
                    </div>
                  </div>

                  <h3 class="booking-title fw-bold mt-3 mb-2">{{ $booking->providerService?->title ?? $booking->service?->name ?? 'Booked service' }}</h3>
                  <p class="booking-description">{{ $booking->providerService?->description ?? 'Your booking request has been recorded successfully.' }}</p>

                  <div class="booking-meta-top">
                    <span class="meta-chip"><i class="bi bi-person-check"></i>{{ $booking->provider?->name ?? 'Provider' }}</span>
                    <span class="meta-chip"><i class="bi bi-calendar3"></i>{{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Date pending' }}</span>
                  </div>

                  <div class="detail-grid">
                    <div class="detail-box">
                      <span>Category</span>
                      <strong>{{ $booking->providerService?->category ?? $booking->service?->name ?? 'Not available' }}</strong>
                    </div>
                    <div class="detail-box">
                      <span>City</span>
                      <strong>{{ $booking->providerService?->city ?? $booking->provider?->city ?? 'Not available' }}</strong>
                    </div>
                    <div class="detail-box">
                      <span>Your Phone</span>
                      <strong>{{ $booking->customer_phone ?: 'Not provided' }}</strong>
                    </div>
                    <div class="detail-box">
                      <span>Booked On</span>
                      <strong>{{ optional($booking->created_at)->format('d M Y') ?: 'Recently' }}</strong>
                    </div>
                  </div>

                  <div class="detail-box address-box">
                    <span>Service Address</span>
                    <strong>{{ $booking->customer_address ?: ($user->address ?: 'Not provided') }}</strong>
                  </div>

                  <div class="btn-stack">
                    @if ($providerWhatsApp)
                      <a
                        href="https://wa.me/{{ $providerWhatsApp }}?text={{ urlencode('Hello '.$booking->provider?->name.', I am checking on my booking for '.($booking->providerService?->title ?? 'my service request').'.') }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-outline-success"
                      >
                        <i class="bi bi-whatsapp me-1"></i>WhatsApp
                      </a>
                    @endif
                    @if ($providerPhone)
                      <a href="tel:{{ $providerPhone }}" class="btn btn-outline-dark">
                        <i class="bi bi-telephone me-1"></i>Call
                      </a>
                    @endif
                    @if ($booking->status === 'finished')
                      <a href="{{ route('user.bookings.invoice', $booking) }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-arrow-down me-1"></i>Download PDF Bill
                      </a>
                    @endif
                    <a href="{{ route('services.directory') }}" class="btn btn-primary">
                      <i class="bi bi-grid me-1"></i>Browse
                    </a>
                  </div>
                </div>
              </article>
            @endforeach
          </div>
        @else
          <div class="empty-state" data-aos="fade-up">
            <h2 class="fw-bold mb-2">No bookings yet</h2>
            <p class="text-muted mb-4">Once you book a service, it will appear here with provider details, status, and contact options.</p>
            <a href="{{ route('services.directory') }}" class="btn btn-primary btn-lg">Explore Services</a>
          </div>
        @endif
      </div>
    </section>
  </main>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script>
    if (window.AOS) {
      AOS.init({ duration: 650, once: true });
    }

    (function () {
      const progress = document.getElementById('scroll-progress');
      const cursorGlow = document.getElementById('cursor-glow');
      const revealItems = document.querySelectorAll('.fade-rise');
      const counters = document.querySelectorAll('[data-counter]');
      const bookingCards = document.querySelectorAll('.booking-card');

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

      // Keep booking cards stable and clean; avoid 3D tilt in this layout.

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

      document.addEventListener('mousemove', (event) => {
        if (!cursorGlow || window.innerWidth < 992) return;
        cursorGlow.classList.add('is-visible');
        cursorGlow.style.left = `${event.clientX}px`;
        cursorGlow.style.top = `${event.clientY}px`;
      });

      document.addEventListener('mouseleave', () => {
        cursorGlow?.classList.remove('is-visible');
      });

      const sparkLayer = document.getElementById('hero-sparks');
      if (sparkLayer) {
        for (let i = 0; i < 12; i += 1) {
          const spark = document.createElement('span');
          spark.className = 'spark';
          spark.style.left = `${Math.random() * 100}%`;
          spark.style.bottom = `${-20 - Math.random() * 40}px`;
          spark.style.animationDuration = `${7 + Math.random() * 7}s`;
          spark.style.animationDelay = `${Math.random() * 4}s`;
          sparkLayer.appendChild(spark);
        }
      }

      updateProgress();
      window.addEventListener('scroll', updateProgress, { passive: true });
    })();
  </script>
</body>
</html>

