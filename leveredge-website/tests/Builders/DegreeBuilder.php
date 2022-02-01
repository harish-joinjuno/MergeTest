<?php


namespace Tests\Builders;

use App\Degree;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DegreeBuilder
{
    use WithFaker;

    /** @var Degree */
    public $degree;

    public function __construct($attributes = [])
    {
        $this->faker  = $this->makeFaker('en_US');
        $this->degree = factory(Degree::class)->make($attributes);
    }

    public function save()
    {
        $this->degree->save();

        return $this;
    }

    public function get()
    {
        return $this->degree;
    }

    public function withName(string $name = null)
    {
        if (!$name) {
            $name = $this->faker->unique()->word;
        }

        $this->degree->name = $name;

        return $this;
    }

    public function withType(string $type = null)
    {
        Validator::make(['type' => $type], [
            'type' => [
                'nullable',
                Rule::in([
                    Degree::TYPE_GRADUATE,
                    Degree::TYPE_UNDERGRADUATE,
                ])],
        ])->validate();

        if (!$type) {
            $type = $this->faker->randomElement([
                Degree::TYPE_GRADUATE,
                Degree::TYPE_UNDERGRADUATE,
            ]);
        }

        $this->degree->type = $type;

        return $this;
    }

    public function withLaurelRoadEligible(bool $value = true)
    {
        $this->degree->laurel_road_eligible = $value;

        return $this;
    }

}
