<?php

namespace Tests\Feature\UserProfile;

use App\Role;
use App\UserProfile;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileFlowSteps extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile'),
        ]);

        $this->assertEquals(urldecode($expected), $actual);
    }

    /** @test */
    public function it_should_successfully_render_loan_type_page()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->save()
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->get(route('user-profile.loan-type'))
            ->assertSuccessful();
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

    /** @test */
    public function it_should_redirect_to_personal_info_page()
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

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.personal-info');

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_should_redirect_to_school_undergrad()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
            ->save()
            ->get();

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-undergrad');

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_should_redirect_to_school_grad()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-grad');

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_should_redirect_to_financials()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.financials');

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_should_redirect_to_international_health_insurance()
    {
        $this->withoutExceptionHandling();
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTERNATIONAL_HEALTH_INSURANCE)
            ->save()
            ->get();

        $this->get(route('user-profile'))
            ->assertRedirect();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.international_health_insurance');

        $this->assertEquals($expected, $actual);
    }
}
