<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class CareerOneStopScholarship extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\CareerOneStopScholarship::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'organization';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','organization',
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
            Number::make('Career One Stop Id'),
            Textarea::make('Name')->nullable(),
            Textarea::make('Organization')->nullable(),
            Text::make('Phone Number')->nullable(),
            Text::make('Email')->nullable(),
            Text::make('Fax Number')->nullable(),
            Textarea::make('Level Of Study')->nullable(),
            Textarea::make('Award Type')->nullable(),
            Textarea::make('Purpose')->nullable(),
            Textarea::make('Focus')->nullable(),
            Textarea::make('Qualifications')->nullable(),
            Textarea::make('Criteria')->nullable(),
            Text::make('Funds')->nullable(),
            Text::make('Duration')->nullable(),
            Text::make('Number of Awards')->nullable(),
            Textarea::make('To Apply')->nullable(),
            Text::make('Deadline')->nullable(),
            Textarea::make('Contact')->nullable(),
            Textarea::make('For More Information')->nullable(),
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
        return [];
    }
}
