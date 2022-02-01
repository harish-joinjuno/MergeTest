<?php

use App\CompletedCampusAmbassadorTask;
use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    public function run()
    {
        PaymentMethod::unguard();
        CompletedCampusAmbassadorTask::unguard();

        /** @var PaymentMethod $default */
        $default = PaymentMethod::query()->updateOrCreate([
            'name' => PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK,
        ]);

        PaymentMethod::query()->updateOrCreate([
            'name' => PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD,
        ]);

        PaymentMethod::query()->updateOrCreate([
            'name' => PaymentMethod::PAYMENT_METHOD_SCHOLARSHIP_POT,
        ]);

        CompletedCampusAmbassadorTask::query()
            ->where('payment_completed', '=', false)
            ->whereNull('payment_method_id')
            ->update([
                'payment_method_id' => $default->id,
            ]);
    }
}
