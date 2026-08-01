<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>LocalServices - Provider Bookings</title>
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <style>
    body.provider-bookings-page {
      background:
        radial-gradient(circle at top left, rgba(241, 90, 36, 0.12), transparent 24%),
        linear-gradient(180deg, #fff7f2 0%, #fff 100%);
      min-height: 100vh;
    }

    .page-shell {
      padding: 120px 0 70px;
    }

    .booking-layout-card {
      border-radius: 28px;
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(31, 23, 20, 0.08);
      box-shadow: 0 22px 50px rgba(31, 23, 20, 0.08);
    }

    .booking-detail-row {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px;
      margin-top: 18px;
    }

    .booking-detail-box {
      padding: 14px 16px;
      border-radius: 18px;
      background: #fff8f3;
      border: 1px solid rgba(241, 90, 36, 0.1);
    }

    .booking-detail-box span {
      display: block;
      font-size: 0.74rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #8a7f79;
      margin-bottom: 6px;
    }

    .booking-detail-box strong {
      color: #201815;
    }

    @media (max-width: 767.98px) {
      .booking-detail-row {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body class="provider-bookings-page">
  <div class="page-shell">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
          <h1 class="fw-bold mb-2">Service Booking Requests</h1>
          <p class="text-muted mb-0">Review customer details, contact numbers, requested dates, and approve requests from one page.</p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('provider.dashboard') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Dashboard
          </a>
          <a href="{{ route('provider.profile') }}" class="btn btn-outline-dark">
            <i class="bi bi-person-circle"></i> Profile
          </a>
          <a href="{{ route('provider.services.index') }}" class="btn btn-primary">Manage Services</a>
        </div>
      </div>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @forelse ($bookings as $booking)
        <div class="booking-layout-card p-4 p-lg-5 mb-4">
          <div class="d-flex flex-wrap justify-content-between gap-3 align-items-start">
            <div>
              <span class="badge text-bg-warning-subtle border border-warning-subtle text-warning-emphasis px-3 py-2">
                {{ ucfirst($booking->status) }}
              </span>
              <h3 class="fw-bold mt-3 mb-2">{{ $booking->providerService?->title ?? $booking->service?->name ?? 'Requested service' }}</h3>
              <p class="text-muted mb-0">{{ $booking->providerService?->description ?? 'Customer submitted a service request for this provider.' }}</p>
            </div>
            @if ($booking->status === 'pending')
              <form method="POST" action="{{ route('provider.bookings.approve', $booking) }}">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">
                  <i class="bi bi-check2-circle me-2"></i>Approve Service
                </button>
              </form>
            @elseif ($booking->status === 'approved')
              <form method="POST" action="{{ route('provider.bookings.finish', $booking) }}">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-patch-check me-2"></i>Finished Service
                </button>
              </form>
            @elseif ($booking->status === 'finished')
              <span class="badge text-bg-primary px-3 py-2">Service finished</span>
            @else
              <span class="badge text-bg-secondary px-3 py-2">{{ ucfirst($booking->status) }}</span>
            @endif
          </div>

          <div class="booking-detail-row">
            <div class="booking-detail-box">
              <span>Customer Name</span>
              <strong>{{ $booking->user?->name ?? 'Customer' }}</strong>
            </div>
            <div class="booking-detail-box">
              <span>Customer Email</span>
              <strong>{{ $booking->user?->email ?? 'Not available' }}</strong>
            </div>
            <div class="booking-detail-box">
              <span>Customer Phone</span>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <strong>{{ $booking->customer_phone ?: 'Not provided' }}</strong>
                @if ($booking->customer_phone)
                @php
                  $whatsAppPhone = preg_replace('/\D+/', '', $booking->customer_phone);
                @endphp
                <a
                  href="https://wa.me/{{ $whatsAppPhone }}?text={{ urlencode('Hello '.$booking->user?->name.', this is '.$provider->name.' regarding your booking request for '.($booking->providerService?->title ?? 'your service request').'.') }}"
                  target="_blank"
                  rel="noopener"
                  class="btn btn-sm btn-outline-success"
                >
                  <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                <a href="tel:{{ $booking->customer_phone }}" class="btn btn-sm btn-outline-dark">
                  <i class="bi bi-telephone"></i> Call
                </a>
              @endif
            </div>
          </div>
            <div class="booking-detail-box">
              <span>Preferred Date</span>
              <strong>{{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Not selected' }}</strong>
            </div>
            <div class="booking-detail-box">
              <span>Service Category</span>
              <strong>{{ $booking->providerService?->category ?? $booking->service?->name ?? 'Not available' }}</strong>
            </div>
            <div class="booking-detail-box">
              <span>Booked On</span>
              <strong>{{ optional($booking->created_at)->format('d M Y h:i A') ?: 'Recently' }}</strong>
            </div>
          </div>

          <div class="booking-detail-box mt-3">
            <span>Service Address</span>
            <strong>{{ $booking->customer_address ?: 'Not provided' }}</strong>
          </div>
        </div>
      @empty
        <div class="booking-layout-card p-5 text-center">
          <h3 class="fw-bold mb-2">No booking requests yet</h3>
          <p class="text-muted mb-4">As soon as a customer books one of your services, the request will appear here with all contact details.</p>
          <a href="{{ route('provider.services.index') }}" class="btn btn-primary">Add or manage services</a>
        </div>
      @endforelse
    </div>
  </div>
</body>
</html>
