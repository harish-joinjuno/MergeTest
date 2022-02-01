<?php

namespace App\Http\Middleware;

use Closure;

class CheckBarPrepAppStarted
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
        if (auth()->check()) {
            if (! userProfile()->bar_prep_app_started) {
                return redirect()->to('/member/bar-prep-signup');
            } else {
                return $next($request);
            }
        }

        return redirect()->to('/login');
    }
}
