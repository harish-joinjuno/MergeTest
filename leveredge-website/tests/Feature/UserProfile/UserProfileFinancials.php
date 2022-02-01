<?php

namespace Tests\Feature\UserProfile;

use App\AcademicYear;
use App\Events\UserProfileCompleted;
use App\Role;
use App\UserProfile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\Builders\AcademicYearBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileFinancials extends FeatureTest
{
    protected function setUp(): void
    {
        parent::setUp();

        (new AcademicYearBuilder())
          ->withRefinance()
          ->withName(AcademicYear::ACADEMIC_YEAR_REFINANCE)
          ->save();

        (new AcademicYearBuilder())
          ->withName(AcademicYear::ACADEMIC_YEAR_20_21)
          ->save();
    }

    /** @test */
    public function it_should_fail_if_user_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.financials'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.financials'),
        ]);

        $this->assertEquals(urldecode($expected), $actual);
    }

    /** @test */
    public function it_should_render_properly_for_student_role()
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

        $this
            ->actingAs($user)
            ->get(route('user-profile.financials'))
            ->assertSuccessful()
            ->assertSee('Financial Information');
    }

    /** @test */
    public function it_should_render_properly_for_parent_role()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withLoanType(UserProfile::LOAN_TYPE_REFINANCE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO)
            ->save()
            ->get();

        $this
            ->actingAs($user)
            ->get(route('user-profile.financials'))
            ->assertSuccessful()
            ->assertSee('Financial Information')
            ->assertDontSee("Student's Credit Score");
    }

    /** @test */
    public function it_should_work_when_valid_and_no_cosigner()
    {
        Event::fake([
            UserProfileCompleted::class,
        ]);
        Queue::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->save()
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        //no cosigner
        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'           => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                'annual_income'          => 100000,
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_credit_score'  => null,
                'cosigner_annual_income' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        Event::assertDispatched(UserProfileCompleted::class);
    }

    /** @test */
    public function it_should_work_when_valid_and_us_cosigner()
    {
        Event::fake([
            UserProfileCompleted::class,
        ]);
        Queue::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->save()
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        //no cosigner
        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'                       => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                'annual_income'                      => 100000,
                'cosigner_status'                    => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score'              => UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749,
                'cosigner_annual_income'             => 100000,
                'cosigner_immigration_status'        => UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                'cosigner_country_of_citizenship_id' => null,
                'cosigner_country_of_residence_id'   => null,
                'cosigner_visa_id'                   => null,
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        Event::assertDispatched(UserProfileCompleted::class);
    }

    /** @test */
    public function it_should_work_when_valid_and_international_cosigner()
    {
        Event::fake([
            UserProfileCompleted::class,
        ]);
        Queue::fake();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->save()
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_FINANCIALS)
            ->save()
            ->get();

        //no cosigner
        $this
            ->withoutExceptionHandling()
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'                       => UserProfile::CREDIT_SCORE_BETWEEN_750_AND_799,
                'annual_income'                      => 100000,
                'cosigner_status'                    => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score'              => UserProfile::CREDIT_SCORE_BETWEEN_700_AND_749,
                'cosigner_annual_income'             => 100000,
                'cosigner_immigration_status'        => UserProfile::IMMIGRATION_STATUS_OTHER,
                'cosigner_country_of_citizenship_id' => 1,
                'cosigner_country_of_residence_id'   => 1,
                'cosigner_visa_id'                   => null,
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        Event::assertDispatched(UserProfileCompleted::class);
    }

    //region Validation

    /** @test */
    public function for_parent_role_it_should_fail_when_invalid_credit_score()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_PARENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'    => null,
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['credit_score']));
        $this->assertValidationError('credit_score', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'    => 'abc',
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['credit_score']));
        $this->assertValidationError('credit_score', 'validation.in');
    }

    /** @test */
    public function for_parent_role_it_should_fail_when_invalid_cosigner_status()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_PARENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_status']));
        $this->assertValidationError('cosigner_status', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_status']));
        $this->assertValidationError('cosigner_status', 'validation.in');
    }

    /** @test */
    public function for_parent_role_it_should_fail_when_invalid_cosigner_credit_score()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_PARENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //nullable if cosigner_status no
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_credit_score' => null,
            ])
            ->assertRedirect();

        $errors = $this->getValidationErrors();
        $this->assertFalse(isset($errors['cosigner_credit_score']));

        //required if cosigner_status yes
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_credit_score']));
        $this->assertValidationError('cosigner_credit_score', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_credit_score']));
        $this->assertValidationError('cosigner_credit_score', 'validation.in');
    }

    /** @test */
    public function for_parent_role_it_should_fail_when_invalid_cosigner_annual_income()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_PARENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //nullable if cosigner_status no
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_annual_income' => null,
            ])
            ->assertRedirect();

        $errors = $this->getValidationErrors();
        $this->assertFalse(isset($errors['cosigner_annual_income']));

        //required if cosigner_status yes
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_annual_income' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_annual_income']));
        $this->assertValidationError('cosigner_annual_income', 'validation.required');
    }

    /** @test */
    public function for_student_role_it_should_fail_when_invalid_credit_score()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'    => null,
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['credit_score']));
        $this->assertValidationError('credit_score', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'credit_score'    => 'abc',
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['credit_score']));
        $this->assertValidationError('credit_score', 'validation.in');
    }

    /** @test */
    public function for_student_role_it_should_fail_when_invalid_cosigner_status()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //required
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_status']));
        $this->assertValidationError('cosigner_status', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_status']));
        $this->assertValidationError('cosigner_status', 'validation.in');
    }

    /** @test */
    public function for_student_role_it_should_fail_when_invalid_cosigner_credit_score()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //nullable if cosigner_status no
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_credit_score' => null,
            ])
            ->assertRedirect();

        $errors = $this->getValidationErrors();
        $this->assertFalse(isset($errors['cosigner_credit_score']));

        //required if cosigner_status yes
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_credit_score']));
        $this->assertValidationError('cosigner_credit_score', 'validation.required');

        //invalid
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'       => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_credit_score' => 'abc',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_credit_score']));
        $this->assertValidationError('cosigner_credit_score', 'validation.in');
    }

    /** @test */
    public function for_student_role_it_should_fail_when_invalid_cosigner_annual_income()
    {
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withRole(UserProfile::ROLE_STUDENT)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTRO_ONE)
            ->save()
            ->get();

        //nullable if cosigner_status no
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_NO,
                'cosigner_annual_income' => null,
            ])
            ->assertRedirect();

        $errors = $this->getValidationErrors();
        $this->assertFalse(isset($errors['cosigner_annual_income']));

        //required if cosigner_status yes
        $this
            ->actingAs($user)
            ->post(route('user-profile.financials'), [
                'cosigner_status'        => UserProfile::COSIGNER_STATUS_YES,
                'cosigner_annual_income' => null,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors();

        $errors = $this->getValidationErrors();
        $this->assertTrue(isset($errors['cosigner_annual_income']));
        $this->assertValidationError('cosigner_annual_income', 'validation.required');
    }

    //endregion
}
