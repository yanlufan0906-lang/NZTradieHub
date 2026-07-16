# Who We Are / Contributors Page

## Page URL

`/who-we-are`

The Home page footer now includes:

**Company → Who We Are**

## Update team member details

Open:

`config/contributors.php`

Each contributor contains:

- `name` — person's name
- `role` — job title
- `group` — team category shown as the small label
- `contribution` — what the person contributed to the project
- `initials` — letters displayed in the avatar box

Replace the placeholder names with the confirmed names before final presentation or deployment.

## Main files added or changed

- `config/contributors.php`
- `resources/views/static/contributors.blade.php`
- `public/css/contributors.css`
- `app/Http/Controllers/PageController.php`
- `routes/web.php`
- `resources/views/partials/footer.blade.php`
