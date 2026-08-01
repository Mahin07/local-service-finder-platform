# Main modules

## Customer module

Customers can register, verify an email OTP, sign in, reset a password, manage a profile, browse the directory, create bookings, review their booking history, and download invoices once a booking is finished.

Key controllers: `AuthController`, `UserDashboardController`, `UserServicesController`, `UserBookingController`, `UserBookingListController`, `UserProfileController`, and `UserInvoiceController`.

## Provider module

Providers register separately and use the `provider` authentication guard. Their accounts begin in `pending` state. After an administrator approves the profile, a provider can create, edit, and remove service listings, update their profile, view bookings, approve requests, and mark work as finished.

Key controllers: `ProviderAuthController`, `ProviderProfileController`, `ProviderServiceController`, and `ProviderBookingController`.

## Service directory and booking module

The public directory shows only active service listings from approved providers. It filters by service/category text and location. A signed-in customer selects a provider service, supplies date and contact details, and creates a pending booking. The system creates or reuses the matching catalogue category/service record and notifies the provider by email.

Key models: `Category`, `Service`, `ProviderService`, and `Booking`.

## Administration module

The admin area provides dashboards and management screens for customers, providers, categories, catalogue services, bookings, provider-service listings, and reports. Provider approval is administered through provider management. Reports support date/category filtering and spreadsheet-compatible export.

Routes under `/admin` require the `admin.auth` middleware.

## Notification and document module

`BookingNotificationService` sends plain-text email notifications for new bookings, approvals, and completion. `UserInvoiceController` uses Dompdf to generate an invoice PDF for a customer-owned booking after it reaches `finished` status.

## Upload module

`PublicImageUploadService` centralizes profile and provider-service image uploads. Files are written to runtime-only subdirectories under `public/uploads/`; these files are intentionally excluded from version control.
