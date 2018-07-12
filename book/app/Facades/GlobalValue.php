<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GlobalValue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'globalvalue';
    }
}