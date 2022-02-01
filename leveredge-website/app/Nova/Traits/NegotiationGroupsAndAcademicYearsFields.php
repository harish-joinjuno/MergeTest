<?php


namespace App\Nova\Traits;


use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use NovaItemsField\Items;

trait NegotiationGroupsAndAcademicYearsFields
{
    protected function dashboardFields()
    {
        return [
            Text::make('Display Name','display_name')->nullable(),

            Select::make('Display Count Based On', 'display_count_based_on')
                ->options(\App\AcademicYear::DISPLAY_COUNT_BASED_ON_LIST)
                ->withMeta(['value' => \App\AcademicYear::DISPLAY_COUNT_BASED_ON_ACADEMIC_YEARS])
                ->required(),

            Trix::make('Dashboard Update', 'dashboard_update')->nullable(),

            Items::make('Progress Titles', 'progress_titles')
                ->nullable()
                ->hideWhenCreating()
                ->fullWidth()
                ->deleteButtonValue('')
                ->max(3),

            Items::make('Progress Descriptions', 'progress_descriptions')
                ->nullable()
                ->hideWhenCreating()
                ->fullWidth()
                ->deleteButtonValue('')
                ->max(3),

            Select::make('Progress Stage', 'progress_stage')
                ->options(\App\AcademicYear::PROGRESS_STAGE_LIST)
                ->required(),

            Text::make('Dashboard Button Cta', 'dashboard_button_cta')->nullable(),

            Boolean::make('Hide Dashboard Button', 'hide_dashboard_button')->nullable(),
        ];
    }
}
