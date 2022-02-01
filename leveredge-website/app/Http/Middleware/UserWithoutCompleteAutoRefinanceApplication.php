<?php

namespace App\Http\Middleware;

use App\AutoRefinanceApplication;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserWithoutCompleteAutoRefinanceApplication
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
            return $next($request);
        }

        if ( AutoRefinanceApplication::where('user_id',user()->id)->exists()) {
            return redirect('/loans/auto-refinance/post-auth');
        }

        return $next($request);
    }
}
