<?php


namespace App\Http\Controllers;

use App\Facades\Mailchimp;
use App\Http\Requests\DeleteAccountRequest;
use App\Mail\MemberAccountDeleted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DeleteAccountController extends Controller
{
    public function show()
    {
        return view('member.delete-account');
    }

    public function delete(DeleteAccountRequest $request)
    {
        $user          = user();
        $deleteRequest = $user->deleteRequest()->create([
            'reason' => $request->reason,
        ]);

        if (! Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Password does not match']);
        }

        Mailchimp::unsubscribe($user->email, config('services.mailchimp.default_list_id'));
        auth()->logout();
        $user->delete();
        Mail::to(['nikhil@joinjuno.com', 'max@joinjuno.com'])->send(new MemberAccountDeleted($deleteRequest->id));
        session()->flash('account_deleted', true);
        Auth::logoutOtherDevices($request->password);
        return redirect()->to('/member/delete-account/success');
    }

    public function success()
    {
        if (session()->get('account_deleted')) {
            return view('member.delete-account-success');
        }

        return redirect()->to('/');
    }
}
