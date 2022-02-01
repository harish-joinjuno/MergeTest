<?php

namespace App\Nova;

use App\AccessTheDeal as AppAccessTheDeal;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AccessTheDeal extends Resource
{
    public static $model = \App\AccessTheDeal::class;

    public static $title = 'user';

    public static $group = 'Deals';

    public static $search = [
        'id', 'loan_status', 'u.name', 'u.email',
    ];

    public function fields(Request $request)
    {
        $availableDeals = \App\DealStatus::whereHas('deals', function ($query) {
            return $query->where('deal_id', $this->deal_id);
        })->get()->pluck('loan_status', 'id');

        return [
            ID::make()->sortable(),

            BelongsTo::make('User')->searchable(),

            BelongsTo::make('Deal')->sortable(),

            Select::make('Deal Status', 'loan_status_id')
                ->options($availableDeals)
                ->displayUsingLabels()
                ->onlyOnForms()
                ->required(),

            BelongsTo::make('DealStatus')
                ->hideWhenUpdating()
                ->hideWhenCreating(),

            Number::make('Lender Reported Loan Amount','loan_amount'),

            Number::make('Lender Reported Disbursed Amount','disbursed_amount'),

            Code::make('Properties', 'properties')
                ->json()
                ->readonly(),

            Boolean::make('Reported Application To Facebook'),
            Boolean::make('Reported Signature To Facebook'),
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('access_the_deals.*','u.name', 'u.email');
        $query->join('users as u', 'access_the_deals.user_id', '=', 'u.id');

        return $query;
    }

    public function title()
    {
        return 'Click by ' . $this->user->name . ' on ' . $this->deal->name;
    }
}
