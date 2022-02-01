<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaResourcePermission extends Resource
{
    public static $model = \App\NovaResourcePermission::class;

    public static $title = 'id';

    public static $group = 'Admin';

    public static $search = [
        'id',
        'user_id',
        'ability',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('NovaUser')->searchable(),

            Select::make('Ability', 'ability')
                ->options(\App\NovaResourcePermission::PERMISSIONS)
                ->displayUsingLabels()
                ->required(),

            Select::make('Model', 'model')
                ->options(collect(\App\NovaResourcePermission::RESOURCE_LIST)->sortKeys())
                ->displayUsingLabels()
                ->required(),
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
