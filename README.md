# Growlytics

Growlytics is a Laravel application that collects Growtopia marketplace listings from an external Server-Sent Events (SSE) stream and stores historical pricing data for item price history, buy/sell listing statistics, average advertised prices, marketplace trends, and analytics dashboards.

## Features

### Implemented

- SSE listener command with automatic reconnection and graceful shutdown.
- Listing ingestion with payload validation, item normalization, duplicate prevention, and UTC timestamp parsing.
- `items` and `listings` schema with indexes for item/side/time and price lookups.
- Fractional World Lock prices stored as DECIMAL(28,8), with raw price representation preserved.
- Permanent item slugs for stable URLs, with numeric ID fallback.
- Bootstrap-based admin dashboard shell under the `/app` prefix (currently a placeholder).
- Laravel Breeze authentication and profile management.
- Public guest frontend: homepage, shared item search, Top Items This Week ranking, item detail analytics, price history charts, recent sell listings by world.
- PHPUnit feature/unit tests for ingestion, normalization, duplicate handling, timestamp precision, malformed payloads, SSE parsing, slugs, search, price history, recent worlds, and weekly ranking.

### Planned

- Admin analytics dashboards.
- Item browsing and filtering pages beyond search.
- Price history and trend charts polish.
- Buy/sell statistics and average advertised price analytics expansion.
- Public trends pages.
- Search result pages.

## Technology Stack

- PHP ^8.3 (verified on PHP 8.4.27)
- Laravel Framework 13.40.0
- MySQL for application data; SQLite in-memory for tests
- Laravel Breeze for authentication scaffolding
- Laravel Boost for AI-assisted development
- Bootstrap 5.3.6 for the admin dashboard (precompiled assets under `public/apps/`)
- Tailwind CSS v3 + Alpine.js for guest/default Laravel/Breeze pages through Vite
- Vite 8 for frontend bundling
- ECharts 6 for price history charts
- Guzzle/HTTP client for the SSE stream
- PHPUnit 12 for testing
- Laravel Pint for code style

The admin dashboard is Bootstrap-based. Tailwind is only used by guest and default Laravel/Breeze views and must not be introduced into admin pages.

## Project Structure

```text
app/
  Console/Commands/StreamGrowtopiaListings.php
  Console/Commands/BackfillItemSlugs.php
  Http/Controllers/Apps/        # Admin controllers
  Http/Controllers/Guest/       # Public controllers (Home, Item)
  Http/Middleware/RoleMiddleware.php
  Models/Item.php, Listing.php, User.php
  Services/ListingIngestService.php, SseParser.php, SseEvent.php
  Services/TopItemsThisWeekService.php, ItemPriceHistoryService.php
  Services/ItemRecentWorldListingsService.php, ItemSearchService.php
  Services/ItemSlugGenerator.php
  Helpers/helpers.php            # versioned_asset, guest_asset, upload_asset, getSetting
config/services.php             # growlytics stream settings
database/migrations/            # items, listings, users + role, slugs, decimal price
resources/views/
  apps/layouts/master.blade.php # Bootstrap admin layout
  apps/dashboard/index.blade.php
  guest/layouts/master.blade.php # Tailwind guest layout
  guest/home/index.blade.php
  guest/items/show.blade.php
  layouts/app.blade.php         # Tailwind authenticated layout
  layouts/guest.blade.php       # Tailwind guest/public layout
routes/web.php                  # wires auth profile, apps, guest
routes/web/apps.php             # /app admin routes
routes/web/guest.php            # public routes
tests/Feature/...               # ingestion, analytics, search, slugs, auth
tests/Unit/SseParserTest.php
```

## Admin and Guest Layout Architecture

- Admin pages extend `resources/views/apps/layouts/master.blade.php` and load Bootstrap assets from `public/apps/` via `versioned_asset()`.
- Guest pages extend `resources/views/guest/layouts/master.blade.php` and use Tailwind/Alpine through Vite (`resources/css/app.css`, `resources/js/app.js`).
- Admin routes are grouped under `/app` with `auth` and `role:admin` middleware.
- Public routes live in `routes/web/guest.php` with no auth requirement.
- `App\View\Components\AppLayout` and `GuestLayout` render Tailwind layouts, not Bootstrap.
- `guest_asset()` serves assets under `public/guest/`.
- Do not merge admin and guest layouts or move pages between them.

## Local Installation

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

The admin Bootstrap assets are already compiled under `public/apps/`; `npm run build` is needed for the Tailwind/Vite guest pages.

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

## Database Schema

### items

- `id`
- `name`
- `normalized_name` (unique)
- `slug` (nullable, unique)
- `created_at`, `updated_at`

Item names are normalized by trimming, collapsing repeated whitespace, and lowercasing using Unicode-aware functions.

### listings

- `id`
- `external_id` (unique, max 64 chars)
- `item_id` (foreign key, `restrictOnDelete`)
- `side` (`buy` or `sell`)
- `price_wl` (non-negative DECIMAL(28,8))
- `price_wl_raw` (nullable string, max 64, original incoming price representation)
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

Item names are normalized to prevent duplicate master records. Duplicate listings are prevented by the unique `external_id` constraint. Historical records are never overwritten or aggregated.

## Fractional World Lock Price Handling

- `price_wl` is DECIMAL(28,8) and non-negative.
- Integer and fractional World Lock prices are supported.
- Invalid, negative, NaN, infinite, and out-of-range values are rejected.
- Decimal values are stored without floating-point conversion.
- `price_wl_raw` preserves the incoming price representation where available.
- BCMath (`bccomp`) is used for decimal range validation.
- Eloquent casts `price_wl` with `decimal:8` (Brick\Math BigDecimal, HalfUp rounding to 8 decimals).
- Validated range is 0 through 99999999999999999999.99999999.
- Fractional inputs are accepted and never silently rounded beyond the 8-decimal column precision.

## SSE Ingestion

### How it works

`php artisan growlytics:stream` opens the configured SSE endpoint and reads the response in 8192-byte chunks. Complete SSE events are parsed incrementally, JSON payloads are validated, and valid listings are persisted inside a transaction. Malformed payloads are logged and skipped. Duplicate `external_id` values are ignored without modifying the stored record. Event timestamps are converted to UTC.

### Commands

```bash
php artisan migrate
php artisan growlytics:stream
php artisan growlytics:stream -v
php artisan growlytics:stream --once
php artisan growlytics:backfill-item-slugs
php artisan growlytics:backfill-item-slugs --batch=100 --dry-run
```

- `-v` shows per-listing saved, duplicate, and rejected output.
- `--once` processes one connection cycle and exits, useful for debugging and tests.
- `growlytics:backfill-item-slugs` generates permanent slugs for items missing one; `--dry-run` reports without writing.

### Reconnection behavior

- Bounded exponential backoff starts at 5 seconds and caps at 60 seconds.
- Jitter is applied to backoff delays.
- Server `retry:` hints are honored.
- `Last-Event-ID` is resent on reconnect when available.
- HTTP 401, 403, and 404 stop the command instead of retrying.
- Unexpected content types are logged but do not stop streaming.

### Known limitations

- The source may ignore `Last-Event-ID`; events posted during downtime can be lost.
- Graceful SIGTERM/SIGINT shutdown requires PCNTL and is unavailable on Windows.
- Application timezone is UTC (required for correct `posted_at` round-tripping).

## Item Search and Detail Navigation

- Shared search in the guest header queries `/search/items?q=...&limit=...` and returns up to 8 items.
- Results link to item detail pages using permanent slugs when available, with numeric ID fallback.
- Item detail page (`/items/{item}`) shows advertised price analytics, buy/sell summary, price history chart, and recent sell listings by world.
- Back navigation prefers safe internal URLs and falls back to the homepage.
- Internal database item IDs are not displayed as decorative text; slugs/IDs are used only for routing and relations.

## Weekly Rankings and Analytics Time Windows

- "Top Items This Week" ranks items by total listings in the current UTC calendar week (Monday 00:00 UTC to now), reset every Monday 00:00 UTC. Maximum 10 items, tie-broken by item ID.
- Homepage ranking counts are cached with a TTL of at most 60 seconds and invalidate at the UTC Monday boundary.
- Item detail analytics default to a rolling 24-hour UTC window and support 24H, 7D, 30D, 90D, 1Y.
- These are intentionally different time windows; differing counts are expected behavior, not a bug.
- Price history scatter points are sampled for display; medians and percentiles use all valid listings.
- Recent sell listings by world use a rolling 24-hour UTC window with pagination.
- Empty state wording: "No listings in the selected time range."
- Statistics are based on advertised marketplace prices, not confirmed transactions.

## Deployment

The application is intended to run on cPanel shared hosting. Do not assume Supervisor, systemd, Docker, Redis, or queue workers are available.

The SSE listener is managed using a cron watchdog pattern:

```text
cPanel Cron (every minute)
    |
    v
nohup + flock
    |
    +-- Lock available → Start Laravel SSE listener
    |
    +-- Lock held → Exit without starting duplicate listener
```

Example (use placeholders, never real paths):

```bash
cd /path/to/growlytics && nohup /bin/flock -n /path/to/growlytics.lock /path/to/php artisan growlytics:stream >> /path/to/stream.log 2>&1 < /dev/null &
```

Important deployment rules:
- Cron checks every minute.
- Laravel's SSE listener should continue running between cron executions.
- `flock` prevents overlapping listeners using the same lock file.
- Do not restart the stream intentionally every minute.
- Do not delete the lock file to force a restart.
- Disable the cron watchdog before manually stopping the listener for maintenance.
- Confirm that the hosting provider permits persistent background processes.

## Testing

Tests run on SQLite in-memory via `phpunit.xml`. Do not run destructive database commands against the development database.

```bash
php artisan test
php artisan test --filter=ListingIngestServiceTest
php artisan test tests/Feature/GrowlyticsStreamCommandTest.php
vendor/bin/pint --dirty --format agent
```

Current suite: 146 tests passing.

## Known Limitations

- SSE reconnect gaps: events published while disconnected may be lost.
- PHP float precision in analytics for very large prices (beyond 2^53).
- Extreme or unrealistic listing prices.
- Data growth over time.
- Differences between calendar-week ranking and rolling detail windows.
- Admin dashboard is currently a placeholder; admin analytics not yet implemented.
- `getSetting()` references a `Setting` model that is not present in the codebase; verify before relying on it.

## Future Roadmap

- Admin analytics dashboards.
- Item browsing and filtering pages.
- Price history and trend charts polish.
- Buy/sell statistics and average advertised price analytics expansion.
- Public trends pages.
- Search result pages.

## AI Agent Context

See `AGENTS.md` for persistent instructions, architectural constraints, and coding conventions for AI agents.