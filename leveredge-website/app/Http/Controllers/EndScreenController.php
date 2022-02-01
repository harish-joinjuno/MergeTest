<?php


namespace App\Http\Controllers;


use App\NegotiationGroupUser;
use Illuminate\Support\Str;

class EndScreenController extends Controller
{
    public function __invoke()
    {
        $user                           = user();
        $mostRecentNegotiationGroupUser = NegotiationGroupUser::where('user_id',$user->id)->orderBy('id','desc')->first();

        $names      = explode(' ', $user->name);
        $first_name = implode(' ', array_slice($names, 0, -1));
        $mostRecentNegotiationGroupUser->negotiationGroup->load('endScreen.infoCardElements');

        if (is_null($mostRecentNegotiationGroupUser->negotiationGroup)) {
            return view('user_profile.end-blocked', ['first_name' => $first_name]);
        }

        return view('user_profile.end', [
            'first_name'       => $first_name,
            'negotiationGroup' => $mostRecentNegotiationGroupUser->negotiationGroup,
            'backLink'         => url()->previous(),
        ]);
    }

    public function refinanceEndScreen()
    {
        return view('user-profile.refinancing-end');
    }
}
