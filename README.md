# Laravel reviews.io api.

![Packagist License](https://img.shields.io/packagist/l/yaroslawww/laravel-reviewsio-api?color=%234dc71f)
[![Packagist Version](https://img.shields.io/packagist/v/yaroslawww/laravel-reviewsio-api)](https://packagist.org/packages/yaroslawww/laravel-reviewsio-api)
[![Total Downloads](https://img.shields.io/packagist/dt/yaroslawww/laravel-reviewsio-api)](https://packagist.org/packages/yaroslawww/laravel-reviewsio-api)
[![Build Status](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/badges/build.png?b=main)](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/build-status/main)
[![Code Coverage](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/?branch=main)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/yaroslawww/laravel-reviewsio-api/?branch=main)

API docs are [there](https://api.reviews.io/documentation/index.html).

NOTE: currently there is small coverage of api endpoints, and oriented to open api routes. <br>
(Package is targeted to the tasks what I have, not for support fully api, sorry).

## Installation

Install the package via composer:

```bash
composer require yaroslawww/laravel-reviewsio-api
```

Optionally you can publish the config file with:

```bash
php artisan vendor:publish --provider="Reviewsio\ServiceProvider" --tag="config"
```

## Usage

```php
use Reviewsio\Facades\Reviewsio;

/** @var \Reviewsio\Endpoints\ProductReviewBySku\Response $response */
$response = Reviewsio::api()
        ->productReviewBySku()
        ->sku('The Reach')
        ->paginate()
        ->call([
            'minRating' => 2,
        ]);
        
$reviewsCollection = $response->reviews();
$total = $response->total();
$perPage = $response->perPage();
$currentPage = $response->currentPage();
```

## Credits

- [![Think Studio](https://yaroslawww.github.io/images/sponsors/packages/logo-think-studio.png)](https://think.studio/) 
