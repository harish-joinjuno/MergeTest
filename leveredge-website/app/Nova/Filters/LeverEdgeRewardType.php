<?php

namespace App\Nova\Filters;

use App\Deal;
use App\Nova\DealStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\Filter;

class LeverEdgeRewardType extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value === 'likely_payable') {
            $query = $query->whereNotNull('access_the_deal_id');
        }

        if ($value === 'likely_payable_excluding_paid_once') {
            $query = $query->whereNotNull('access_the_deal_id')->whereHas('accessTheDeal',function(Builder $query) {
                $query->where('loan_status_id',\App\DealStatus::SIGNED_THE_LOAN)
                    ->where('disbursed_amount','>',0)
                    ->where('reward_amount', '>', 0);
            });
            $query = $query->whereDoesntHave('distributions',function (Builder $query) {
                $query->where('payment_completed',1);
            });
        }

        if ($value === 'likely_attribution_issue') {
            $query = $query
                ->whereDoesntHave('accessTheDeal')
                ->whereDoesntHave('user',function (Builder $query) {
                    $query->whereHas('accessTheDeals',function(Builder $query) {
                        $query->whereIn('loan_status_id',
                            [
                                \App\DealStatus::SIGNED_THE_LOAN,
                                \App\DealStatus::CERTIFIED,
                                \App\DealStatus::APPROVED_BY_LENDER,
                                \App\DealStatus::SUBMITTED_COMPLETE_APPLICATION,
                            ]
                        );
                    });
                })
                ->where('payment_completed', false);
        }

        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Likely Payable'                                 => 'likely_payable',
            'Likely Payable Excluding at least paid once'    => 'likely_payable_excluding_paid_once',
            'Likely Attribution Issue'                       => 'likely_attribution_issue',
        ];
    }
}
