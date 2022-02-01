<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class PasswordProtect
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

        if(Request::isMethod('post')) {
            if ($request->password == 'LeverEdgeSecurity') {
                Cookie::queue(Cookie::make('password-entered', 'true', 2400));
                return $next($request);
            }else{
                Session::flash('alert', "You entered an incorrect password. Reach out to Nikhil (email nikhil@joinjuno.com) if you believe you should have access to this data");
                return response()->view('enter-password');
            }
        }

        if( Cookie::has('password-entered') ){
            return $next($request);
        }

        return response()->view('enter-password');
    }
}
