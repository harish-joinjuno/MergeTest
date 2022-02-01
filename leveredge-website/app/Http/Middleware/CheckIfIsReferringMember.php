<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\View;

class CheckIfIsReferringMember
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
        if ($request->filled('grow')) {
            $user = User::whereReferralCode($request->get('grow'))->first();
            if ($user && $user->hasRole('borrower') && ! $user->hasRole('partner')) {
                View::share('referringMember', $user);
            }
        }

        return $next($request);
    }
}
