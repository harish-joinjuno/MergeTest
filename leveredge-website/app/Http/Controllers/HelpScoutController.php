<?php


namespace App\Http\Controllers;

use App\Facades\HelpScout;
use Illuminate\Http\Request;

class HelpScoutController extends Controller
{
    public function sendMessage(Request $request)
    {
        HelpScout::createConversation(user()->email, $request->get('message'));

        return response()->json([
            'success' => true,
        ]);
    }

    public function getMember()
    {
        $helpScoutSignature  = config('services.helpscout.signature');
        $calculatedSignature = base64_encode(hash_hmac('sha1', file_get_contents('php://input'), $helpScoutSignature, true));
        if ($calculatedSignature === request()->header('X-HELPSCOUT-SIGNATURE')) {
            $request        = request()->all();
            $email          = $request["customer"]["email"];
            $user           = \App\User::whereEmail($email)->first();
            if (! $user) {
                echo json_encode([
                    'html' => '<h3 style="color: black;">Not a Juno Member</h3>',
                ]);
                die;
            }

            $html           = view('helpscout.app', compact( 'user'))->render();
            echo json_encode([
                'html' => $html,
            ]);
            die;
        }
        echo json_encode([
            'html' => '',
        ]);
        die;
    }
}
