<?php

namespace App\Nova;

use App\UserProfile;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SimpleActionNotificationRule extends Resource
{
    public static $model = \App\SimpleActionNotificationRule::class;

    public static $title = 'id';

    public static $group = 'Action Notifications';

    public static $search = [
        'id','display_on_page',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('ActionNotification')
                ->searchable()
                ->required(),

            BelongsTo::make('NegotiationGroup')
                ->searchable()
                ->nullable(),

            BelongsTo::make('AcademicYear')
                ->searchable()
                ->nullable(),

            BelongsTo::make('University')
                ->searchable()
                ->nullable(),

            BelongsTo::make('Undergrad Degree', 'degree', 'App\Nova\UndergraduateDegree')
                ->searchable()
                ->nullable(),

            BelongsTo::make('Grad University', 'gradUniversity', 'App\Nova\University')
                ->searchable()
                ->nullable(),

            BelongsTo::make('Grad Degree', 'gradDegree', 'App\Nova\GradDegree')
                ->searchable()
                ->nullable(),

            Select::make('Immigration Status', 'immigration_status')
                ->options(UserProfile::CITIZENSHIP_STATUSES)
                ->displayUsingLabels()
                ->nullable(),

            Text::make('Display on page', 'display_on_page')->nullable(),

            Select::make('Credit Score Range', 'credit_score_range')
                ->options(UserProfile::CREDIT_SCORES),

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
