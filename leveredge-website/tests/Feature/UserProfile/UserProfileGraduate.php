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

class UserProfileGraduate extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.school-grad'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.school-grad'),
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
            ->get(route('user-profile.school-grad'))
            ->assertSuccessful()
            ->assertSee('Graduate Program Information');
    }

    /** @test */
    public function it_should_fail_if_grad_university_id_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        // exists
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_university_id' => -12,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_university_id']));
        $this->assertEquals('The selected university is invalid.', $errors['grad_university_id'][0]);

        //integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_university_id' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_university_id']));
        $this->assertEquals('The university must be an integer.', $errors['grad_university_id'][0]);
    }

    /** @test */
    public function it_should_fail_if_grad_degree_id_invalid()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        // exists
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_id' => -12,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_degree_id']));
        $this->assertEquals('The selected degree is invalid.', $errors['grad_degree_id'][0]);

        //integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_id' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_degree_id']));
        $this->assertEquals('The degree must be an integer.', $errors['grad_degree_id'][0]);

        //invalid degree
        $degree = (new DegreeBuilder())
            ->withType(Degree::TYPE_UNDERGRADUATE)
            ->save()
            ->get();
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_id' => $degree->id,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_degree_id']));
        $this->assertEquals('The degree field is an invalid degree type.', $errors['grad_degree_id'][0]);
    }

    /** @test */
    public function it_should_redirect_to_grad_if_loan_type_is_undergraduate()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_UNDERGRADUATE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        $response = $this
            ->actingAs($user)
            ->get(route('user-profile.school-grad'))
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('user-profile.school-undergrad');

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
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_graduation_year' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_graduation_year']));
        $this->assertEquals('The graduation year field is required.', $errors['grad_graduation_year'][0]);

        //must be integer
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_graduation_year' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_graduation_year']));
        $this->assertEquals('The graduation year must be an integer.', $errors['grad_graduation_year'][0]);

        //must be 1900 or above
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_graduation_year' => 1899,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_graduation_year']));
        $this->assertEquals('The graduation year must be between 1900 and 2050.', $errors['grad_graduation_year'][0]);


        //must be 2050 or bellow
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_graduation_year' => 2051,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_graduation_year']));
        $this->assertEquals('The graduation year must be between 1900 and 2050.', $errors['grad_graduation_year'][0]);
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
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_enrollment_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_enrollment_status']));
        $this->assertEquals('The enrollment status field is required.', $errors['grad_enrollment_status'][0]);

        //must be valid in array
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_enrollment_status' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_enrollment_status']));
        $this->assertEquals('The selected enrollment status is invalid.', $errors['grad_enrollment_status'][0]);
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
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_format' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_degree_format']));
        $this->assertEquals('The degree format field is required.', $errors['grad_degree_format'][0]);

        //must be valid in array
        $this
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_format' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['grad_degree_format']));
        $this->assertEquals('The selected degree format is invalid.', $errors['grad_degree_format'][0]);
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
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->save()
            ->get();

        $degree = (new DegreeBuilder())
            ->withType(Degree::TYPE_GRADUATE)
            ->save()
            ->get();

        $university = (new UniversityBuilder())->save()->get();
        $response   = $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_id'         => $degree->id,
                'grad_university_id'     => $university->id,
                'grad_graduation_year'   => now()->year,
                'grad_enrollment_status' => UserProfile::ENROLLMENT_STATUS_FULL_TIME,
                'grad_degree_format'     => UserProfile::DEGREE_FORMAT_ON_CAMPUS,
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

    /** @test */
    public function it_should_successfully_save_and_redirect_to_finances_page_when_role_is_parent()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_PARENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->withLoanType(UserProfile::LOAN_TYPE_GRADUATE)
            ->save()
            ->get();

        $degree = (new DegreeBuilder())
            ->withType(Degree::TYPE_GRADUATE)
            ->save()
            ->get();

        $university = (new UniversityBuilder())->save()->get();
        $response   = $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.school-grad'), [
                'grad_degree_id'         => $degree->id,
                'grad_university_id'     => $university->id,
                'grad_graduation_year'   => now()->year,
                'grad_enrollment_status' => UserProfile::ENROLLMENT_STATUS_FULL_TIME,
                'grad_degree_format'     => UserProfile::DEGREE_FORMAT_ON_CAMPUS,
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
