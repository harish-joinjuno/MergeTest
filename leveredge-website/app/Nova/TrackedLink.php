<?php

namespace App\Nova;

use App\Facades\Hubspot;
use App\Nova\Actions\UpdateDealMetricsInHubSpot;
use App\UserProfile;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;

class TrackedLink extends Resource
{
    public static $model = \App\TrackedLink::class;

    public static $title = 'id';

    public static $search = [
        'id',
        'url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Url', 'url')
                ->sortable()
                ->required(),

            Text::make('Utm Source', 'utm_source')
                ->nullable()
                ->sortable(),

            Text::make('Utm Medium', 'utm_medium')
                ->nullable()
                ->sortable(),

            Text::make('Utm Campaign', 'utm_campaign')
                ->nullable()
                ->sortable(),

            Text::make('Utm Term', 'utm_term')
                ->nullable()
                ->sortable(),

            Text::make('Utm Content', 'utm_content')
                ->nullable()
                ->sortable(),

            Number::make('Hubspot deal ID', 'hubspot_deal_id')->nullable(),

            Trix::make('Notes', 'notes')
                ->nullable()
                ->sortable(),

            Text::make('Tracked Url', 'tracked_url')
                ->readonly(),

            new Panel('Hubspot Properties', $this->hubspotProperties()),
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
        return [
            new UpdateDealMetricsInHubSpot(),
        ];
    }

    protected function hubspotProperties()
    {
        if ($this->utm_source ||
            $this->utm_medium ||
            $this->utm_campaign ||
            $this->utm_term ||
            $this->utm_content
        ) {
            $userProfiles = UserProfile::whereUtmSource($this->utm_source)
                ->whereUtmMedium($this->utm_medium)
                ->whereUtmCampaign($this->utm_campaign)
                ->whereUtmTerm($this->utm_term)
                ->whereUtmContent($this->utm_content)
                ->get();

            return [
                Text::make('Registrations')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countRegistrations($userProfiles),
                    ]),

                Text::make('Complete Profiles')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countCompleteProfiles($userProfiles),
                    ]),

                Text::make('Complete Profiles High Quality')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countCompleteProfilesHighQualities($userProfiles),
                    ]),

                Text::make('Clicked to Provider')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countClickedToProviders($userProfiles),
                    ]),

                Text::make('Received Quotes')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countReceivedQuotes($userProfiles),
                    ]),

                Text::make('Signed Loan')
                    ->readonly()
                    ->onlyOnDetail()
                    ->withMeta([
                        'value' => Hubspot::countSignedLoans($userProfiles),
                    ]),
            ];
        }

        return [];
    }
}
