<?php

namespace Tests\Feature\CampusAmbassadorTask;

use App\CampusAmbassadorTask;
use App\CompletedCampusAmbassadorTask;
use App\Events\CampusAmbassadorTaskCompleted;
use App\Listeners\NotifyTaskCompletedToAdminListener;
use App\Notifications\TaskCompletedNotification;
use App\PaymentMethod;
use App\Role;
use App\User;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\Builders\CampusAmbassadorTaskBuilder;
use Tests\Builders\PartnerProfileBuilder;
use Tests\Builders\PaymentMethodBuilder;
use Tests\Builders\UserBuilder;
use Tests\Feature\FeatureTest;

class MarkTaskCompleteTest extends FeatureTest
{
    /** @test */
    public function it_should_fail_when_user_not_ambassador()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        $task = (new CampusAmbassadorTaskBuilder())
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', ['task' => $task]);

        $this
            ->actingAs($user)
            ->get($url)
            ->assertForbidden();
    }

    /** @test */
    public function it_should_succeed_when_user_is_ambassador()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->get($url)
            ->assertSuccessful();
    }

    /** @test */
    public function it_should_failed_when_task_payment_type_is_hourly_and_hours_not_informed()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withTaskRecurrence(CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->actingAs($user)
            ->post($url, [
                'hours_worked'     => null,
                'ambassador_notes' => null,
            ])
            ->assertSessionHasErrorsIn('default');

        $this->assertValidationError('hours_worked', 'validation.required');
    }

    /** @test */
    public function it_should_see_the_field_hourly_rate_when_task_payment_type_is_hourly()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withTaskRecurrence(CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->actingAs($user)
            ->get($url)
            ->assertSee('Payment Amount')
            ->assertSee('hourly rate');
    }

    /** @test */
    public function it_should_see_the_field_payment_amount_when_task_payment_type_is_fixed()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withTaskRecurrence(CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->actingAs($user)
            ->get($url)
            ->assertDontSee('Hourly Rate')
            ->assertSee('Payment Amount');
    }

    /** @test */
    public function it_should_failed_when_hours_not_informed_is_not_numeric()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withTaskRecurrence(CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_HOURLY)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->actingAs($user)
            ->post($url, [
                'hours_worked'     => 'abc',
                'ambassador_notes' => null,
            ])
            ->assertSessionHasErrorsIn('default');

        $this->assertValidationError('hours_worked', 'validation.numeric');
    }

    /** @test */
    public function it_should_failed_when_ambassador_notes_is_not_present()
    {
        (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withTaskRecurrence(CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->actingAs($user)
            ->post($url, [
            ])
            ->assertSessionHasErrorsIn('default');

        $this->assertValidationError('ambassador_notes', 'validation.present');
    }

    /** @test */
    public function it_should_not_notify_non_admin_users()
    {
        $paymentMethod = (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        Notification::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
            ->withFixedPaymentAmount(1000)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $response = $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post($url, [
                'ambassador_notes' => null,
                'payment_method'   => $paymentMethod->id,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        Notification::assertNotSentTo(
            [$user], TaskCompletedNotification::class
        );
    }

    /** @test */
    public function it_should_notify_admin_users()
    {
        $paymentMethod = (new PaymentMethodBuilder())
            ->withName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)
            ->save()
            ->get();

        Notification::fake();
        Event::fake();
        Queue::fake();

        if (! $admin = User::whereEmail('nikhil@leveredge.org')->first()) {
            $admin = (new UserBuilder())
                ->withEmail('nikhil@leveredge.org')
                ->withPassword()
                ->withRoleName(Role::ROLE_NAME_ADMIN)
                ->get();
        }

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_PARTNER)
            ->get();

        (new PartnerProfileBuilder())
            ->withContractType()
            ->withPartnerType()
            ->withUser($user)
            ->save();

        $task = (new CampusAmbassadorTaskBuilder())
            ->withFixedPaymentAmount(1000)
            ->withPaymentType(CampusAmbassadorTask::PAYMENT_TYPE_FIXED)
            ->save()
            ->get();

        $url = route('campus-ambassador-tasks.mark-complete', [
            'task' => $task,
        ]);

        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post($url, [
                'ambassador_notes' => null,
                'payment_method'   => $paymentMethod->id,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $completedCampusAmbassadorTask = CompletedCampusAmbassadorTask::whereUserId($user->id)
            ->whereCampusAmbassadorTaskId($task->id)
            ->first();

        Event::assertDispatched(CampusAmbassadorTaskCompleted::class);

        $listener = new NotifyTaskCompletedToAdminListener();
        $listener->handle(new CampusAmbassadorTaskCompleted($completedCampusAmbassadorTask));

        Notification::assertSentTo(
            [$admin], TaskCompletedNotification::class
        );
    }

}
