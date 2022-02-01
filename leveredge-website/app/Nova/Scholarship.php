<?php

namespace App\Nova;

use App\Nova\Actions\CopyScholarship;
use App\Nova\Actions\SelectScholarshipWinner;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Scholarship extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Scholarship::class;

    public static $group = 'Internal Scholarships';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name'),
            Text::make('Slug'),
            Text::make('Url')->readonly(),
            BelongsTo::make('Scholarship Template','scholarshipTemplate'),
            HasMany::make('Scholarship Questions','scholarshipQuestions')->help('You must have at least email, first_name and last_name'),
            HasMany::make('Scholarship Winners','scholarshipWinners'),
            HasMany::make('Scholarship Contents','scholarshipContents'),
            HasMany::make('Scholarship Emails','scholarshipEmails'),
            HasMany::make('Scholarship Entrants','scholarshipEntrants'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            CopyScholarship::make(),
            SelectScholarshipWinner::make(),
        ];
    }
}
