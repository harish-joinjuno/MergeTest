<?php

namespace App\Nova;

use App\UserProfile;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class ReferralProgramEligibleProfile extends Resource
{

    public static $model = \App\ReferralProgramEligibleProfile::class;

    public static $title = 'id';

    public static $group = 'Referral Program';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Referral Program', 'referralProgram')->sortable()->nullable(),

            BelongsTo::make('University')->sortable()->searchable()->nullable(),
            BelongsTo::make('Degree')->sortable()->searchable()->nullable(),
            BelongsTo::make('Grad University', 'gradUniversity', \App\Nova\University::class)->sortable()->searchable()->nullable(),
            BelongsTo::make('Grad Degree', 'gradDegree', \App\Nova\Degree::class)->sortable()->searchable()->nullable(),

            Date::make('Created On Or After')->sortable(),
            Date::make('Created Before')->sortable(),

            Select::make('Immigration Status')->options([
                UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT  => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_OTHER                             => UserProfile::IMMIGRATION_STATUS_OTHER,
            ])->nullable(),

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
