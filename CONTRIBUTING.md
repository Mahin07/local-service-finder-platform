# Contributing to ServiceFinder

Thanks for improving ServiceFinder. Keep contributions focused, tested, and safe for a public Laravel project.

## Local setup

1. Copy `.env.example` to `.env` and configure a local database.
2. Install dependencies with `composer install` and `npm install`.
3. Run `php artisan key:generate`, `php artisan migrate`, and the required seeders.

Never commit `.env`, database exports, runtime uploads, generated dependencies, or credentials.

## Before opening a pull request

Run the following checks:

```bash
vendor/bin/pint --test
php artisan test
```

Add or update tests when changing authorization, booking flows, validation, or database behavior. Keep migrations reversible and avoid unrelated formatting changes in the same pull request.

## Commit format

Use small, imperative commits with a conventional prefix:

```text
feat: add provider availability validation
fix: prevent duplicate booking submissions
perf: index active provider service lookups
docs: clarify local mail configuration
```
