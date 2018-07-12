<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\CustomerToken;
use UserInfo;

class Login
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
        if($request->filled('token')){
            $token=CustomerToken::where('token',$request->input('token'))->where('status',1)->first();
            if(!empty($token)){
                $customer=$token->customer()->first();
                if(!empty($customer)){
                    UserInfo::setCustomer($customer);
                    UserInfo::setToken($token);
                }
            }
        }
        return $next($request);
    }
}
