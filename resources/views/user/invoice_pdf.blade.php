<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Invoice #{{ $booking->id }}</title>
  <style>
    @page {
      margin: 24px;
    }

    body {
      font-family: DejaVu Sans, sans-serif;
      color: #211915;
      font-size: 12px;
      line-height: 1.45;
    }

    .invoice-shell {
      border: 1px solid #ead8cf;
      border-radius: 18px;
      overflow: hidden;
    }

    .hero {
      background: #f15a24;
      color: #ffffff;
      padding: 24px 28px;
    }

    .hero-table,
    .party-table,
    .summary-table,
    .totals-table {
      width: 100%;
      border-collapse: collapse;
    }

    .hero-table td {
      vertical-align: top;
    }

    .brand {
      font-size: 28px;
      font-weight: 800;
      letter-spacing: -0.03em;
    }

    .hero-label {
      font-size: 10px;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      opacity: 0.82;
      margin-bottom: 6px;
    }

    .hero-right {
      text-align: right;
    }

    .content {
      padding: 26px 28px 30px;
      background: #fffdfa;
    }

    .section-title {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: #8f7f77;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .box {
      border: 1px solid #f0dfd5;
      background: #fff7f1;
      border-radius: 14px;
      padding: 16px 18px;
    }

    .party-table td {
      width: 50%;
      vertical-align: top;
      padding-bottom: 18px;
    }

    .party-name {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .muted {
      color: #7f726b;
    }

    .service-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 6px;
    }

    .service-table th,
    .service-table td {
      padding: 12px 10px;
      border-bottom: 1px solid #f0dfd5;
      text-align: left;
      vertical-align: top;
    }

    .service-table th {
      font-size: 10px;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #8f7f77;
      background: #fff8f3;
    }

    .service-table tr:last-child td {
      border-bottom: 0;
    }

    .totals-wrap {
      margin-top: 22px;
    }

    .totals-table td {
      padding: 8px 0;
    }

    .totals-table .label {
      color: #7f726b;
      width: 70%;
    }

    .totals-table .amount {
      text-align: right;
      font-weight: 700;
    }

    .grand-total {
      border-top: 1px solid #ebd8ce;
      margin-top: 8px;
      padding-top: 10px;
    }

    .grand-total .label,
    .grand-total .amount {
      font-size: 14px;
      font-weight: 800;
      color: #211915;
    }

    .footer-note {
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px dashed #ead8cf;
      color: #7f726b;
      font-size: 11px;
    }

    .badge {
      display: inline-block;
      padding: 7px 12px;
      border-radius: 999px;
      background: #fff0e7;
      color: #b64614;
      font-weight: 700;
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }
  </style>
</head>
<body>
  @php
    $serviceTitle = $booking->providerService?->title ?? $booking->service?->name ?? 'Booked service';
    $serviceCategory = $booking->providerService?->category ?? $booking->service?->name ?? 'Service';
    $servicePrice = $booking->providerService?->price ? number_format((float) $booking->providerService->price, 2) : null;
    $serviceDate = $booking->booking_date ? $booking->booking_date->format('d M Y') : 'Not selected';
    $invoiceNumber = 'INV-'.str_pad((string) $booking->id, 6, '0', STR_PAD_LEFT);
  @endphp

  <div class="invoice-shell">
    <div class="hero">
      <table class="hero-table">
        <tr>
          <td>
            <div class="hero-label">LocalServices</div>
            <div class="brand">Premium Service Invoice</div>
            <div style="margin-top: 8px; opacity: 0.88;">Professional booking confirmation and completion bill.</div>
          </td>
          <td class="hero-right">
            <div class="hero-label">Invoice Number</div>
            <div style="font-size: 18px; font-weight: 800;">{{ $invoiceNumber }}</div>
            <div style="margin-top: 8px;">
              <span class="badge">{{ ucfirst($booking->status) }}</span>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table class="party-table">
        <tr>
          <td style="padding-right: 10px;">
            <div class="section-title">Bill To</div>
            <div class="box">
              <div class="party-name">{{ $booking->user?->name ?? 'Customer' }}</div>
              <div>{{ $booking->user?->email ?? 'Not available' }}</div>
              <div>{{ $booking->customer_phone ?: 'Phone not provided' }}</div>
              <div style="margin-top: 8px;">{{ $booking->customer_address ?: 'Address not provided' }}</div>
            </div>
          </td>
          <td style="padding-left: 10px;">
            <div class="section-title">Provider Details</div>
            <div class="box">
              <div class="party-name">{{ $booking->provider?->name ?? 'Approved Provider' }}</div>
              <div>{{ $booking->provider?->email ?? 'Not available' }}</div>
              <div>{{ $booking->provider?->phone ?? 'Phone not available' }}</div>
              <div style="margin-top: 8px;">{{ $booking->providerService?->city ?? $booking->provider?->city ?? 'City not available' }}</div>
            </div>
          </td>
        </tr>
      </table>

      <div class="section-title">Service Summary</div>
      <table class="service-table">
        <thead>
          <tr>
            <th style="width: 30%;">Service</th>
            <th style="width: 18%;">Category</th>
            <th style="width: 16%;">Service Date</th>
            <th style="width: 18%;">Location</th>
            <th style="width: 18%;">Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <strong>{{ $serviceTitle }}</strong>
              <div class="muted" style="margin-top: 5px;">{{ $booking->providerService?->description ?? 'Completed service booking through LocalServices.' }}</div>
            </td>
            <td>{{ $serviceCategory }}</td>
            <td>{{ $serviceDate }}</td>
            <td>{{ $booking->providerService?->service_area ?? ($booking->providerService?->city ?? 'Local area') }}</td>
            <td>{{ $servicePrice ? '$'.$servicePrice : 'Price on request' }}</td>
          </tr>
        </tbody>
      </table>

      <div class="totals-wrap">
        <table class="totals-table">
          <tr>
            <td class="label">Booked On</td>
            <td class="amount">{{ optional($booking->created_at)->format('d M Y h:i A') ?: 'Recently' }}</td>
          </tr>
          <tr>
            <td class="label">Payment Terms</td>
            <td class="amount">Pay directly to provider</td>
          </tr>
          <tr>
            <td class="label">Platform Reference</td>
            <td class="amount">Booking #{{ $booking->id }}</td>
          </tr>
          <tr class="grand-total">
            <td class="label">Total Amount</td>
            <td class="amount">{{ $servicePrice ? '$'.$servicePrice : 'Price on request' }}</td>
          </tr>
        </table>
      </div>

      <div class="footer-note">
        This invoice confirms that the listed service has been marked as finished by the provider on the LocalServices platform. Keep this bill for your records.
      </div>
    </div>
  </div>
</body>
</html>
