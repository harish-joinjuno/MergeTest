<?php

namespace App\Observers;


use App\Traits\HasChangesModel;
use App\User;
use Illuminate\Support\Str;

class UserObserver
{
    use HasChangesModel;

    public function created(User $user)
    {
        if (app()->environment('testing')) {
            return;
        }

        if (!$user->referral_code) {
            $user->referral_code = $this->getNewReferralCode();
        }

        $user->save();
    }

    protected function getNewReferralCode()
    {
        // Generate a unique random affiliate code
        $code = $this->generateReferralCode();

        // Iterate until we know that the code is unique in the database
        while (User::query()->where('referral_code', $code)->exists()) {
            $code = $this->generateReferralCode();
        }

        return $code;
    }

    protected function generateReferralCode()
    {
        return strtolower(Str::random(8));
    }

    public function updated(User $user)
    {
        if ($this->hasChanges($user)) {

        }
    }
}
