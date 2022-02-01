<?php


namespace App\Http\Controllers;

use App\NegotiationGroupUser;
use App\NegotiationGroupUserLeave;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeaveNegotiationGroup2122Controller extends Controller
{
    public function index()
    {
        if (! NegotiationGroupUser::whereUserId(user()->id)->whereNegotiationGroupId(22)->exists()) {
            return redirect()->to('/member/dashboard');
        }

        return view('leave-ng-group-22.index');
    }

    public function leave(Request $request)
    {
        $request->validate([
            'reason' => [
                'required',
                Rule::in(NegotiationGroupUserLeave::REASONS),
            ],
        ]);

        if (! $negotiationGroupUser = NegotiationGroupUser::whereUserId(user()->id)->whereNegotiationGroupId(22)->first()) {
            return redirect()->to('/dashboard');
        }
        $negotiationGroupUserLeave                            = new NegotiationGroupUserLeave();
        $negotiationGroupUserLeave->user_id                   = user()->id;
        $negotiationGroupUserLeave->negotiation_group_user_id = $negotiationGroupUser->id;
        $negotiationGroupUserLeave->reason                    = $request->reason;
        $negotiationGroupUserLeave->save();
        $negotiationGroupUser->delete();

        session()->flash('group_leave_success', true);

        return redirect()->to('/leave-negotiation-group/success');
    }


    public function success()
    {
        if (session()->get('group_leave_success')) {
            return view('leave-ng-group-22.success');
        }

        return redirect()->to('/member/dashboard');
    }
}
