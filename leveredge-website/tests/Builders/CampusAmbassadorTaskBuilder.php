<?php


namespace Tests\Builders;

use App\CampusAmbassadorTask;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CampusAmbassadorTaskBuilder
{
    use WithFaker;

    /** @var CampusAmbassadorTask */
    public $campusAmbassadorTask;

    public function __construct($attributes = [])
    {
        $this->faker                = $this->makeFaker('en_US');
        $this->campusAmbassadorTask = factory(CampusAmbassadorTask::class)->make($attributes);
    }

    public function save()
    {
        $this->campusAmbassadorTask->save();

        return $this;
    }

    public function get()
    {
        return $this->campusAmbassadorTask;
    }

    public function withTaskRecurrence(int $taskRecurrence = null)
    {
        Validator::make(['task_recurrence' => $taskRecurrence], [
            'task_recurrence' => [
                'nullable',
                Rule::in([
                    CampusAmbassadorTask::TASK_RECURRENCE_NONE,
                    CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
                ])],
        ]);

        $this->campusAmbassadorTask->task_recurrence = $taskRecurrence ?? $this->faker->randomElement([
                CampusAmbassadorTask::TASK_RECURRENCE_NONE,
                CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
            ]);

        return $this;
    }

    public function withTaskCompletionTracking(int $taskCompletionTracking = null)
    {
        Validator::make(['task_completion_tracking' => $taskCompletionTracking], [
            'task_completion_tracking' => [
                'nullable',
                Rule::in([
                    CampusAmbassadorTask::TASK_COMPLETION_TRACKING_AUTOMATIC,
                    CampusAmbassadorTask::TASK_COMPLETION_TRACKING_MANUAL,
                ])],
        ]);

        $this->campusAmbassadorTask->task_completion_tracking = $taskCompletionTracking ?? $this->faker->randomElement([
                CampusAmbassadorTask::TASK_RECURRENCE_NONE,
                CampusAmbassadorTask::TASK_RECURRENCE_RECURRING,
            ]);

        return $this;
    }

    public function withPaymentType(int $paymentType = null)
    {
        Validator::make(['payment_type' => $paymentType], [
            'payment_type' => [
                'nullable',
                Rule::in([
                    CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
                    CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
                    CampusAmbassadorTask::PAYMENT_TYPE_NONE,
                ])],
        ]);

        $this->campusAmbassadorTask->payment_type = $paymentType ?? $this->faker->randomElement([
                CampusAmbassadorTask::PAYMENT_TYPE_FIXED,
                CampusAmbassadorTask::PAYMENT_TYPE_HOURLY,
                CampusAmbassadorTask::PAYMENT_TYPE_NONE,
            ]);

        return $this;
    }

    public function withFixedPaymentAmount(int $fixedPaymentAmount = null)
    {
        $this->campusAmbassadorTask->fixed_payment_amount = $fixedPaymentAmount ?? $this->faker->randomElement([
                100,
                200,
                300,
            ]);

        return $this;
    }

    public function withTaskCompletionRedirect(string $taskCompletionRedirect = null)
    {
        $this->campusAmbassadorTask->task_completion_redirect = $taskCompletionRedirect ?? $this->faker->url;

        return $this;
    }
}
