<?php

namespace Tests\Feature\UserProfile;

use App\Degree;
use App\Role;
use App\UserProfile;
use Tests\Builders\DegreeBuilder;
use Tests\Builders\UniversityBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileUndergraduate extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.school-undergrad'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.school-undergrad'),
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
            ->get(route('user-profile.school-undergrad'))
            ->assertSuccessful()
            ->assertSee('Undergraduate Information');
    }

    /** @test */
    public function it_should_fail_if_university_id_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
            ->save()
            ->get();

        // exists
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'university_id' => -12,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['university_id']));
        $this->assertEquals('The selected university is invalid.', $errors['university_id'][0]);

        //integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'university_id' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['university_id']));
        $this->assertEquals('The university must be an integer.', $errors['university_id'][0]);
    }

    /** @test */
    public function it_should_fail_if_degree_id_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
            ->save()
            ->get();

        // exists
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_id' => -12,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['degree_id']));
        $this->assertEquals('The selected degree is invalid.', $errors['degree_id'][0]);

        //integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_id' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['degree_id']));
        $this->assertEquals('The degree must be an integer.', $errors['degree_id'][0]);

        //invalid degree
        $degree = (new DegreeBuilder())
            ->withType(Degree::TYPE_GRADUATE)
            ->save()
            ->get();
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_id' => $degree->id,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['degree_id']));
        $this->assertEquals('The degree field is an invalid degree type.', $errors['degree_id'][0]);
    }

    /** @test */
    public function it_should_redirect_to_grad_if_loan_type_is_graduate()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile.school-undergrad'))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-grad');

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function it_should_fail_if_graduation_year_invalid()
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

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'graduation_year' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['graduation_year']));
        $this->assertValidationError('graduation_year', 'validation.required');

        //must be integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'graduation_year' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['graduation_year']));
        $this->assertValidationError('graduation_year', 'validation.integer');

        //must be 1900 or above
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'graduation_year' => 1899,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['graduation_year']));
        $this->assertValidationError('graduation_year', 'validation.between.numeric', ['min' => 1900, 'max' => 2050]);


        //must be 2050 or bellow
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'graduation_year' => 2051,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['graduation_year']));
        $this->assertValidationError('graduation_year', 'validation.between.numeric', ['min' => 1900, 'max' => 2050]);
    }

    /** @test */
    public function it_should_fail_if_enrollment_status_invalid()
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

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'enrollment_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['enrollment_status']));
        $this->assertValidationError('enrollment_status', 'validation.required');

        //must be valid in array
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'enrollment_status' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['enrollment_status']));
        $this->assertValidationError('enrollment_status', 'validation.in');
    }

    /** @test */
    public function it_should_fail_if_degree_format_invalid()
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

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_format' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['degree_format']));
        $this->assertValidationError('degree_format', 'validation.required');

        //must be valid in array
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_format' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['degree_format']));
        $this->assertValidationError('degree_format', 'validation.in');
    }

    /** @test */
    public function it_should_successfully_save_and_redirect_to_finances_page()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->save()
            ->get();

        $degree = (new DegreeBuilder())
            ->withType(Degree::TYPE_UNDERGRADUATE)
            ->save()
            ->get();

        $university = (new UniversityBuilder())->save()->get();
        $response   = $this
            ->actingAs($user)
            ->post(route('user-profile.school-undergrad'), [
                'degree_id'         => $degree->id,
                'university_id'     => $university->id,
                'graduation_year'   => now()->year,
                'enrollment_status' => UserProfile::ENROLLMENT_STATUS_FULL_TIME,
                'degree_format'     => UserProfile::DEGREE_FORMAT_ON_CAMPUS,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.financials');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_FINANCIALS,
        ]);
    }
}
