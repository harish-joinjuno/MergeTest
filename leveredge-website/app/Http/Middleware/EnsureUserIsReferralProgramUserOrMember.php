<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class EnsureUserIsReferralProgramUserOrMember
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
        if (
            $request->user()
            && ( $request->user()->hasRole(Role::ROLE_NAME_ADMIN)
                || $request->user()->hasRole(Role::ROLE_NAME_REFERRAL_PROGRAM_USER)
                || $request->user()->hasRole(Role::ROLE_NAME_BORROWER) )
        ) {
            return $next($request);
        }

        abort(403, 'You are not authorized to view this information');
    }
}
