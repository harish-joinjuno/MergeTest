<?php

namespace App\Http;

use App\Http\Middleware\CheckBarPrepAppStarted;
use App\Http\Middleware\CheckForInternalIpAddress;
use App\Http\Middleware\CheckIfIsReferringMember;
use App\Http\Middleware\CheckIsShehzan;
use App\Http\Middleware\CheckReferralForPartnershipsPage;
use App\Http\Middleware\CheckTransitionAnimation;
use App\Http\Middleware\ConnectClientAndUser;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsBorrower;
use App\Http\Middleware\EnsureUserIsLender;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use App\Http\Middleware\EnsureUserIsReferralProgramUserOrMember;
use App\Http\Middleware\PasswordProtect;
use App\Http\Middleware\SaveClientRequest;
use App\Http\Middleware\SentryContext;
use App\Http\Middleware\SetAffiliateCookie;
use App\Http\Middleware\SetClientId;
use App\Http\Middleware\TrackSourceMiddleware;
use App\Http\Middleware\UpdateInternationalStudentProfileMiddleware;
use App\Http\Middleware\UserWithCompleteAutoRefinanceApplication;
use App\Http\Middleware\UserWithoutCompleteAutoRefinanceApplication;
use App\Http\Middleware\VerifyRequestFromBoldHostName;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
//        \App\Http\Middleware\Admin::class,
        SentryContext::class,
        SetAffiliateCookie::class,
        SetClientId::class,
        SaveClientRequest::class,
        ConnectClientAndUser::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
             \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            TrackSourceMiddleware::class,
            UpdateInternationalStudentProfileMiddleware::class,
            CheckTransitionAnimation::class,
            CheckIfIsReferringMember::class,
            CheckForInternalIpAddress::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                                                 => \App\Http\Middleware\Authenticate::class,
        'auth.basic'                                           => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'                                             => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers'                                        => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can'                                                  => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                                                => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed'                                               => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle'                                             => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified'                                             => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'password-protected'                                   => PasswordProtect::class,
        'lender'                                               => EnsureUserIsLender::class,
        'admin'                                                => EnsureUserIsAdmin::class,
        'borrower'                                             => EnsureUserIsBorrower::class,
        'rp-member'                                            => EnsureUserIsReferralProgramUserOrMember::class,
        'logged-in'                                            => EnsureUserIsLoggedIn::class,
        'bold'                                                 => VerifyRequestFromBoldHostName::class,
        'shehzan'                                              => CheckIsShehzan::class,
        'check-partnerships-referral'                          => CheckReferralForPartnershipsPage::class,
        'redirect-users-without-complete-application'          => UserWithCompleteAutoRefinanceApplication::class,
        'redirect-users-with-complete-application'             => UserWithoutCompleteAutoRefinanceApplication::class,
        'redirect-users-with-bar-prep-app-started'             => CheckBarPrepAppStarted::class,
    ];
}
