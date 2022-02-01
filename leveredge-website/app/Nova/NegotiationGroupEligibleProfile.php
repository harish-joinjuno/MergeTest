<?php

namespace App\Nova;

use App\UserProfile;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;

class NegotiationGroupEligibleProfile extends Resource
{
    public static $model = \App\NegotiationGroupEligibleProfile::class;

    public static $title = 'id';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'immigration_status', 'credit_score',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Negotiation Group', 'negotiationGroup')->sortable()->nullable(),

            BelongsTo::make('Grad University', 'gradUniversity', \App\Nova\University::class)->sortable()->searchable()->nullable(),
            BelongsTo::make('Grad Degree', 'gradDegree', \App\Nova\Degree::class)->sortable()->searchable()->nullable(),

            BelongsTo::make('University')->sortable()->searchable()->nullable(),
            BelongsTo::make('Degree')->sortable()->searchable()->nullable(),

            Number::make('Annual Income Min')
                ->displayUsing(function($value) {
                    return '$ ' . number_format($value, 2);
                }),
            Number::make('Annual Income Max')
                ->displayUsing(function($value) {
                    return '$ ' . number_format($value, 2);
                }),

            Select::make('Immigration Status')->options([
                UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT  => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT => UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_OTHER                             => UserProfile::IMMIGRATION_STATUS_OTHER,
            ])->nullable(),

            Select::make('Credit Score')->options([
                UserProfile::CREDIT_SCORE_ABOVE_800           => UserProfile::CREDIT_SCORE_ABOVE_800,
                UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799 => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749 => UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749,
                UserProfile::CREDIT_SCORE_BETWEEN_650_AND_699 => UserProfile::CREDIT_SCORE_BETWEEN_650_AND_699,
                UserProfile::CREDIT_SCORE_BETWEEN_550_AND_649 => UserProfile::CREDIT_SCORE_BETWEEN_550_AND_649,
                UserProfile::CREDIT_SCORE_BELOW_550           => UserProfile::CREDIT_SCORE_BELOW_550,
                UserProfile::CREDIT_SCORE_I_DONT_HAVE         => UserProfile::CREDIT_SCORE_I_DONT_HAVE,
                UserProfile::CREDIT_SCORE_UNKNOWN             => UserProfile::CREDIT_SCORE_UNKNOWN,
            ])->nullable(),

            Boolean::make('Has Graduated', 'has_graduated')->sortable(),

            Boolean::make('Is Undergrad Student', 'is_undergrad_student'),

            Boolean::make('Is Grad Student', 'is_grad_student'),
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
