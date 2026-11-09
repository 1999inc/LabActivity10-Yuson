# Bakuna Tracker

A Laravel Blade dashboard for viewing barangay vaccination schedules.

## Requirements

- PHP and Composer
- Node.js and npm
- SQLite, or another database configured in `.env`

## Setup

```sh
composer install
npm install
php artisan migrate:fresh --seed
```

`migrate:fresh` drops existing database tables before rebuilding them. Use it only when resetting the local project database.

In separate terminals, start Laravel and Vite:

```sh
php artisan serve
npm run dev
```

Open the URL printed by `php artisan serve`.

## Seeded sign-in

- Email: `nurse.yuson@bakuna.test`
- Password: `bakuna2026`

The database seeder creates this health-worker account and sample vaccination schedules.
