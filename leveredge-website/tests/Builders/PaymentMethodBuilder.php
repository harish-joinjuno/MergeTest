<?php


namespace Tests\Builders;

use App\PaymentMethod;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentMethodBuilder
{
    use WithFaker;

    /** @var PaymentMethod */
    public $paymentMethod;

    public function __construct($attributes = [])
    {
        $this->faker         = $this->makeFaker('en_US');
        $this->paymentMethod = factory(PaymentMethod::class)->make($attributes);
    }

    public function save()
    {
        $this->paymentMethod->save();

        return $this;
    }

    public function get()
    {
        return $this->paymentMethod;
    }

    public function withName(string $name = null)
    {
        Validator::make(['name' => $name], [
            'type' => [
                'nullable',
                Rule::in([
                    PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD,
                    PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK,
                ])],
        ]);

        $this->paymentMethod->name = $name ?? $this->faker->randomElement([
                PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD,
                PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK,
            ]);

        return $this;
    }
}
