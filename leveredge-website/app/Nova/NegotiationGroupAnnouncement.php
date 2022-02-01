<?php

namespace App\Nova;

use App\Nova\Actions\NegotiationGroupAnnouncementHide;
use App\Nova\Actions\NegotiationGroupAnnouncementPublish;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;

class NegotiationGroupAnnouncement extends Resource
{
    public static $model = \App\NegotiationGroupAnnouncement::class;

    public static $title = 'id';

    public static $group = 'Negotiation Group';

    public static $search = [
        'id'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Negotiation Group', 'negotiationGroup'),
            Date::make('Announced On')->format('MMM Do, YYYY'),
            Trix::make('Body')
                ->withFiles(config('filesystems.nova_public_disk'))
                ->hideFromIndex(),
            Trix::make('Published Body')
                ->hideWhenUpdating()
                ->hideWhenCreating(),
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
        $publish = new NegotiationGroupAnnouncementPublish();

        return [
            $publish,
            new NegotiationGroupAnnouncementHide(),
        ];
    }
}
