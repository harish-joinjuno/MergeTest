<?php

namespace App\Nova;

use App\ActionNotifications\Abstracts\AbstractActionNotificationVisibilityRule;
use App\Partnerships\Contracts\MetricsDefinitionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Symfony\Component\Finder\Finder;

class Metric extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Metric::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    public static $group = 'Partner Management';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','metric_definition',
    ];

    public static function uriKey()
    {
        return 'metrics-definition';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $namespace           = app()->getNamespace();
        $metricsResources    = [];
        $metricsDirectory    = base_path('app/Partnerships/Concretes/MetricsDefinition/');
        $metricsFiles        = (new Finder)->files()->in($metricsDirectory);
        foreach ($metricsFiles as $resource) {
            $resource = $namespace . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($resource->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );
            if (is_subclass_of($resource, MetricsDefinitionInterface::class)) {
                $metricsResources[$resource] = $resource;
            }
        }

        return [
            ID::make()->sortable(),

            Select::make('Metric Definition', 'metric_definition')
                ->options($metricsResources)
                ->required()
                ->displayUsingLabels(),

            Text::make('Title', 'title')->readonly(),

            Text::make('Description', 'description')->readonly(),
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
