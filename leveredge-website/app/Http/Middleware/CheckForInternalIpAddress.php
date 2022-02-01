<?php

namespace App\Http\Middleware;

use App\InternalIpAddress;
use Closure;

class CheckForInternalIpAddress
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
            if (user()->hasRole('admin') || user()->hasRole('nova-user')) {
                InternalIpAddress::firstOrCreate([
                    'ip' => $request->ip(),
                ], [
                    'name' => user()->name,
                ]);
            }
        }

        return $next($request);
    }
}
