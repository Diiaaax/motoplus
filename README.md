<p align="center"><img src="https://img.shields.io/badge/MotoPlus-Electric%20Mobility-16a34a?style=for-the-badge" alt="MotoPlus"></p>

# MotoPlus — Electric Motorcycle Dealership (Algeria)

Plateforme e-commerce premium pour la vente de motos électriques, scooters, batteries et accessoires en Algérie, avec livraison dans les 58 wilayas.

## Stack

- **Backend:** Laravel 12, PHP 8.3
- **Frontend:** Tailwind CSS v4, Alpine.js, Blade
- **Admin Panel:** Filament 3
- **Database:** MariaDB / MySQL 8
- **Caching:** Redis (via Predis)

## Installation

```bash
git clone https://github.com/Diiaaax/motoplus.git
cd motoplus
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Admin Access

Seeded with `AdminUserSeeder`. Set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `.env` before running `php artisan migrate --seed`.
If `ADMIN_PASSWORD` is empty, a random password is generated and printed once in the console.

## Tests

```bash
php artisan test
```

34 tests — covering units (Brand, DeliveryService, FinancingService) and features (Home, Search, CatalogFilters, Sitemap).

## Sitemap

Dynamic XML sitemap at `/sitemap.xml` — includes static pages, products, and brands.

## Features

- Catalog with filters (brand, category, vehicle type, price range)
- Live search with Alpine.js
- Compare up to 4 vehicles
- Financing calculator with configurable terms
- Nationwide delivery pricing (58 wilayas, door/stopdesk)
- Wishlist (session-based)
- FAQ, Blog, Contact form (rate-limited)
- Coupons & promotions
- Product reviews & Q&A
- SEO metadata per product
- Responsive dark/glassmorphism design

## Rate Limiting

- Contact form: 3 submissions per minute per IP (Livewire rate limiter)
- Login: 60 attempts per minute (Laravel default)

## CI/CD

GitHub Actions workflow runs tests on push/PR to `main`/`develop` (`.github/workflows/tests.yml`).

## License

Proprietary — all rights reserved.
