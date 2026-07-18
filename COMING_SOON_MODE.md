# Coming Soon mode

The project is currently configured to show only the Coming Soon page.

## Current setting

In `.env`:

```env
REAL_API_CONNECTED=false
```

While this value is `false`:

- `/` displays the Coming Soon page.
- Every other website URL also displays the Coming Soon page.
- Existing business search, profiles, registration, login, dashboard, quote, contact, and contributors features remain in the code but are not publicly accessible.

## Restore the full website after the real API is connected

Change `.env` to:

```env
REAL_API_CONNECTED=true
```

Then clear Laravel's cached configuration:

```bash
php artisan optimize:clear
```

Restart the local server if it is running:

```bash
php artisan serve
```
