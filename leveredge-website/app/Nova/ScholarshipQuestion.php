<?php

namespace App\Nova;

use App\Traits\NeedsFileNamesFromDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Symfony\Component\Finder\Finder;

class ScholarshipQuestion extends Resource
{
    use HasSortableRows, NeedsFileNamesFromDirectory;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\ScholarshipQuestion::class;

    public static $group = 'Internal Scholarships';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'label';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','label','field_name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $questionTemplates = $this->getFilenamesFromResourcesDirectory('views/scholarship/question');

        return [
            ID::make()->sortable(),
            Select::make('Type')->options($questionTemplates)->displayUsingLabels(),
            Text::make('Label'),
            Text::make('Field Name'),
            Text::make('Validation Rules')
            ->help('<a href="https://laravel.com/docs/8.x/validation#available-validation-rules">See List of Rules</a>'),
            Text::make('Helper Text')->nullable(),
            BelongsTo::make('Scholarship'),

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
