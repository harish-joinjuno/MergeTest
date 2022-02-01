<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaUser extends Resource
{
    public static $model = \App\NovaUser::class;

    public static $title = 'name';


    public static $search = [
        'id', 'name', 'email',
    ];


    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
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

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

}
