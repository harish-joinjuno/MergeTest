<?php

namespace App\Providers;

use App\Nova\Metrics\NewUsersPerDay;
use App\Nova\Metrics\TotalUsers;
use App\Nova\Metrics\UsersPerAcademicYear;
use App\Nova\Metrics\UsersPerNegotiationGroup;
use App\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    protected function gate()
    {
        Gate::define('viewNova', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('nova-user');
        });
    }

    protected function cards()
    {
        return [
            (new NewUsersPerDay)->width('1/2'),
            (new TotalUsers)->width('1/2'),
            (new UsersPerNegotiationGroup)->width('1/2'),
            (new UsersPerAcademicYear)->width('1/2'),
        ];
    }

    protected function dashboards()
    {
        return [];
    }

    public function tools()
    {
        return [];
    }

    public function register()
    {
        //
    }
}
