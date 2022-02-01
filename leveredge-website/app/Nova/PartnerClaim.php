<?php

namespace App\Nova;

use App\Nova\Actions\PayMemberForClaim;
use App\Nova\Metrics\ClaimsPerDay;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class PartnerClaim extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\PartnerClaim::class;

    public static $group = 'Partner Management';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return "Claim by ". $this->partner->name . " on " . $this->created_at->format('m/d/Y h:i A');
    }

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
            BelongsTo::make('Partner', 'partner', 'App\Nova\User')->searchable(),
            BelongsTo::make('Payment')
                ->hideWhenUpdating(),
            BelongsTo::make('Payment Method', 'paymentMethod'),
            Number::make('Amount'),
            Boolean::make('Payment Completed')
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
        return [
            new ClaimsPerDay
        ];
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
        return [
            (new PayMemberForClaim)
                ->confirmText('Are you sure you want to pay for this claim ?')
                ->confirmButtonText('Pay Partner')
                ->cancelButtonText('Cancel'),
        ];
    }
}
