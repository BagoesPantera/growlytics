# AGENTS.md

Persistent instructions for AI coding agents working on Growlytics.

## Project Identity

Growlytics is a Laravel 13 application that ingests Growtopia marketplace listings from an external SSE stream and stores historical pricing data. It provides item price history, buy/sell listing statistics, average advertised prices, marketplace trends, and analytics dashboards. The admin area uses a Bootstrap 5.3.6 template; the public/guest pages use Laravel's Tailwind/Alpine starter stack through Vite.

## Mandatory Audit Before Coding

Before making changes, agents must:

1. Read this file.
2. Read relevant sections of `README.md`.
3. Inspect existing implementation patterns in the affected area.
4. Identify whether the task affects the admin (`/app`) or guest/public area.
5. Verify dependencies, routes, middleware, and layouts instead of assuming they exist.

## Architecture and Directory Conventions

- Admin routes: `routes/web/apps.php` — prefix `app`, name `app.`, middleware `auth` and `role:admin`.
- Public routes: `routes/web/guest.php` — home, item search, item detail, price history, recent worlds.
- Admin controllers: `app/Http/Controllers/Apps/`.
- Guest controllers: `app/Http/Controllers/Guest/`.
- Business logic lives in services under `app/Services/`.
- Models: `app/Models/Item.php`, `Listing.php`, `User.php`.
- SSE ingestion: `ListingIngestService`, `SseParser`, `SseEvent`, `StreamGrowtopiaListings`.
- Public analytics services: `TopItemsThisWeekService`, `ItemPriceHistoryService`, `ItemRecentWorldListingsService`, `ItemSearchService`, `ItemSlugGenerator`.
- Admin dashboard view: `resources/views/apps/dashboard/index.blade.php`.
- Guest views: `resources/views/guest/...`, layout `resources/views/guest/layouts/master.blade.php`.
- Helpers: `app/Helpers/helpers.php` (`versioned_asset`, `guest_asset`, `upload_asset`, `getSetting`).

## Frontend Rules — CRITICAL

Growlytics uses Bootstrap for the admin dashboard, NOT Tailwind CSS.

- Admin pages must extend `resources/views/apps/layouts/master.blade.php`.
- Load admin assets with `versioned_asset()` from `public/apps/`.
- Reuse existing partials in `resources/views/apps/layouts/partials/`.
- Do not generate Tailwind utility classes for admin pages.
- Do not install Tailwind, DaisyUI, Flowbite, or other Tailwind-based libraries into admin pages.
- Do not rewrite or migrate the admin layout.
- Tailwind v3 and Alpine.js are only for guest/default Laravel/Breeze pages through `resources/css/app.css`, `resources/js/app.js`, and Vite.
- `App\View\Components\AppLayout` and `GuestLayout` render Tailwind layouts (`layouts.app`, `layouts.guest`), not Bootstrap.
- `guest_asset()` serves assets under `public/guest/`.
- Do not mix admin and guest navigation or layouts.

## Backend Conventions

- Target Laravel 13 and PHP 8.3+.
- Use Eloquent and existing project patterns.
- Use Form Requests when consistent with existing conventions.
- Keep controllers focused; put ingestion and business logic in services.
- Reuse `ListingIngestService`, `SseParser`, and `SseEvent`.
- Avoid adding packages or infrastructure unless explicitly requested.
- Follow Laravel Pint style; run `vendor/bin/pint --dirty --format agent` after PHP changes.

## Database Rules

- Preserve historical listings; never overwrite or aggregate them.
- Prevent duplicate `external_id` values using the unique constraint.
- Normalize item names with `ListingIngestService::normalizeItemName()`.
- Keep buy and sell data distinguishable via the `side` enum.
- Preserve original event timestamps; parse them as UTC.
- Store timestamps consistently in UTC.
- `price_wl` is stored as DECIMAL(28,8) (non-negative). Values are validated as non-negative decimals and stored as decimal strings; Eloquent casts `price_wl` with `decimal:8` (Brick\Math BigDecimal, HalfUp rounding to 8 decimals). Fractional inputs are accepted, never silently rounded on ingestion beyond the 8-decimal column precision. The original incoming representation is preserved in the nullable `price_wl_raw` column (VARCHAR(64)). Validated range is 0 through 99999999999999999999.99999999.
- Item names are normalized; `items.normalized_name` is unique; `items.slug` is a nullable unique permanent slug used for URLs, with numeric IDs retained for legacy URLs and relations.
- Avoid destructive migrations without explicit approval.
- Tests use SQLite in-memory; do not run destructive commands against the development database.

## SSE Ingestion Rules

- Preserve existing parser behavior in `SseParser` and `SseEvent`.
- Do not replace SSE with polling.
- Maintain reconnection handling, backoff, jitter, and `Last-Event-ID` resume.
- Maintain duplicate protection in `ListingIngestService`.
- Keep the long-running command behavior of `StreamGrowtopiaListings`.
- Do not introduce queue systems or workers.
- Account for cPanel shared hosting constraints.
- Keep `--once` and verbose (`-v`) modes working.
- Events published while disconnected may be lost unless the SSE source supports replay; deduplication does not recover missing events.

## Analytics Rules

- Calculate buy and sell statistics separately.
- Use listing `posted_at` timestamps for historical windows.
- Distinguish advertised prices from confirmed transaction prices.
- Avoid misleading statistics from very small sample sizes.
- Prefer efficient SQL aggregation using existing indexes.
- Homepage "Top Items This Week" uses the current UTC calendar week (Monday 00:00 UTC to now).
- Item detail analytics default to a rolling 24-hour UTC window and also support 24H, 7D, 30D, 90D, 1Y.
- These time windows are intentionally different; differing counts are expected, not a bug.
- Empty state wording: "No listings in the selected time range."
- Analytics currently casts prices to PHP floats for in-memory statistics; this can lose precision for values beyond 2^53. Database storage remains exact.
- Top items ranking includes item slug for URL routing.

## Deployment Rules

- Respect cPanel limitations.
- Do not automatically start background workers.
- Do not modify production cron jobs without permission.
- Do not expose secrets.
- Avoid unnecessary infrastructure.
- SSE listener managed via cron watchdog + `flock` + `nohup`.

## Testing Rules

- Add or update tests for changed behavior.
- Run `php artisan test` for the full suite (SQLite in-memory).
- Run focused tests with `php artisan test --filter=...` or a file path.
- Run `vendor/bin/pint --dirty --format agent` after PHP changes.
- Do not claim tests passed unless they were executed.
- Preserve backward compatibility unless a change is explicitly requested.
- Current suite: 146 tests passing.

## Known Limitations and Future Considerations

- SSE reconnect gaps: events published while disconnected may be lost.
- PHP float precision in analytics for very large prices.
- Extreme or unrealistic listing prices.
- Data growth over time.
- Differences between calendar-week ranking and rolling detail windows.
- Admin dashboard is currently a placeholder; admin analytics not yet implemented.
- `getSetting()` references a `Setting` model that is not present in the codebase; verify before relying on it.
- Pint currently reports pre-existing style issues in several files; not part of documentation scope.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

When the user types `/graphify`, use the installed graphify skill or instructions before doing anything else.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- Dirty graphify-out/ files are expected after hooks or incremental updates; dirty graph files are not a reason to skip graphify. Only skip graphify if the task is about stale or incorrect graph output, or the user explicitly says not to use it.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).