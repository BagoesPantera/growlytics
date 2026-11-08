<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Growlytics — SSE Data Ingestion

Growlytics collects real-time Growtopia marketplace listings from an external
Server-Sent Events (SSE) endpoint and stores them for later price analytics.

### Configuration

Set the stream endpoint in `.env` (already wired through `config/services.php`):

```env
GROWLYTICS_STREAM_URL=https://example.com/stream
```

Optional tuning (defaults shown):

```env
# GROWLYTICS_STREAM_CONNECT_TIMEOUT=15   # seconds to establish the connection
# GROWLYTICS_STREAM_READ_TIMEOUT=60     # seconds of stream inactivity before reconnecting
# GROWLYTICS_STREAM_RETRY_DELAY=5       # base reconnect backoff (seconds)
# GROWLYTICS_STREAM_MAX_RETRY_DELAY=60  # backoff ceiling (seconds)
# GROWLYTICS_STREAM_MAX_EVENT_SIZE=65536  # bytes; larger SSE events are dropped
```

### Running the ingestion

```bash
# Apply the items/listings schema
php artisan migrate

# Start the long-lived SSE listener
php artisan growlytics:stream

# Show per-listing console output (saved / duplicate / rejected)
php artisan growlytics:stream -v

# Process exactly one connection cycle then exit (debugging / tests)
php artisan growlytics:stream --once
```

The command reconnects automatically with bounded exponential backoff (plus
jitter and any server `retry:` hint), resends the SSE `Last-Event-ID` header on
reconnect when one was seen, and exits immediately on permanent HTTP errors
(401/403/404). Run it under a supervisor (e.g. systemd or Supervisor) in
production.

### How duplicates are prevented

Every event's JSON `id` is stored as `listings.external_id`, which has a unique
index. An ingest runs inside a transaction; if the insert hits the unique
constraint (either a fast repeat from the stream or a race with another
process), the existing row is left untouched and the event is reported as a
duplicate. Historical records are never overwritten or aggregated.

### Known limitations

- The source may not support replay: if it ignores `Last-Event-ID`, events
  posted while the listener was disconnected are lost.
- The SSE `id:` field is tracked for resume purposes only; the listing's
  `external_id` always comes from the JSON payload.
- Graceful SIGTERM/SIGINT shutdown requires PCNTL (not available on Windows);
  elsewhere Ctrl+C terminates the process directly.
- `priceWl` is stored as an integer; fractional or negative prices are rejected
  and logged, never rounded.
- UTC storage assumes `APP_TIMEZONE` remains its default `UTC`.

### Tests

```bash
php artisan test
```

The suite covers ingestion, normalization, duplicate handling, timestamp
precision, malformed payload rejection, and SSE parsing (heartbeats, partial
chunks, CRLF) using fakes only — no access to the real stream is required.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
