<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->to('/login');
        }

        auth()->loginUsingId($user->id);

        return view('auth.passwords.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ], $request->all());
        $user           = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->to('/member/dashboard');
    }
}
