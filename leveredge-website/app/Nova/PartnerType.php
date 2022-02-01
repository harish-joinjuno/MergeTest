<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class PartnerType extends Resource
{
    public static $model = \App\PartnerType::class;

    public static $title = 'type';

    public static $group = 'Partner Management';

    public static $search = [
        'id', 'type',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Type')
                ->sortable()
                ->rules('required', 'max:255'),

            HasMany::make('Partner Profiles','partnerProfiles'),
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
