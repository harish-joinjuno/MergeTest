<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class ReferralRewardClaim extends Resource
{
    public static $model = \App\ReferralRewardClaim::class;

    public static $group = 'Referral Program';

    public static $title = 'reward';

    public static $search = [
        'reward', 'address_line_one', 'address_line_two', 'address_line_three', 'city', 'state', 'zip_code', 'status',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('reward')->sortable(),
            Number::make('value')->onlyOnForms(),
            BelongsTo::make('Referral Program User', 'referralProgramUser')->searchable(),
            Text::make('Address Line One'),
            Text::make('Address Line Two'),
            Text::make('Address Line Three'),
            Text::make('City'),
            Text::make('State'),
            Text::make('Zip Code'),
            Text::make('Status')->sortable(),
            Date::make('Created At')->readonly(),
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
