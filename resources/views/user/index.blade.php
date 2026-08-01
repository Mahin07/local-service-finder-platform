<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Premium Home & Professional Solutions</title>
  <meta name="description" content="Quickly connect with verified professionals in your city for home cleaning, plumbing, electrical, and maintenance needs.">
  <meta name="keywords" content="local services, home maintenance, cleaning, plumbing, electrical">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <style>
    /* ================================================================
    ADVANCED CUSTOM CSS - LOCAL SERVICES PREMIUM THEME
    ================================================================
    */
    :root {
      --accent-color: #f15a24; 
      --accent-hover: #d64511;
      --accent-soft: #ffcfb8;
      --ink: #1e1714;
      --warm-bg: #f8ede7;
      --card-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      --glass-bg: rgba(255, 255, 255, 0.12);
      --section-bg-light: #fdf7f4;
    }

    body {
      background:
        radial-gradient(circle at top left, rgba(241, 90, 36, 0.10), transparent 28%),
        radial-gradient(circle at top right, rgba(255, 196, 0, 0.08), transparent 24%),
        linear-gradient(180deg, #fffaf7 0%, #f8efe9 40%, #fff 100%);
      color: var(--ink);
      overflow-x: hidden;
    }

    .section-title {
      position: relative;
    }

    .section-title::after {
      content: "";
      width: 92px;
      height: 4px;
      border-radius: 999px;
      background: linear-gradient(90deg, var(--accent-color), #ffbb87);
      display: block;
      margin: 18px auto 0;
      box-shadow: 0 10px 24px rgba(241, 90, 36, 0.28);
    }

    /* Vibrant Global Accent Overrides */
    .btn-primary, .btn-book, .btn-submit, .btn-reserve, .scroll-top {
      background-color: var(--accent-color) !important;
      border-color: var(--accent-color) !important;
      color: #fff !important;
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
    }

    .btn-primary:hover, .btn-book:hover, .btn-submit:hover, .btn-reserve:hover {
      background-color: var(--accent-hover) !important;
      transform: translateY(-3px) scale(1.02);
      box-shadow: 0 10px 20px rgba(241, 90, 36, 0.3) !important;
    }

    .btn-outline {
      border: 1px solid rgba(255, 255, 255, 0.35);
      border-radius: 999px;
      padding: 0.95rem 1.6rem;
      backdrop-filter: blur(12px);
      transition: 0.35s ease;
    }

    .btn-outline:hover {
      background: rgba(255, 255, 255, 0.12);
      transform: translateY(-2px);
    }

    .magnetic-wrap {
      display: inline-block;
      transition: transform 0.18s ease;
      will-change: transform;
    }

    .bi, .feature-item i, .trust-box i, .contact-info-box i, .faq-icon, .faq-toggle, .card-icon i, .info-icon i {
      color: var(--accent-color) !important;
    }

    .topbar,
    .branding {
      backdrop-filter: blur(14px);
    }

    .navmenu a {
      position: relative;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .navmenu a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -6px;
      width: 0;
      height: 2px;
      border-radius: 999px;
      background: linear-gradient(90deg, var(--accent-color), #ffc08c);
      transition: width 0.3s ease;
    }

    .navmenu a:hover::after,
    .navmenu a.active::after {
      width: 100%;
    }

    /* Hero Section Enhancements */
    .hero {
      position: relative;
      overflow: hidden;
    }

    .hero .booking-card {
      background: var(--glass-bg) !important;
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3) !important;
      border-radius: 30px !important;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
      position: relative;
      overflow: hidden;
    }

    .hero .booking-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.16), transparent 48%, rgba(241, 90, 36, 0.1));
      pointer-events: none;
    }

    .hero-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(8px);
      opacity: 0.5;
      animation: floatOrb 11s ease-in-out infinite;
      pointer-events: none;
    }

    .hero-orb.one {
      width: 240px;
      height: 240px;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.55), transparent 68%);
      top: 14%;
      left: -5%;
    }

    .hero-orb.two {
      width: 340px;
      height: 340px;
      background: radial-gradient(circle, rgba(255, 205, 156, 0.35), transparent 70%);
      bottom: 8%;
      right: -8%;
      animation-delay: -3s;
    }

    .hero-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
      background-size: 80px 80px;
      mask-image: linear-gradient(180deg, rgba(0,0,0,0.8), transparent);
      opacity: 0.18;
      pointer-events: none;
    }

    .hero-title {
      font-size: 4rem !important;
      font-weight: 900 !important;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.2);
      line-height: 0.95;
      letter-spacing: -0.03em;
      max-width: 12ch;
    }

    .tagline {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      border-radius: 999px;
      background: rgba(255,255,255,0.12);
      border: 1px solid rgba(255,255,255,0.16);
      text-transform: uppercase;
      letter-spacing: 0.16em;
      font-size: 0.74rem;
      font-weight: 700;
    }

    .hero-description {
      max-width: 58ch;
      font-size: 1.06rem;
    }

    .hero-metrics {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      margin-top: 28px;
      max-width: 760px;
    }

    .hero-metric {
      padding: 16px 18px;
      border-radius: 22px;
      background: rgba(255,255,255,0.10);
      border: 1px solid rgba(255,255,255,0.16);
      backdrop-filter: blur(14px);
      box-shadow: 0 16px 30px rgba(0,0,0,0.16);
      transition: transform 0.35s ease, border-color 0.35s ease;
    }

    .hero-metric:hover {
      transform: translateY(-6px);
      border-color: rgba(255,255,255,0.4);
    }

    .hero-metric strong {
      display: block;
      color: #fff;
      font-size: 1.5rem;
      line-height: 1;
      margin-bottom: 6px;
    }

    .hero-metric span {
      color: rgba(255,255,255,0.72);
      font-size: 0.86rem;
    }

    /* Custom Swiper Controls */
    .swiper-pagination-bullet-active {
      background: var(--accent-color) !important;
      width: 25px !important;
      border-radius: 10px !important;
    }

    /* Card Hover Interactions */
    .menu-card, .trust-box, .chef-card, .recommendation-card {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: 0.4s ease;
      height: 100%;
      transform-style: preserve-3d;
      will-change: transform;
    }

    .menu-card:hover, .trust-box:hover {
      transform: translateY(-15px);
      border: 1px solid var(--accent-color);
    }

    /* Multi-column Stats Layout */
    .stats-item {
      padding: 50px 30px;
      border-radius: 24px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(5px);
    }

    .purecounter {
      font-size: 3.8rem;
      font-weight: 800;
      color: var(--accent-color);
      display: block;
      margin-bottom: 10px;
    }

    /* Gallery Masonry & Hover */
    .gallery-card {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
      cursor: pointer;
    }

    .gallery-card img {
      transition: 0.6s ease;
    }

    .gallery-card:hover img {
      transform: scale(1.1) rotate(2deg);
      filter: brightness(0.7);
    }

    .gallery-overlay {
      position: absolute;
      inset: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      opacity: 0;
      transition: 0.4s;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    .gallery-card:hover .gallery-overlay {
      opacity: 1;
    }

    .about-gallery img {
      width: 100%;
      height: 260px;
      object-fit: cover;
    }

    .menu-card-image img {
      width: 100%;
      height: 240px;
      object-fit: cover;
    }

    .chef-card .image-wrapper img,
    .hero-image img {
      width: 100%;
      height: 320px;
      object-fit: cover;
    }

    .chef-card {
      position: relative;
      isolation: isolate;
      overflow: hidden;
      border: 1px solid rgba(241, 90, 36, 0.08);
      background:
        linear-gradient(180deg, rgba(255,255,255,0.98), rgba(255,245,240,0.96));
    }

    .chef-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at var(--spot-x, 50%) var(--spot-y, 50%), rgba(255, 204, 170, 0.30), transparent 34%);
      opacity: 0;
      transition: opacity 0.35s ease;
      pointer-events: none;
      z-index: 1;
    }

    .chef-card:hover::before {
      opacity: 1;
    }

    .chef-card .image-wrapper {
      position: relative;
      overflow: hidden;
    }

    .chef-card .image-wrapper::after {
      content: "";
      position: absolute;
      inset: auto 0 0 0;
      height: 55%;
      background: linear-gradient(180deg, transparent, rgba(16, 12, 10, 0.18));
      pointer-events: none;
      z-index: 1;
    }

    .chef-card .image-wrapper img {
      transition: transform 0.75s ease, filter 0.75s ease;
      transform-origin: center;
      will-change: transform;
    }

    .chef-card .content {
      position: relative;
      z-index: 2;
      transition: transform 0.45s ease;
    }

    .chef-card .content h4,
    .chef-card .content p {
      transition: transform 0.45s ease, opacity 0.45s ease;
    }

    .chef-card:hover .image-wrapper img {
      transform: scale(1.1) translateY(-6px);
      filter: saturate(1.06) contrast(1.04);
    }

    .chef-card:hover .content {
      transform: translateY(-8px);
    }

    .chef-card:hover .content h4 {
      transform: translateY(-2px);
    }

    .expert-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 7px 12px;
      margin-bottom: 12px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.10);
      color: var(--accent-color);
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      font-weight: 700;
    }

    .section img.rounded-5.shadow-2xl {
      width: 100%;
      height: 500px;
      object-fit: cover;
    }

    /* App CTA Buttons */
    .app-btn {
      display: flex;
      align-items: center;
      gap: 15px;
      background: #111;
      color: #fff;
      padding: 12px 28px;
      border-radius: 15px;
      text-decoration: none;
      transition: 0.3s;
      border: 1px solid #333;
    }

    .app-btn:hover {
      background: var(--accent-color);
      color: #fff;
      transform: scale(1.05);
    }

    #partners {
      position: relative;
      overflow: hidden;
    }

    #partners::before,
    #partners::after {
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      width: 120px;
      z-index: 2;
      pointer-events: none;
    }

    #partners::before {
      left: 0;
      background: linear-gradient(90deg, #f9f0ea, transparent);
    }

    #partners::after {
      right: 0;
      background: linear-gradient(270deg, #f9f0ea, transparent);
    }

    .partner-logo {
      padding: 18px 24px;
      border-radius: 20px;
      background: rgba(255,255,255,0.82);
      border: 1px solid rgba(0,0,0,0.04);
      transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .partner-logo:hover {
      transform: translateY(-6px) scale(1.03);
      box-shadow: 0 18px 35px rgba(0,0,0,0.08);
    }

    .floating-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      margin-top: 20px;
      padding: 14px 16px;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 18px 38px rgba(0,0,0,0.12);
      border: 1px solid rgba(241, 90, 36, 0.12);
      animation: floatCard 7s ease-in-out infinite;
    }

    .floating-badge strong {
      display: block;
      color: var(--ink);
      font-size: 0.95rem;
    }

    .floating-badge span {
      color: #6e625d;
      font-size: 0.82rem;
    }

    .pulse-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: var(--accent-color);
      box-shadow: 0 0 0 0 rgba(241, 90, 36, 0.45);
      animation: pulseDot 1.8s infinite;
    }

    .shine-card {
      position: relative;
      overflow: hidden;
    }

    .shine-card::after {
      content: "";
      position: absolute;
      inset: -120% auto auto -20%;
      width: 40%;
      height: 300%;
      transform: rotate(22deg);
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.28), transparent);
      transition: transform 0.8s ease;
    }

    .shine-card:hover::after {
      transform: translateX(280%) rotate(22deg);
    }

    .reveal-line {
      overflow: hidden;
    }

    .reveal-line > * {
      animation: riseIn 0.8s ease both;
    }

    .scroll-progress {
      position: fixed;
      top: 0;
      left: 0;
      width: 0;
      height: 4px;
      background: linear-gradient(90deg, #ffcf8d, var(--accent-color), #ffd6bf);
      box-shadow: 0 0 18px rgba(241, 90, 36, 0.35);
      z-index: 1000000;
      transition: width 0.12s linear;
    }

    .cursor-glow {
      position: fixed;
      width: 26px;
      height: 26px;
      border-radius: 50%;
      pointer-events: none;
      z-index: 999999;
      background: radial-gradient(circle, rgba(241, 90, 36, 0.35), rgba(241, 90, 36, 0));
      mix-blend-mode: screen;
      transform: translate(-50%, -50%);
      transition: width 0.2s ease, height 0.2s ease, opacity 0.2s ease;
      opacity: 0;
    }

    .cursor-glow.active {
      opacity: 1;
    }

    .cursor-glow.hover {
      width: 70px;
      height: 70px;
    }

    .section-fade {
      opacity: 0;
      transform: translateY(30px) scale(0.985);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .section-fade.in-view {
      opacity: 1;
      transform: translateY(0) scale(1);
    }

    .ambient-spark {
      position: fixed;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255, 205, 157, 0.9), rgba(255, 205, 157, 0));
      pointer-events: none;
      z-index: 2;
      opacity: 0.35;
      animation: driftSpark linear infinite;
    }

    .counter-pop {
      display: inline-block;
      min-width: 3ch;
    }

    /* FAQ System */
    .faq-item {
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      margin-bottom: 20px;
      cursor: pointer;
      position: relative;
      transition: 0.3s;
      border: 1px solid transparent;
      box-shadow: 0 5px 15px rgba(0,0,0,0.02);
    }

    .faq-active {
      border-color: var(--accent-color);
      box-shadow: 0 10px 30px rgba(241, 90, 36, 0.1);
    }

    .faq-content {
      display: none;
      padding-top: 20px;
      color: #555;
      font-size: 1.05rem;
      line-height: 1.8;
    }

    .faq-active .faq-content { display: block; }

    /* Scroll Down Indicator Animation */
    .scroll-arrow i {
      animation: bounce 2s infinite;
      color: var(--accent-color);
      font-size: 2rem;
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
      40% {transform: translateY(-10px);}
      60% {transform: translateY(-5px);}
    }
    .city-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  backdrop-filter: blur(6px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999999 !important;
}

.city-modal {
  background: #fff;
  width: 92%;
  max-width: 650px;
  padding: 32px;
  border-radius: 14px;
  text-align: center;
  animation: fadeUp 0.4s ease;
}

.city-modal h2 {
  margin-bottom: 6px;
}

.city-modal p {
  color: #777;
  margin-bottom: 20px;
}

.city-search {
  width: 100%;
  padding: 14px;
  border-radius: 8px;
  border: 1px solid #ddd;
  margin-bottom: 25px;
}

.city-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
  gap: 20px;
}

.city-item {
  cursor: pointer;
  transition: all 0.3s ease;
}

.city-item:hover {
  transform: translateY(-6px);
}

.city-icon {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  border: 2px solid currentColor;
  color: #ff6f61;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 8px;
}

.city-icon svg {
  width: 36px;
  height: 36px;
}

.auth-links {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: 18px;
}

.auth-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 10px 16px;
  border-radius: 999px;
  text-decoration: none;
  font-weight: 700;
  transition: 0.3s ease;
}

.auth-link.login {
  color: #fff;
  border: 1px solid rgba(255, 255, 255, 0.22);
  background: rgba(255, 255, 255, 0.08);
}

.auth-link.register {
  color: #fff;
  background: var(--accent-color);
  box-shadow: 0 14px 28px rgba(241, 90, 36, 0.22);
}

.auth-link:hover {
  color: #fff;
  transform: translateY(-1px);
}

@media (max-width: 1199px) {
  .auth-links {
    display: none;
  }
}

@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes floatOrb {
  0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
  50% { transform: translate3d(16px, -18px, 0) scale(1.05); }
}

@keyframes floatCard {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-8px); }
}

@keyframes pulseDot {
  0% { box-shadow: 0 0 0 0 rgba(241, 90, 36, 0.45); }
  70% { box-shadow: 0 0 0 14px rgba(241, 90, 36, 0); }
  100% { box-shadow: 0 0 0 0 rgba(241, 90, 36, 0); }
}

@keyframes driftSpark {
  from {
    transform: translate3d(0, 110vh, 0) scale(0.8);
  }
  to {
    transform: translate3d(0, -15vh, 0) scale(1.2);
  }
}

@keyframes riseIn {
  from {
    opacity: 0;
    transform: translateY(22px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 991px) {
  .hero-title {
    font-size: 3rem !important;
    max-width: 100%;
  }

  .hero-metrics {
    grid-template-columns: 1fr;
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
    padding-top: 62px;
  }

  .sitename {
    font-size: 1.25rem;
  }

  .hero-title {
    font-size: 2.15rem !important;
    line-height: 1.1;
  }

  .hero {
    padding-top: 74px !important;
    padding-bottom: 56px !important;
  }

  .hero .booking-card {
    padding: 1.25rem !important;
    border-radius: 18px !important;
  }

  .hero-actions {
    display: grid;
    gap: 10px;
  }

  .hero-actions .btn {
    width: 100%;
    margin: 0 !important;
  }

  .city-modal {
    padding: 22px;
    max-height: 88vh;
    overflow-y: auto;
  }

  .city-grid {
    gap: 14px;
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
  .ambient-spark,
  .hero-orb,
  .hero-grid {
    display: none !important;
  }
}

  </style>
</head>

<body class="index-page">
<div class="scroll-progress" id="scrollProgress"></div>
<div class="cursor-glow" id="cursorGlow"></div>
<!-- CITY SELECTION OVERLAY -->
<div id="cityOverlay" class="city-overlay">

  <div class="city-modal">
    <h2>We curate services for you</h2>
    <p>Please choose your city to continue</p>

    <input type="text" class="city-search" placeholder="Search city here">

    <h4>Popular Cities</h4>

    <div class="city-grid">

      <div class="city-item" onclick="selectCity('Ahmedabad')">
        <div class="city-icon">
          <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M8 52h48"/>
            <path d="M16 52V28l16-12 16 12v24"/>
            <path d="M28 52V36h8v16"/>
          </svg>
        </div>
        <span>Ahmedabad</span>
      </div>

      <div class="city-item" onclick="selectCity('Mumbai')">
        <div class="city-icon">
          <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10 52h44"/>
            <path d="M18 52V26h28v26"/>
            <path d="M24 26V14h16v12"/>
          </svg>
        </div>
        <span>Mumbai</span>
      </div>

      <div class="city-item" onclick="selectCity('Delhi')">
        <div class="city-icon">
          <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 52h24"/>
            <path d="M26 52V24h12v28"/>
            <path d="M24 24h16"/>
          </svg>
        </div>
        <span>Delhi</span>
      </div>

      <div class="city-item" onclick="selectCity('Bangalore')">
        <div class="city-icon">
          <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 52h40"/>
            <rect x="18" y="24" width="28" height="28"/>
            <path d="M26 24V14h12v10"/>
          </svg>
        </div>
        <span>Bangalore</span>
      </div>

    </div>
  </div>

</div>

  @include('user.partials.header')

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background section-fade">
      <div class="hero-background">
        <video autoplay="" muted="" loop="" playsinline="">
          <source src="{{ asset('img/vid-4.mp4') }}" type="video/mp4">
        </video>
        <div class="overlay"></div>
      </div>
      <div class="hero-orb one" data-parallax-speed="18"></div>
      <div class="hero-orb two" data-parallax-speed="10"></div>
      <div class="hero-grid"></div>

      <div class="container hero-content">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="hero-text" data-aos="fade-right" data-aos-delay="100">
              <span class="tagline"><i class="bi bi-stars"></i> Premium Care for Your Premium Home</span>
              <h1 class="hero-title reveal-line"><span>Trusted Pros at Your Fingertips</span></h1>
              <p class="hero-description">We connect you with the top 1% of local professionals. From rapid emergency repairs to meticulous home transformations, excellence is just a click away.</p>
              <div class="hero-actions">
                <span class="magnetic-wrap"><a href="#services" class="btn btn-primary btn-lg px-5 py-3">Book Service Now</a></span>
                <span class="magnetic-wrap"><a href="#services" class="btn btn-outline text-white ms-3">Explore Experts</a></span>
              </div>
              <div class="hero-metrics" data-aos="fade-up" data-aos-delay="220">
                <div class="hero-metric">
                  <strong>10k+</strong>
                  <span>homes upgraded with trusted professionals</span>
                </div>
                <div class="hero-metric">
                  <strong>4.9/5</strong>
                  <span>average rating across premium service partners</span>
                </div>
                <div class="hero-metric">
                  <strong>60 min</strong>
                  <span>rapid dispatch window for urgent requests</span>
                </div>
              </div>
              <div class="hero-features mt-5 d-flex flex-wrap gap-4">
                <div class="feature-item"><i class="bi bi-patch-check-fill fs-3"></i> <div><strong>Vetted</strong><br><small>Background Checked</small></div></div>
                <div class="feature-item"><i class="bi bi-shield-lock-fill fs-3"></i> <div><strong>Secure</strong><br><small>Insured Professionals</small></div></div>
                <div class="feature-item"><i class="bi bi-stars fs-3"></i> <div><strong>Guaranteed</strong><br><small>100% Satisfaction</small></div></div>
              </div>
              <div class="floating-badge" data-aos="fade-up" data-aos-delay="320">
                <span class="pulse-dot"></span>
                <div>
                  <strong>Live city matching</strong>
                  <span>Curated recommendations update after city selection</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="booking-card p-5 shine-card" data-aos="zoom-in" data-aos-delay="200">
              <h3 class="text-white text-center mb-4">Request Instant Quote</h3>
              <form action="{{ route('services.directory') }}" method="get" class="php-email-form">
                <div class="row gy-4">
                  <div class="col-12">
                    <select name="service" class="form-select bg-transparent text-white border-white-50 py-3" required>
                      <option value="" class="text-dark">Select the service you need</option>
                      <option value="cleaning" class="text-dark">Full Home Deep Cleaning</option>
                      <option value="plumbing" class="text-dark">Plumbing & Emergency Leaks</option>
                      <option value="electrical" class="text-dark">Electrical Audits & Repairs</option>
                      <option value="hvac" class="text-dark">HVAC & AC Maintenance</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <input type="text" name="location" class="form-control bg-transparent text-white border-white-50 py-3" placeholder="Enter Your Zip Code or City" required>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100 py-3 mt-2 fw-bold">FIND BEST PROS NEAR ME</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="400">
        <div class="scroll-arrow text-center">
          <small class="text-white-50 d-block mb-2">SCROLL TO DISCOVER</small>
          <i class="bi bi-chevron-double-down"></i>
        </div>
      </div>
    </section>

    <!-- Partners Row -->
    <section id="partners" class="section py-5 light-background section-fade">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center opacity-75">
          <div class="col-4 col-md-2" data-aos="fade-up" data-aos-delay="100"><div class="partner-logo"><img src="{{ asset('img/misc/signature-1.webp') }}" class="img-fluid grayscale" alt="Partner" style="max-height: 40px; filter: grayscale(100%);"></div></div>
          <div class="col-4 col-md-2" data-aos="fade-up" data-aos-delay="200"><div class="partner-logo"><img src="{{ asset('img/misc/signature-1.webp') }}" class="img-fluid grayscale" alt="Partner" style="max-height: 40px; filter: grayscale(100%);"></div></div>
          <div class="col-4 col-md-2" data-aos="fade-up" data-aos-delay="300"><div class="partner-logo"><img src="{{ asset('img/misc/signature-1.webp') }}" class="img-fluid grayscale" alt="Partner" style="max-height: 40px; filter: grayscale(100%);"></div></div>
          <div class="col-4 col-md-2" data-aos="fade-up" data-aos-delay="400"><div class="partner-logo"><img src="{{ asset('img/misc/signature-1.webp') }}" class="img-fluid grayscale" alt="Partner" style="max-height: 40px; filter: grayscale(100%);"></div></div>
          <div class="col-4 col-md-2" data-aos="fade-up" data-aos-delay="500"><div class="partner-logo"><img src="{{ asset('img/misc/signature-1.webp') }}" class="img-fluid grayscale" alt="Partner" style="max-height: 40px; filter: grayscale(100%);"></div></div>
        </div>
      </div>
    </section>

    <!-- Detailed About Section -->
    <section id="about" class="about section section-fade">
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title">&nbsp;About Us</span>
        <h2>Redefining Local Excellence</h2>
        <p>Your sanctuary deserves nothing but the most skilled hands and reliable minds.</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-5 align-items-center">
          <div class="col-lg-6" data-aos="fade-right">
            <div class="about-content">
              <h2 class="fw-bold mb-4">A Legacy of Trust and Precision</h2>
              <p class="lead text-muted mb-4">Founded on the principle that home maintenance should be stress-free, LocalServices has grown into a community-led powerhouse of vetted experts.</p>
              <p>We believe that every repair, every cleaning, and every installation is an opportunity to improve your quality of life. That is why we do not just find a pro, we find the right pro for your unique home.</p>
              
              <div class="row mt-5">
                <div class="col-md-6 mb-4">
                  <div class="feature-item p-4 bg-white rounded shadow-sm">
                    <i class="bi bi-award-fill fs-2 mb-3"></i>
                    <h4>Elite Standards</h4>
                    <p class="small">We only accept the top 1% of applicants into our professional network.</p>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="feature-item p-4 bg-white rounded shadow-sm border-accent border-top border-4">
                    <i class="bi bi-clock-history fs-2 mb-3"></i>
                    <h4>On-Time Promise</h4>
                    <p class="small">If our pro is more than 15 minutes late, your next service is 50% off.</p>
                  </div>
                </div>
              </div>

              <div class="signature mt-4 d-flex align-items-center">
                <div>
                  <p class="chef-name mb-0">Jane Smith</p>
                  <small class="text-muted">Head of Quality Operations</small>
                </div>
                <img src="{{ asset('img/misc/signature-1.webp') }}" alt="Signature" class="img-fluid ms-4" style="max-width: 150px;">
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left">
            <div class="about-gallery">
              <div class="row g-3">
                <div class="col-6">
                  <img src="{{ asset('img/WhatsApp Image 2026-03-28 at 7.10.25 PM.jpeg') }}" class="img-fluid rounded-4 shadow-lg" alt="Service Image">
                </div>
                <div class="col-6">
                  <img src="{{ asset('img/WhatsApp Image 2026-03-28 at 7.10.25 PM (1).jpeg') }}" class="img-fluid rounded-4 shadow-lg mt-5" alt="Service Image">
                </div>
                <div class="col-12 mt-3">
                  <div class="years-badge shadow-xl">
                    <span class="number">10k+</span>
                    <span class="text">Projects Delivered</span>
                  </div>
                  <img src="{{ asset('img/WhatsApp Image 2026-03-28 at 7.10.25 PM (2).jpeg') }}" class="img-fluid rounded-4 shadow-lg" alt="Service Image">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Slider (Scroll Right Feature) -->
    <section id="services" class="menu section light-background section-fade">
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Our Expertise</span>
        <h2>Popular Service Categories</h2>
        <p>Scroll or swipe to explore our most requested home solutions.</p>
      </div>

      @php
        $categoryCards = $categories ?? collect();
        $resolveCategoryImage = function ($categoryName) {
          $name = strtolower(trim((string) $categoryName));

          return match (true) {
            str_contains($name, 'paint') || str_contains($name, 'painter') => 'img/painter.jpeg',
            str_contains($name, 'plumb') || str_contains($name, 'pipe') => 'img/plumber.jpeg',
            str_contains($name, 'elect') || str_contains($name, 'wire') || str_contains($name, 'ac') => 'img/electrition.jpeg',
            str_contains($name, 'clean') || str_contains($name, 'housekeeping') || str_contains($name, 'maid') => 'img/clener.jpeg',
            str_contains($name, 'laund') || str_contains($name, 'wash') || str_contains($name, 'dry clean') => 'img/lundry.jpeg',
            default => 'img/WhatsApp Image 2026-03-28 at 7.10.26 PM.jpeg',
          };
        };
      @endphp

      <div class="container" data-aos="fade-up">
        <div class="init-swiper swiper-container-padding">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": { "delay": 4000 },
              "slidesPerView": "auto",
              "spaceBetween": 30,
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" },
              "breakpoints": {
                "320": { "slidesPerView": 1.2, "spaceBetween": 20 },
                "768": { "slidesPerView": 2.5, "spaceBetween": 30 },
                "1200": { "slidesPerView": 3.5, "spaceBetween": 40 }
              }
            }
          </script>
          <div class="swiper-wrapper">
            @forelse ($categoryCards as $index => $category)
              <div class="swiper-slide">
                <div class="menu-card shine-card interactive-card{{ $index === 1 ? ' featured' : '' }}">
                  <div class="menu-card-image">
                    <img src="{{ asset($resolveCategoryImage($category->name)) }}" class="img-fluid" alt="{{ $category->name }}">
                    <div class="dietary-badges"><span class="badge bg-success">Category</span></div>
                    <div class="price-overlay">Active</div>
                  </div>
                  <div class="p-4">
                    <h4 class="fw-bold">{{ $category->name }}</h4>
                    <p class="text-muted">{{ $category->description ?: 'Explore trusted providers available in this category.' }}</p>
                    <span class="magnetic-wrap"><a href="{{ route('services.directory', ['service' => $category->name]) }}" class="btn btn-sm btn-primary">Explore</a></span>
                  </div>
                </div>
              </div>
            @empty
              <div class="swiper-slide">
                <div class="menu-card">
                  <div class="p-4">
                    <h4 class="fw-bold">No categories available</h4>
                    <p class="text-muted mb-0">Add active categories from the admin panel and they will appear here automatically.</p>
                  </div>
                </div>
              </div>
            @endforelse
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Slider -->
    <section id="why-choose-us" class="chefs section section-fade">
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Why Us</span>
        <h2>The LocalServices Advantage</h2>
        <p>We've built a platform focused on your security and convenience.</p>
      </div>

      <div class="container" data-aos="fade-up">
        <div class="init-swiper swiper-container-padding">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 800,
              "autoplay": { "delay": 5000 },
              "slidesPerView": 4,
              "spaceBetween": 25,
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "breakpoints": {
                "320": { "slidesPerView": 1 },
                "768": { "slidesPerView": 2 },
                "1200": { "slidesPerView": 4 }
              }
            }
          </script>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="trust-box p-5 text-center interactive-card shine-card">
                <i class="bi bi-shield-check-fill fs-1 mb-4"></i>
                <h4 class="fw-bold">Background Verified</h4>
                <p class="text-muted small">Every professional is thoroughly screened for your family's safety.</p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="trust-box p-5 text-center border-accent border-top border-4 interactive-card shine-card">
                <i class="bi bi-lightning-charge-fill fs-1 mb-4"></i>
                <h4 class="fw-bold">Rapid Dispatch</h4>
                <p class="text-muted small">Booking emergency services? We have pros arriving within 60 minutes.</p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="trust-box p-5 text-center interactive-card shine-card">
                <i class="bi bi-wallet2 fs-1 mb-4"></i>
                <h4 class="fw-bold">Fixed Pricing</h4>
                <p class="text-muted small">No hourly rates that drag on. You pay one fair price for the whole task.</p>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="trust-box p-5 text-center interactive-card shine-card">
                <i class="bi bi-heart-fill fs-1 mb-4"></i>
                <h4 class="fw-bold">Joy Guarantee</h4>
                <p class="text-muted small">If you're not 100% happy, we'll fix it for free or issue a full refund.</p>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <!-- Experts Slider (Restored Team Layout) -->
    <section id="experts" class="chefs section light-background section-fade">
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Our Team</span>
        <h2>Meet Our Elite Experts</h2>
        <p>The highly skilled professionals who make excellence happen every day.</p>
      </div>

      <div class="container" data-aos="fade-up">
        <div class="init-swiper swiper-container-padding">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 1000,
              "autoplay": { "delay": 4500 },
              "slidesPerView": 4,
              "spaceBetween": 24,
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "breakpoints": {
                "320": { "slidesPerView": 1 },
                "768": { "slidesPerView": 2 },
                "1200": { "slidesPerView": 4 }
              }
            }
          </script>
          <div class="swiper-wrapper">
            <!-- Expert 1 -->
            <div class="swiper-slide">
              <article class="chef-card h-100 interactive-card shine-card">
                <div class="image-wrapper"><img src="{{ asset('img/person/person-m-12.webp') }}" class="img-fluid" alt="Jordan Lee"></div>
                <div class="content p-4">
                  <span class="expert-badge"><i class="bi bi-patch-check-fill"></i> Verified Expert</span>
                  <h4 class="fw-bold">Jordan Lee</h4>
                  <p class="text-accent small fw-bold text-uppercase">Master Electrician</p>
                  <p class="small text-muted">Specialized in smart home automation and complex panel upgrades with 15+ years experience.</p>
                </div>
              </article>
            </div>
            <!-- Expert 2 -->
            <div class="swiper-slide">
              <article class="chef-card h-100 interactive-card shine-card">
                <div class="image-wrapper"><img src="{{ asset('img/person/person-f-12.webp') }}" class="img-fluid" alt="Mila Santos"></div>
                <div class="content p-4">
                  <span class="expert-badge"><i class="bi bi-stars"></i> Top Rated</span>
                  <h4 class="fw-bold">Mila Santos</h4>
                  <p class="text-accent small fw-bold text-uppercase">Cleaning Supervisor</p>
                  <p class="small text-muted">Expert in commercial-grade sanitization and upholstery care. Leading our deep-clean teams.</p>
                </div>
              </article>
            </div>
            <!-- Expert 3 -->
            <div class="swiper-slide">
              <article class="chef-card h-100 interactive-card shine-card">
                <div class="image-wrapper"><img src="{{ asset('img/person/person-m-13.webp') }}" class="img-fluid" alt="Kai Thompson"></div>
                <div class="content p-4">
                  <span class="expert-badge"><i class="bi bi-lightning-charge-fill"></i> Fast Response</span>
                  <h4 class="fw-bold">Kai Thompson</h4>
                  <p class="text-accent small fw-bold text-uppercase">Plumbing Specialist</p>
                  <p class="small text-muted">Our lead responder for emergency leaks and full bathroom renovations. Certified Journeyman.</p>
                </div>
              </article>
            </div>
            <!-- Expert 4 -->
            <div class="swiper-slide">
              <article class="chef-card h-100 interactive-card shine-card">
                <div class="image-wrapper"><img src="{{ asset('img/person/person-f-13.webp') }}" class="img-fluid" alt="Renee Collins"></div>
                <div class="content p-4">
                  <span class="expert-badge"><i class="bi bi-award-fill"></i> Certified Pro</span>
                  <h4 class="fw-bold">Renee Collins</h4>
                  <p class="text-accent small fw-bold text-uppercase">HVAC Engineer</p>
                  <p class="small text-muted">Keeps the city cool. Certified expert in all major AC brands and heating systems.</p>
                </div>
              </article>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <!-- App CTA -->
    <section id="app" class="section dark-background section-fade">
      <div class="container" data-aos="fade-up">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2 class="display-4 fw-bold mb-4">Book in Seconds with our Mobile App</h2>
            <p class="lead text-white-50 mb-5">Track your pro in real-time, get exclusive local deals, and manage payments securely. The future of home care is here.</p>
            <div class="d-flex flex-wrap gap-3">
              <span class="magnetic-wrap"><a href="{{ route('services.directory') }}" class="app-btn"><i class="bi bi-grid fs-2"></i> <div><span>Instant Access</span> <strong>Open Web App</strong></div></a></span>
              <span class="magnetic-wrap"><a href="{{ route('provider.register') }}" class="app-btn"><i class="bi bi-briefcase fs-2"></i> <div><span>Grow With Us</span> <strong>Become Provider</strong></div></a></span>
            </div>
          </div>
          <div class="col-lg-6 mt-5 mt-lg-0 text-center">
            <img src="{{ asset('img/WhatsApp Image 2026-03-28 at 7.10.32 PM.jpeg') }}" class="img-fluid rounded-5 shadow-2xl border border-accent" style="max-height: 500px;" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq section section-fade">
      <div class="container section-title" data-aos="fade-up">
        <span class="description-title">Support</span>
        <h2>Got Questions?</h2>
        <p>Everything you need to know about our vetting, pricing, and safety standards.</p>
      </div>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="faq-container">
              <div class="faq-item shine-card" data-aos="fade-up">
                <i class="faq-icon bi bi-patch-question"></i>
                <h4 class="mb-0">Are your professionals background-checked?</h4>
                <div class="faq-content"><p>Yes, 100% of our pros undergo identity verification, criminal background checks, and professional skill audits before being listed.</p></div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item shine-card" data-aos="fade-up" data-aos-delay="100">
                <i class="faq-icon bi bi-patch-question"></i>
                <h4 class="mb-0">What if I'm not satisfied with the result?</h4>
                <div class="faq-content"><p>We offer a 100% satisfaction guarantee. If the work doesn't meet our elite standards, we'll fix it at no cost or offer a full refund.</p></div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item shine-card" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-patch-question"></i>
                <h4 class="mb-0">How is pricing calculated?</h4>
                <div class="faq-content"><p>We use fixed pricing for standard tasks so you know the cost upfront. For larger renovations, our pros provide transparent, no-obligation quotes.</p></div>
                <i class="faq-toggle bi bi-chevron-right"></i>
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

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>

  <script>
    /* ================================================================
    ADVANCED CUSTOM JS - CORE ENGINE
    ================================================================
    */
    (function() {
      "use strict";

      // 1. Scrolled Logic
      function toggleScrolled() {
        const body = document.querySelector('body');
        window.scrollY > 100 ? body.classList.add('scrolled') : body.classList.remove('scrolled');
      }
      document.addEventListener('scroll', toggleScrolled);
      window.addEventListener('load', toggleScrolled);

      const scrollProgress = document.getElementById('scrollProgress');
      function updateScrollProgress() {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const ratio = scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0;
        if (scrollProgress) scrollProgress.style.width = `${ratio}%`;
      }
      document.addEventListener('scroll', updateScrollProgress, { passive: true });
      window.addEventListener('load', updateScrollProgress);

      // 2. Mobile Menu Toggle
      const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
      if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', function() {
          document.querySelector('body').classList.toggle('mobile-nav-active');
          this.classList.toggle('bi-list');
          this.classList.toggle('bi-x');
        });
      }

      // 3. FAQ Accordion Logic
      document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
          const isActive = item.classList.contains('faq-active');
          document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('faq-active'));
          if (!isActive) item.classList.add('faq-active');
        });
      });

      // 4. PureCounter Logic (Internal Version)
      const startCounter = (el) => {
        const target = +el.getAttribute('data-purecounter-end');
        const duration = +el.getAttribute('data-purecounter-duration') * 1000;
        let count = 0;
        const step = target / (duration / 16);
        const timer = setInterval(() => {
          count += step;
          if (count >= target) { el.innerText = target.toLocaleString(); clearInterval(timer); }
          else { el.innerText = Math.ceil(count).toLocaleString(); }
        }, 16);
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) { startCounter(entry.target); observer.unobserve(entry.target); }
        });
      }, { threshold: 0.5 });
      document.querySelectorAll('.purecounter').forEach(s => observer.observe(s));

      // 5. Interactive Card Tilt
      document.querySelectorAll('.interactive-card').forEach((card) => {
        card.addEventListener('mousemove', (event) => {
          const rect = card.getBoundingClientRect();
          const x = event.clientX - rect.left;
          const y = event.clientY - rect.top;
          const rotateY = ((x / rect.width) - 0.5) * 12;
          const rotateX = ((y / rect.height) - 0.5) * -12;
          card.style.transform = `perspective(1200px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });

        card.addEventListener('mouseleave', () => {
          card.style.transform = '';
        });
      });

      // 6. Experts Spotlight Effect
      document.querySelectorAll('#experts .chef-card').forEach((card) => {
        const image = card.querySelector('.image-wrapper img');
        const textBlocks = card.querySelectorAll('.content h4, .content p, .expert-badge');

        card.addEventListener('mousemove', (event) => {
          const rect = card.getBoundingClientRect();
          const x = event.clientX - rect.left;
          const y = event.clientY - rect.top;
          const xRatio = (x / rect.width) - 0.5;
          const yRatio = (y / rect.height) - 0.5;

          card.style.setProperty('--spot-x', `${(x / rect.width) * 100}%`);
          card.style.setProperty('--spot-y', `${(y / rect.height) * 100}%`);

          if (image) {
            image.style.transform = `scale(1.1) translate(${xRatio * 10}px, ${yRatio * 10}px)`;
          }

          textBlocks.forEach((node, index) => {
            node.style.transform = `translate(${xRatio * (index + 1) * 3}px, ${yRatio * (index + 1) * 3}px)`;
          });
        });

        card.addEventListener('mouseleave', () => {
          card.style.removeProperty('--spot-x');
          card.style.removeProperty('--spot-y');
          if (image) image.style.transform = '';
          textBlocks.forEach((node) => {
            node.style.transform = '';
          });
        });
      });

      // 7. Hero Parallax Orbs
      const hero = document.querySelector('#hero');
      const parallaxItems = document.querySelectorAll('[data-parallax-speed]');

      if (hero && parallaxItems.length) {
        hero.addEventListener('mousemove', (event) => {
          const { left, top, width, height } = hero.getBoundingClientRect();
          const x = (event.clientX - left - width / 2) / width;
          const y = (event.clientY - top - height / 2) / height;

          parallaxItems.forEach((item) => {
            const speed = Number(item.getAttribute('data-parallax-speed')) || 10;
            item.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
          });
        });

        hero.addEventListener('mouseleave', () => {
          parallaxItems.forEach((item) => {
            item.style.transform = '';
          });
        });
      }

      // 8. Magnetic Buttons
      document.querySelectorAll('.magnetic-wrap').forEach((wrap) => {
        const strength = 18;
        wrap.addEventListener('mousemove', (event) => {
          const rect = wrap.getBoundingClientRect();
          const x = event.clientX - (rect.left + rect.width / 2);
          const y = event.clientY - (rect.top + rect.height / 2);
          wrap.style.transform = `translate(${x / strength}px, ${y / strength}px)`;
        });

        wrap.addEventListener('mouseleave', () => {
          wrap.style.transform = '';
        });
      });

      // 9. Section Reveal
      const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
          }
        });
      }, { threshold: 0.18 });

      document.querySelectorAll('.section-fade').forEach((section) => revealObserver.observe(section));

      // 10. Cursor Glow
      const cursorGlow = document.getElementById('cursorGlow');
      if (cursorGlow && window.matchMedia('(pointer:fine)').matches) {
        document.addEventListener('mousemove', (event) => {
          cursorGlow.classList.add('active');
          cursorGlow.style.left = `${event.clientX}px`;
          cursorGlow.style.top = `${event.clientY}px`;
        });

        document.querySelectorAll('a, button, .interactive-card, .city-item, .faq-item').forEach((item) => {
          item.addEventListener('mouseenter', () => cursorGlow.classList.add('hover'));
          item.addEventListener('mouseleave', () => cursorGlow.classList.remove('hover'));
        });
      }

      // 11. Ambient Sparks
      function spawnAmbientSpark(index) {
        const spark = document.createElement('span');
        spark.className = 'ambient-spark';
        spark.style.left = `${Math.random() * 100}vw`;
        spark.style.animationDuration = `${12 + Math.random() * 14}s`;
        spark.style.animationDelay = `${index * 0.8}s`;
        spark.style.opacity = `${0.12 + Math.random() * 0.25}`;
        spark.style.width = spark.style.height = `${4 + Math.random() * 10}px`;
        document.body.appendChild(spark);
      }

      for (let i = 0; i < 12; i += 1) {
        spawnAmbientSpark(i);
      }

      // 12. Animated Hero Metrics
      function animateMetric(metric) {
        const targetText = metric.textContent.trim();
        const value = parseFloat(targetText);
        if (Number.isNaN(value)) return;
        const suffix = targetText.replace(String(value), '');
        let current = 0;
        const duration = 1200;
        const stepTime = 24;
        const increment = value / (duration / stepTime);
        const timer = setInterval(() => {
          current += increment;
          if (current >= value) {
            metric.textContent = `${targetText}`;
            clearInterval(timer);
            return;
          }
          metric.textContent = `${current.toFixed(value % 1 ? 1 : 0)}${suffix}`;
        }, stepTime);
      }

      const metricObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const strong = entry.target.querySelector('strong');
            if (strong && !entry.target.dataset.animated) {
              entry.target.dataset.animated = 'true';
              animateMetric(strong);
            }
          }
        });
      }, { threshold: 0.5 });

      document.querySelectorAll('.hero-metric').forEach((metric) => metricObserver.observe(metric));

      // 13. Active Nav by Section
      const navLinks = Array.from(document.querySelectorAll('#navmenu a[href^="#"], #navmenu a[href="/"], #navmenu a[href="{{ route('home') }}"]'));
      const sectionMap = ['hero', 'services', 'experts', 'faq']
        .map((id) => document.getElementById(id))
        .filter(Boolean);

      const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          const id = entry.target.id;
          navLinks.forEach((link) => {
            const href = link.getAttribute('href');
            const isMatch = href === `#${id}` || (id === 'hero' && (href === '/' || href === "{{ route('home') }}"));
            link.classList.toggle('active', isMatch);
          });
        });
      }, { threshold: 0.45 });

      sectionMap.forEach((section) => sectionObserver.observe(section));

      // 14. Vendor Init
      window.addEventListener('load', () => {
        AOS.init({ duration: 600, easing: 'ease-in-out', once: true });
        
        // Dynamic Swiper Init for all containers
        document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
          let config = JSON.parse(swiperElement.querySelector(".swiper-config").innerHTML.trim());
          new Swiper(swiperElement, config);
        });

        // Isotope Init
        document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
          let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
          let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
          let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

          let initIsotope;
          imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
            initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
              itemSelector: '.isotope-item',
              layoutMode: layout,
              filter: filter,
              sortBy: sort
            });
          });

          isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
            filters.addEventListener('click', function() {
              isotopeItem.querySelector('.filter-active').classList.remove('filter-active');
              this.classList.add('filter-active');
              initIsotope.arrange({ filter: this.getAttribute('data-filter') });
            });
          });
        });

        GLightbox({ selector: '.glightbox' });
      });

      // 15. Preloader
      const preloader = document.querySelector('#preloader');
      if (preloader) window.addEventListener('load', () => preloader.remove());

    })();
  
document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.getElementById("cityOverlay");
  const selectedCity = localStorage.getItem("selectedCity");
  const citySearch = document.querySelector(".city-search");
  const cityItems = Array.from(document.querySelectorAll(".city-item"));

  if (!selectedCity) {
    overlay.style.display = "flex";
  } else {
    overlay.style.display = "none";
  }

  if (citySearch) {
    citySearch.addEventListener("input", function () {
      const query = this.value.trim().toLowerCase();
      cityItems.forEach((item) => {
        const matches = item.textContent.toLowerCase().includes(query);
        item.style.display = matches ? "" : "none";
      });
    });
  }
});

function selectCity(city) {
  localStorage.setItem("selectedCity", city);
  document.getElementById("cityOverlay").style.display = "none";
  console.log("Selected City:", city);
}
</script>

</body>

</html>	


