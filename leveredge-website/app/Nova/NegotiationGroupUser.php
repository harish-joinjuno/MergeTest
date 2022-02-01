<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;

class NegotiationGroupUser extends Resource
{
    public static $model = \App\NegotiationGroupUser::class;

    public static $title = 'id';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')->sortable()->searchable(),
            BelongsTo::make('Academic Year', 'academicYear')->sortable(),
            BelongsTo::make('Negotiation Group', 'negotiationGroup')->sortable(),

            Number::make('Amount')
                ->displayUsing(function($value) {
                    return '$ ' . number_format($value, 2);
                }),
            Badge::make('Status')->map([
                self::$model::STATUS_PENDING  => 'info',
                self::$model::STATUS_APPROVED => 'success',
                self::$model::STATUS_DENIED   => 'danger',
            ])->sortable(),
            Select::make('Status')->options([
                self::$model::STATUS_PENDING  => 'Peding',
                self::$model::STATUS_APPROVED => 'Approved',
                self::$model::STATUS_DENIED   => 'Denied',
            ])->onlyOnForms(),
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
