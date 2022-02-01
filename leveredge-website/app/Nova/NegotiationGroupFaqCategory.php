<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class NegotiationGroupFaqCategory extends Resource
{
    use HasSortableRows;

    public static $model = \App\NegotiationGroupFaqCategory::class;

    public function title()
    {
        return $this->name . ' - ' . $this->negotiationGroup->name;
    }

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'name',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),

            BelongsTo::make('Negotiation Group', 'negotiationGroup')->sortable(),
            HasMany::make('Negotiation Group Faqs', 'negotiationGroupFaqs'),
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
