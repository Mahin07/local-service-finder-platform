<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Services Directory</title>
  <meta name="description" content="Browse verified local professionals for cleaning, plumbing, electrical, HVAC, and more.">
  <meta name="keywords" content="local services, plumbing, cleaning, electrical, hvac, carpentry, landscaping">

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
      --ink-dark: #1f1714;
      --warm-card: #fffaf7;
      --soft-border: rgba(31, 23, 20, 0.08);
    }

    body.services-page {
      background:
        radial-gradient(circle at top left, rgba(241, 90, 36, 0.12), transparent 26%),
        radial-gradient(circle at 85% 15%, rgba(255, 214, 153, 0.35), transparent 20%),
        linear-gradient(180deg, #fffaf7 0%, #fff4ee 38%, #fff 100%);
      color: var(--ink-dark);
      overflow-x: hidden;
    }

    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0;
      height: 4px;
      background: linear-gradient(90deg, #ff7a3d, #f15a24, #ffca8b);
      box-shadow: 0 0 18px rgba(241, 90, 36, 0.45);
      z-index: 10000;
      transition: width 0.12s linear;
    }

    .cursor-glow {
      position: fixed;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.16), rgba(241, 90, 36, 0.03) 45%, transparent 70%);
      pointer-events: none;
      z-index: 1;
      transform: translate(-50%, -50%);
      filter: blur(10px);
      opacity: 0;
      transition: opacity 0.25s ease;
    }

    .cursor-glow.is-visible {
      opacity: 1;
    }

    .page-atmosphere {
      position: fixed;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: 0;
    }

    .page-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(6px);
      opacity: 0.45;
      animation: floatOrb 16s ease-in-out infinite;
    }

    .page-orb.one {
      width: 260px;
      height: 260px;
      top: 8%;
      left: -4%;
      background: radial-gradient(circle, rgba(255, 196, 146, 0.8), rgba(255, 196, 146, 0));
    }

    .page-orb.two {
      width: 320px;
      height: 320px;
      top: 42%;
      right: -7%;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.26), rgba(241, 90, 36, 0));
      animation-delay: -5s;
    }

    .page-orb.three {
      width: 220px;
      height: 220px;
      bottom: 6%;
      left: 12%;
      background: radial-gradient(circle, rgba(255, 224, 190, 0.8), rgba(255, 224, 190, 0));
      animation-delay: -10s;
    }

    @keyframes floatOrb {
      0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
      50% { transform: translate3d(0, -22px, 0) scale(1.05); }
    }

    .main {
      position: relative;
      z-index: 2;
    }

    .services-hero {
      background: linear-gradient(180deg, rgba(0,0,0,0.6), rgba(0,0,0,0.3)),
        url('{{ asset('img/service5.jfif') }}') center/cover no-repeat;
      border-radius: 28px;
      overflow: hidden;
      min-height: 320px;
      display: flex;
      align-items: center;
      position: relative;
      box-shadow: 0 26px 70px rgba(31, 23, 20, 0.18);
    }

    .services-hero .hero-copy {
      color: #fff;
      position: relative;
      z-index: 2;
      max-width: 680px;
    }

    .services-hero::before {
      content: "";
      position: absolute;
      inset: auto -15% -35% auto;
      width: 320px;
      height: 320px;
      background: radial-gradient(circle, rgba(255,255,255,0.26), transparent 65%);
      border-radius: 50%;
      animation: heroPulse 7s ease-in-out infinite;
    }

    .services-hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background:
        linear-gradient(120deg, rgba(255,255,255,0.06), transparent 22%, transparent 76%, rgba(255,255,255,0.08)),
        linear-gradient(180deg, transparent, rgba(0,0,0,0.22));
      pointer-events: none;
    }

    @keyframes heroPulse {
      0%, 100% { transform: scale(1); opacity: 0.55; }
      50% { transform: scale(1.1); opacity: 0.85; }
    }

    .hero-stats {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      margin-top: 26px;
      max-width: 720px;
    }

    .hero-stat {
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.16);
      backdrop-filter: blur(14px);
      padding: 16px 18px;
      border-radius: 18px;
      box-shadow: 0 10px 24px rgba(0,0,0,0.16);
    }

    .hero-stat-value {
      display: block;
      font-size: 1.45rem;
      font-weight: 800;
      color: #fff;
    }

    .hero-stat-label {
      display: block;
      font-size: 0.8rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(255,255,255,0.68);
      margin-top: 6px;
    }

    .floating-signal {
      position: absolute;
      top: 28px;
      right: 28px;
      z-index: 2;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.16);
      color: #fff;
      padding: 14px 16px;
      border-radius: 18px;
      backdrop-filter: blur(14px);
      box-shadow: 0 10px 24px rgba(0,0,0,0.16);
      min-width: 180px;
    }

    .signal-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #72f0a6;
      box-shadow: 0 0 0 8px rgba(114, 240, 166, 0.15);
      animation: pulse 2.6s ease-in-out infinite;
    }

    .filter-card {
      background: rgba(255,255,255,0.9);
      border-radius: 20px;
      box-shadow: 0 16px 40px rgba(31, 23, 20, 0.1);
      border: 1px solid var(--soft-border);
      backdrop-filter: blur(10px);
    }

    .filter-chip {
      border: 1px solid rgba(0,0,0,0.12);
      padding: 6px 14px;
      border-radius: 999px;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .filter-chip:hover {
      transform: translateY(-2px);
      border-color: rgba(241, 90, 36, 0.35);
      box-shadow: 0 10px 18px rgba(241, 90, 36, 0.12);
    }

    .filter-chip.active {
      background: var(--accent-color);
      color: #fff;
      border-color: var(--accent-color);
      box-shadow: 0 10px 20px rgba(241, 90, 36, 0.25);
    }

    .directory-shell {
      position: relative;
    }

    .directory-shell::before {
      content: "";
      position: absolute;
      inset: 18px 0 auto 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(241, 90, 36, 0.18), transparent);
    }

    .section-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 7px 12px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.08);
      color: var(--accent-color);
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
    }

    .search-glass {
      background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(255,247,241,0.92));
      border-radius: 28px;
      padding: 28px;
      border: 1px solid rgba(241, 90, 36, 0.1);
      box-shadow: 0 24px 50px rgba(31, 23, 20, 0.08);
    }

    .service-grid {
      position: relative;
      z-index: 1;
    }

    .service-card {
      border-radius: 20px;
      overflow: hidden;
      border: 1px solid rgba(0,0,0,0.06);
      box-shadow: 0 14px 34px rgba(31, 23, 20, 0.08);
      transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
      height: 100%;
      background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(255,250,247,0.98));
      position: relative;
      transform-style: preserve-3d;
    }

    .service-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 24px 56px rgba(31, 23, 20, 0.14);
      border-color: rgba(241, 90, 36, 0.2);
    }

    .service-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.45), transparent 26%, transparent 68%, rgba(241, 90, 36, 0.08));
      opacity: 0;
      transition: opacity 0.35s ease;
      pointer-events: none;
      z-index: 1;
    }

    .service-card:hover::before {
      opacity: 1;
    }

    .service-card img {
      height: 190px;
      object-fit: cover;
      width: 100%;
      transition: transform 0.45s ease;
    }

    .service-card:hover img {
      transform: scale(1.06);
    }

    .service-card-body {
      position: relative;
      z-index: 2;
    }

    .service-image-wrap {
      position: relative;
      overflow: hidden;
    }

    .service-image-wrap::after {
      content: "";
      position: absolute;
      inset: auto 0 0 0;
      height: 72px;
      background: linear-gradient(180deg, transparent, rgba(0,0,0,0.25));
      pointer-events: none;
    }

    .service-badge-row {
      position: absolute;
      inset: 14px 14px auto 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 2;
    }

    .glass-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 12px;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 700;
      background: rgba(255,255,255,0.14);
      border: 1px solid rgba(255,255,255,0.18);
      color: #fff;
      backdrop-filter: blur(10px);
    }

    .tag-pill {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 5px 10px;
      border-radius: 999px;
      font-size: 0.7rem;
      background: rgba(241, 90, 36, 0.1);
      color: var(--accent-color);
      border: 1px solid rgba(241, 90, 36, 0.2);
    }

    .service-meta {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 18px;
    }

    .service-meta-box {
      padding: 12px 14px;
      border-radius: 14px;
      background: var(--warm-card);
      border: 1px solid rgba(241, 90, 36, 0.08);
    }

    .service-meta-box strong {
      display: block;
      font-size: 0.95rem;
      color: var(--ink-dark);
    }

    .service-meta-box span {
      display: block;
      font-size: 0.75rem;
      color: #7d726d;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      margin-top: 4px;
    }

    .map-card {
      background: rgba(255,255,255,0.92);
      border-radius: 22px;
      border: 1px solid var(--soft-border);
      box-shadow: 0 16px 36px rgba(31, 23, 20, 0.08);
      backdrop-filter: blur(10px);
    }

    .map-placeholder {
      height: 220px;
      border-radius: 18px;
      background: linear-gradient(120deg, rgba(241, 90, 36, 0.2), rgba(241, 90, 36, 0.05));
      position: relative;
      overflow: hidden;
    }

    .map-placeholder::before {
      content: "";
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.22) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.22) 1px, transparent 1px);
      background-size: 34px 34px;
      opacity: 0.55;
    }

    .map-pin {
      position: absolute;
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: var(--accent-color);
      box-shadow: 0 0 0 8px rgba(241, 90, 36, 0.2);
      animation: pulse 2.6s ease-in-out infinite;
    }

    .map-pin.one { top: 38%; left: 32%; }
    .map-pin.two { top: 58%; left: 55%; animation-delay: 0.6s; }
    .map-pin.three { top: 30%; left: 70%; animation-delay: 1.2s; }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.6; }
      50% { transform: scale(1.2); opacity: 1; }
    }

    .empty-state {
      padding: 40px;
      border-radius: 20px;
      border: 1px dashed rgba(0,0,0,0.1);
      background: rgba(255,255,255,0.9);
      text-align: center;
      box-shadow: 0 18px 36px rgba(31, 23, 20, 0.06);
    }

    .magnetic {
      transition: transform 0.18s ease;
      will-change: transform;
    }

    .reveal-block {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal-block.is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .spark-layer {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      border-radius: inherit;
    }

    .spark {
      position: absolute;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,255,255,0.95), rgba(255,255,255,0));
      animation: driftSpark linear infinite;
      opacity: 0.7;
    }

    @keyframes driftSpark {
      from { transform: translate3d(0, 30px, 0) scale(0.6); opacity: 0; }
      15% { opacity: 0.8; }
      to { transform: translate3d(0, -260px, 0) scale(1.2); opacity: 0; }
    }

    @media (max-width: 991.98px) {
      .hero-stats {
        grid-template-columns: 1fr;
      }

      .floating-signal {
        position: static;
        margin-top: 22px;
      }

      .search-glass {
        padding: 20px;
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

      .service-meta {
        grid-template-columns: 1fr;
      }

      .services-hero {
        min-height: auto;
      }

      .services-hero {
        padding: 20px !important;
      }

      .directory-shell {
        padding: 14px;
      }

      .filter-card {
        position: static !important;
      }

      .service-card .btn {
        width: 100%;
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

      .navmenu ul li .btn {
        width: 100%;
        text-align: center;
      }
    }

    @media (hover: none), (pointer: coarse) {
      .cursor-glow,
      .scroll-progress,
      .page-atmosphere,
      .spark-layer {
        display: none !important;
      }
    }

    #preloader { display: none !important; }
  </style>
</head>
<body class="services-page">
  <div class="scroll-progress" id="scroll-progress"></div>
  <div class="cursor-glow" id="cursor-glow"></div>
  <div class="page-atmosphere" aria-hidden="true">
    <span class="page-orb one"></span>
    <span class="page-orb two"></span>
    <span class="page-orb three"></span>
  </div>

  @php
    $directoryProviders = $directoryProviders ?? collect();
    $directoryCategories = $directoryCategories ?? collect();
    $selectedLocation = $selectedLocation ?? '';
    $selectedService = $selectedService ?? '';
  @endphp

  @include('user.partials.header')

  <main class="main">

    <section class="section pt-5">
      <div class="container reveal-block" data-aos="fade-up">
        <div class="services-hero p-5">
          <div class="spark-layer" id="hero-sparks"></div>
          <div class="hero-copy">
            <span class="tagline d-inline-flex align-items-center gap-2 text-white-50 mb-3"><i class="bi bi-stars"></i> Curated local professionals</span>
            <h2 class="display-5 fw-bold mb-3 text-white">Find the right pro for every job.</h2>
            <p class="lead text-white-50 mb-4">Filter by category, availability, and ratings. Book instantly with transparent pricing and a more cinematic local search experience.</p>
            <div class="d-flex flex-wrap gap-3">
              <a href="#directory" class="btn btn-primary btn-lg px-4 magnetic">Browse services</a>
              <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg px-4 magnetic">View dashboard</a>
            </div>
            <div class="hero-stats">
              <div class="hero-stat reveal-block">
                <span class="hero-stat-value" data-counter="{{ $directoryProviders->count() }}">0</span>
                <span class="hero-stat-label">Live Listings</span>
              </div>
              <div class="hero-stat reveal-block">
                <span class="hero-stat-value" data-counter="{{ $directoryCategories->count() }}">0</span>
                <span class="hero-stat-label">Service Categories</span>
              </div>
              <div class="hero-stat reveal-block">
                <span class="hero-stat-value" data-counter="{{ $activeProsCount }}">0</span>
                <span class="hero-stat-label">Active Experts</span>
              </div>
            </div>
          </div>
          <div class="floating-signal reveal-block">
            <div class="d-flex align-items-center gap-2 small text-uppercase text-white-50 fw-semibold mb-2">
              <span class="signal-dot"></span>
              Service pulse
            </div>
            <div class="fw-bold fs-5 text-white">Verified providers online</div>
            <div class="small text-white-50 mt-2">Fresh local matches update as you filter.</div>
          </div>
        </div>
      </div>
    </section>

    <section id="directory" class="section light-background">
      <div class="container directory-shell reveal-block" data-aos="fade-up">
        <div class="search-glass mb-4 reveal-block">
          <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
              <span class="section-kicker"><i class="bi bi-compass"></i> Smart Discovery</span>
              <h2 class="fw-bold mt-3 mb-2">A directory built to feel alive</h2>
              <p class="text-muted mb-0">Browse providers through animated filters, richer previews, and a more visual service-matching experience.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
              <span class="tag-pill"><i class="bi bi-patch-check-fill"></i> Verified profiles</span>
              <span class="tag-pill"><i class="bi bi-lightning-charge-fill"></i> Fast response</span>
              <span class="tag-pill"><i class="bi bi-geo-alt-fill"></i> Local coverage</span>
            </div>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-lg-4 reveal-block">
            <div class="filter-card p-4 sticky-top magnetic" style="top: 110px;">
              <h4 class="fw-bold mb-3">Search your area</h4>
              <div class="mb-3">
                <label class="form-label small text-uppercase text-muted">Location</label>
                <input type="text" class="form-control" id="location-input" value="{{ $selectedLocation }}" placeholder="City or ZIP">
              </div>
              <div class="mb-3">
                <label class="form-label small text-uppercase text-muted">Service</label>
                <input type="text" class="form-control" id="service-input" value="{{ $selectedService }}" placeholder="What do you need?">
              </div>
              <div class="mb-4">
                <label class="form-label small text-uppercase text-muted">Timeframe</label>
                <select class="form-select" id="time-input">
                  <option>Today</option>
                  <option>Tomorrow</option>
                  <option>This week</option>
                </select>
              </div>
              <button class="btn btn-primary w-100 mb-3 magnetic" type="button" id="see-matches-btn">See matches</button>
              <div class="d-flex flex-wrap gap-2" id="chip-row">
                <span class="filter-chip active">Available</span>
                <span class="filter-chip">Top rated</span>
                <span class="filter-chip">Budget friendly</span>
                <span class="filter-chip">Emergency</span>
              </div>
            </div>

            <div class="map-card p-4 mt-4 reveal-block">
              <h6 class="text-uppercase text-muted small">Neighborhood snapshot</h6>
              <div class="map-placeholder mt-3">
                <div class="map-pin one"></div>
                <div class="map-pin two"></div>
                <div class="map-pin three"></div>
              </div>
              <div class="d-flex justify-content-between pt-3 small text-muted">
                <span>Avg response</span>
                <strong class="text-dark">18 mins</strong>
              </div>
              <div class="d-flex justify-content-between pt-2 small text-muted">
                <span>Active pros</span>
                <strong class="text-dark">{{ $activeProsCount }}</strong>
              </div>
            </div>

            <div class="map-card p-4 mt-4 reveal-block">
              <h6 class="text-uppercase text-muted small">Match Pulse</h6>
              <h4 class="fw-bold mb-2" id="pulse-title">Best availability</h4>
              <p class="text-muted mb-3" id="pulse-copy">We are scanning your current filters to find the strongest category match.</p>
              <div class="d-flex justify-content-between pt-2 small text-muted">
                <span>Visible results</span>
                <strong class="text-dark" id="pulse-count">{{ $activeProsCount }}</strong>
              </div>
            </div>
          </div>

          <div class="col-lg-8 reveal-block">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <span class="text-uppercase small text-muted">Categories</span>
                <h3 class="fw-bold mb-0">Best matches nearby</h3>
                <div class="small text-muted mt-1" id="results-meta">Showing live provider listings for your filters.</div>
              </div>
              <div class="d-flex flex-wrap gap-2" id="category-row"></div>
            </div>

            <div class="row g-4 service-grid" id="results"></div>
            <div id="empty" class="empty-state mt-4" style="display:none;">
              <h4 class="fw-bold">No pros found</h4>
              <p class="text-muted">Try a new category or clear your search.</p>
              <button class="btn btn-outline-primary magnetic" onclick="resetFilters()">Reset filters</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container reveal-block" data-aos="fade-up">
        <div class="row align-items-center g-4">
          <div class="col-lg-7">
            <h2 class="fw-bold">Need help choosing?</h2>
            <p class="text-muted">Our concierge matches you with the best local pro in under 5 minutes.</p>
          </div>
          <div class="col-lg-5 text-lg-end">
            <a class="btn btn-primary btn-lg magnetic" href="{{ route('home') }}#services">Talk to concierge</a>
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
            <a href="{{ route('services.directory') }}" class="app-btn btn-sm"><i class="bi bi-grid"></i> Web App</a>
            <a href="{{ route('provider.register') }}" class="app-btn btn-sm"><i class="bi bi-briefcase"></i> Become Pro</a>
          </div>
        </div>
        <div class="col-lg-4 text-lg-end">
          <div class="social-links d-flex justify-content-center justify-content-lg-end gap-3">
            <a href="https://facebook.com" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
            <a href="https://x.com" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-twitter-x"></i></a>
            <a href="https://instagram.com" target="_blank" rel="noopener" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="container py-4 text-center">
      <p class="mb-0 small text-white-50">&copy; 2026 LocalServices Inc. Quality Certified. <a href="{{ route('home') }}#faq" class="text-accent">Privacy Policy</a> | <a href="{{ route('home') }}#faq" class="text-accent">Terms</a></p>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script id="services-data" type="application/json">@json(['providers' => $directoryProviders, 'categories' => $directoryCategories])</script>

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

      const data = JSON.parse(document.getElementById("services-data").textContent);
      const providers = data.providers || [];
      const categories = ["All", ...((data.categories || []).filter(Boolean))];

      const initialService = String(@json($selectedService ?? '')).trim();
      const initialServiceLower = initialService.toLowerCase();
      const matchedCategory = categories.find((cat) => cat.toLowerCase() === initialServiceLower);
      let activeCategory = matchedCategory || "All";
      let searchTerm = matchedCategory ? "" : initialServiceLower;

      const categoryRow = document.getElementById("category-row");
      const results = document.getElementById("results");
      const empty = document.getElementById("empty");
      const serviceInput = document.getElementById("service-input");
      const locationInput = document.getElementById("location-input");
      const seeMatchesBtn = document.getElementById("see-matches-btn");
      const resultsMeta = document.getElementById("results-meta");
      const pulseTitle = document.getElementById("pulse-title");
      const pulseCopy = document.getElementById("pulse-copy");
      const pulseCount = document.getElementById("pulse-count");
      const scrollProgress = document.getElementById("scroll-progress");
      const cursorGlow = document.getElementById("cursor-glow");
      const revealBlocks = document.querySelectorAll(".reveal-block");
      const magneticItems = document.querySelectorAll(".magnetic");

      function renderCategories() {
        categoryRow.innerHTML = categories
          .map(
            (cat) => `
              <button class="filter-chip ${cat === activeCategory ? "active" : ""}" data-category="${cat}">${cat}</button>
            `
          )
          .join("");
      }

      function updatePulse(filtered) {
        if (!pulseTitle || !pulseCopy || !pulseCount) return;

        pulseCount.textContent = filtered.length;

        if (filtered.length === 0) {
          pulseTitle.textContent = "No strong matches";
          pulseCopy.textContent = "Try another category, location, or search term to discover available providers.";
          return;
        }

        const grouped = filtered.reduce((carry, provider) => {
          carry[provider.category] = (carry[provider.category] || 0) + 1;
          return carry;
        }, {});

        const [bestCategory, bestCount] = Object.entries(grouped).sort((a, b) => b[1] - a[1])[0];
        pulseTitle.textContent = `${bestCategory} is trending`;
        pulseCopy.textContent = `${bestCount} provider${bestCount > 1 ? "s are" : " is"} matching your current filters right now.`;
      }

      function renderProviders() {
        const locationTerm = (locationInput?.value || "").toLowerCase();
        const filtered = providers.filter((p) => {
          const matchesCategory = activeCategory === "All" || p.category === activeCategory;
          const matchesSearch = p.name.toLowerCase().includes(searchTerm) || p.category.toLowerCase().includes(searchTerm) || (p.description || "").toLowerCase().includes(searchTerm);
          const matchesLocation = !locationTerm || (p.distance || "").toLowerCase().includes(locationTerm) || (p.tags || []).join(" ").toLowerCase().includes(locationTerm);
          return matchesCategory && matchesSearch && matchesLocation;
        });

        updatePulse(filtered);

        if (resultsMeta) {
          const categoryLabel = activeCategory === "All" ? "all categories" : activeCategory;
          resultsMeta.textContent = `${filtered.length} match${filtered.length === 1 ? "" : "es"} for ${categoryLabel}${locationTerm ? ` in ${locationInput.value}` : ""}.`;
        }

        if (filtered.length === 0) {
          results.style.display = "none";
          empty.style.display = "block";
          return;
        }

        results.style.display = "";
        empty.style.display = "none";

        results.innerHTML = filtered
          .map(
            (p) => `
            <div class="col-md-6">
              <article class="service-card interactive-card">
                <div class="service-image-wrap">
                  <img src="${p.image}" alt="${p.category} service">
                  <div class="service-badge-row">
                    <span class="glass-pill"><i class="bi bi-patch-check-fill"></i> Verified</span>
                    <span class="glass-pill"><i class="bi bi-geo-alt-fill"></i> ${p.distance}</span>
                  </div>
                </div>
                <div class="p-4 service-card-body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0">${p.name}</h5>
                    <span class="tag-pill"><i class="bi bi-star-fill"></i>${p.rating}</span>
                  </div>
                  <div class="text-muted small d-flex justify-content-between mb-2">
                    <span>${p.category}</span>
                    <span>${p.reviews} reviews</span>
                  </div>
                  <div class="text-muted small d-flex justify-content-between mb-3">
                    <span>${p.category}</span>
                    <span>Responds in ${p.response}</span>
                  </div>
                  <div class="service-meta">
                    <div class="service-meta-box">
                      <strong>${p.price}</strong>
                      <span>Starting price</span>
                    </div>
                    <div class="service-meta-box">
                      <strong>${p.reviews}</strong>
                      <span>Client reviews</span>
                    </div>
                  </div>
                  <div class="d-flex flex-wrap gap-2 mb-3">
                    ${p.tags.map((tag) => `<span class="tag-pill">${tag}</span>`).join("")}
                  </div>
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="small text-muted">Premium local match</span>
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                      ${p.phone ? `<a class="btn btn-outline-success btn-sm magnetic" href="https://wa.me/${String(p.phone).replace(/\D+/g, '')}?text=${encodeURIComponent('Hello, I want to know more about ' + p.name + '.')}">WhatsApp</a>` : ``}
                      ${p.phone ? `<a class="btn btn-outline-dark btn-sm magnetic" href="tel:${p.phone}">Call</a>` : ``}
                      <a class="btn btn-primary btn-sm magnetic" href="${p.booking_url}">Book now</a>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          `
          )
          .join("");

        bindInteractiveCards();
      }

      function setCategory(cat) {
        activeCategory = cat;
        renderCategories();
        renderProviders();
      }

      function resetFilters() {
        activeCategory = "All";
        searchTerm = "";
        serviceInput.value = "";
        if (locationInput) locationInput.value = "{{ $selectedLocation }}";
        renderCategories();
        renderProviders();
      }

      categoryRow.addEventListener("click", (event) => {
        const chip = event.target.closest("[data-category]");
        if (!chip) return;
        setCategory(chip.getAttribute("data-category"));
      });

      serviceInput.addEventListener("input", (e) => {
        searchTerm = e.target.value.toLowerCase();
        renderProviders();
      });

      if (locationInput) {
        locationInput.addEventListener("input", () => {
          renderProviders();
        });
      }

      if (seeMatchesBtn) {
        seeMatchesBtn.addEventListener("click", () => {
          const url = new URL(window.location.href);
          const currentService = (serviceInput?.value || "").trim();
          const currentLocation = (locationInput?.value || "").trim();

          if (currentService) {
            url.searchParams.set("service", currentService);
          } else {
            url.searchParams.delete("service");
          }

          if (currentLocation) {
            url.searchParams.set("location", currentLocation);
          } else {
            url.searchParams.delete("location");
          }

          window.history.replaceState({}, "", url.toString());
          renderProviders();
          document.getElementById("directory")?.scrollIntoView({ behavior: "smooth", block: "start" });
        });
      }

      const chipRow = document.getElementById("chip-row");
      if (chipRow) {
        chipRow.querySelectorAll(".filter-chip").forEach((chip) => {
          chip.addEventListener("click", () => {
            chipRow.querySelectorAll(".filter-chip").forEach((c) => c.classList.remove("active"));
            chip.classList.add("active");
          });
        });
      }

      window.addEventListener('load', () => {
        if (window.AOS) {
          AOS.init({ duration: 600, easing: 'ease-in-out', once: true });
        }
      });

      function updateScrollProgress() {
        if (!scrollProgress) return;
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const progress = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;
        scrollProgress.style.width = `${Math.min(progress, 100)}%`;
      }

      function bindInteractiveCards() {
        document.querySelectorAll(".interactive-card").forEach((card) => {
          card.addEventListener("mousemove", (event) => {
            if (window.innerWidth < 992) return;
            const rect = card.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;
            const rotateY = ((x / rect.width) - 0.5) * 10;
            const rotateX = ((y / rect.height) - 0.5) * -10;
            card.style.transform = `translateY(-8px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
          });

          card.addEventListener("mouseleave", () => {
            card.style.transform = "";
          });
        });
      }

      const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            revealObserver.unobserve(entry.target);
          }
        });
      }, { threshold: 0.16 });

      revealBlocks.forEach((block) => revealObserver.observe(block));

      magneticItems.forEach((item) => {
        item.addEventListener("mousemove", (event) => {
          if (window.innerWidth < 992) return;
          const rect = item.getBoundingClientRect();
          const x = event.clientX - rect.left - rect.width / 2;
          const y = event.clientY - rect.top - rect.height / 2;
          item.style.transform = `translate(${x * 0.08}px, ${y * 0.08}px)`;
        });

        item.addEventListener("mouseleave", () => {
          item.style.transform = "";
        });
      });

      document.addEventListener("mousemove", (event) => {
        if (!cursorGlow || window.innerWidth < 992) return;
        cursorGlow.classList.add("is-visible");
        cursorGlow.style.left = `${event.clientX}px`;
        cursorGlow.style.top = `${event.clientY}px`;
      });

      document.addEventListener("mouseleave", () => {
        cursorGlow?.classList.remove("is-visible");
      });

      function animateCounters() {
        document.querySelectorAll("[data-counter]").forEach((counter) => {
          const target = Number(counter.getAttribute("data-counter")) || 0;
          const start = performance.now();
          const duration = 1200;

          function frame(now) {
            const progress = Math.min((now - start) / duration, 1);
            counter.textContent = Math.round(target * (1 - Math.pow(1 - progress, 3)));
            if (progress < 1) window.requestAnimationFrame(frame);
          }

          window.requestAnimationFrame(frame);
        });
      }

      function buildHeroSparks() {
        const layer = document.getElementById("hero-sparks");
        if (!layer) return;

        for (let i = 0; i < 14; i += 1) {
          const spark = document.createElement("span");
          spark.className = "spark";
          spark.style.left = `${Math.random() * 100}%`;
          spark.style.bottom = `${-20 - Math.random() * 40}px`;
          spark.style.animationDuration = `${7 + Math.random() * 7}s`;
          spark.style.animationDelay = `${Math.random() * 4}s`;
          layer.appendChild(spark);
        }
      }

      renderCategories();
      renderProviders();
      bindInteractiveCards();
      updateScrollProgress();
      animateCounters();
      buildHeroSparks();
      window.resetFilters = resetFilters;
      window.addEventListener("scroll", updateScrollProgress, { passive: true });
    })();
  </script>

  <script>
    const preloader = document.querySelector('#preloader');
    if (preloader) {
      window.addEventListener('load', () => preloader.remove());
    }
  </script>
</body>
</html>

