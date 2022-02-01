<?php


namespace App\Http\Controllers\Webhooks;


use App\Http\Controllers\Controller;
use App\Notifications\CalendlyNewInviteeCreatedNotification;
use App\Notifications\NotFoundSlackNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CalendlyWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        Notification::route('slack', config('services.slack.experiments_webhook_url'))
            ->notify(new CalendlyNewInviteeCreatedNotification($request->all()));

        return response()->json(['success' => true]);
    }
}
