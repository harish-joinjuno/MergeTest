<?php

namespace Tests\Feature\UserProfile;

use App\Events\UserProfileRoleUpdated;
use App\Facades\Mailchimp;
use App\Role;
use App\UserProfile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfilePersonalInfo extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.personal-info'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.personal-info'),
        ]);

        $this->assertEquals(urldecode($expected), $actual);
    }

    /** @test */
    public function it_should_render_properly()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->get(route('user-profile.personal-info'))
            ->assertSuccessful()
            ->assertSee('Personal Information');
    }

    /** @test */
    public function it_should_render_properly_when_refinancing()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_REFINANCE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->get(route('user-profile.personal-info'))
            ->assertSuccessful()
            ->assertSee('Personal Information')
            ->assertDontSee('Are you the student or a parent?');
    }

    /** @test */
    public function it_should_fail_if_role_is_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['role']));
        $this->assertValidationError('role', 'validation.required');

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['role']));
        $this->assertValidationError('role', 'validation.in');

        $user->profile->refresh();
        $user->profile->loan_type = UserProfile::LOAN_TYPE_REFINANCE;
        $user->profile->save();
        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role' => UserProfile::ROLE_PARENT,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['role']));
        $this->assertValidationError('role', 'validation.in');
    }

    /** @test */
    public function it_should_fail_if_citizenship_status_is_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'citizenship_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['citizenship_status']));
        $this->assertValidationError('citizenship_status', 'validation.required');

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'citizenship_status' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['citizenship_status']));
        $this->assertValidationError('citizenship_status', 'validation.in');
    }

    /** @test */
    public function it_should_fail_if_first_name_is_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'first_name' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['first_name']));
        $this->assertValidationError('first_name', 'validation.required');

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'first_name' => Str::random(65),
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['first_name']));
        $this->assertValidationError('first_name', 'validation.max.string', ['max' => 64]);
    }

    /** @test */
    public function it_should_fail_if_last_name_is_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'last_name' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['last_name']));
        $this->assertValidationError('last_name', 'validation.required');

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'last_name' => Str::random(65),
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['last_name']));
        $this->assertValidationError('last_name', 'validation.max.string', ['max' => 64]);
    }

    /** @test */
    public function it_should_fail_if_phone_number_is_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'phone_number' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['phone_number']));
        $this->assertValidationError('phone_number', 'validation.phone');

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['phone_number']));
        $this->assertValidationError('phone_number', 'validation.present');
    }

    /** @test */
    public function it_should_successfully_save_and_redirect_to_undergraduate_page()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role'                 => UserProfile::ROLE_STUDENT,
                'first_name'           => $this->faker->firstName,
                'last_name'            => $this->faker->lastName,
                'citizenship_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                'phone_number'         => "(801) 321-1234",
                'heard_from_option_id' => 1,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-undergrad');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD,
        ]);
    }

    /** @test */
    public function it_should_successfully_save_and_redirect_to_undergraduate_page_when_refinancing()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->withLoanType(UserProfile::LOAN_TYPE_REFINANCE)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role'                 => UserProfile::ROLE_STUDENT,
                'first_name'           => $this->faker->firstName,
                'last_name'            => $this->faker->lastName,
                'citizenship_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                'phone_number'         => "(801) 321-1234",
                'heard_from_option_id' => 1,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.financials');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD,
        ]);
    }

    /** @test */
    public function it_should_successfully_save_and_redirect_to_graduate_page()
    {
        Mailchimp::shouldReceive('syncSubscriber');

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role'                 => UserProfile::ROLE_STUDENT,
                'first_name'           => $this->faker->firstName,
                'last_name'            => $this->faker->lastName,
                'citizenship_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                'phone_number'         => "(801) 321-1234",
                'heard_from_option_id' => 1,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-grad');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD,
        ]);
    }

    /** @test */
    public function it_should_successfully_save_and_dispatch_event_role_updated()
    {
        Event::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->post(route('user-profile.personal-info'), [
                'role'                 => UserProfile::ROLE_STUDENT,
                'first_name'           => $this->faker->firstName,
                'last_name'            => $this->faker->lastName,
                'citizenship_status'   => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                'phone_number'         => null,
                'heard_from_option_id' => 1,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        Event::assertDispatched(UserProfileRoleUpdated::class, function ($event) use ($user) {
            return $event->user->id == $user->id;
        });
    }
}
