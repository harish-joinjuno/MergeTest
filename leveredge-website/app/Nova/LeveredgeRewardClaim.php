<?php

namespace App\Nova;

use App\LeveredgeRewardClaim as LeveredgeRewardClaimModel;
use App\Nova\Filters\LeverEdgeRewardType;
use App\Nova\Lenses\LikelyPayableWhoHaveBeenPaidOnce;
use App\Nova\Traits\LeveredgeRewardClaimFieldsTrait;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class LeveredgeRewardClaim extends Resource
{
    use LeveredgeRewardClaimFieldsTrait;

    public static $model = LeveredgeRewardClaimModel::class;

    public static $title = 'id';

    public static $search = [
        'id', 'u.name', 'u.email',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            BelongsTo::make('User')
                ->searchable()
                ->required(),

            BelongsTo::make('Deal')
                ->required(),

            BelongsTo::make('Access The Deal', 'accessTheDeal')
                ->searchable()
                ->nullable()
                ->hideFromIndex(),

            BelongsTo::make('Payment Method', 'paymentMethod')
                ->required()
                ->hideFromIndex(),

            Date::make('Filed date', 'created_at'),

            Number::make('Member Reported Loan Amount', 'loan_amount')
                ->required(),

            Number::make('Disbursed Loan Amount', 'disbursed_loan_amount')
                ->readonly(),

            Number::make('Reward Amount', 'reward_amount')
                ->required(),

            Boolean::make('Is Paid', 'payment_completed')
                ->hideWhenUpdating()
                ->hideWhenCreating()
                ->readonly()
                ->nullable(),

//            Text::make('Credit Score')
//                ->nullable(),
//
//            Text::make('Cosigner Credit Score')
//                ->nullable(),
//
//            Number::make('Annual Income')
//                ->nullable(),

            MorphOne::make('File'),

            HasMany::make('Distributions', 'distributions', LeveredgeRewardDistribution::class),

            Trix::make('Admin Notes', 'admin_notes'),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [
            new LeverEdgeRewardType,
        ];
    }

    public function lenses(Request $request)
    {
        return [
            new LikelyPayableWhoHaveBeenPaidOnce,
        ];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('leveredge_reward_claims.*','u.name', 'u.email');
        $query->join('users as u', 'leveredge_reward_claims.user_id', '=', 'u.id');

        return $query;
    }

    public function title()
    {
        return "Claim on " . $this->created_at->format('m-d-Y');
    }
}
