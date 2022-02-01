<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Jobs\TwilioWebhookHandler;

class TwilioWebhookController extends Controller
{
    public function __invoke()
    {
        dispatch(new TwilioWebhookHandler(request()->all()));
        abort(400);
    }
}
