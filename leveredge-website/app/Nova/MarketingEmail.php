<?php

namespace App\Nova;

use App\Nova\Actions\SendMarketingEmail;
use App\Nova\Filters\MarketingEmailsDateFilter;
use App\Nova\Filters\MarketingEmailStatusFilter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MarketingEmail extends Resource
{
    public static $model = \App\MarketingEmail::class;

    public static $title = 'id';

    public static $group = 'Marketing';

    public static $search = [
        'id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')->sortable(),

            Text::make('Email Address', 'email_address')
                ->sortable()
                ->required(),

            BelongsTo::make('MarketingEmailTemplate')
                ->sortable()
                ->required(),

            Select::make('Status', 'status')
                ->sortable()
                ->nullable()
                ->options(\App\MarketingEmail::MAIL_STATUSES)
                ->displayUsingLabels(),

            Date::make('Send Date', 'send_date')
                ->sortable()
                ->required(),

            Number::make('Open', 'open')->sortable(),

            Number::make('Click', 'click')->sortable(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [
            new MarketingEmailsDateFilter(),
            new MarketingEmailStatusFilter(),
        ];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [
            new SendMarketingEmail(),
        ];
    }
}
