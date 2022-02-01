<?php

namespace App\Nova;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class Deal extends Resource
{
    use HasDependencies;

    public static $model = \App\Deal::class;

    public static $title = 'name';

    public static $group = 'Deals';

    public static $search = [
        'id', 'name', 'description',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description')
                ->sortable()
                ->rules('required'),

            Date::make('Start Date')
                ->format('MMM Do YYYY')
                ->rules('required', 'date')
                ->sortable(),

            Date::make('End Date')
                ->format('MMM Do YYYY')
                ->nullable()
                ->sortable(),

            BelongsTo::make('Deal Type', 'dealType')->sortable(),

            BelongsTo::make('Fee Type', 'feeType')->sortable(),

            NovaDependencyContainer::make([
                Number::make('Fee Amount','fee_amount'),
            ])->dependsOn('feeType', \App\FeeType::FIXED_AMOUNT_PER_LOAN)
                ->onlyOnForms(),

            NovaDependencyContainer::make([
                Number::make('Percentage of Loan Amount','percentage_of_loan_amount'),
            ])->dependsOn('feeType', \App\FeeType::PERCENTAGE_OF_LOANS_ORIGINATED)
                ->onlyOnForms(),

            Text::make('Redirect Url', 'redirect_url')
                ->rules('required')
                ->onlyOnForms(),

            Text::make('Tracked Query Parameter', 'tracked_query_parameter')
                ->rules('required')
                ->onlyOnForms(),

            Boolean::make('Allow Guest Access', 'allow_guest_access')->onlyOnForms(),

            Text::make('Slug', 'slug')
                ->creationRules('required','unique:deals,slug')
                ->updateRules('required','unique:deals,slug,{{resourceId}}')
                ->onlyOnForms(),

            MorphOne::make('Mailable', 'mailable', MailchimpAutomatedCampaignMailable::class),

            BelongsToMany::make('Deal Status', 'dealStatuses', DealStatus::class),

            Text::make('Handoff Url')->readonly(),

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
