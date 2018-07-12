<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CacheData extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cachedata';
    }
}