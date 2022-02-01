<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\MarketingEmailUnsubscribe;
use Aws\Sns\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SesWebhookController extends Controller
{
    public function registerBounce(Request $request){
        $message = Message::fromRawPostData();
        $sesMessage = json_decode($message['Message'], true);
        if($sesMessage['notificationType'] == 'Bounce'){
            $bounceType = $sesMessage['bounce']['bounceType'];
            $bounceSubType = $sesMessage['bounce']['bounceSubType'];
            if( $bounceType == 'Permanent'){
                foreach($sesMessage['bounce']['bouncedRecipients'] as $bouncedRecipient ){
                    MarketingEmailUnsubscribe::create([
                        'email'            => $bouncedRecipient['emailAddress'],
                        'has_unsubscribed' => 1,
                        'reason'           => "Bounce: " . $bounceType . " : " . $bounceSubType
                    ]);
                }
            }
        }
    }

    public function registerComplaint(Request $request){
        $message = Message::fromRawPostData();
        $sesMessage = json_decode($message['Message'], true);
        if($sesMessage['notificationType'] == 'Complaint'){
            foreach($sesMessage['complaint']['complainedRecipients'] as $complainedRecipient ){
                MarketingEmailUnsubscribe::create([
                    'email'            => $complainedRecipient['emailAddress'],
                    'has_unsubscribed' => 1,
                    'reason'           => "Complaint"
                ]);
            }
        }
    }

    public function registerOpenOrClick(Request $request){
        throw new \Exception('Not Yet Implemented', 511);
    }


}
