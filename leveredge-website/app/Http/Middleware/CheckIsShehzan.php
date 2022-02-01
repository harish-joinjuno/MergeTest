<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsShehzan
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
        if (!$request->user()->email === 'shehzan.maredia@duke.edu' && !$request->user()->hasRole('admin')) {
            abort(401);
        }

        return $next($request);
    }
}
