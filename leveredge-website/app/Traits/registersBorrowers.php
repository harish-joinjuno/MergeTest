<?php

namespace App\Traits;

use App\Events\PingBold;
use App\Role;
use App\User;
use App\UserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait registersBorrowers
{
    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email'    => $data['email'],
            'password' => array_key_exists('password',$data) ? Hash::make($data['password']) : Hash::make(Str::random(12)) ,
        ]);

        $user->roles()->attach(Role::ROLE_BORROWER);

        return $user;
    }

    /**
     * @param User $user
     */
    protected function createBorrowerProfile(User $user)
    {
        if (Cookie::has('tracking_sources')) {
            $trackingSources = unserialize(Cookie::get('tracking_sources'));
            $user->profile()->create($trackingSources);

            if (isset($trackingSources['utm_source']) && $trackingSources['utm_source'] === 'bold') {
                event(new PingBold($trackingSources['subId1']));
            }
        } else {
            $user->profile()->create();
        }

        // Save the FBP to the profile if available
        if (Cookie::has('_fbp')) {
            $user->profile->fbp = Cookie::get('_fbp');
            $user->profile->save();
        }

        // Save the Google Client ID (ga) to the profile if available
        if (Cookie::has('_ga')) {
            $user->profile->ga = substr(Cookie::get('_ga'),6);
            $user->profile->save();
        }

        // Save the Request IP Address and User Agent
        $user->profile->ip_address = substr(request()->ip(),0,254);
        $user->profile->user_agent = substr(request()->userAgent(),0,254);
        $user->profile->save();

        // Check if someone has referred this new user.
        if (Cookie::has('affiliate')) {
            $referring_members_referral_code = Cookie::get('affiliate');
            $referring_members_profile       = User::where('referral_code', $referring_members_referral_code)->first();
            if ($referring_members_profile) {
                $user->referred_by_id      = $referring_members_profile->id;
                $user->profile->utm_source = UserProfile::UTM_MEMBER_REFERRAL;
                $user->save();
            }
        }
    }
}
