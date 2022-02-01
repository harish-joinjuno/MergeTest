<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BoldPingListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return Response | null
     */
    public function handle($event)
    {
        return Http::get(config('services.bold.bold_ping_url'), [
            'key'    => 'leveredge',
            'subId1' => $event->subId1,
        ]);
    }
}
