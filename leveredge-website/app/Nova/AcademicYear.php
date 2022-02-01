<?php

namespace App\Nova;

use App\Nova\Traits\NegotiationGroupsAndAcademicYearsFields;
use App\Traits\NeedsFileNamesFromDirectory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class AcademicYear extends Resource
{
    use NegotiationGroupsAndAcademicYearsFields,
        NeedsFileNamesFromDirectory;

    public static $model = \App\AcademicYear::class;

    public static $title = 'name';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'name',
    ];

    public function fields(Request $request)
    {
        $questionFlowRedirects = $this->getFilenamesFromAppDirectory('Redirects');

        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Number::make('Display Priority')->sortable(),
            Boolean::make('Refinance'),
            Date::make('Starts On')->format('MMM, DD YYYY'),
            Date::make('Ends On')->format('MMM, DD YYYY'),
            Select::make('Join Group Redirect')
                ->options($questionFlowRedirects)
                ->displayUsingLabels()
                ->nullable(),

            HasMany::make('Negotiation Groups', 'negotiationGroups'),

            new Panel('Dashboard Fields', $this->dashboardFields()),
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
