<?php

namespace App\Nova;

use App\CampusAmbassadorTask as CampusAmbassadorTaskModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class CampusAmbassadorTask extends Resource
{
    use HasSortableRows;

    public static $model = CampusAmbassadorTaskModel::class;

    public static $title = 'title';

    public static $group = 'Ambassador Program';

    public static $search = [
        'id', 'title', 'body',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title'),
            Trix::make('Body'),
            Select::make('Task Recurrence')->options([
                CampusAmbassadorTaskModel::TASK_RECURRENCE_NONE      => 'None',
                CampusAmbassadorTaskModel::TASK_RECURRENCE_RECURRING => 'Recurring',
            ])->displayUsingLabels(),

            new Panel('Task Amount', $this->taskAmountFields()),

            new Panel('Task Completion Options', $this->taskCompletionOptionsFields()),
        ];
    }

    protected function taskAmountFields()
    {
        return [
            Select::make('Payment Type')->options([
                CampusAmbassadorTaskModel::PAYMENT_TYPE_NONE   => 'None',
                CampusAmbassadorTaskModel::PAYMENT_TYPE_FIXED  => 'Fixed Fee',
                CampusAmbassadorTaskModel::PAYMENT_TYPE_HOURLY => 'Hourly',
            ])->displayUsingLabels(),

            Currency::make('Fixed Payment Amount')
                ->sortable()
                ->rules([function ($attribute, $value, $fail) {
                    if (request()->payment_type == CampusAmbassadorTaskModel::PAYMENT_TYPE_NONE && $value != null) {
                        return $fail('Leave blank if Payment Type is None');
                    }

                    if (request()->payment_type == CampusAmbassadorTaskModel::PAYMENT_TYPE_HOURLY && $value != null) {
                        return $fail('Leave blank if Payment Type is Hourly');
                    }

                    if (request()->payment_type == CampusAmbassadorTaskModel::PAYMENT_TYPE_FIXED && $value <= 0) {
                        return $fail('Enter a value greater than zero');
                    }
                }])->displayUsing(function ($value) {
                    return '$ ' . number_format($value, 2);
                }),
        ];
    }

    protected function taskCompletionOptionsFields()
    {
        return [
            Select::make('Task Completion Tracking')->options([
                CampusAmbassadorTaskModel::TASK_COMPLETION_TRACKING_MANUAL    => 'Ambassador Input Required',
                CampusAmbassadorTaskModel::TASK_COMPLETION_TRACKING_AUTOMATIC => 'Automatic',
            ])->displayUsingLabels(),

            Text::make('Task Completion Redirect')->nullable(true),

            BelongsToMany::make('Completed By', 'completedBy', \App\Nova\User::class),
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
