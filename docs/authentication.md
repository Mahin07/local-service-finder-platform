# Authentication and authorization

## Roles and guards

| Role | Identity model | Access mechanism | Protected middleware |
| --- | --- | --- | --- |
| Customer | `User` | Laravel default `web` guard | `auth` |
| Provider | `Provider` | Laravel `provider` guard | `auth:provider` |
| Administrator | `Admin` | Custom session flag after credential check | `admin.auth` |

Guests are protected by `guest` or `guest:provider`, depending on the intended login flow.

## Customer flow

```text
Register -> validate captcha/honeypot -> store pending registration in session
         -> email OTP -> verify OTP -> create user -> login

Login -> Laravel Auth::attempt -> regenerate session -> customer dashboard
Logout -> Auth::logout -> invalidate session -> home page
```

- Registration and login routes are rate limited.
- The OTP expires after 10 minutes and is kept only in the session until verification succeeds.
- A customer can request a password reset through Laravel's password broker.
- Customer routes verify ownership before exposing an invoice.

## Provider flow

```text
Register -> create pending provider -> provider guard login -> provider dashboard
Admin approval -> provider status becomes approved -> service-management access
```

- Provider registration and login use the dedicated `provider` guard.
- Rejected providers cannot log in.
- Service-management actions verify both that the current provider is approved and that the provider owns the targeted service listing.

## Administrator flow

```text
POST /admin/login -> username/password verification -> regenerate session
                  -> set admin_authenticated session flag -> /admin/dashboard
```

`EnsureAdminAuthenticated` checks the `admin_authenticated` session flag before allowing access to routes inside the `/admin` group. Admin logout invalidates the session and regenerates the CSRF token.

## Security notes

- Passwords use Laravel's `hashed` cast on the user and provider models.
- Forms use Laravel's CSRF protection through the `web` middleware group.
- Image uploads validate MIME/type and file size before storage.
- Environment secrets belong only in `.env`; `.env.example` must contain placeholders.
- The passkey routes are deliberately unavailable until complete WebAuthn verification is implemented. They return HTTP `503` and should not be considered an authentication option.
