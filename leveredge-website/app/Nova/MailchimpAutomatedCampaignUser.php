<?php

namespace App\Nova;

use App\Nova\Actions\SendMailchimpCampaignEmailToMember;
use App\Nova\Actions\ValidateMailchimpCampaignMember;
use App\Nova\Filters\MailchimpAutomatedCampaignEmailStatusFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MailchimpAutomatedCampaignUser extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\MailchimpAutomatedCampaignUser::class;

    public static $group = 'Mailchimp Automated Campaigns';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','u.name','u.email','mc.name',
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

            BelongsTo::make('User', 'user')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Automated Campaign', 'mailchimpAutomatedCampaign', MailchimpAutomatedCampaign::class)
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Date::make('Send Date', 'send_date')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Boolean::make('Validated', 'validated')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make('Status', 'status')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Code::make('Response', 'response'),
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
        return [
            new MailchimpAutomatedCampaignEmailStatusFilter(),
        ];
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
        return [
            new ValidateMailchimpCampaignMember(),
            new SendMailchimpCampaignEmailToMember(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->select('mailchimp_automated_campaign_users.*','u.name', 'u.email', 'mc.name');
        $query->leftJoin('users as u', 'mailchimp_automated_campaign_users.user_id', '=', 'u.id');
        $query->leftJoin('mailchimp_automated_campaigns as mc', 'mailchimp_automated_campaign_users.mailchimp_automated_campaign_id', '=', 'mc.id');


        return $query;
    }
}
