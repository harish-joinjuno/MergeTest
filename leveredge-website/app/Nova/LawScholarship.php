<?php

namespace App\Nova;

use App\LawScholarship as LawScholarshipModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use OptimistDigital\MultiselectField\Multiselect;

class LawScholarship extends Resource
{
    static $group = 'Scholarships';

    public static $model = LawScholarshipModel::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'name',
        'max_amount'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable()
                ->required(),

            Date::make('Application Due By', 'application_due_by')
                ->sortable()
                ->required(),

            Number::make('Max Amount', 'max_amount')
                ->sortable()
                ->nullable(),

            Textarea::make('Description', 'description')
                ->nullable(),

            Text::make('Link', 'link')->required(),

            Select::make('Eligible Gender', 'eligible_gender')
                ->options(LawScholarshipModel::ELIGIBLE_GENDERS)
                ->nullable(),

            Multiselect::make('Eligible Protected Classes', 'eligible_protected_classes')
                ->options(LawScholarshipModel::ELIGIBLE_PROTECTED_CLASSES)
                ->nullable()
                ->saveAsJSON(),

            Select::make('Citizenship Requirement', 'citizenship_requirement')
                ->options([
                    1 => 'Yes',
                    0 => 'No'
                ])
                ->displayUsingLabels()
                ->nullable(),

            Multiselect::make('Eligible States', 'eligible_states')
                ->options(LawScholarshipModel::STATES)
                ->nullable()
                ->saveAsJSON(),

            Number::make('Minimum Eligible GPA','minimum_eligible_gpa')
                ->nullable()
                ->step(0.01)
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
