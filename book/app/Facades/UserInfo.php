<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserInfo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userinfo';
    }
}