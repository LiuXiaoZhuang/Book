<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\ApiReturn;
use App\Libs\GlobalValue;
use App\Libs\CommonFunc;
use App\Libs\UserInfo;
use App\Libs\CacheData;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('apireturn',function(){
            return new ApiReturn;
        });
        
        $this->app->singleton('globalvalue',function(){
            return new GlobalValue;
        });

        $this->app->singleton('commonfunc',function(){
            return new CommonFunc;
        });

        $this->app->singleton('userinfo',function(){
            return new UserInfo;
        });

        $this->app->singleton('cachedata',function(){
            return new CacheData;
        });
        
    }
}
