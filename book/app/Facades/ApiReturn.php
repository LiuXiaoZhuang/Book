<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiReturn extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apireturn';
    }
}