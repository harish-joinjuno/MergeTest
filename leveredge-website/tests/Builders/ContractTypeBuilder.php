<?php


namespace Tests\Builders;

use App\ContractType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContractTypeBuilder
{
    use WithFaker;

    /** @var ContractType */
    public $contractType;

    public function __construct($attributes = [])
    {
        $this->faker        = $this->makeFaker('en_US');
        $this->contractType = factory(ContractType::class)->make($attributes);
    }

    public function save()
    {
        $this->contractType->save();

        return $this;
    }

    public function get()
    {
        return $this->contractType;
    }

    public function withType(string $type = null)
    {
        Validator::make(['type' => $type], [
            'type' => [
                'nullable',
                Rule::in([
                    ContractType::TYPE_CAMPUS_AMBASSADOR,
                ])],
        ]);

        $this->contractType->type = $type ?? $this->faker->randomElement([
                ContractType::TYPE_CAMPUS_AMBASSADOR,
            ]);

        return $this;
    }
}
