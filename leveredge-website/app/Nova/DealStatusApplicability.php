<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class DealStatusApplicability extends Resource
{
    use HasSortableRows;

    public static $model = \App\DealStatusApplicability::class;

    public static $title = 'id';

    public static $group = 'Deals';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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

            BelongsTo::make('Deal', 'deal')
                ->searchable()
                ->creationRules([
                    'required',
                    'unique:deal_status_applicabilities,deal_id,NULL,id,deal_status_id,' . $request->dealStatus,
                ])
                ->updateRules([
                    'required',
                    'unique:deal_status_applicabilities,deal_id,' . $this->id . ',id,deal_status_id,' . $request->dealStatus,
                ]),

            BelongsTo::make('DealStatus', 'dealStatus')
                ->searchable()
                ->required(),
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
