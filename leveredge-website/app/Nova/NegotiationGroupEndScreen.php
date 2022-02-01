<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class NegotiationGroupEndScreen extends Resource
{
    public static $model = \App\NegotiationGroupEndScreen::class;

    public static $title = 'heading';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'heading', 'description', 'cta_text',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Heading', 'heading')->required(),

            Text::make('Description', 'description')->nullable(),

            Text::make('Cta Text', 'cta_text')->nullable(),

            Text::make('Cta Link', 'cta_link')->nullable(),

            BelongsTo::make('Negotiation Group', 'negotiationGroup')->searchable(),

            MorphMany::make('infoCardElements'),
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
