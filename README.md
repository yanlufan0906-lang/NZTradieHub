# TradyNZ Client Demo Version

This version is prepared for a client-facing demonstration of the NZ Businesses / TradyNZ directory flow.

## Main demo flows

1. Home page: search for a service and location.
2. Business list: filter by service, location, industry, or category.
3. Business profile: view details and request a quote.
4. Quote request: submit a customer enquiry without needing to log in.
5. Contact Us: send a general message without needing to log in.
6. List Your Business: complete a business registration flow, preview uploaded images/files, and submit the registration.

## What was polished

- Contact Us no longer looks like it requires login.
- Customer quote requests can open directly from `/quote` or from a selected business.
- The quote form email validation only runs on the contact-details step.
- Business registration now posts to Laravel instead of only being a front-end placeholder.
- Business logo, cover photo, government ID, and trade license uploads now support preview, drag/drop, file type validation, and 5 MB size validation.
- Business service areas selector now works with tags.
- Contact and quote submissions have demo fallback references if the database is not available.
- About and Privacy footer links now open real pages.

## Run locally

```bash
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

If the database is not set up yet, normal browsing, Contact, and Quote can still be demonstrated using demo fallback reference numbers. For full database saving, ensure the SQLite PHP extension is enabled and run `php artisan migrate`.

## Useful URLs

- `/` Home
- `/businesses` Business list
- `/quote` Quote request
- `/contact` Contact form
- `/businesses/register` Business registration
