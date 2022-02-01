<?php

namespace App\Policies;

use App\Payment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function before($user, $abilities)
    {
        if (in_array($user->email, ['nikhil@leveredge.org'])) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Payment $payment)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Payment $payment)
    {
        return false;
    }

    public function delete(User $user, Payment $payment)
    {
        return false;
    }

    public function restore(User $user, Payment $payment)
    {
        return false;
    }

    public function forceDelete(User $user, Payment $payment)
    {
        return false;
    }
}
