<?php

namespace Tests\Feature\UserProfile;

use App\Role;
use App\UserProfile;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileLoanType extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.loan-type'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.loan-type'),
        ]);

        $this->assertEquals(urldecode($expected), $actual);
    }

//    /** @test */
//    public function it_should_render_properly()
//    {
//        $user = (new UserBuilder())
//            ->withEmail()
//            ->withPassword()
//            ->withRoleName(Role::ROLE_NAME_BORROWER)
//            ->get();
//
//        (new UserProfileBuilder())
//            ->withUser($user)
//            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
//            ->save()
//            ->get();
//
//        $this
//            ->actingAs($user)
//            ->get(route('user-profile.loan-type'))
//            ->assertSuccessful()
//            ->assertSee('Undergraduate Student Loan')
//            ->assertSee('Graduate Student Loan')
//            ->assertSee('Refinance Loan');
//
//        $this->assertDatabaseHas('user_profiles', [
//            'user_id'         => $user->id,
//            'signup_progress' => UserProfile::SIGNUP_PROGRESS_LOAN_TYPE,
//        ]);
//    }

//    /** @test */
//    public function it_should_fail_if_loan_type_is_invalid()
//    {
//        $user = (new UserBuilder())
//            ->withEmail()
//            ->withPassword()
//            ->withRoleName(Role::ROLE_NAME_BORROWER)
//            ->get();
//
//        (new UserProfileBuilder())
//            ->withUser($user)
//            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_LOAN_TYPE)
//            ->save()
//            ->get();
//
//        $this
//            ->actingAs($user)
//            ->post(route('user-profile.loan-type'), [
//                'loan_type' => null,
//            ])
//            ->assertRedirect()
//            ->assertSessionHasErrors();
//
//        $errors = $this->getValidationErrors();
//        $this->assertTrue(isset($errors['loan_type']));
//        $this->assertValidationError('loan_type', 'validation.required');
//
//        $this
//            ->actingAs($user)
//            ->post(route('user-profile.loan-type'), [
//                'loan_type' => 'abc',
//            ])
//            ->assertRedirect()
//            ->assertSessionHasErrors();
//
//        $errors = $this->getValidationErrors();
//        $this->assertTrue(isset($errors['loan_type']));
//        $this->assertValidationError('loan_type', 'validation.in');
//    }

    /** @test */
    public function it_should_successfully_save_and_redirect_to_personal_info_page()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_LOAN_TYPE)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->post(route('user-profile.loan-type'), [
                'loan_type' => UserProfile::LOAN_TYPE_UNDERGRADUATE,
            ])
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.personal-info');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO,
        ]);
    }

    /** @test */
    public function it_should_redirect_to_loan_type_page()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_LOAN_TYPE)
            ->save()
            ->get();

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.loan-type');

        $this->assertEquals($expected, $actual);
    }
}
