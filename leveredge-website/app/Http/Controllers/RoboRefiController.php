<?php


namespace App\Http\Controllers;

use App\Jobs\SyncScholarshipEntrantWithMailcoachJob;
use App\Mail\RoboRefiUserOnWaitList;
use App\RoboRefiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RoboRefiController extends Controller
{
    public function show(Request $request)
    {
        return view('robo-refi.show');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $roboRefiUser = RoboRefiUser::firstOrNew(['email' => $validatedData['email']]);
        $roboRefiUser->save();


        if ($roboRefiUser->wasRecentlyCreated) {
            $listId = config('services.mailcoach_email.robo_refi_list_id');
            dispatch(new SyncScholarshipEntrantWithMailcoachJob($roboRefiUser, $listId));
            Mail::to($roboRefiUser->email)
                ->send(new RoboRefiUserOnWaitList($roboRefiUser));
        }

        return redirect('/robo-refi/success/' . $roboRefiUser->id);
    }

    public function success(Request $request, $roboRefiUserId)
    {
        $roboRefiUser = RoboRefiUser::findOrFail($roboRefiUserId);

        return view('robo-refi.success')->with(compact([
            'roboRefiUser',
        ]));
    }
}
