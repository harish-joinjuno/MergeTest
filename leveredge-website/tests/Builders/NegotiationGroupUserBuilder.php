<?php


namespace Tests\Builders;

use App\AcademicYear;
use App\NegotiationGroup;
use App\NegotiationGroupUser;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NegotiationGroupUserBuilder
{
    use WithFaker;

    /** @var NegotiationGroupUser */
    public $negotiationGroupUser;

    public function __construct($attributes = [])
    {
        $this->faker                = $this->makeFaker('en_US');
        $this->negotiationGroupUser = factory(NegotiationGroupUser::class)->make($attributes);
    }

    public function save()
    {
        $this->negotiationGroupUser->save();

        return $this;
    }

    public function get()
    {
        return $this->negotiationGroupUser;
    }

    public function withStatus(string $status = null)
    {
        Validator::make(['status' => $status], [
            'type' => [
                'nullable',
                Rule::in([
                    NegotiationGroupUser::STATUS_PENDING,
                    NegotiationGroupUser::STATUS_APPROVED,
                    NegotiationGroupUser::STATUS_DENIED,
                ])],
        ])->validate();

        if (!$status) {
            $status = $this->faker->randomElement([
                NegotiationGroupUser::STATUS_PENDING,
                NegotiationGroupUser::STATUS_APPROVED,
                NegotiationGroupUser::STATUS_DENIED,
            ]);
        }

        $this->negotiationGroupUser->status = $status;

        return $this;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = (new UserBuilder())->save()->get();
        }

        $this->negotiationGroupUser->user_id = $user->id;

        return $this;
    }

    public function withAcademicYear(AcademicYear $academicYear = null)
    {
        if (!$academicYear) {
            $academicYear = (new AcademicYearBuilder())->save()->get();
        }

        $this->negotiationGroupUser->academic_year_id = $academicYear->id;

        return $this;
    }

    public function withNegotiationGroup(NegotiationGroup $negotiationGroup = null)
    {
        if (!$negotiationGroup) {
            $negotiationGroup = (new NegotiationGroupBuilder())->save()->get();
        }

        $this->negotiationGroupUser->negotiation_group_id = $negotiationGroup->id;

        return $this;
    }
}
