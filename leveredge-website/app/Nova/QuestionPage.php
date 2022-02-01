<?php

namespace App\Nova;

use App\Nova\Actions\CopyQuestionPage;
use App\Traits\NeedsFileNamesFromDirectory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class QuestionPage extends Resource
{
    use NeedsFileNamesFromDirectory, HasSortableRows;

    public static $group = 'Question Flow';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\QuestionPage::class;

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
        $skipPolicyOptions = $this->getFilenamesFromAppDirectory('SkipPolicies');
        $templateOptions   = $this->getDirectoryNamesFromDirectory(resource_path('views/question'));
        $prePageRedirects  = $this->getFilenamesFromAppDirectory('Redirects');

        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->required()
                ->readonly(function () {
                    return $this->resource->id ? true : false;
                }),

            Text::make('Slug')
                ->sortable()
                ->required()
                ->readonly(function () {
                    return $this->resource->id ? true : false;
                }),

            Select::make('Template')
                ->options($templateOptions)
                ->displayUsingLabels()
                ->sortable()
                ->nullable(),

            Select::make('Pre Render Redirect', 'pre_render_redirect')
                ->options($prePageRedirects)
                ->displayUsingLabels()
                ->nullable(),

            Text::make('Show View')->readonly()->hideWhenCreating()->hideWhenUpdating(),
            Text::make('Url')->readonly()->hideWhenCreating()->hideWhenUpdating(),
            DateTime::make('Created At')->hideFromIndex()->readonly()->hideWhenCreating()->hideWhenUpdating(),
            DateTime::make('Updated At')->hideFromIndex()->readonly()->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Question Flow','questionFlow'),
            HasMany::make('Questions','questions'),
            HasMany::make('Contents','contents'),
            HasMany::make('Question Page Responders', 'questionPageResponders'),

            new Panel('Advanced Functions',[
                Select::make('Skip Policy')
                    ->options($skipPolicyOptions)
                    ->displayUsingLabels()
                    ->sortable()
                    ->nullable(),
                Boolean::make('Hide Submission Button')->sortable(),
//                Text::make('Validation Rules')->nullable()->hideFromIndex()->help('This determines if the response to the question is valid'),

//                Select::make('Skip Policy')->nullable()->hideFromIndex()->options($skipPolicyOptions),
//                Select::make('Visibility Policy')->nullable()->hideFromIndex()->options($visibilityPolicyOptions)->help('This determines when the question is shown on the page and when it is hidden'),
            ]),

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
            new CopyQuestionPage(),
        ];
    }
}
