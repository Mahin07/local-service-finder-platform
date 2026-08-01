# Database schema

ServiceFinder uses MySQL or MariaDB. The schema is managed through Laravel migrations; do not treat a local SQL dump as the authoritative schema.

## Domain relationships

```text
users 1 --- * bookings * --- 1 providers
                     |
                     + --- 1 services * --- 1 categories
                     |
                     + --- 0..1 provider_services * --- 1 providers

users 1 --- * user_passkeys
```

## Core tables

| Table | Purpose | Important columns |
| --- | --- | --- |
| `users` | Customer identities and profiles | `name`, unique `email`, `password`, `address`, `image`, `status`, `email_verified_at` |
| `providers` | Service-provider identities and approval state | `name`, unique `email`, `password`, `phone`, `city`, `service`, `experience`, `status`, `subscription_status`, `image` |
| `admins` | Administrator credentials | unique `username`, `password`, `image` |
| `categories` | Admin-managed service categories | `name`, `description`, boolean `status`, `deleted_at` |
| `services` | Catalogue services belonging to a category | `name`, `category_id`, `description`, `price` |
| `provider_services` | Provider-specific service listings | `provider_id`, `title`, `category`, `description`, `price`, `city`, `service_area`, `availability`, `image`, `is_active`, `deleted_at` |
| `bookings` | Customer requests for provider services | `user_id`, `provider_id`, `service_id`, nullable `provider_service_id`, `booking_date`, contact details, `status`, `finished_at`, `deleted_at` |
| `user_passkeys` | Reserved WebAuthn credential metadata | `user_id`, unique `credential_id`, `public_key`, `counter`, `transports`, `last_used_at` |

## Supporting Laravel tables

| Table | Purpose |
| --- | --- |
| `password_reset_tokens` | Password-broker tokens for customer resets |
| `sessions` | Database session storage when configured |
| `cache`, `cache_locks` | Database cache driver data |
| `jobs`, `job_batches`, `failed_jobs` | Database queue driver data |
| `migrations` | Records applied Laravel migrations |

## Constraints and lifecycle rules

- `users.email`, `providers.email`, `admins.username`, and `user_passkeys.credential_id` are unique.
- A booking belongs to a customer, provider, and catalogue service. Deleting one of those parent records cascades to its bookings at database level.
- `bookings.provider_service_id` is nullable and changes to `NULL` if its provider-service record is deleted.
- `categories`, `providers`, `provider_services`, and `bookings` use Laravel soft deletes. Eloquent queries exclude soft-deleted records by default.
- Booking status is an enum: `pending`, `approved`, `finished`, or `cancelled`. `finished_at` records the completion timestamp.
- Provider status is an enum: `pending`, `approved`, or `rejected`. Only approved providers can publish and manage provider services.
- Customer status is `active` or `blocked`. Administrative blocking is represented as a state update rather than a deletion.

## Migration workflow

```bash
php artisan migrate:status
php artisan migrate
```

For a disposable local database only:

```bash
php artisan migrate:fresh --seed
```

Never run `migrate:fresh` against a shared or production database.
