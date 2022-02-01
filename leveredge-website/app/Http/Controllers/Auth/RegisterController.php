<?php

namespace App\Http\Controllers\Auth;

use App\Events\LeadCaptured;
use App\Http\Controllers\Controller;
use App\Traits\DeletedAccountCheckTrait;
use App\Traits\registersBorrowers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers,
        registersBorrowers,
        DeletedAccountCheckTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'    => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required|string|min:6',
        ]);
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('email')) {
            $email = request()->get('email');
            if ($email) {
                event(new LeadCaptured($request->email));
            }
            return view('auth.register')->with('piped_email', $request->email);
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->abortIfAccountIsDeleted($request->email);

        $user = $this->create($request->all());

        $this->createBorrowerProfile($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        event(new Registered($user));

        $this->guard()->login($user);
    }
}
