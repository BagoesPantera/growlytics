# Growlytics

Growlytics is a Laravel application that collects Growtopia marketplace listings from an external Server-Sent Events (SSE) stream and stores historical pricing data for item price history, buy/sell listing statistics, average advertised prices, marketplace trends, and analytics dashboards.

## Features

### Implemented

- SSE listener command with automatic reconnection and graceful shutdown.
- Listing ingestion with payload validation, item normalization, duplicate prevention, and UTC timestamp parsing.
- `items` and `listings` schema with indexes for item/side/time and price lookups.
- Bootstrap-based admin dashboard shell (Velzon-style template) under the `/app` prefix.
- Laravel Breeze authentication and profile management.
- PHPUnit feature/unit tests for ingestion, normalization, duplicate handling, timestamp precision, malformed payloads, and SSE parsing.

### Planned

- Public Growlytics frontend pages.
- Price history and trend charts.
- Buy/sell statistics and average advertised price analytics.
- Item search and filtering.
- Admin analytics dashboards.

## Technology Stack

- PHP ^8.3 (verified on PHP 8.4.27)
- Laravel Framework 13.40.0
- MySQL for application data; SQLite in-memory for tests
- Laravel Breeze for authentication scaffolding
- Laravel Boost for AI-assisted development
- Bootstrap 5.3.6 for the admin dashboard (precompiled assets under `public/apps/`)
- Tailwind CSS v3 + Alpine.js for the default Laravel/Breeze starter pages through Vite
- Vite 8 for frontend bundling of Tailwind-based pages
- Guzzle/HTTP client for the SSE stream
- PHPUnit 12 for testing
- Laravel Pint for code style

The admin dashboard is Bootstrap-based. Tailwind is only used by the default Laravel/Breeze views and must not be introduced into admin pages.

## Project Structure

```text
app/
  Console/Commands/StreamGrowtopiaListings.php
  Http/Controllers/Apps/        # Admin controllers
  Http/Controllers/Guest/       # Public controllers
  Http/Middleware/RoleMiddleware.php
  Models/Item.php, Listing.php, User.php
  Services/ListingIngestService.php, SseParser.php, SseEvent.php
  Helpers/helpers.php           # versioned_asset, guest_asset, upload_asset, getSetting
config/services.php             # growlytics stream settings
database/migrations/            # items, listings, users + role
resources/views/
  apps/layouts/master.blade.php # Bootstrap admin layout
  layouts/app.blade.php         # Tailwind authenticated layout
  layouts/guest.blade.php       # Tailwind guest/public layout
routes/web.php                  # wires auth profile, apps, guest
routes/web/apps.php             # /app admin routes
routes/web/guest.php            # public routes
tests/Feature/ListingIngestServiceTest.php
tests/Feature/GrowlyticsStreamCommandTest.php
tests/Unit/SseParserTest.php
```

## Requirements

- PHP 8.3 or newer
- Composer
- MySQL (or another Laravel-supported database)
- Node.js and npm, only needed to build Tailwind/Vite assets for default Laravel pages
- cPanel-compatible PHP CLI for deployment

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure database credentials in `.env`, then:

```bash
php artisan migrate
npm install
npm run build
php artisan serve
```

The admin Bootstrap assets are already compiled under `public/apps/`; `npm run build` is needed for the Tailwind/Vite pages.

## Environment Configuration

Relevant variables from `.env.example`:

```env
APP_NAME="Growlytics"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

GROWLYTICS_STREAM_URL=
# GROWLYTICS_STREAM_CONNECT_TIMEOUT=15
# GROWLYTICS_STREAM_READ_TIMEOUT=60
# GROWLYTICS_STREAM_RETRY_DELAY=5
# GROWLYTICS_STREAM_MAX_RETRY_DELAY=60
# GROWLYTICS_STREAM_MAX_EVENT_SIZE=65536

VITE_APP_NAME="${APP_NAME}"
```

Do not commit real `.env` values or credentials.

## Database

### items

- `id`
- `name`
- `normalized_name` (unique)
- `created_at`, `updated_at`

### listings

- `id`
- `external_id` (unique, max 64 chars)
- `item_id` (foreign key, `restrictOnDelete`)
- `side` (`buy` or `sell`)
- `price_wl` (unsigned integer)
- `server`, `channel` (nullable)
- `world` (nullable, max 100)
- `world_verified` (boolean, default false)
- `url` (nullable text)
- `posted_at` (timestamp with millisecond precision)
- `created_at`, `updated_at`

Indexes:

- `item_id`, `side`, `posted_at`
- `item_id`, `side`, `price_wl`
- `posted_at`

Item names are normalized by trimming, collapsing repeated whitespace, and lowercasing using Unicode-aware functions. Duplicate listings are prevented by the unique `external_id` constraint. Historical records are never overwritten or aggregated.

## SSE Ingestion

### How it works

`php artisan growlytics:stream` opens the configured SSE endpoint and reads the response in 8192-byte chunks. Complete SSE events are parsed incrementally, JSON payloads are validated, and valid listings are persisted inside a transaction. Malformed payloads are logged and skipped. Duplicate `external_id` values are ignored without modifying the stored record. Event timestamps are converted to UTC.

### Commands

```bash
php artisan migrate
php artisan growlytics:stream
php artisan growlytics:stream -v
php artisan growlytics:stream --once
```

- `-v` shows per-listing saved, duplicate, and rejected output.
- `--once` processes one connection cycle and exits, useful for debugging and tests.

### Reconnection behavior

- Bounded exponential backoff starts at 5 seconds and caps at 60 seconds.
- Jitter is applied to backoff delays.
- Server `retry:` hints are honored.
- `Last-Event-ID` is resent on reconnect when available.
- HTTP 401, 403, and 404 stop the command instead of retrying.
- Unexpected content types are logged but do not stop streaming.

### Debugging

- Use `--once` to test one connection cycle.
- Check Laravel logs for connection failures, malformed payloads, duplicates, and database errors.
- Inspect the HTTP status and content type warnings for endpoint issues.

### Known limitations

- The source may ignore `Last-Event-ID`; events posted during downtime can be lost.
- Graceful SIGTERM/SIGINT shutdown requires PCNTL and is unavailable on Windows.
- `price_wl` is an integer; fractional or negative prices are rejected, not rounded.
- UTC storage assumes `APP_TIMEZONE` is UTC. The current config sets `Asia/Makassar`, which breaks `posted_at` round-tripping; this is a known issue and should be corrected before production use.

## Deployment

The application is intended to run on cPanel shared hosting. Do not assume Supervisor, systemd, Docker, Redis, or queue workers are available.

Use a cron job with `flock` and `nohup` to keep one listener running:

```cron
*/5 * * * * /usr/bin/flock -n /home/CPANEL_USER/growlytics/stream.lock /bin/bash -c 'cd /home/CPANEL_USER/public_html/growlytics && nohup php artisan growlytics:stream >> storage/logs/growlytics-stream.log 2>&1 &'
```

Replace placeholder paths with the actual cPanel account paths. Monitor `storage/logs/` and application logs. Do not modify production cron jobs or long-running processes without permission.

## Frontend Architecture

- Admin pages extend `resources/views/apps/layouts/master.blade.php`.
- The admin layout loads Bootstrap 5.3.6 and template assets from `public/apps/` through `versioned_asset()`.
- Admin routes are grouped under `/app` with `auth` and `role:admin` middleware.
- Public pages use `resources/views/layouts/guest.blade.php`, which is currently Tailwind-based and separate from the admin layout.
- Default Laravel/Breeze pages use `resources/views/layouts/app.blade.php`, also Tailwind-based.
- `App\View\Components\AppLayout` and `GuestLayout` render the Tailwind layouts, not Bootstrap.
- `guest_asset()` is available for assets under `public/guest/`.

Do not merge the admin and guest layouts or move pages between them without explicit instructions.

## Testing

Tests run on SQLite in-memory via `phpunit.xml`. Do not run destructive database commands against the development database.

```bash
php artisan test
php artisan test --filter=ListingIngestServiceTest
php artisan test tests/Feature/GrowlyticsStreamCommandTest.php
vendor/bin/pint --dirty --format agent
```

Current suite: 72 tests, with one known failure caused by the `Asia/Makassar` timezone configuration.

## Development Guidelines

See `AGENTS.md` for instructions that apply to AI coding agents and contributors.
