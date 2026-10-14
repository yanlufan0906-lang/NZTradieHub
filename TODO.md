# Remaining Work

## Product decisions

- [ ] Decide whether login and business registration belong in this application.
- [ ] If retained, implement authentication, CSRF-protected registration submission, persistence, and upload handling.
- [ ] Replace demo business configuration with a database-backed directory when production data is available.

## Application features

- [ ] Add an administration interface for quote requests and contact messages.
- [ ] Add email notifications for new submissions.
- [ ] Define and implement the quote-matching workflow.
- [ ] Decide whether an external Tradie Assist integration is required.

## Cleanup backlog

- [ ] Move the remaining inline homepage, contact, and quote JavaScript into page-specific files.
- [ ] Complete or remove unfinished registration interactions such as upload previews, area tags, and character counters.
- [ ] Remove the unused Laravel welcome/Vite scaffold or migrate active assets fully to Vite.
- [ ] Flatten the duplicated outer project directory after establishing a valid Git baseline.
- [ ] Resize and convert oversized images, and rename `automative.jpg` to `automotive.jpg`.
- [ ] Expand feature tests for filtering, invalid business slugs, validation, and persistence.
