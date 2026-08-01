# ServiceFinder

ServiceFinder is a Laravel-based local-services marketplace that connects customers with verified service providers. Customers can discover services by category and location, request bookings, and download invoices. Providers manage their profiles, service listings, and booking lifecycle, while administrators oversee the platform.

## Key features

- Separate customer, provider, and administrator experiences
- Customer registration with email OTP verification and password-reset flow
- Provider onboarding, approval workflow, profile management, and service publishing
- Searchable service directory with category and location filters
- Booking requests with approval, completion, and cancellation states
- Booking email notifications and PDF invoice downloads for completed jobs
- Admin dashboards for users, providers, categories, services, bookings, and reports
- Responsive Blade UI with Bootstrap, Vite, and bundled frontend assets

## Tech stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2+, Laravel 12 |
| Database | MySQL / MariaDB |
| Views | Blade templates, Bootstrap |
| Frontend tooling | Vite, JavaScript, CSS |
| Authentication | Laravel session guards for customers and providers; protected admin session |
| Documents | `barryvdh/laravel-dompdf` |
| Quality tooling | PHPUnit and Laravel Pint |

## Folder structure

```text
app/
|-- Http/
|   |-- Controllers/       # Customer, provider, and admin workflows
|   `-- Middleware/        # Admin access protection
|-- Models/                # Eloquent domain models
`-- Services/              # Notifications and shared upload logic
config/                    # Application and integration configuration
database/
|-- factories/             # Test/demo factories
|-- migrations/            # Version-controlled schema
`-- seeders/               # Demo data seeders
public/
|-- css/, js/, img/        # Public frontend assets
`-- uploads/               # Runtime uploads (not committed)
resources/
|-- css/, js/              # Vite source assets
`-- views/                 # Blade views grouped by role
routes/web.php             # Web routes
tests/                     # Unit and feature tests
```

## Documentation

Implementation documentation is available in [`docs/`](docs/README.md):

- [Database schema](docs/database-schema.md)
- [Main modules](docs/modules.md)
- [Authentication and authorization](docs/authentication.md)
- [Application endpoints](docs/endpoints.md)

## Requirements

- PHP 8.2 or later
- Composer 2
- Node.js 20+ and npm
- MySQL 8+ or MariaDB 10.6+

## Installation

1. Clone the repository and enter the project directory.

   ```bash
   git clone <your-repository-url> servicefinder
   cd servicefinder
   ```

2. Install PHP and JavaScript dependencies.

   ```bash
   composer install
   npm install
   ```

3. Create your local environment file and application key.

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   On Windows PowerShell, use:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

4. Configure the database, run migrations, and seed demo data as described below.

5. Create the public storage link, build frontend assets, and start the application.

   ```bash
   php artisan storage:link
   npm run build
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000`. For XAMPP, configure the virtual host/document root to point at the `public` directory.

## Environment setup

Start from `.env.example`; never commit `.env` or real credentials.

```dotenv
APP_NAME="ServiceFinder"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_finder
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
QUEUE_CONNECTION=database
```

For local development, `MAIL_MAILER=log` writes OTP and notification emails to `storage/logs/laravel.log`. Configure a real SMTP provider only through your uncommitted `.env`. Twilio settings are optional and only needed if SMS support is enabled.

### Production environment

Use [`.env.production.example`](.env.production.example) as the deployment baseline; copy its values into the hosting platform's secret manager rather than committing a production `.env` file. At minimum, set a unique `APP_KEY`, a real `APP_URL`, strong database/mail credentials, and the following values:

```dotenv
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
```

After deploying environment values, run `php artisan config:cache` and `php artisan route:cache`. Never run `php artisan optimize` until the production `.env` has been verified, because Laravel caches configuration values.



### Recommended: migrations and seeders

Create the database first:

```sql
CREATE DATABASE service_finder CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Then run the schema and seeders:

```bash
php artisan migrate
php artisan db:seed
ADMIN_SEED_USERNAME=admin ADMIN_SEED_PASSWORD="use-a-unique-local-password" php artisan db:seed --class=AdminSeeder
```

To rebuild a local development database from scratch:

```bash
php artisan migrate:fresh --seed
ADMIN_SEED_USERNAME=admin ADMIN_SEED_PASSWORD="use-a-unique-local-password" php artisan db:seed --class=AdminSeeder
```

### Optional legacy SQL import

The repository may include a local SQL export for development reference. Migrations are the supported and portable setup path. If you intentionally use an SQL export, import it into an empty local database, then run `php artisan migrate:status` to confirm the schema state. Do not import database dumps into production without review.

## Demo credentials

After running the seed commands above, the following local-only accounts are available:

| Role | Login URL | Credentials |
| --- | --- | --- |
| Customer | `/login` | `test@example.com` / `password` |
| Administrator | `/admin/login` | Values you set in `ADMIN_SEED_USERNAME` and `ADMIN_SEED_PASSWORD` |

These credentials are for local demonstration only. Change or remove them before any deployment. Provider accounts are created through `/provider/register` and must be approved by an administrator before publishing services.

## Quality checks

```bash
php artisan test
vendor/bin/pint --test
```

## Repository standards

- [Contributing guide](CONTRIBUTING.md)
- [Security policy](SECURITY.md)
- [Changelog](CHANGELOG.md)
- GitHub Actions runs Pint and PHPUnit for pull requests targeting `main`.

## Release checklist

Before creating a public release:

1. Confirm `.env`, database dumps, runtime uploads, and credentials are not staged.
2. Run `composer install --no-dev --optimize-autoloader`, `vendor/bin/pint --test`, and `php artisan test`.
3. Set production environment values (`APP_ENV=production`, `APP_DEBUG=false`, HTTPS cookie settings, real queue/mail drivers).
4. Run migrations and build production assets with `npm run build`.
5. Update `CHANGELOG.md`, create a semantic version tag, and publish release notes.

## Future improvements

- Add comprehensive feature tests for booking, authorization, and admin workflows
- Replace session-based admin authentication with a dedicated Laravel guard and policies
- Move uploads to Laravel Storage/S3 with image optimization and deletion lifecycle handling
- Add provider availability calendars, service ratings, reviews, and payments
- Queue email notifications and add observability for failed jobs
- Add CI with automated tests, Pint, and dependency security checks
- Publish an API layer for mobile clients or third-party integrations

## License

This project is released under the [MIT License](LICENSE).
