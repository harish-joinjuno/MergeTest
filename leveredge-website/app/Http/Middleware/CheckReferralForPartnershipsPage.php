<?php

namespace App\Http\Middleware;

use App\LandingPage;
use Closure;

class CheckReferralForPartnershipsPage
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
        $urlArr      = explode('/', $request->url());
        $landingPage = LandingPage::whereSlug(end($urlArr))->firstOrFail();

        if (! $request->has('grow')) {
            return redirect()->to($request->url() . '?grow=' . $landingPage->partner_profile->user->referral_code);
        }

        return $next($request);
    }
}
