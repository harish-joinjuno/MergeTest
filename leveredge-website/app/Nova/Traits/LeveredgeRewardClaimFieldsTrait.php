<?php


namespace App\Nova\Traits;


use App\Nova\LeveredgeRewardDistribution;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Trix;

trait LeveredgeRewardClaimFieldsTrait
{
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->searchable()
                ->required(),

            BelongsTo::make('Deal')
                ->required(),

            BelongsTo::make('Access The Deal', 'accessTheDeal')
                ->nullable(),

            BelongsTo::make('Payment Method', 'paymentMethod')
                ->required(),

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
}
