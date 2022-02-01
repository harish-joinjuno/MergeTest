<?php

namespace App\Listeners;

use App\DealStatus;
use App\Events\UpdateSociallyPowered;
use GuzzleHttp\Client;

class UpdateSociallyPoweredAccessTheDeal
{
    /**
     * Handle the event.
     *
     * @param  UpdateSociallyPowered  $event
     * @return void
     */
    public function handle(UpdateSociallyPowered $event)
    {
        if ($event->accessTheDeal->loan_status_id === DealStatus::SIGNED_THE_LOAN) {
            $spBaseUrl = config('services.socially_powered.base_url');

            $client    = new Client();
            $client->post($spBaseUrl . '/webhook/juno/access-the-deals', [
                'form_params' => [
                    'accessTheDealId' => $event->accessTheDeal->id,
                    'deal'            => $event->accessTheDeal->deal->slug,
                    'loan_amount'     => $event->accessTheDeal->loan_amount,
                    'loan_status_id'  => $event->accessTheDeal->loan_status_id,
                ],
            ]);
        }
    }
}
