<?php

namespace App\Nova;

use App\Nova\Actions\PayMemberForClaim;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class InternationalStudentHealthInsuranceClaim extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\InternationalStudentHealthInsuranceClaim::class;

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

            BelongsTo::make('User', 'user')
                ->searchable()
                ->readonly(),

            BelongsTo::make('Deal', 'deal')
                ->searchable()
                ->readonly(),

            BelongsTo::make('Payment Record', 'payment', Payment::class)
                ->searchable()
                ->readonly(),

            BelongsTo::make('Payment Method', 'paymentMethod')
                ->searchable()
                ->readonly(),

            Number::make('Loan Amount', 'loan_amount')
                ->readonly(),

            Number::make('Reward Amount', 'amount')
                ->readonly(),

            Boolean::make('Payment Completed', 'payment_completed'),

            MorphOne::make('File'),
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
        $internationalStudentHealthInsuranceClaim = \App\InternationalStudentHealthInsuranceClaim::find($request->resourceId);

        $action                                   = new PayMemberForClaim();
        if ($internationalStudentHealthInsuranceClaim && $internationalStudentHealthInsuranceClaim->amount > 1000) {
            $action->confirmText("This payment is larger than $1000. Are you sure you want to make this payment?");
        }

        return [
            $action,
        ];
    }
}
