<?php


namespace Tests\Builders;

use App\ContractType;
use App\PartnerProfile;
use App\PartnerType;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class PartnerProfileBuilder
{
    use WithFaker;

    /** @var PartnerProfile */
    public $partnerProfile;

    public function __construct($attributes = [])
    {
        $this->faker          = $this->makeFaker('en_US');
        $this->partnerProfile = factory(PartnerProfile::class)->make($attributes);
    }

    public function save()
    {
        $this->partnerProfile->save();

        return $this;
    }

    public function get()
    {
        return $this->partnerProfile;
    }

    public function withContractType(ContractType $contractType = null)
    {
        if (!$contractType) {
            $contractType = (new ContractTypeBuilder())->save()->get();
        }

        $this->partnerProfile->contract_type_id = $contractType->id;

        return $this;
    }

    public function withPartnerType(PartnerType $partnerType = null)
    {
        if (!$partnerType) {
            $partnerType = (new PartnerTypeBuilder())->save()->get();
        }

        $this->partnerProfile->partner_type_id = $partnerType->id;

        return $this;
    }

    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = (new UserBuilder())->save()->get();
        }

        $this->partnerProfile->user_id = $user->id;

        return $this;
    }


}
