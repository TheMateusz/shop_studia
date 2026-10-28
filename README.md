# Laravel Shop

An academic e-commerce application built with Laravel 10 and PHP 8.1+, with product administration, a session cart, order history and Przelewy24 integration code.

## Features

- Registration, login and email verification.
- Products, categories and product images.
- User and administrator roles enforced through Laravel gates.
- A session-based cart using Cart and CartItem value objects.
- Order creation and paginated order history.
- Przelewy24 transaction initialization and payment-status callbacks.

## Stack

PHP 8.1+, Laravel 10, Eloquent, MySQL, Blade, Bootstrap, JavaScript, SCSS and Vite. Payment integration uses devpark/laravel-przelewy24.

## Local setup

Requires PHP compatible with composer.lock, Composer, Node.js/npm and MySQL.

```sh
composer install
cp .env.example .env
php artisan key:generate
npm ci
```

On PowerShell, use `Copy-Item .env.example .env`. Create an empty database and configure DB_DATABASE, DB_USERNAME and DB_PASSWORD in .env. Configure an email transport for account verification.

```sh
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

For frontend development, run `npm run dev` separately. The seeder creates categories, not demo products or an administrator. Assign the role defined in app/Enums/UserRole.php to a local test user for administration access.

### Payments

Use sandbox credentials and PRZELEWY24_TEST_SERVER=true for testing. Configure PRZELEWY24_MERCHANT_ID, PRZELEWY24_POS_ID, PRZELEWY24_CRC and PRZELEWY24_REPORT_KEY. See config/transfers24.php for return and status URL settings; the payment-status route is /payment/status and must be reachable by the provider for callback testing.

## Code map

| Area | Location |
| --- | --- |
| Routes | routes/web.php |
| Cart | app/ValueObjects/ and CartController |
| Orders and transactions | app/Http/Controllers/OrderController.php |
| Payment callbacks | app/Http/Controllers/PaymentController.php |
| Role gates | app/Providers/AuthServiceProvider.php |
| Database | database/migrations/ |
| Interface | resources/views/, resources/js/, resources/sass/ |

## Project status

Academic project from 2023. Documentation was checked against the source; a fresh installation and external payment flow have not been verified during this update. Existing tests are Laravel examples, not a business-logic regression suite. Dependency and application review are needed before deployment.
