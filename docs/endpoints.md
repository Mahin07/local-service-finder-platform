# Application endpoints

## API status

ServiceFinder does **not** currently provide a versioned REST or JSON API. It is a server-rendered Laravel web application, and its routes use session authentication and CSRF protection. There is no `routes/api.php` endpoint surface to integrate with external clients.

The only JSON-oriented endpoints are the passkey beta endpoints below; each intentionally returns `503 Service Unavailable` until secure WebAuthn verification is implemented.

| Method | URI | Purpose | Middleware |
| --- | --- | --- | --- |
| POST | `/passkey/register/options` | Reserved registration options endpoint | `guest`, throttle |
| POST | `/passkey/register/verify` | Reserved registration verification endpoint | `guest`, throttle |
| POST | `/passkey/login/options` | Reserved sign-in options endpoint | `guest`, throttle |
| POST | `/passkey/login/verify` | Reserved sign-in verification endpoint | `guest`, throttle |

## Web route groups

| Area | Base URI | Authentication | Primary capabilities |
| --- | --- | --- | --- |
| Public | `/`, `/services-directory` | None | Landing page and provider-service discovery |
| Customer guest | `/login`, `/register`, `/forgot-password` | `guest` | Login, OTP registration, password reset |
| Customer account | `/dashboard`, `/profile`, `/my-bookings` | `auth` | Profile, bookings, invoices, logout |
| Provider guest | `/provider/register`, `/provider/login` | `guest:provider` | Provider onboarding and login |
| Provider account | `/provider/dashboard`, `/provider/services`, `/provider/bookings` | `auth:provider` | Provider profile, listings, and booking actions |
| Admin | `/admin/*` | `admin.auth` except login | Management, reports, and approvals |

## Route discovery

Use Laravel to inspect the current route table instead of treating this document as a generated contract:

```bash
php artisan route:list
php artisan route:list --path=provider
php artisan route:list --path=admin
```

## Building an API later

When external consumers are required, create an explicit `/api/v1` route group, use token-based authentication such as Laravel Sanctum, return API Resources, publish an OpenAPI specification, and add endpoint-level feature tests. Do not repurpose the current session/Blade routes as a public API.
