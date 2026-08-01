<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Manage Provider Services</title>
  <meta name="description" content="Manage provider services for LocalServices.">

  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">

  <style>
    :root {
      --accent-color: #f15a24;
    }

    body {
      background: #f8f4f1;
    }

    #preloader { display: none !important; }

    .service-shell {
      padding-top: 130px;
      padding-bottom: 60px;
    }

    .panel-card {
      background: #fff;
      border-radius: 22px;
      border: 1px solid rgba(0, 0, 0, 0.06);
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.06);
    }

    .summary-chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.12);
      color: var(--accent-color);
      font-weight: 700;
      font-size: 0.8rem;
    }

    .service-thumb {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 18px;
      background: #f3f3f3;
    }

    .mini-meta {
      color: #6c757d;
      font-size: 0.92rem;
    }
  </style>
</head>
<body>
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
            <li><a href="{{ route('provider.profile') }}">Profile</a></li>
            <li><a href="{{ route('provider.services.index') }}" class="active">Add Your Services</a></li>
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

  <main class="service-shell">
    <div class="container">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <div class="panel-card p-4 p-lg-5 mb-4">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
          <div>
            <span class="summary-chip"><i class="bi bi-stars"></i> Approved provider tools</span>
            <h2 class="fw-bold mt-3 mb-2">Add and manage your live services</h2>
            <p class="text-muted mb-0">Every active service you add here becomes visible on the user dashboard for nearby discovery.</p>
          </div>
          <div class="mini-meta text-end">
            <div><strong class="text-dark">{{ $provider->name }}</strong></div>
            <div>{{ $provider->city }}</div>
            <div>{{ $provider->service ?: 'General provider profile' }}</div>
          </div>
        </div>

        <form class="row g-3" method="POST" action="{{ route('provider.services.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="col-md-6">
            <label class="form-label">Service title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="AC repair, sofa cleaning, plumbing visit" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $provider->service) }}" placeholder="Electrical, Cleaning, Plumbing" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}" placeholder="499">
          </div>
          <div class="col-md-4">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $provider->city) }}" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Service area</label>
            <input type="text" name="service_area" class="form-control" value="{{ old('service_area') }}" placeholder="Satellite, Andheri West, South Delhi">
          </div>
          <div class="col-md-6">
            <label class="form-label">Availability</label>
            <input type="text" name="availability" class="form-control" value="{{ old('availability') }}" placeholder="Mon-Sat, 9 AM - 7 PM">
          </div>
          <div class="col-md-6">
            <label class="form-label">Service image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
          </div>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Tell users what you do, response time, specialties, and why they should choose you." required>{{ old('description') }}</textarea>
          </div>
          <div class="col-12">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
              <label class="form-check-label" for="is_active">Show this service to users immediately</label>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary px-4">Publish Service</button>
          </div>
        </form>
      </div>

      <div class="row g-4">
        @forelse ($services as $service)
          <div class="col-12">
            <div class="panel-card p-4">
              <div class="row g-4 align-items-start">
                <div class="col-lg-4">
                  <img
                    src="{{ $service->image ? asset($service->image) : ($provider->image ? asset($provider->image) : asset('img/WhatsApp Image 2026-03-28 at 7.10.26 PM.jpeg')) }}"
                    alt="{{ $service->title }}"
                    class="service-thumb">
                </div>
                <div class="col-lg-8">
                  <div class="d-flex flex-wrap justify-content-between gap-3 mb-3">
                    <div>
                      <h4 class="fw-bold mb-1">{{ $service->title }}</h4>
                      <div class="mini-meta">{{ $service->category }} - {{ $service->city }}{{ $service->service_area ? ' - ' . $service->service_area : '' }}</div>
                    </div>
                    <span class="summary-chip">
                      <i class="bi bi-{{ $service->is_active ? 'eye' : 'eye-slash' }}"></i>
                      {{ $service->is_active ? 'Live on user site' : 'Hidden from user site' }}
                    </span>
                  </div>

                  <form class="row g-3" method="POST" action="{{ route('provider.services.update', $service) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                      <label class="form-label">Service title</label>
                      <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Category</label>
                      <input type="text" name="category" class="form-control" value="{{ $service->category }}" required>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Price</label>
                      <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ $service->price }}">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">City</label>
                      <input type="text" name="city" class="form-control" value="{{ $service->city }}" required>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Service area</label>
                      <input type="text" name="service_area" class="form-control" value="{{ $service->service_area }}">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Availability</label>
                      <input type="text" name="availability" class="form-control" value="{{ $service->availability }}">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Replace image</label>
                      <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Description</label>
                      <textarea name="description" class="form-control" rows="4" required>{{ $service->description }}</textarea>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active_{{ $service->id }}" @checked($service->is_active)>
                        <label class="form-check-label" for="active_{{ $service->id }}">Keep this service visible on the user site</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Update Service</button>
                    </div>
                  </form>

                  <div class="mt-3">
                    <form method="POST" action="{{ route('provider.services.destroy', $service) }}" onsubmit="return confirm('Delete this service permanently?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="panel-card p-4 text-center">
              <h4 class="fw-bold mb-2">No services published yet</h4>
              <p class="text-muted mb-0">Add your first service above. Once it is active, users will be able to find it from the dashboard nearby section.</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </main>

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
