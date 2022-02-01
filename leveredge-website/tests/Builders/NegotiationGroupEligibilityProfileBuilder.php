<?php


namespace Tests\Builders;

use App\Degree;
use App\NegotiationGroup;
use App\NegotiationGroupEligibleProfile;
use App\University;
use App\UserProfile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NegotiationGroupEligibilityProfileBuilder
{
    use WithFaker;

    /** @var NegotiationGroupEligibleProfile */
    public $eligibleProfile;

    public function __construct($attributes = [])
    {
        $this->faker           = $this->makeFaker('en_US');
        $this->eligibleProfile = factory(NegotiationGroupEligibleProfile::class)->make($attributes);
    }

    public function save()
    {
        $this->eligibleProfile->save();

        return $this;
    }

    public function get()
    {
        return $this->eligibleProfile;
    }

    public function withNegotiationGroup(NegotiationGroup $negotiationGroup = null)
    {
        if (!$negotiationGroup) {
            $negotiationGroup = (new NegotiationGroupBuilder())
                ->save()
                ->get();
        }

        $this->eligibleProfile->negotiation_group_id = $negotiationGroup->id;

        return $this;
    }

    public function withDegree(Degree $degree = null)
    {
        if (!$degree) {
            $degree = (new DegreeBuilder())->save()->get();
        }

        $this->eligibleProfile->degree_id = $degree->id;

        return $this;
    }

    public function withGradDegree(Degree $degree = null)
    {
        if (!$degree) {
            $degree = (new DegreeBuilder())->save()->get();
        }

        $this->eligibleProfile->grad_degree_id = $degree->id;

        return $this;
    }

    public function withUniversity(University $university = null)
    {
        if (!$university) {
            $university = (new UniversityBuilder())->save()->get();
        }

        $this->eligibleProfile->university_id = $university->id;

        return $this;
    }

    public function withGradUniversity(University $university = null)
    {
        if (!$university) {
            $university = (new UniversityBuilder())->save()->get();
        }

        $this->eligibleProfile->grad_university_id = $university->id;

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
                ])],
        ])->validate();

        $this->eligibleProfile->immigration_status = $immigrationStatus ?? $this->faker->randomElement([
                UserProfile::IMMIGRATION_STATUS_US_CITIZEN_OR_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_US_CONDITIONAL_PERMANENT_RESIDENT,
                UserProfile::IMMIGRATION_STATUS_OTHER,
            ]);

        return $this;
    }

    public function withAnnualIncomeMin(int $annualIncomeMin = 1)
    {
        $this->eligibleProfile->annual_income_min = $annualIncomeMin;

        return $this;
    }

    public function withAnnualIncomeMax(int $annualIncomeMax = 100)
    {
        $this->eligibleProfile->annual_income_max = $annualIncomeMax;

        return $this;
    }

}
