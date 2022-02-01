<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class UserProfile extends Resource
{
    public static $model = \App\UserProfile::class;

    public static $title = 'user_name';

    public static $group = 'Admin';

    public static $search = [
        'id', 'users.name', 'users.email', 'phone_number','utm_campaign','utm_source','utm_medium', 'utm_term'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User')->sortable()->searchable(),

            Text::make('Immigration Status')->sortable()->hideFromIndex(),
            Text::make('Application Status')->sortable()->hideFromIndex(),
            Text::make('Phone Number')->sortable()->hideFromIndex(),
            Boolean::make('Is Confirmed With User')->sortable()->hideFromIndex(),
            Boolean::make('Has Access to Deal', 'has_access_to_deal'),

            new Panel('Undergraduate Information', $this->undergraduateFields()),
            new Panel('Graduate Information', $this->graduateFields()),
            new Panel('Financial Information', $this->financialFields()),
            new Panel('Utm Codes', $this->utmFields()),

            Text::make('Role')->hideFromIndex(),
        ];
    }

    protected function utmFields()
    {
        return [
            Text::make('Utm Source')->readonly()->hideFromIndex(),
            Text::make('Utm Medium')->readonly()->hideFromIndex(),
            Text::make('Utm Campaign')->readonly()->hideFromIndex(),
            Text::make('Utm Term')->readonly()->hideFromIndex(),
            Text::make('Utm Content')->readonly()->hideFromIndex()

        ];
    }

    protected function undergraduateFields()
    {
        return [
            BelongsTo::make('University')->sortable()->nullable(),
            BelongsTo::make('Degree')->sortable()->nullable(),
            Number::make('Graduation Year')->sortable()->hideFromIndex(),
            Text::make('Enrollment Status')->sortable()->hideFromIndex(),
            Text::make('Degree Format')->sortable()->hideFromIndex(),
        ];
    }

    protected function graduateFields()
    {
        return [
            BelongsTo::make('Grad University','gradUniversity',\App\Nova\University::class)->sortable()->nullable(),
            BelongsTo::make('Grad Degree','gradDegree',\App\Nova\Degree::class)->sortable()->nullable(),
            Number::make('Grad Graduation Year')->sortable()->hideFromIndex(),
            Text::make('Grad Enrollment Status')->sortable()->hideFromIndex(),
            Text::make('Grad Degree Format')->sortable()->hideFromIndex(),
        ];
    }

    protected function financialFields()
    {
        return [
            Text::make('Credit Score')->sortable()->hideFromIndex(),
            Number::make('Annual Income')->sortable()->hideFromIndex(),
            Text::make('Cosigner Status')->sortable()->hideFromIndex(),
            Text::make('Cosigner Credit Score')->sortable()->hideFromIndex(),
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
        $query->select(['user_profiles.*', 'users.name as user_name'])
            ->join('users', 'user_profiles.user_id', '=', 'users.id');
        return $query;
    }
}
