<?php

namespace App\Http\Middleware;

use Closure;

class UpdateInternationalStudentProfileMiddleware
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
        if (auth()->check() && session()->has('international_student_update_profile') && $request->path() !== 'user-profile/international-student-profile-update') {
            return redirect('/user-profile/international-student-profile-update');
        }

        return $next($request);
    }
}
