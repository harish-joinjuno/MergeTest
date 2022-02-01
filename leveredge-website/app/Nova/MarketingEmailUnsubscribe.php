<?php

namespace App\Nova;

use App\MarketingEmailUnsubscribe as MarketingEmailUnsubscribeModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class MarketingEmailUnsubscribe extends Resource
{
    public static $model = \App\MarketingEmailUnsubscribe::class;

    public static $title = 'id';

    public static $group = 'Marketing';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Email', 'email')
                ->sortable()
                ->required(),

            Text::make('Reason', 'reason')
                ->sortable()
                ->required(),

            Boolean::make('Unsubscribed', 'has_unsubscribed')
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
