<?php

namespace App\Http\Middleware;

use App\ClientRequest;
use Closure;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class SaveClientRequest
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
        $crawlerDetect               = new CrawlerDetect();
        $clientRequest               = new ClientRequest();
        $clientRequest->client_id    = getClientId();
        $clientRequest->method       = substr($request->method(),0,255);
        $clientRequest->path         = substr($request->path(),0,255);
        $clientRequest->query_string = substr(substr($request->fullUrl(), strlen($request->url())),0,65000);
        $clientRequest->ip           = substr($request->ip(),0,255);
        $clientRequest->user_agent   = substr($request->userAgent(),0,255);
        $clientRequest->date         = now();

        if ($request->has('utm_source')) {
            $clientRequest->utm_source = substr($request->utm_source,0,255);
        }
        if ( $request->has('utm_medium')) {
            $clientRequest->utm_medium = substr($request->utm_medium,0,255);
        }
        if ( $request->has('utm_campaign')) {
            $clientRequest->utm_campaign = substr($request->utm_campaign,0,255);
        }
        if ( $request->has('utm_content')) {
            $clientRequest->utm_content = substr($request->utm_content,0,255);
        }
        if ( $request->has('utm_term')) {
            $clientRequest->utm_term = substr($request->utm_term,0,255);
        }
        if ( $request->has('utm_id')) {
            $clientRequest->utm_id = substr($request->utm_id,0,255);
        }


        if ($crawlerDetect->isCrawler($clientRequest->user_agent)) {
            $clientRequest->crawler = true;
        }
        $clientRequest->save();

        return $next($request);
    }
}
