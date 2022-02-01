<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class TrackSourceMiddleware
{
    protected $trackableParams = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'utm_id',
        'gclid',
    ];

    protected $excepts = [
        '/affiliate-tracking.png',
        '/tracking-pixel.png',
    ];

    public function handle($request, Closure $next)
    {
        if (in_array($request->getRequestUri(), $this->excepts)) {
            return $next($request);
        }

        if ($request->user()) {
            if (Cookie::has('tracking_sources')) {
                $cookie = cookie()->forget('tracking_sources');
                Cookie::queue($cookie);
            }

            return $next($request);
        }

        $cookieCleared    = false;
        $trackableSources = [];

        foreach ($this->trackableParams as $param) {
            if ($request->filled($param)) {
                if (! $cookieCleared) {
                    $cookieCleared = true;
                    cookie()->forget('tracking_sources');
                }

                $trackableSources[$param] = $request->get($param);
            }
        }

        if ($cookieCleared && $request->filled('utm_source') && $request->get('utm_source') === 'bold') {
            $trackableSources['subId1'] = $request->get('subId1');
        }

        if (! empty($trackableSources)) {
            $cookie = cookie()->forever('tracking_sources', serialize($trackableSources));
            Cookie::queue($cookie);
        }

        return $next($request);
    }
}
