# Client Demo Changes

## Customer-facing flow

- Contact Us is public and does not require login.
- The shared public header now shows Browse, Contact, and List Your Business instead of pushing users toward Login.
- Quote requests can now be opened directly from `/quote` or from a selected business card/profile.
- Quote form JavaScript bug fixed: email validation only blocks the Contact Details step, not Step 1.
- Quote page now has the same public header for easier navigation.

## Business listing flow

- `/businesses/register` now submits to Laravel with POST and CSRF protection.
- The form uses `enctype="multipart/form-data"`, so file uploads are handled correctly.
- Business logo, cover photo, government ID, and trade license upload boxes now support:
  - click-to-select
  - drag and drop
  - image preview
  - selected file name and size display
  - file type validation
  - 5 MB size limit
- Areas Served selector now works with dropdown checkboxes and removable tags.
- Character counters now work for profile textareas.
- Final submit validates all steps before posting.

## Demo reliability

- Contact and Quote submissions now use database saving when available, but fall back to demo reference numbers if the database is not configured.
- `.env.example` now uses file-based session/cache and sync queue, which is easier for local demo running.
- Footer About and Privacy links now open real pages instead of redirecting to the home page.

## Tested

- Main pages returned HTTP 200 locally: `/`, `/contact`, `/businesses`, `/quote`, `/businesses/register`, `/pages/about`, `/pages/privacy`.
- Contact form POST returned a success page with a demo reference number.
- Quote form POST returned a success page with a demo reference number.
- Business registration POST returned a success page with a demo reference number.
- PHP files passed syntax checks.
- `public/js/business.js` passed JavaScript syntax check.

- Removed Contact from the top navigation and removed the entire Company section from the footer, per client presentation feedback.
