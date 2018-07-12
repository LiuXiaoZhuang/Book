<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\AccountException;
use App\Models\CustomerToken;
use UserInfo;

class LoginToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->filled('token')){
            throw new LoginInvalidException();
        }
        $token=CustomerToken::where('token',$request->input('token'))->where('status',1)->first();
        if(empty($token)){
            throw new LoginInvalidException();
        }
        $customer=$token->customer()->first();
        if(empty($customer)){
            throw new AccountException('用户不存在');
        }
        UserInfo::setCustomer($customer);
        UserInfo::setToken($token);
        return $next($request);
    }
}
