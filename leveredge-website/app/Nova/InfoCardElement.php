<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class InfoCardElement extends Resource
{

    public static $model = \App\InfoCardElement::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title', 'description'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Icon', 'icon'),

            Text::make('Title', 'title')->required(),

            Trix::make('Description', 'description'),

            MorphTo::make('Info Card', 'infoCards')
                ->types([
                    NegotiationGroupEndScreen::class
                ]),
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
