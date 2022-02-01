<?php

namespace App\Nova;

use App\RateType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class RateProperty extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\RateProperty::class;

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','term', 'apr','internal_name',
    ];

    public function title()
    {
        return $this->internal_name . '(' . $this->term . ', ' . $this->apr . ', ' . $this->type . ')';
    }

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

            Text::make('Term', 'term')->required(),

            Text::make('Apr', 'apr')
                ->required(),

            Select::make('Type', 'type')
                ->options(\App\RateProperty::RATE_TYPES)
                ->displayUsingLabels()
                ->required(),

            Text::make('Internal Name', 'internal_name')
                ->nullable(),

            BelongsToMany::make('Rate', 'rate')
                ->searchable()
                ->required(),
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
