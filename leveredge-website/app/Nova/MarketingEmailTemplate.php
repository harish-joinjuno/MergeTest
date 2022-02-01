<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MarketingEmailTemplate extends Resource
{
    public static $model = \App\MarketingEmailTemplate::class;

    public static $title = 'name';

    public static $group = 'Marketing';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Slug', 'slug')
                ->sortable()
                ->readonly(),

            Text::make('Name', 'name')
                ->sortable()
                ->required()
                ->creationRules('unique:marketing_email_templates,name')
                ->updateRules('unique:marketing_email_templates,name,{{resourceId}}'),

            Text::make('Subject', 'subject')
                ->sortable()
                ->required()
                ->creationRules('unique:marketing_email_templates,subject')
                ->creationRules('unique:marketing_email_templates,subject,{{resourceId}}'),

            Text::make('Description', 'description')->sortable()
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
