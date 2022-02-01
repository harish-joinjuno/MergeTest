<?php

namespace App\Http\Middleware;

use App\Client;
use Closure;
use Illuminate\Support\Facades\Cookie;

class SetClientId
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
        if (!Cookie::has('client_id') ) {
            $client = new Client();
            $client->save();
            $client->refresh();

            Cookie::queue('client_id', $client->id, 2628000);
        }

        return $next($request);
    }
}
