<?php

namespace App\Nova;

use App\Nova\Actions\NegotiationGroupFaqHide;
use App\Nova\Actions\NegotiationGroupFaqPublish;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

class NegotiationGroupFaq extends Resource
{
    use HasSortableRows;

    public static $model = \App\NegotiationGroupFaq::class;

    public static $title = 'title';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id', 'title',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Trix::make('Body')
                ->hideFromIndex(),
            Trix::make('Published Body')
                ->hideWhenUpdating()
                ->hideWhenCreating(),
            DateTime::make('Published At')
                ->readonly()
                ->format('MMM, DD YYYY \a\t h:m a')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Negotiation Group Faq Category', 'negotiationGroupFaqCategory'),
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
        $publish = new NegotiationGroupFaqPublish();

        return [
            $publish,
            new NegotiationGroupFaqHide(),
        ];
    }
}
