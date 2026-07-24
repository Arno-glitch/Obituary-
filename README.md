# Obituary Management Platform (Laravel)

A web application for submitting, managing, and displaying obituaries, with
SEO and Social Media Optimization built in.

## What's in this repo

This contains the **application-specific files** for the assignment layered
on top of a standard Laravel install (Laravel doesn't ship its skeleton
files — `vendor/`, `bootstrap/`, `artisan`, etc. — through a code drop; they
come from `composer create-project`). Follow the setup steps below to get a
fully working project.

| Assignment Task | File(s) |
|---|---|
| Task 1: Environment Setup | `.env.example`, steps below |
| Task 2: Database Creation | `database/migrations/2024_01_01_000000_create_obituaries_table.php` |
| Task 3: HTML Form | `resources/views/obituaries/create.blade.php`, `public/css/style.css`, `public/js/validate.js` |
| Task 4: Submission script | `app/Http/Controllers/ObituaryController.php` (`store`), `app/Http/Requests/StoreObituaryRequest.php` |
| Task 5: Retrieval script | `app/Http/Controllers/ObituaryController.php` (`index`), `resources/views/obituaries/index.blade.php` |
| Task 6: SEO & Social | `resources/views/layouts/app.blade.php`, `resources/views/obituaries/show.blade.php`, `app/Http/Controllers/SitemapController.php`, `resources/views/sitemap.blade.php` |
| Task 7: Testing | `tests/Feature/ObituaryTest.php`, `database/factories/ObituaryFactory.php` |

**Note on naming:** the spec asks for scripts named `submit_obituary` and
`view_obituaries`. In Laravel, form submission and data retrieval are
implemented as the `store()` and `index()` methods on `ObituaryController`
rather than as separate files — that's the idiomatic Laravel equivalent of
those two scripts.

## 1. Environment Setup (Task 1)

Requirements: PHP 8.2+, Composer, MySQL/PostgreSQL/SQLite.

```bash
# Scaffold a fresh Laravel app, then copy this repo's files over it
composer create-project laravel/laravel obituary-platform
cd obituary-platform

# Copy in the files from this repo (app/, database/, resources/, routes/, public/css, public/js, tests/)
# then:
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your DB credentials, then confirm the DB service is running
locally (e.g. `mysql.server start` / `sudo service mysql start`, or use
`sqlite` with `DB_CONNECTION=sqlite` and a `database/database.sqlite` file
for the simplest local setup).

## 2. Database Creation (Task 2)

```bash
# Create the database first, e.g.:
mysql -u root -e "CREATE DATABASE obituary_platform"

# Then run the migration to create the `obituaries` table
php artisan migrate
```

## 3–6. Run the app

```bash
php artisan serve
```

- Form: `http://localhost:8000/obituaries/create`
- Listing (paginated): `http://localhost:8000/obituaries`
- Single obituary (SEO/OG/schema.org/canonical/share buttons): `http://localhost:8000/obituaries/{slug}`
- XML sitemap: `http://localhost:8000/sitemap.xml`

Optionally seed sample data for testing:

```bash
php artisan tinker
>>> App\Models\Obituary::factory()->count(20)->create();
```

## 7. Testing and Validation (Task 7)

```bash
php artisan test
```

`tests/Feature/ObituaryTest.php` covers: form load, valid submission and
storage, missing-field validation, invalid date range (edge case), paginated
listing, SEO/OG tag presence on the show page, and sitemap generation.

## Deliverables checklist

- [x] `obituaries.create` route/view — HTML form for submitting obituaries
- [x] `ObituaryController@store` — handles submission and storage
- [x] `ObituaryController@index` — retrieves and displays stored obituaries
- [x] `obituary_platform` database + `obituaries` table (migration)
- [x] This README documents setup, development process, and usage

## Pushing this to GitHub

```bash
git init
git add .
git commit -m "Obituary management platform (Laravel)"
git branch -M main
git remote add origin https://github.com/<your-username>/<your-repo>.git
git push -u origin main
```

Make sure `.env` (with real credentials) is **not** committed — it's already
excluded via `.gitignore`.
