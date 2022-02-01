<?php


namespace Tests\Builders;

use App\User;
use App\Payment;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\WithFaker;

class PaymentBuilder
{
    use WithFaker;

    /** @var Payment */
    public $payment;

    public function __construct($attributes = [])
    {
        $this->faker = $this->makeFaker('en_US');
        $this->payment = factory(Payment::class)->make($attributes);
    }

    public function save()
    {
        $this->payment->save();

        return $this;
    }

    public function get()
    {
        return $this->payment;
    }

    public function withAmount(int $amount = null)
    {
        $this->payment->amount = $amount ?? rand(25, 150);

        return $this;
    }

    public function withUser(User $user)
    {
        $this->payment->user_id = $user->id;

        return $this;
    }

    public function withPayer(User $payer)
    {
        $this->payment->payer_id = $payer->id;

        return $this;
    }
}
