<?php

namespace App\Http\Middleware;

use Closure;

class VerifyRequestFromBoldHostName
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
//        $referer = preg_replace('/http(s)?:\/\//', '', request()->server('HTTP_REFERER'));

        $config = config('services.bold');

//        if ($referer !== $config['host']) {
//            return abort(404);
//        }

        if (! $request->has($config['secret_key_name'])) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Secret key is missing'
            ], 400);
        }

        if ($request->get($config['secret_key_name']) !== $config['secret_key']) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Secret key is not matching'
            ], 400);
        }

        return $next($request);
    }
}
