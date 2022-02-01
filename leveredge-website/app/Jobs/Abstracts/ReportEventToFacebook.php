<?php


namespace App\Jobs\Abstracts;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

abstract class ReportEventToFacebook implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $requestInformation;

    public $eventInformation;

    public $email;

    public function __construct()
    {
        $this->requestInformation = $this->getRequestInformation();
        $this->eventInformation   = $this->getEventInformation();
        $this->email              = $this->getEmail();
    }

    public function handle()
    {
        if (is_null($this->eventInformation)) {
            return;
        }

        $access_token  = config('services.facebook.access_token');
        $pixel_id      = config('services.facebook.pixel_id');
        $api           = Api::init(null,null,$access_token);
        $api->setLogger(new CurlLogger());

        $user_data = (new UserData())
            ->setFbp($this->requestInformation['fbp'])
            ->setClientIpAddress($this->requestInformation['ip_address'])
            ->setClientUserAgent($this->requestInformation['user_agent']);

        if ($this->requestInformation['fbc']) {
            $user_data = $user_data->setFbc($this->requestInformation['fbc']);
        }
        $user_data->setEmail($this->email);

        $custom_data = (new CustomData())
            ->setCurrency('usd')
            ->setValue($this->eventInformation['value']);

        if ($this->eventInformation['category']) {
            $custom_data->setContentCategory($this->eventInformation['category']);
        }

        if ($this->eventInformation['label']) {
            $custom_data->setContentType('product');
            $custom_data->setContentIds($this->eventInformation['label']);
        }

        $facebook_event = (new Event())
            ->setEventName($this->eventInformation['action'])
            ->setEventTime(time())
            ->setEventSourceUrl($this->requestInformation['url'])
            ->setUserData($user_data)
            ->setCustomData($custom_data);

        if (isset($this->eventInformation['event_id'])) {
            $facebook_event->setEventId($this->eventInformation['event_id']);
        }

        $events = [];

        array_push($events, $facebook_event);

        $facebookRequest = (new EventRequest($pixel_id))
            ->setEvents($events);

        if (!App::environment('production')) {
            $facebookRequest->setTestEventCode("TEST72170");
        }

        $facebookRequest->execute();
    }

    abstract protected function getEventInformation();

    private function getRequestInformation()
    {
        $request = request();

        return [
            'ip_address'       => $request->ip(),
            'user_agent'       => $request->userAgent(),
            'path'             => $request->path(),
            'url'              => $request->fullUrl(),
            'fbp'              => Cookie::has('_fbp') ? Cookie::get('_fbp') : null,
            'fbc'              => null,
            'google_client_id' => Cookie::has('_ga') ? substr(Cookie::get('_ga'),6) : null,
        ];
    }

    private function getEmail()
    {
        return user()->email;
    }
}
