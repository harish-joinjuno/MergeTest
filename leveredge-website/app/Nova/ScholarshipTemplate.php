<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Symfony\Component\Finder\Finder;

class ScholarshipTemplate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\ScholarshipTemplate::class;

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
        $showTemplates                           = [];
        $showTemplatesRoute                      = 'views/scholarship/template/show';
        $showTemplatesDirectory                  = resource_path($showTemplatesRoute);
        $showTemplateFiles                       = (new Finder)->files()->in($showTemplatesDirectory);
        foreach ($showTemplateFiles as $templateFile) {
            $fileName = explode('.', $templateFile->getFilename())[0];

            if (! Str::startsWith($fileName, '_')) {
                $templateName                 = Str::title(str_replace('-', ' ', $fileName));
                $showTemplates[$fileName]     = $templateName;
            }
        }

        $successTemplates                           = [];
        $successTemplatesRoute                      = 'views/scholarship/template/success';
        $successTemplatesDirectory                  = resource_path($successTemplatesRoute);
        $successTemplateFiles                       = (new Finder)->files()->in($successTemplatesDirectory);
        foreach ($successTemplateFiles as $templateFile) {
            $fileName = explode('.', $templateFile->getFilename())[0];
            if (! Str::startsWith($fileName, '_')) {
                $templateName                 = Str::title(str_replace('-', ' ', $fileName));
                $successTemplates[$fileName]  = $templateName;
            }
        }

        return [
            ID::make()->sortable(),
            Text::make('Name')->required(),
            Select::make('View')
                ->options($showTemplates)
                ->displayUsingLabels()
                ->required(),
            Select::make('Success View')
                ->options($successTemplates)
                ->displayUsingLabels()
                ->required(),
            HasMany::make('Scholarships'),
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
        return [];
    }
}
