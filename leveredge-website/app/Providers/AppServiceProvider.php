<?php

namespace App\Providers;

use App\MarketingEmailUnsubscribe;
use App\NegotiationGroupUserExclusion;
use App\NovaResourcePermission;
use App\Observers\NegotiationGroupUserExclusionObserver;
use App\Observers\ScholarshipObserver;
use App\Observers\UserObserver;
use App\Observers\UserProfileObserver;
use App\PageSection;
use App\Scholarship;
use App\Socialite\DoximityProvider;
use App\UnsubscribeRequest;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::observe(UserObserver::class);
        UserProfile::observe(UserProfileObserver::class);
        NegotiationGroupUserExclusion::observe(NegotiationGroupUserExclusionObserver::class);
        Scholarship::observe(ScholarshipObserver::class);

        Blade::if('hasPageSection', function ($targetPage, $sectionName): bool {
            $result = PageSection::query()
            ->where('target_page', '=', $targetPage)
            ->where('section_name', '=', $sectionName)
            ->whereNotNull('published_at')
            ->exists();

            return $result;
        });

        $this->bootDoximitySocialite();
    }

    public function register()
    {
        $this->app->singleton('nova_permissions', function () {
            return NovaResourcePermission::whereUserId(auth()->id())->get();
        });

        $this->app->singleton('user_is_admin', function () {
            return auth()->user()->isAdmin();
        });

        $this->app->singleton('mailchimp_automated_campaign_users', function () {
            return User::whereHas('accessTheDeals')
                ->get()
                ->filter(function (User $user) {
                    $marketingEmail = ! MarketingEmailUnsubscribe::whereEmail($user->email)
                        ->whereReason('Unsubscribed via MailChimp, ' . config('services.mailchimp.customer_list_id'))->exists();

                    $unsubscribedRequest = ! UnsubscribeRequest::whereEmail($user->email)->exists();

                    if ($marketingEmail && $unsubscribedRequest) {
                        return $user;
                    }

                    return false;
                });
        });

        $this->app->singleton('client_question_responders', function () {
            $responders = getClient()->questionResponder()
                ->orderByDesc('created_at')
                ->get();

            return $responders->groupBy('question_id')->map(function ($responses) {
                return $responses->first();
            });
        });
    }

    private function bootDoximitySocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'doximity',
            function ($app) use ($socialite) {
                $config = $app['config']['services.doximity'];
                return $socialite->buildProvider(DoximityProvider::class, $config);
            }
        );
    }
}
