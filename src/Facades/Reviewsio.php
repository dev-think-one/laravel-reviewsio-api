<?php

namespace Reviewsio\Facades;

use Illuminate\Support\Facades\Facade;
use Reviewsio\ReviewsioApi;

/**
 * @method ReviewsioApi api()
 */
class Reviewsio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Reviewsio\Reviewsio::class ;
    }
}
