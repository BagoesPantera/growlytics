# AGENTS.md

Persistent instructions for AI coding agents working on Growlytics.

## Project Identity

Growlytics is a Laravel 13 application that ingests Growtopia marketplace listings from an external SSE stream and stores historical pricing data. It provides item price history, buy/sell listing statistics, average advertised prices, marketplace trends, and analytics dashboards. The admin area uses a Bootstrap 5.3.6 template; the public/default pages use Laravel's Tailwind/Alpine starter stack.

## Mandatory Audit Before Coding

Before making changes, agents must:

1. Read this file.
2. Read relevant sections of `README.md`.
3. Inspect existing implementation patterns in the affected area.
4. Identify whether the task affects the admin (`/app`) or guest/public area.
5. Verify dependencies, routes, middleware, and layouts instead of assuming they exist.

## Frontend Rules — CRITICAL

Growlytics uses Bootstrap for the admin dashboard, NOT Tailwind CSS.

- Admin pages must extend `resources/views/apps/layouts/master.blade.php`.
- Load admin assets with `versioned_asset()` from `public/apps/`.
- Reuse existing partials in `resources/views/apps/layouts/partials/`.
- Do not generate Tailwind utility classes for admin pages.
- Do not install Tailwind, DaisyUI, Flowbite, or other Tailwind-based libraries.
- Do not rewrite or migrate the admin layout.
- Tailwind v3 and Alpine.js are only for default Laravel/Breeze pages through `resources/css/app.css`, `resources/js/app.js`, and Vite.
- `App\View\Components\AppLayout` and `GuestLayout` render Tailwind layouts (`layouts.app`, `layouts.guest`), not Bootstrap.
- `guest_asset()` serves assets under `public/guest/`.

## Admin and Guest Separation

- Admin routes live in `routes/web/apps.php`: prefix `app`, name `app.`, middleware `auth` and `role:admin`.
- Public routes live in `routes/web/guest.php`.
- Admin controllers live under `app/Http/Controllers/Apps/`.
- Guest controllers live under `app/Http/Controllers/Guest/`.
- `RoleMiddleware` (`app/Http/Middleware/RoleMiddleware.php`) checks `Auth::user()->role`; unauthorized guests receive 404, forbidden roles receive 403.
- The admin dashboard view is `resources/views/apps/dashboard/index.blade.php`.
- The public home controller currently returns an empty string; do not assume public pages are implemented.
- Do not mix admin and guest navigation or layouts.
- Do not assume shared components exist unless verified.

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
- Do not silently round or alter `price_wl`; reject fractional or negative values.
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

## Analytics Rules

Future analytics should:

- Calculate buy and sell statistics separately.
- Use listing `posted_at` timestamps for historical windows.
- Distinguish advertised prices from confirmed transaction prices.
- Avoid misleading statistics from very small sample sizes.
- Prefer efficient SQL aggregation using existing indexes.

## Testing and Quality

- Add or update tests for changed behavior.
- Run `php artisan test` for the full suite.
- Run focused tests with `php artisan test --filter=...` or a file path.
- Run `vendor/bin/pint --dirty --format agent` after PHP changes.
- Do not claim tests passed unless they were executed.
- Preserve backward compatibility unless a change is explicitly requested.
- Current known issue: one test fails because `config/app.php` sets `Asia/Makassar` instead of UTC.

## Deployment Safety

- Do not expose `.env` secrets.
- Do not silently change production configuration.
- Do not automatically start long-running processes.
- Do not modify production cron jobs without permission.
- Respect existing cPanel deployment conventions.
- `UsersTableSeeder` contains sample accounts; do not expose or rely on its credentials in documentation.

## Agent Workflow

For future coding tasks:

1. Inspect relevant files.
2. Explain intended changes briefly.
3. Implement using existing conventions.
4. Add or update tests.
5. Run applicable checks.
6. Summarize changed files.
7. Report remaining limitations.

## graphify

This project has a knowledge graph at graphify-out/ with god nodes, community structure, and cross-file relationships.

When the user types `/graphify`, use the installed graphify skill or instructions before doing anything else.

Rules:
- For codebase questions, first run `graphify query "<question>"` when graphify-out/graph.json exists. Use `graphify path "<A>" "<B>"` for relationships and `graphify explain "<concept>"` for focused concepts. These return a scoped subgraph, usually much smaller than GRAPH_REPORT.md or raw grep output.
- Dirty graphify-out/ files are expected after hooks or incremental updates; dirty graph files are not a reason to skip graphify. Only skip graphify if the task is about stale or incorrect graph output, or the user explicitly says not to use it.
- If graphify-out/wiki/index.md exists, use it for broad navigation instead of raw source browsing.
- Read graphify-out/GRAPH_REPORT.md only for broad architecture review or when query/path/explain do not surface enough context.
- After modifying code, run `graphify update .` to keep the graph current (AST-only, no API cost).
