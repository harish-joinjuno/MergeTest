<?php


namespace App\Partnerships\Concretes\MetricsDefinition;

use App\Deal;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class ClickedToLender implements MetricsDefinitionInterface
{
    public static function getTitle(): string
    {
        return 'Referred Users who clicked to a lender';
    }

    public static function getDescription(): string
    {
        return 'Referred Users who clicked to a lender';
    }

    public static function getValue(User $partner)
    {
        return User::where('referred_by_id',$partner->id)
            ->whereHas('accessTheDeals',function(Builder $query) {
                $query->whereIn('deal_id',Deal::whereIn('deal_type_id',[1,2,3,4])->pluck('id'));
            })
            ->count();
    }
}
