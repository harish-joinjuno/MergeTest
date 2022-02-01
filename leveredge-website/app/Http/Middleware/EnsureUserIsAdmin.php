<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class EnsureUserIsAdmin
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
        if ($request->user() && $request->user()->hasRole('admin') ){
            return $next($request);
        }else{
            abort(403, 'You are not authorized to view this information');
        }
    }
}
