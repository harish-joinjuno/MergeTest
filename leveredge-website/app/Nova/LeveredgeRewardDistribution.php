<?php

namespace App\Nova;

use App\Nova\Actions\PayMemberForClaim;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class LeveredgeRewardDistribution extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\LeveredgeRewardDistribution::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Leveredge Reward Claim', 'rewardClaim')
                ->required()
                ->sortable()
                ->searchable(),

            BelongsTo::make('Payment', 'payment')
                ->readonly()
                ->sortable()
                ->searchable(),

            Number::make('Amount', 'amount')
                ->creationRules([
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $rewardClaim = \App\LeveredgeRewardClaim::find($request->rewardClaim);
                        $payedAmount = $rewardClaim->distributions->sum('amount');
                        if ($payedAmount + $value > $rewardClaim->reward_amount) {
                            return $fail('The sum of ' . $attribute . ' can not be greater than reward amount, already payed - $' . $payedAmount . ', overall reward amount is $' . $rewardClaim->reward_amount);
                        }
                    },
                ]),

            Boolean::make('Payment Completed', 'payment_completed')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->readonly(),

            Trix::make('Admin Notes', 'admin_notes'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        $leveredgeRewardDistribution = \App\LeveredgeRewardDistribution::find($request->resourceId);
        $action                      = new PayMemberForClaim();
        if ($leveredgeRewardDistribution && $leveredgeRewardDistribution->amount > 1000) {
            $action->confirmText("This payment is larger than $1000. Are you sure you want to make this payment?");
        }

        return [
            $action,
        ];
    }
}
