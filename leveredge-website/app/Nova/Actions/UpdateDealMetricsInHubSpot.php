<?php

namespace App\Nova\Actions;

use App\Jobs\UpdateHubSpotProperties;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class UpdateDealMetricsInHubSpot extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $utmProps = $models->map(function ($item) {
            return [
                'utm_source'   => $item->utm_source,
                'utm_campaign' => $item->utm_campaign,
                'utm_term'     => $item->utm_term,
                'utm_content'  => $item->utm_content,
                'utm_medium'   => $item->utm_medium
            ];
        })->toArray();

        foreach($utmProps as $utmProp){
            dispatch(new UpdateHubSpotProperties($utmProp));
        }
    }


    public function fields()
    {
        return [];
    }
}
