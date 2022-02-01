<?php

namespace App\Nova;

use App\Contracts\PersistResponseInterface;
use App\Nova\Actions\CopyQuestion;
use App\Traits\NeedsFileNamesFromDirectory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Question extends Resource
{
    use NeedsFileNamesFromDirectory, HasSortableRows;

    public static $group = 'Question Flow';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Question::class;

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
        $templateOptions         = $this->getDirectoryNamesFromDirectory(resource_path('views/question'));
        $questionOptionOptions   = $this->getFilenamesFromAppDirectory('QuestionOptions');
        $persistResponseOptions  = $this->getFilenamesFromAppDirectory('PersistResponse');
        $skipPolicyOptions       = $this->getFilenamesFromAppDirectory('SkipPolicies');
        $visibilityPolicyOptions = $this->getFilenamesFromAppDirectory('VisibilityPolicies');

        return [
            ID::make()->sortable(),
            BelongsTo::make('Question Page','questionPage'),
            Text::make('Field Name')->required()
                ->rules([
                    function($attribute, $value, $fail) use ($request) {
                        if (class_exists($request->persist_response)) {
                            /** @var PersistResponseInterface $persistObject */
                            $persistObject = new $request->persist_response;
                            if (! $persistObject->acceptsFieldName($value)) {
                                return $fail($persistObject->getTableName() . " table does not have {$value} column in database");
                            }
                        }
                    },
                ])
                ->readonly(function () {
                    return $this->resource->id ? true : false;
                }),
            Text::make('Show View')->readonly()->onlyOnDetail(),
            Select::make('Type')->required()->hideFromIndex()->options($this->getFilenamesFromResourcesDirectory('views/question/version-1')),
            Text::make('Label')->required(),
            Select::make('Persist Response')
                ->required()
                ->hideFromIndex()
                ->options($persistResponseOptions),
            Select::make('Template')->nullable()->options($templateOptions)->hideFromIndex(),
            Select::make('Question Option')->nullable()->hideFromIndex()->help('This is required when using a dropdown or radio button type')->options($questionOptionOptions),

            new Panel('Copy Around The Question',[
                Text::make('Helper Text')->nullable()->hideFromIndex(),
                Text::make('Placeholder')->nullable()->hideFromIndex(),
                Text::make('Tooltip')->nullable()->hideFromIndex(),
            ]),


            new Panel('Advanced Functions',[
                Text::make('Validation Rules')->nullable()->hideFromIndex()->help('This determines if the response to the question is valid'),
                Select::make('Skip Policy')->nullable()->hideFromIndex()->options($skipPolicyOptions),
                Select::make('Visibility Policy')->nullable()->hideFromIndex()->options($visibilityPolicyOptions)->help('This determines when the question is shown on the page and when it is hidden'),
            ]),


            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail(),
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
            new CopyQuestion(),
        ];
    }
}
