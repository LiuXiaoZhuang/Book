<?php

namespace App\Http\Middleware;

use Closure;
use ApiReturn;

/**
 * 数据返回层，定义所有的数据的返回类型
 */
class DataType
{

    private $dataType=array(
        'json',
        'base64',
        'view',
    );

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type='json')
    {
        if(!in_array($type, $this->dataType)){
            $type='json';
        }
        ApiReturn::{$type}();
        return $next($request);
    }
}
