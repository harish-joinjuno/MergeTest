<?php


namespace Tests\Builders;

use App\CampusAmbassadorTask;
use App\CompletedCampusAmbassadorTask;
use App\PaymentMethod;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class CompletedCampusAmbassadorTaskBuilder
{
    use WithFaker;

    /** @var CompletedCampusAmbassadorTask */
    public $completedCampusAmbassadorTask;

    public function __construct($attributes = [])
    {
        $this->faker                         = $this->makeFaker('en_US');
        $this->completedCampusAmbassadorTask = factory(CompletedCampusAmbassadorTask::class)->make($attributes);
    }

    public function save()
    {
        $this->completedCampusAmbassadorTask->save();

        return $this;
    }

    public function get()
    {
        return $this->completedCampusAmbassadorTask;
    }

    public function withCampusAmbassadorTask(CampusAmbassadorTask $campusAmbassadorTask = null)
    {
        if (!$campusAmbassadorTask) {
            $campusAmbassadorTask = (new CampusAmbassadorTaskBuilder())
                ->save()
                ->get();
        }

        $this->completedCampusAmbassadorTask->campus_ambassador_task_id = $campusAmbassadorTask->id;

        return $this;
    }

    public function withPaymentMethod(PaymentMethod $paymentMethod = null)
    {
        if (!$paymentMethod) {
            $paymentMethod = (new PaymentMethodBuilder())
                ->save()
                ->get();
        }

        $this->completedCampusAmbassadorTask->payment_method_id = $paymentMethod->id;

        return $this;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = (new UserBuilder())
                ->save()
                ->get();
        }

        $this->completedCampusAmbassadorTask->user_id = $user->id;

        return $this;
    }

    public function withAmount(int $amount = null)
    {
        $this->completedCampusAmbassadorTask->amount = $amount ?? $this->faker->randomElement([
                100,
                200,
                300,
            ]);

        return $this;
    }

    public function withPaymentCompleted(int $completed = null)
    {
        $this->completedCampusAmbassadorTask->payment_completed = $completed ?? $this->faker->boolean(25);

        return $this;
    }
}
