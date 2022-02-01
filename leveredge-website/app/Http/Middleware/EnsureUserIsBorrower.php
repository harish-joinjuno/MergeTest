<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class EnsureUserIsBorrower
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
        if ($request->user() && $request->user()->hasRole('borrower') ) {
            return $next($request);
        }

        return redirect('/home');
    }
}
