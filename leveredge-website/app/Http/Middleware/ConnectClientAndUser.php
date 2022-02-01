<?php

namespace App\Http\Middleware;

use App\UserClient;
use Closure;
use Illuminate\Support\Facades\Auth;

class ConnectClientAndUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (Auth::check()) {
            UserClient::firstOrCreate([
                'user_id'   => user()->id,
                'client_id' => getClientId(),
            ]);
        }

        return $response;
    }
}
