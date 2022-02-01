<?php

namespace App\Nova;

use App\Degree as Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Degree extends Resource
{

    public static $model = \App\Degree::class;

    public static $title = 'name';

    public static $group = 'Admin';

    public static $search = [
        'id', 'name',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Select::make('Type')->options([
                Model::TYPE_UNDERGRADUATE => ucfirst(Model::TYPE_UNDERGRADUATE),
                Model::TYPE_GRADUATE      => ucfirst(Model::TYPE_GRADUATE),
            ])->sortable(),
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
