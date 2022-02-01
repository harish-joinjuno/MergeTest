<?php

namespace App\Nova;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ReferralProgram extends Resource
{

    public static $model = \App\ReferralProgram::class;

    public static $title = 'name';

    public static $group = 'Referral Program';

    public static $search = [
        'id','name','slug'
    ];


    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Display Name')->sortable(),
            Text::make('Slug')->sortable()->readonly(),
            Number::make('Priority')->sortable(),
            HasMany::make('Eligible Profiles', 'referralProgramEligibleProfiles', \App\Nova\ReferralProgramEligibleProfile::class),
            HasMany::make('ReferralProgramUsers','referralProgramUsers',\App\Nova\ReferralProgramUser::class)
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
