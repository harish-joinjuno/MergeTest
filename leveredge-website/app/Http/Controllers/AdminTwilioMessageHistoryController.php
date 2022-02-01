<?php


namespace App\Http\Controllers;


use App\SmsMessage;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;

class AdminTwilioMessageHistoryController extends Controller
{
    public function index()
    {
        return view('admin.message-histories.view-by-phone');
    }

    public function search(Request $request)
    {
        $messages = SmsMessage::where('to', 'like', "%{$request->phone}%")
            ->orWhere(function ($query) use ($request) {
                return $query->where('from', 'like', "%{$request->phone}%")
                    ->whereIncoming(1);
            })
            ->get();

        $userInfo = null;
        if ($userProfile = UserProfile::where('phone_number', 'like', "%{$request->phone}%")->first())
            $userInfo = User::with(['profile.university', 'profile.gradUniversity', 'profile.degree', 'profile.gradDegree'])->find($userProfile->user_id);
        if ($messages->count())
            $userInfo = User::with(['profile.university', 'profile.gradUniversity', 'profile.degree', 'profile.gradDegree'])->find($messages->first()->user_id);

        return response()->json([
            'messages' => $messages,
            'userInfo' => $userInfo
        ]);
    }
}
