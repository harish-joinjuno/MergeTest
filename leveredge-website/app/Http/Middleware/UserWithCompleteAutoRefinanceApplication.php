<?php

namespace App\Http\Middleware;

use App\AutoRefinanceApplication;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserWithCompleteAutoRefinanceApplication
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
        if (!Auth::check()) {
            return redirect('/loans/auto-refinance/get-started/start');
        }

        if ( !AutoRefinanceApplication::where('user_id',user()->id)->exists()) {
            return redirect('/loans/auto-refinance/get-started/start');
        }

        return $next($request);
    }
}
