<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class CheckTransitionAnimation
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
        if (! $request->is('p/*') && ! Cookie::has('saw_transition') && $request->has('is_redirect_to_join_juno')) {
            $cookie = cookie()->forever('saw_transition', true);
            Cookie::queue($cookie);
            View::share('displayTransitionAnimation', true);
        }

        return $next($request);
    }
}
