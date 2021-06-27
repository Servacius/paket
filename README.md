# Sistem Penerimaan Paket Barang

## Prerequisite

-   PHP `^7.3`
-   Node.js `8.10.0`
-   npm `3.5.2`
-   Composer `1.6.3`
-   MySQL `5.7`

## Installation

-   Clone this project by run command `git clone git@github.com:Servacius/paket.git`.
-   Run `composer install` to download all PHP dependencies.
-   Run `npm install` to download all Node.js dependencies.
-   Copy `.env.example` to `.env`.
-   Run `php artisan key:generate` to generate `APP_KEY` in `.env` file.
-   Run `php artisan storage:link` to create storage symbolic link in local.

## Migration

-   Import database schema.
-   Update database config in `.env` file.
-   Run `php artisan migrate --seed` to generate the database schema and run the database seeder.

## Run

-   Run `php artisan serve` to start PHP server.
-   Run `npm run watch` to start Node.js server.

## Mail Configuration

In this project we support to send email in feature: **tambah paket**.
To ensure this function works, the mail set-up in `.env` should be like this.

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=YOUR_EMAIL_ADDRESS(GMAIL)
MAIL_PASSWORD=YOUR_EMAIL_PASSWORD
MAIL_ENCRYPTION=ssl
```
