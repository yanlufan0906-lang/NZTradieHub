# Project Review

## Current direction

NZ Businesses is currently a business-directory and request-submission prototype. Its production-ready scope is limited to browsing demo businesses and storing contact and quote requests.

## Implemented

### Business directory

- Demo business records are maintained in `config/demo-businesses.php`.
- Directory filtering supports service text, location, industry, and category.
- Business profile pages expose services, service areas, contact details, ratings, and quote links.
- Invalid business slugs return a 404 response.

### Quote requests

- Quote links prefill the selected business, service, and location.
- Client-side and server-side validation are present.
- Valid requests are stored in the `quote_requests` table.
- Successful submissions display a generated reference number.

### Contact messages

- The contact page uses a single-page form with shared client-side validation.
- Server-side validation is handled by `ContactController`.
- Valid messages are stored in the `contact_messages` table.
- Successful submissions display a generated reference number.

### Shared frontend structure

- `resources/views/layouts/app.blade.php` owns the document shell and shared assets.
- Shared header and footer partials provide site navigation.
- Shared CSS is separated from page-specific styles.
- `public/js/form-validation.js` provides common form-validation behavior.

## Prototype boundaries

### Business registration

`/businesses/register` displays a six-step interface, but JavaScript prevents final submission and shows a local success state. No registration data or uploaded files are persisted. The existing POST route returns an informational confirmation only.

### Login

`/login` displays a validated login interface, but no authentication request is submitted and no authenticated session is created.

### Business data

There is no businesses table or management interface. Directory content remains configuration-backed demo data.

## Operational notes

- Active frontend assets are loaded directly from `public/css`, `public/js`, and `public/images`.
- The default Laravel Vite scaffold remains present but is not used by active pages.
- `vendor`, runtime logs, compiled views, framework caches, and the local SQLite database are generated or environment-managed content rather than application source.
- Remaining decisions and cleanup work are tracked in `TODO.md`.
