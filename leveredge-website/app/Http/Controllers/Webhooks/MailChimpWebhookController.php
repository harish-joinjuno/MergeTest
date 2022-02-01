<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\MarketingEmailUnsubscribe;
use Illuminate\Http\Request;

class MailChimpWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->offsetExists('type') && $request->type == 'unsubscribe') {
            if ($request->offsetExists('data')) {
                $unsubscribe                   = new MarketingEmailUnsubscribe();
                $unsubscribe->email            = $request->data['email'];
                $unsubscribe->has_unsubscribed = true;
                if ($request->offsetExists('action') && $request->action == 'abuse') {
                    $unsubscribe->reason = 'Complaint';
                } else {
                    $unsubscribe->reason = 'Unsubscribed via MailChimp, ' . $request->data['list_id'];
                }
                $unsubscribe->save();
            }
        }

        return response()->json([],200);
    }
}
