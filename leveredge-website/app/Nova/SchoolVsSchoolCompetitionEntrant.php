<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SchoolVsSchoolCompetitionEntrant extends Resource
{

    public static $model = \App\SchoolVsSchoolCompetitionEntrant::class;

    public static $title = 'id';

    public static $group = 'Vs Competition';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Competition','competition',\App\Nova\SchoolVsSchoolCompetition::class)->sortable(),
            Text::make('Colloquial Slug')->sortable(),
            Text::make('First Name')->sortable(),
            Text::make('Email')->sortable(),
            Boolean::make('Wants To Host Party')->sortable(),
            Text::make('Recommended Location'),
            Boolean::make('verified')->sortable(),
            Text::make('verification_code')->hideFromIndex(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
