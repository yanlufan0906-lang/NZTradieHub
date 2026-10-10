# NZ Businesses

NZ Businesses is a Laravel application for discovering New Zealand service providers, viewing demo business profiles, and submitting contact and quote requests.

## Current features

- Search and filter demo businesses by service, location, industry, and category.
- View individual business profiles and service information.
- Submit quote requests for a selected business.
- Submit contact messages.
- Browse informational pages such as pricing and lead information.
- Responsive shared layout, navigation, footer, form styles, and validation utilities.

## Prototype-only features

- Business registration is a six-step interface prototype. It does not persist registrations or upload files.
- Login is an interface prototype. Authentication is not implemented.
- Business listings come from `config/demo-businesses.php`, not a businesses database table.

## Requirements

- PHP 8.3 or later
- Composer
- SQLite or another Laravel-supported database

## Local setup

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

The active frontend assets are served directly from `public/css`, `public/js`, and `public/images`; no frontend build is required for the current pages.

## AI job-description improvement

The quote form can rewrite a customer's short job description through a
provider-neutral backend service. The default adapter uses the Gemini API with
`gemini-3.5-flash-lite`.

Add a Gemini API key to `.env`:

```env
AI_DESCRIPTION_PROVIDER=gemini
AI_DESCRIPTION_DAILY_LIMIT=10
AI_DESCRIPTION_TIMEOUT_SECONDS=30
GEMINI_API_KEY=your-api-key
GEMINI_MODEL=gemini-3.5-flash-lite
```

Then clear cached configuration:

```powershell
php artisan config:clear
```

The API key is used only by Laravel. The public endpoint is CSRF protected,
accepts at most 1,500 characters, and permits ten requests per authenticated
user or guest IP address within the daily rate-limit window.

Review the provider's current privacy terms before production use. Google's
Gemini free tier may use submitted content to improve its products.

## Tests

```powershell
php artisan test
```

## Important locations

- `app/Http/Controllers` — request handling and validation
- `config/demo-businesses.php` — demo directory data
- `public/css` — shared and page-specific styles
- `public/js` — shared validation and page behavior
- `resources/views` — Blade layouts, partials, and pages
- `routes/web.php` — web routes

See `PROJECT_REVIEW.md` for the current implementation boundary and `TODO.md` for remaining work.
