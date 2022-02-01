<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use NovaItemsField\Items;

class SchoolVsSchoolCompetition extends Resource
{
    public static $model = \App\SchoolVsSchoolCompetition::class;

    public static $group = 'Vs Competition';

    public static $search = [
        'id',
    ];

    public function title(): string
    {
        return substr($this->model()->colloquial_name_one, 0, 5)
            . ' vs. '
            . substr($this->model()->colloquial_name_two,0,5);
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Items::make('True Statements','true_statements'),
            Image::make('Hero Image'),
            new Panel('Program One',$this->programOneFields()),
            new Panel('Program Two',$this->programTwoFields()),
            new Panel('Prizes',$this->prizesFields()),

        ];
    }

    protected function programOneFields(): array
    {
        return [
            BelongsTo::make('University','universityOne')->searchable(),
            Text::make('Colloquial Name','colloquial_name_one'),
            Text::make('Color', 'color_one'),
            Image::make('Logo One'),
        ];
    }

    protected function programTwoFields(): array
    {
        return [
            BelongsTo::make('University','universityTwo')->searchable(),
            Text::make('Colloquial Name','colloquial_name_two'),
            Text::make('Color', 'color_two'),
            Image::make('Logo Two'),
        ];
    }

    protected function prizesFields(): array
    {
        return [
            Number::make('First Prize','first_prize_amount'),
            Number::make('Number of Prizes'),
            Number::make('Target Number Of Students'),
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
