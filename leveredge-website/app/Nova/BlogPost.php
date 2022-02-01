<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class BlogPost extends Resource
{
    use HasSortableRows;

    protected $attributes = [
        'active' => true,
    ];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\BlogPost::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description', 'slug'
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
            Text::make('URL Preview', function () {
                return '<a href="' . url('/financial-literacy/' . optional($this->resource)->slug) . '" target="_blank">URL Preview</a>';
            })->asHtml(),
            Text::make('Title')
                ->rules('max:255')
                ->nullable()
                ->sortable(),
            Text::make('Slug')
                ->rules('required')
                ->hideFromIndex(),
            Select::make('Type')
                ->options([
                    'article' => 'Article',
                    'opinion' => 'Opinion',
                    'video'   => 'Video',
                ])
                ->displayUsingLabels()
                ->rules('required')
                ->hideFromIndex(),
            Boolean::make('active')->nullable(),
            Text::make('Description')
                ->rules('max:1000')
                ->nullable()
                ->hideFromIndex(),
            Trix::make('Content')
                ->withFiles('s3_app_public')
                ->nullable()
                ->alwaysShow(),
            Text::make('Video Id')
                ->rules('max:255')
                ->nullable()
                ->hideFromIndex(),
            Image::make('Video Thumbnail')
                ->disk('s3_app_public')
                ->rules('max:255')
                ->nullable()
                ->hideFromIndex(),
        ];
    }

    public static function canSort(NovaRequest $request)
    {
        return true;
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
