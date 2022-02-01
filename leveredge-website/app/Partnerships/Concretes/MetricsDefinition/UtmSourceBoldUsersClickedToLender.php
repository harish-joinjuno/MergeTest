<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\Deal;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UtmSourceBoldUsersClickedToLender implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Number of Users who clicked to lender and have utm_source = bold';
    }

    public static function getDescription(): string
    {
        return 'Number of Users who clicked to lender and have utm_source = bold';
    }

    /**
     * @param User $partner
     * @return mixed
     */
    public static function getValue($partner)
    {
        return User::whereHas('profile',function(Builder $query) {
            $query->where('utm_source','bold');
        })->whereHas('accessTheDeals',function(Builder $query) {
            $query->whereIn('deal_id', Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'));
        })->count();
    }
}
