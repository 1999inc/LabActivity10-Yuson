# Barangay Bulletin – Purok Yuson

A Laravel Blade application for browsing Barangay Matina Crossing announcements and updates.

## Assignment details

- Posts per page: 5, as requested for this project (Yuson has five letters; the assignment's default minimum is six).
- Custom category: `Off-Topic`.
- Pinned Kagawad post date: May 23, 2026.

## Setup and run

```sh
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate:fresh --seed
npm run dev
```

`migrate:fresh` drops existing database tables before rebuilding them. Use it only when resetting the local project database. Configure `.env` to use SQLite before migrating.

In a second terminal, start Laravel:

```sh
php artisan serve
```

Open the URL printed by `php artisan serve` to browse, search, and filter published posts.
