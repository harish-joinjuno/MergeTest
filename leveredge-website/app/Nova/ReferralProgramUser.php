<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;

class ReferralProgramUser extends Resource
{
    public static $model = \App\ReferralProgramUser::class;

    public static $group = 'Referral Program';

    public static $search = [
        'id',
    ];

    public function title()
    {
        return $this->user->name;
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Date::make('Starts On')->sortable(),
            Date::make('Ends Before')->sortable(),
            BelongsTo::make('User')->sortable()->searchable(),
            BelongsTo::make('Referral Program', 'referralProgram')->sortable(),
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
