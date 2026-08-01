<header id="header" class="header header-unified fixed-top">
  <div class="topbar d-flex align-items-center dark-background">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:support@localservices.com">support@localservices.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://x.com" target="_blank" rel="noopener" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="https://facebook.com" target="_blank" rel="noopener" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://instagram.com" target="_blank" rel="noopener" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank" rel="noopener" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>
  </div>

  <div class="branding d-flex align-items-center">
    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="{{ route('home') }}" class="logo d-flex align-items-center">
        <h1 class="sitename">LocalServices</h1>
      </a>

      @guest
        <div class="auth-links d-none d-xl-flex align-items-center">
          <a href="{{ route('login') }}" class="auth-link login">Login</a>
          <a href="{{ route('register') }}" class="auth-link register">Register</a>
        </div>
      @endguest

      <nav id="navmenu" class="navmenu">
        <ul>
          @auth
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('services.directory') }}" class="{{ request()->routeIs('services.directory', 'services.booking.*') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{ route('user.bookings') }}" class="{{ request()->routeIs('user.bookings', 'user.bookings.invoice') ? 'active' : '' }}">My Bookings</a></li>
            <li><a href="{{ route('profile') }}" class="{{ request()->routeIs('profile', 'profile.update') ? 'active' : '' }}">Profile</a></li>
            <li><a href="{{ route('provider.register') }}" class="btn btn-primary px-3 py-2" style="color:#fff;">Become a Provider</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-link nav-link px-0" style="color: var(--nav-color); text-decoration: none;">Logout</button>
              </form>
            </li>
          @else
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('services.directory') }}" class="{{ request()->routeIs('services.directory', 'services.booking.*') ? 'active' : '' }}">Services</a></li>
            <li><a href="{{ route('provider.register') }}" class="btn btn-primary px-3 py-2" style="color:#fff;">Become a Provider</a></li>
            <li class="d-xl-none"><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a></li>
            <li class="d-xl-none"><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a></li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </div>
</header>
