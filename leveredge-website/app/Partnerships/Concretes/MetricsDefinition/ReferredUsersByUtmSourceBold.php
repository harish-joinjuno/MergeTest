<?php


namespace App\Partnerships\Concretes\MetricsDefinition;


use App\Deal;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Builder;

class ReferredUsersByUtmSourceBold implements MetricsDefinitionInterface
{

    public static function getTitle(): string
    {
        return 'Users with Utm Source Bold';
    }

    public static function getDescription(): string
    {
        return 'Users who have Utm Source = Bold in their User Profile';
    }

    public static function getValue(User $partner)
    {
        return User::whereHas('profile',function(Builder $query) {
            $query->where('utm_source','bold');
        })->count();
    }
}
