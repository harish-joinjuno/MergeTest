<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;

class SetAffiliateCookie
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

        // Create the Affiliate Cookie
        if ($request->has('affiliate')) {
            $affiliate_cookie = Cookie::make('affiliate', $request->affiliate, 100000);
        }

        if ($request->has('grow')) {
            $affiliate_cookie = Cookie::make('affiliate', $request->grow, 100000);
        }

        // Queue for attaching to the response if created
        if (isset($affiliate_cookie)) {
            Cookie::queue($affiliate_cookie);
        }

        return $next($request);



    }
}
