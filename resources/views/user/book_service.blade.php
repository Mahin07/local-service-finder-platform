<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Book Service - LocalServices</title>
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <style>
    body.book-service-page {
      min-height: 100vh;
      background:
        radial-gradient(circle at top left, rgba(241, 90, 36, 0.12), transparent 24%),
        linear-gradient(180deg, #fff8f3 0%, #fff 100%);
    }

    .booking-shell {
      padding: 120px 0 70px;
    }

    .booking-card,
    .service-summary {
      border-radius: 26px;
      border: 1px solid rgba(31, 23, 20, 0.08);
      background: rgba(255, 255, 255, 0.94);
      box-shadow: 0 22px 50px rgba(31, 23, 20, 0.08);
    }

    .service-summary img {
      width: 100%;
      height: 260px;
      object-fit: cover;
      border-radius: 22px;
    }

    .soft-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 7px 12px;
      border-radius: 999px;
      background: rgba(241, 90, 36, 0.1);
      color: #f15a24;
      border: 1px solid rgba(241, 90, 36, 0.15);
      font-size: 0.78rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      gap: 18px;
      padding: 12px 0;
      border-bottom: 1px solid rgba(31, 23, 20, 0.06);
    }

    .summary-row:last-child {
      border-bottom: 0;
      padding-bottom: 0;
    }

    .summary-label {
      color: #7d726d;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      font-size: 0.74rem;
    }

    .summary-value {
      color: #1f1714;
      font-weight: 700;
      text-align: right;
    }

    @media (max-width: 991.98px) {
      .booking-shell {
        padding: 96px 0 28px;
      }

      .service-summary {
        position: static !important;
      }

      .service-summary img {
        height: 220px;
      }
    }

    @media (max-width: 767.98px) {
      .booking-card,
      .service-summary {
        border-radius: 18px;
        padding: 18px !important;
      }

      .service-summary img {
        height: 190px;
        border-radius: 14px;
      }

      .summary-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
      }

      .summary-value {
        text-align: left;
      }

      .btn.btn-lg {
        width: 100%;
      }
    }
  </style>
</head>
<body class="book-service-page">
  <div class="booking-shell">
    <div class="container">
      <div class="row g-4 align-items-start">
        <div class="col-lg-5">
          <div class="service-summary p-4 sticky-top" style="top: 110px;">
            <span class="soft-pill mb-3"><i class="bi bi-stars"></i> Booking Summary</span>
            <img src="{{ $providerService->image ? asset($providerService->image) : ($providerService->provider?->image ? asset($providerService->provider->image) : asset('img/WhatsApp Image 2026-03-28 at 7.10.26 PM.jpeg')) }}" alt="{{ $providerService->title }}">
            <div class="pt-4">
              <h2 class="fw-bold mb-2">{{ $providerService->title }}</h2>
              <p class="text-muted mb-4">{{ $providerService->description }}</p>

              <div class="summary-row">
                <div class="summary-label">Provider</div>
                <div class="summary-value">{{ $providerService->provider?->name ?? 'Approved Provider' }}</div>
              </div>
              <div class="summary-row">
                <div class="summary-label">Category</div>
                <div class="summary-value">{{ $providerService->category }}</div>
              </div>
              <div class="summary-row">
                <div class="summary-label">City</div>
                <div class="summary-value">{{ $providerService->city }}</div>
              </div>
              <div class="summary-row">
                <div class="summary-label">Price</div>
                <div class="summary-value">{{ $providerService->price ? '$' . number_format((float) $providerService->price, 2) : 'Price on request' }}</div>
              </div>
              <div class="summary-row">
                <div class="summary-label">Availability</div>
                <div class="summary-value">{{ $providerService->availability ?: 'Same day' }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="booking-card p-4 p-lg-5">
            <div class="d-flex flex-wrap justify-content-between gap-3 align-items-start mb-4">
              <div>
                <span class="soft-pill"><i class="bi bi-calendar-check"></i> Confirm Booking</span>
                <h1 class="fw-bold mt-3 mb-2">Book this service</h1>
                <p class="text-muted mb-0">Choose a date and add your contact details. The provider will use this information to confirm and deliver the service.</p>
              </div>
              <a href="{{ route('services.directory') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to services
              </a>
            </div>

            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                Please fix the highlighted fields and try again.
              </div>
            @endif

            <form method="POST" action="{{ route('services.booking.store', $providerService) }}" class="row g-4">
              @csrf

              <div class="col-md-6">
                <label class="form-label fw-semibold">Customer Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Email Address</label>
                <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
              </div>

              <div class="col-md-6">
                <label for="booking_date" class="form-label fw-semibold">Preferred Date</label>
                <input
                  type="date"
                  id="booking_date"
                  name="booking_date"
                  class="form-control @error('booking_date') is-invalid @enderror"
                  value="{{ old('booking_date') }}"
                  min="{{ now()->toDateString() }}"
                  required
                >
                @error('booking_date')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label for="customer_phone" class="form-label fw-semibold">Customer Phone</label>
                <input
                  type="text"
                  id="customer_phone"
                  name="customer_phone"
                  class="form-control @error('customer_phone') is-invalid @enderror"
                  value="{{ old('customer_phone') }}"
                  placeholder="+91 9876543210"
                  required
                >
                @error('customer_phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Provider Contact</label>
                <input type="text" class="form-control" value="{{ $providerService->provider?->phone ?: 'Phone not available' }}" readonly>
                @if ($providerService->provider?->phone)
                  @php
                    $providerWhatsApp = preg_replace('/\D+/', '', $providerService->provider->phone);
                  @endphp
                  <div class="d-flex flex-wrap gap-2 mt-3">
                    <a
                      href="https://wa.me/{{ $providerWhatsApp }}?text={{ urlencode('Hello, I want to discuss the service '.$providerService->title.'.') }}"
                      target="_blank"
                      rel="noopener"
                      class="btn btn-outline-success"
                    >
                      <i class="bi bi-whatsapp me-2"></i>WhatsApp Provider
                    </a>
                    <a href="tel:{{ $providerService->provider->phone }}" class="btn btn-outline-dark">
                      <i class="bi bi-telephone me-2"></i>Call Provider
                    </a>
                  </div>
                @endif
              </div>

              <div class="col-12">
                <label for="customer_address" class="form-label fw-semibold">Service Address</label>
                <textarea
                  id="customer_address"
                  name="customer_address"
                  class="form-control @error('customer_address') is-invalid @enderror"
                  rows="3"
                  required
                >{{ old('customer_address', auth()->user()->address) }}</textarea>
                @error('customer_address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-12 d-flex flex-wrap gap-3 pt-2">
                <button type="submit" class="btn btn-primary btn-lg px-4">
                  <i class="bi bi-send-check me-2"></i>Send Booking Request
                </button>
                <a href="{{ route('services.directory') }}" class="btn btn-outline-dark btn-lg px-4">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
