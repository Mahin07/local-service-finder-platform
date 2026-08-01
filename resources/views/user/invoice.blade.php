<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Invoice - Booking #{{ $booking->id }}</title>
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      background: #f7f1ed;
      color: #1f1714;
      font-family: "Roboto", sans-serif;
    }

    .invoice-shell {
      max-width: 920px;
      margin: 38px auto;
      background: #fff;
      border-radius: 28px;
      border: 1px solid rgba(31, 23, 20, 0.08);
      box-shadow: 0 24px 50px rgba(31, 23, 20, 0.08);
      overflow: hidden;
    }

    .invoice-hero {
      padding: 34px 40px;
      background: linear-gradient(135deg, #f15a24, #ff9b63);
      color: #fff;
    }

    .invoice-content {
      padding: 34px 40px 40px;
    }

    .invoice-box {
      padding: 18px 20px;
      border-radius: 20px;
      border: 1px solid rgba(241, 90, 36, 0.1);
      background: #fff8f3;
      height: 100%;
    }

    .invoice-box h6 {
      font-size: 0.78rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: #8a7f79;
      margin-bottom: 10px;
    }

    .summary-table {
      width: 100%;
      border-collapse: collapse;
    }

    .summary-table th,
    .summary-table td {
      padding: 14px 0;
      border-bottom: 1px solid rgba(31, 23, 20, 0.08);
      vertical-align: top;
    }

    .summary-table th {
      color: #7f726b;
      font-weight: 500;
      width: 32%;
    }

    .summary-table tr:last-child th,
    .summary-table tr:last-child td {
      border-bottom: 0;
    }

    .actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap;
      margin-bottom: 26px;
    }

    @media print {
      body {
        background: #fff;
      }

      .no-print {
        display: none !important;
      }

      .invoice-shell {
        box-shadow: none;
        border: 0;
        margin: 0;
        max-width: none;
      }
    }

    @media (max-width: 767.98px) {
      .invoice-shell {
        margin: 12px;
        border-radius: 16px;
      }

      .invoice-hero,
      .invoice-content {
        padding: 20px;
      }

      .actions {
        flex-direction: column;
      }

      .actions .btn {
        width: 100%;
      }

      .summary-table th,
      .summary-table td {
        display: block;
        width: 100%;
        padding: 8px 0;
      }
    }
  </style>
</head>
<body>
  @php
    $serviceTitle = $booking->providerService?->title ?? $booking->service?->name ?? 'Booked service';
    $serviceCategory = $booking->providerService?->category ?? $booking->service?->name ?? 'Service';
    $servicePrice = $booking->providerService?->price ? number_format((float) $booking->providerService->price, 2) : null;
  @endphp

  <div class="invoice-shell">
    <div class="invoice-hero">
      <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
          <div class="text-uppercase small fw-semibold opacity-75">LocalServices Invoice</div>
          <h1 class="fw-bold mt-2 mb-1">Service Bill</h1>
          <div class="opacity-75">Booking #{{ $booking->id }} | {{ optional($booking->created_at)->format('d M Y') }}</div>
        </div>
        <div class="text-end">
          <div class="fw-semibold">Status</div>
          <div class="fs-5 fw-bold">{{ ucfirst($booking->status) }}</div>
        </div>
      </div>
    </div>

    <div class="invoice-content">
      <div class="actions no-print">
        <button type="button" class="btn btn-primary" onclick="window.print()">
          Download / Save PDF
        </button>
        <a href="{{ route('user.bookings') }}" class="btn btn-outline-dark">Back to My Bookings</a>
      </div>

      <div class="row g-4 mb-4">
        <div class="col-md-6">
          <div class="invoice-box">
            <h6>Bill To</h6>
            <div class="fw-bold">{{ $booking->user?->name ?? 'Customer' }}</div>
            <div>{{ $booking->user?->email ?? 'Not available' }}</div>
            <div>{{ $booking->customer_phone ?: 'Phone not provided' }}</div>
            <div class="mt-2">{{ $booking->customer_address ?: 'Address not provided' }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="invoice-box">
            <h6>Service Provider</h6>
            <div class="fw-bold">{{ $booking->provider?->name ?? 'Approved Provider' }}</div>
            <div>{{ $booking->provider?->email ?? 'Not available' }}</div>
            <div>{{ $booking->provider?->phone ?? 'Phone not available' }}</div>
            <div class="mt-2">{{ $booking->providerService?->city ?? $booking->provider?->city ?? 'City not available' }}</div>
          </div>
        </div>
      </div>

      <div class="invoice-box mb-4">
        <h6>Service Details</h6>
        <table class="summary-table">
          <tr>
            <th>Service Name</th>
            <td>{{ $serviceTitle }}</td>
          </tr>
          <tr>
            <th>Category</th>
            <td>{{ $serviceCategory }}</td>
          </tr>
          <tr>
            <th>Service Date</th>
            <td>{{ $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Not selected' }}</td>
          </tr>
          <tr>
            <th>Description</th>
            <td>{{ $booking->providerService?->description ?? 'Service booking completed.' }}</td>
          </tr>
          <tr>
            <th>Service Area</th>
            <td>{{ $booking->providerService?->service_area ?? 'Local service area' }}</td>
          </tr>
        </table>
      </div>

      <div class="invoice-box">
        <h6>Billing Summary</h6>
        <table class="summary-table">
          <tr>
            <th>Invoice Number</th>
            <td>INV-{{ str_pad((string) $booking->id, 6, '0', STR_PAD_LEFT) }}</td>
          </tr>
          <tr>
            <th>Booked On</th>
            <td>{{ optional($booking->created_at)->format('d M Y h:i A') ?: 'Recently' }}</td>
          </tr>
          <tr>
            <th>Payment Status</th>
            <td>Pay directly to provider</td>
          </tr>
          <tr>
            <th>Amount</th>
            <td>{{ $servicePrice ? '$'.$servicePrice : 'Price on request' }}</td>
          </tr>
          <tr>
            <th>Terms</th>
            <td>This bill confirms the completed service booking recorded through LocalServices.</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
