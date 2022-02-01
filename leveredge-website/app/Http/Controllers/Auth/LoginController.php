<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSocialRequest;
use App\Role;
use App\SocialProvider;
use App\Traits\DeletedAccountCheckTrait;
use App\Traits\registersBorrowers;
use App\User;
use App\UserSocial;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    use registersBorrowers;

    use AuthenticatesUsers,
        DeletedAccountCheckTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','redirectToGoogleProvider','handleProviderGoogleCallback']);
    }

    /*
     * Redirect to Provider
     */
    protected function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function redirectToGoogleProvider()
    {
        return $this->redirectToProvider('google');
    }

    public function redirectToFacebookProvider()
    {
        return $this->redirectToProvider('facebook');
    }

    public function redirectToDoximityProvider()
    {
        return $this->redirectToProvider('doximity');
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return Response|void
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->abortIfAccountIsDeleted($request->email);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param Request $request
     * @param $provider
     * @return RedirectResponse
     */
    protected function handleProviderCallback(Request $request, $provider)
    {
        $auth_user = Socialite::driver($provider)->stateless()->user();
        if ($auth_user instanceof RedirectResponse) {
            return redirect()->to('/login');
        }
        if (! $auth_user->email) {
            $userSocial = UserSocial::firstOrCreate([
                'unique_id_from_provider' => $auth_user->user['id'],
                'social_provider_id'      => SocialProvider::whereName($provider)->first()->id,
                ],[
                'user_data'               => [
                    'name'       => $auth_user->name ?: $auth_user->first_name . ' ' . $auth_user->last_name,
                    'first_name' => isset($auth_user->first_name) ? $auth_user->first_name : null,
                    'last_name'  => isset($auth_user->last_name) ? $auth_user->last_name : null,
                ],
            ]);

            if ($userSocial->email_provided && $userSocial->user) {
                Auth::login($userSocial->user, true);

                return redirect()->to('/home');
            }

            session()->put('user_social_provider_id', encrypt($userSocial->id));

            return redirect()->to('/socials/email');
        }

        $user = User::where('email',$auth_user->email)->first();

        if ($user) {
            Auth::login($user, true);

            return redirect()->intended('/home');
        }

        $user = $this->create(
            [
                'name'     => $auth_user->name,
                'email'    => $auth_user->email,
                'password' => Hash::make(Str::random(8)),
            ]
        );

        $this->createBorrowerProfile($user);

        $this->registered($request, $user);

        return redirect()->intended($this->redirectPath());
    }

    public function handleProviderGoogleCallback(Request $request)
    {
        return $this->handleProviderCallback($request, 'google');
    }

    public function handleProviderFacebookCallback(Request $request)
    {
        return $this->handleProviderCallback($request,'facebook');
    }

    public function handleDoximityProviderCallback(Request $request)
    {
        return $this->handleProviderCallback($request, 'doximity');
    }

    public function showEmailForm()
    {
        if ($userSocialProviderId = session()->get('user_social_provider_id')) {
            $userSocial = UserSocial::find(decrypt($userSocialProviderId));

            if (! $userSocial->email_provided) {
                return view('socials.email');
            }
        }

        return redirect()->to('/member/dashboard');
    }

    public function storeEmailFromSocial(UserSocialRequest $request)
    {
        $userSocialProviderId = session()->get('user_social_provider_id');
        $userSocial           = UserSocial::find(decrypt($userSocialProviderId));
        if (! $userSocial->email_provided) {
            $user                 = User::create(
                [
                    'name'       => $userSocial->user_data['name'],
                    'email'      => $request->get('email'),
                    'password'   => Hash::make(Str::random(8)),
                    'first_name' => $userSocial->user_data['first_name'],
                    'last_name'  => $userSocial->user_data['last_name'],
                ]
            );
            $user->roles()->attach(Role::ROLE_BORROWER);

            $this->createBorrowerProfile($user);

            $userSocial->email_provided = true;
            $userSocial->user_id        = $user->id;
            $userSocial->save();

            session()->forget('user_social_provider_id');

            $this->registered($request, $user);

            return redirect()->intended($this->redirectPath());
        }

        return redirect()->to('/dashboard');
    }

    protected function registered(Request $request, $user)
    {
        event(new Registered($user));

        $this->guard()->login($user);
    }
}
