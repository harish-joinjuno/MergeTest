<?php


namespace Tests\Feature\UserProfile;

use App\AcademicYear;
use App\Degree;
use App\Role;
use App\UserProfile;
use Illuminate\Support\Facades\Event;
use Tests\Builders\AcademicYearBuilder;
use Tests\Builders\DegreeBuilder;
use Tests\Builders\UniversityBuilder;
use Tests\Builders\UserBuilder;
use Tests\Builders\UserProfileBuilder;
use Tests\Feature\FeatureTest;

class UserProfileInternationalHealthInsurance extends FeatureTest
{
    /** @test */
    public function it_should_fail_if_user_is_not_authenticated()
    {
        $response = $this
            ->get(route('user-profile.international_health_insurance'))
            ->assertRedirect();

        $actual   = $response->headers->get('location');
        $expected = route('login', [
            'next' => route('user-profile.international_health_insurance'),
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
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_INTERNATIONAL_HEALTH_INSURANCE)
            ->save()
            ->get();

        $this->actingAs($user)
            ->get(route('user-profile.international_health_insurance'))
            ->assertSuccessful()
            ->assertSee('International Health insurance');
    }

    /** @test */
    public function it_should_redirect_to_end_page_from_undergraduate_with_international_health_insurance_loan_type()
    {
        Event::fake();
        $this->withoutExceptionHandling();

        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_INTERNATIONAL_HEALTH_INSURANCE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD)
            ->save()
            ->get();

        (new AcademicYearBuilder())
            ->withName(AcademicYear::ACADEMIC_YEAR_HEALTH_INSURANCE)
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
        $expected = route('user-profile.end');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_COMPLETED,
        ]);
    }

    /** @test */
    public function it_should_redirect_to_end_page_from_grad_with_international_health_insurance_loan_type()
    {
        Event::fake();
        $this->withoutExceptionHandling();
        $user = (new UserBuilder())
            ->withEmail()
            ->withPassword()
            ->withRoleName(Role::ROLE_NAME_BORROWER)
            ->get();

        (new UserProfileBuilder())
            ->withUser($user)
            ->withLoanType(UserProfile::LOAN_TYPE_INTERNATIONAL_HEALTH_INSURANCE)
            ->withSignupProgress(UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD)
            ->save()
            ->get();

        (new AcademicYearBuilder())
            ->withName(AcademicYear::ACADEMIC_YEAR_HEALTH_INSURANCE)
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
        $expected = route('user-profile.end');

        $this->assertEquals($expected, $actual);

        $this->assertDatabaseHas('user_profiles', [
            'user_id'         => $user->id,
            'signup_progress' => UserProfile::SIGNUP_PROGRESS_COMPLETED,
        ]);
    }
}
