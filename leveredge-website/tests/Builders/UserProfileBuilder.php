<?php


namespace Tests\Builders;

use App\Degree;
use App\University;
use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserProfileBuilder
{
    use WithFaker;

    /** @var UserProfile */
    public $userProfile;

    public function __construct($attributes = [])
    {
        $this->faker       = $this->makeFaker('en_US');
        $this->userProfile = factory(UserProfile::class)->make($attributes);
    }

    public function save()
    {
        $this->userProfile->save();

        return $this;
    }

    public function get()
    {
        return $this->userProfile;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = (new UserBuilder())->save()->get();
        }

        $this->userProfile->user_id = $user->id;

        return $this;
    }

    public function withDegree(Degree $degree = null)
    {
        if (!$degree) {
            $degree = (new DegreeBuilder())->save()->get();
        }

        $this->userProfile->degree_id = $degree->id;

        return $this;
    }

    public function withGradDegree(Degree $degree = null)
    {
        if (!$degree) {
            $degree = (new DegreeBuilder())->save()->get();
        }

        $this->userProfile->grad_degree_id = $degree->id;

        return $this;
    }

    public function withUniversity(University $university = null)
    {
        if (!$university) {
            $university = (new UniversityBuilder())->save()->get();
        }

        $this->userProfile->university_id = $university->id;

        return $this;
    }

    public function withGradUniversity(University $university = null)
    {
        if (!$university) {
            $university = (new UniversityBuilder())->save()->get();
        }

        $this->userProfile->grad_university_id = $university->id;

        return $this;
    }

    public function withImmigrationStatus(string $immigrationStatus = null)
    {
        Validator::make(['immigration_status' => $immigrationStatus], [
            'type' => [
                'nullable',
                Rule::in([
                    UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                    UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                    UserProfile::IMMIGRATION_STATUS_OTHER,
                ]), ],
        ])->validate();

        $this->userProfile->immigration_status = $immigrationStatus ?? $this->faker->randomElement([
                UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_OTHER,
            ]);

        return $this;
    }

    public function withAnnualIncome(int $annualIncome = 1)
    {
        $this->userProfile->annual_income = $annualIncome;

        return $this;
    }

    public function withGraduationYear(int $year = null)
    {
        $this->userProfile->graduation_year = $year ?? now()->year;

        return $this;
    }

    public function withGradGraduationYear(int $year = null)
    {
        $this->userProfile->grad_graduation_year = $year ?? now()->year;

        return $this;
    }

    public function withSignupProgress(string $progress = null)
    {
        Validator::make(['progress' => $progress], [
            'progress' => [
                'nullable',
                Rule::in([
                    UserProfile::SIGNUP_PROGRESS_INTRO_ONE,
                    UserProfile::SIGNUP_PROGRESS_LOAN_TYPE,
                    UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO,
                    UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD,
                    UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD,
                    UserProfile::SIGNUP_PROGRESS_FINANCIALS,
                    UserProfile::SIGNUP_PROGRESS_INTERNATIONAL_HEALTH_INSURANCE,
                ]), ],
        ])->validate();

        $this->userProfile->signup_progress = $progress ?? $this->faker->randomElement([
                UserProfile::SIGNUP_PROGRESS_INTRO_ONE,
                UserProfile::SIGNUP_PROGRESS_LOAN_TYPE,
                UserProfile::SIGNUP_PROGRESS_PERSONAL_INFO,
                UserProfile::SIGNUP_PROGRESS_SCHOOL_UNDERGRAD,
                UserProfile::SIGNUP_PROGRESS_SCHOOL_GRAD,
                UserProfile::SIGNUP_PROGRESS_FINANCIALS,
                UserProfile::SIGNUP_PROGRESS_INTERNATIONAL_HEALTH_INSURANCE,
            ]);

        return $this;
    }

    public function withLoanType(string $loanType = null)
    {
        $this->userProfile->loan_type = $loanType ?? $this->faker->randomElement([
                UserProfile::LOAN_TYPE_UNDERGRADUATE,
                UserProfile::LOAN_TYPE_GRADUATE,
                UserProfile::LOAN_TYPE_REFINANCE,
            ]);

        return $this;
    }

    public function withRole(string $role = null)
    {
        $this->userProfile->role = $role ?? $this->faker->randomElement([
                UserProfile::ROLE_STUDENT,
                UserProfile::ROLE_PARENT,
            ]);

        return $this;
    }

    public function withPhoneNumber(string $number = null)
    {
        $this->userProfile->phone_number = $number ?? $this->faker->tollFreePhoneNumber();

        return $this;
    }
}
