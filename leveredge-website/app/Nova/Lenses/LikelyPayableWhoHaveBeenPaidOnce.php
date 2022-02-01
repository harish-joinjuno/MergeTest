<?php

namespace App\Nova\Lenses;

use App\Nova\Traits\LeveredgeRewardClaimFieldsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class LikelyPayableWhoHaveBeenPaidOnce extends Lens
{
    use LeveredgeRewardClaimFieldsTrait;
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        $result = collect(DB::select("
select `leveredge_reward_claims`.`id` from `leveredge_reward_claims`
where `access_the_deal_id` is not null
and exists (
    select * from `access_the_deals`
    where `leveredge_reward_claims`.`access_the_deal_id` = `access_the_deals`.`id`
    and `loan_status_id` = ". \App\DealStatus::SIGNED_THE_LOAN . "
    and `disbursed_amount` > 0
    and `reward_amount` > 0
)
and (
    select count(*) from `leveredge_reward_distributions`
        where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
        and `leveredge_reward_distributions`.`deleted_at` is null) > 1
        and `leveredge_reward_claims`.`reward_amount` >
        (select SUM(`leveredge_reward_distributions`.`amount`) from `leveredge_reward_distributions`
            where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
            and `leveredge_reward_distributions`.`payment_completed` = 1
            and `leveredge_reward_distributions`.`deleted_at` is null
        )
and exists (
    select * from `leveredge_reward_distributions`
    where `leveredge_reward_claims`.`id` = `leveredge_reward_distributions`.`leveredge_reward_claim_id`
    and `payment_completed` = 0
    and `leveredge_reward_distributions`.`deleted_at` is null)
    and `leveredge_reward_claims`.`deleted_at` is null")
)->pluck('id');

        return $request->withOrdering($request->withFilters(
            $query->whereIn('id', $result)
        ));
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'likely-payable-who-have-been-paid-once';
    }
}
