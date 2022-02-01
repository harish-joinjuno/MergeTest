<?php

namespace App\Http\Controllers;
use App\ReferralProgram;
use App\ReferralProgramUser;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterReferralController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|string|email|max:255|unique:users',
            'password'       => 'required|string|min:6',
        ]);
    }

    public function registerForReferralProgram(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name'  => $request['last_name'],
            'name'       => $request['first_name'] . " " . $request['last_name'],
            'email'      => $request['email'],
            'password'   => Hash::make($request['password']),
        ]);

        $user->roles()->attach(Role::ROLE_REFERRAL_PROGRAM_USER);

        $referralProgram = ReferralProgram::where('slug',ReferralProgram::REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K)->first();

        $referralProgramUser                      = new ReferralProgramUser();
        $referralProgramUser->user_id             = $user->id;
        $referralProgramUser->referral_program_id = $referralProgram->id;
        $referralProgramUser->starts_on           = Carbon::today()->format('Y-m-d');
        $referralProgramUser->save();

        Auth::guard()->login($user);

        return redirect()->intended('/home');
    }

    public function showReferralRegistrationForm(Request $request)
    {
        if ($request->has('email')) {
            return view('auth.register')->with('piped_email', $request->email);
        }

        return view('auth.register-referral');
    }
}
