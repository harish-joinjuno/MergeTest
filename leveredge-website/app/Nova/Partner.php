<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Partner extends Resource
{
    public static $model = \App\PartnerProfile::class;

    public static $group = 'Partner Management';

    public static $search = [
        'id', 'pt.type', 'ct.type', 'users.name'
    ];

    public function title()
    {
        return $this->user->name . ' - ' . $this->partner_type->type;
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User')->searchable(),
            Text::make('Email')->displayUsing(function () {
                return $this->user->email;
            })->exceptOnForms(),
            Text::make('Referral Code')->displayUsing(function() {
                return "<a class='no-underline dim text-primary font-bold' href='{$this->user->referral_link}' target='_blank'>{$this->user->referral_code}</a>";
            })->asHtml()->exceptOnForms(),
            BelongsTo::make('Contract Type'),
            BelongsTo::make('Partner Type'),
            HasMany::make('Landing Pages'),
            HasMany::make('Partner Claims','claims'),
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
        $query->select(['partner_profiles.*', 'pt.type', 'ct.type'])
            ->join('partner_types as pt', 'partner_profiles.partner_type_id', '=', 'pt.id')
            ->join('contract_types as ct', 'partner_profiles.contract_type_id', '=', 'ct.id')
            ->join('users', 'partner_profiles.user_id', '=', 'users.id');

        return $query;
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
}
