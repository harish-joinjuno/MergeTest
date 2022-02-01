<?php

namespace App\Listeners;

use App\Events\EmailEnteredOnAutoRefinanceApplication;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\App;

class ReportViewContentToFacebook implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailEnteredOnAutoRefinanceApplication $event)
    {
        $access_token  = config('services.facebook.access_token');
        $pixel_id      = config('services.facebook.pixel_id');
        $api           = Api::init(null,null,$access_token);
        $api->setLogger(new CurlLogger());


        $user_data = (new UserData())
            ->setFbp($event->requestInformation['fbp'])
            ->setClientIpAddress($event->requestInformation['ip_address'])
            ->setClientUserAgent($event->requestInformation['user_agent']);

        if ($event->requestInformation['fbc']) {
            $user_data = $user_data->setFbc($event->requestInformation['fbc']);
        }
        $user_data->setEmail($event->email);

        $custom_data = (new CustomData())
            ->setCurrency('usd')
            ->setValue($event->eventInformation['value']);

        if ($event->eventInformation['category']) {
            $custom_data->setContentCategory($event->eventInformation['category']);
        }

        if ($event->eventInformation['label']) {
            $custom_data->setContentType('product');
            $custom_data->setContentIds($event->eventInformation['label']);
        }

        $facebook_event = (new Event())
            ->setEventName($event->eventInformation['action'])
            ->setEventTime(time())
            ->setEventSourceUrl($event->requestInformation['url'])
            ->setUserData($user_data)
            ->setCustomData($custom_data);

        $events = [];

        array_push($events, $facebook_event);

        $facebookRequest = (new EventRequest($pixel_id))
            ->setEvents($events);

        if (!App::environment('production')) {
            $facebookRequest->setTestEventCode("TEST72170");
        }

        $facebookRequest->execute();
    }
}
