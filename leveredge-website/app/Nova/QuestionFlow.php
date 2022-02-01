<?php

namespace App\Nova;

use App\Nova\Actions\CopyQuestionFlow;
use App\QuestionPage;
use App\Traits\NeedsFileNamesFromDirectory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaItemsField\Items;

class QuestionFlow extends Resource
{
    use NeedsFileNamesFromDirectory;

    public static $group = 'Question Flow';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\QuestionFlow::class;

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
        $afterCompletionRedirects = $this->getFilenamesFromAppDirectory('Redirects');

        return [
            ID::make()->sortable(),
            Text::make('Name')
                ->readonly(function () {
                    return $this->resource->id ? true : false;
                }),
            Text::make('Slug')
                ->readonly(function () {
                    return $this->resource->id ? true : false;
                }),
            Text::make('Template'),
            Text::make('Authorization Policy'),
            Items::make('Start Sequence'),
            Items::make('Complete Sequence'),
            Select::make('After Completion Redirect To')
                ->options($afterCompletionRedirects)
                ->displayUsingLabels(),
            DateTime::make('Created At'),
            DateTime::make('Updated At'),
            HasMany::make('Question Pages','questionPages'),
            HasMany::make('Question Flow Responders', 'questionFlowResponders'),
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
        return [
            new CopyQuestionFlow(),
        ];
    }
}
