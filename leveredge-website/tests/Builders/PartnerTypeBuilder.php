<?php


namespace Tests\Builders;

use App\PartnerType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PartnerTypeBuilder
{
    use WithFaker;

    /** @var PartnerType */
    public $partnerType;

    public function __construct($attributes = [])
    {
        $this->faker       = $this->makeFaker('en_US');
        $this->partnerType = factory(PartnerType::class)->make($attributes);
    }

    public function save()
    {
        $this->partnerType->save();

        return $this;
    }

    public function get()
    {
        return $this->partnerType;
    }

    public function withType(string $type = null)
    {
        Validator::make(['type' => $type], [
            'type' => [
                'nullable',
                Rule::in([
                    PartnerType::TYPE_CAMPUS_AMBASSADOR,
                ])],
        ])->validate();

        $this->partnerType->type = $type ?? $this->faker->randomElement([
                PartnerType::TYPE_CAMPUS_AMBASSADOR,
            ]);

        return $this;
    }
}
