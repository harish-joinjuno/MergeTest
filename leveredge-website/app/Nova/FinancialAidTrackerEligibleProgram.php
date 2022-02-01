<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

class FinancialAidTrackerEligibleProgram extends Resource
{

    public static $model = \App\FinancialAidTrackerEligibleProgram::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('University', function () { return $this->university->name; }) ->onlyOnIndex(),
            BelongsTo::make('University', 'university', \App\Nova\University::class)
                ->required()
                ->searchable()
                ->sortable(),

            Text::make('Degree', function () { return $this->degree->name; }) ->onlyOnIndex(),
            BelongsTo::make('Degree', 'degree', \App\Nova\Degree::class)
                ->required()
                ->searchable()
                ->sortable(),

            Text::make('Chart Label')->nullable(),
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
