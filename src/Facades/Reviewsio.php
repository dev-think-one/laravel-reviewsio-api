<?php

namespace Reviewsio\Facades;

use Illuminate\Support\Facades\Facade;

class Reviewsio extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Reviewsio\Reviewsio::class ;
    }
}
