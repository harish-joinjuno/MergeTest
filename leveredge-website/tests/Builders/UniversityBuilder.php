<?php


namespace Tests\Builders;

use App\University;
use Illuminate\Foundation\Testing\WithFaker;

class UniversityBuilder
{
    use WithFaker;

    /** @var University */
    public $university;

    public function __construct($attributes = [])
    {
        $this->faker      = $this->makeFaker('en_US');
        $this->university = factory(University::class)->make($attributes);
    }

    public function save()
    {
        $this->university->save();

        return $this;
    }

    public function get()
    {
        return $this->university;
    }

    public function withName(string $name = null)
    {
        if (!$name) {
            $name = $this->faker->unique()->word . ' University';
        }

        $this->university->name = $name;

        return $this;
    }

    public function withLaurelRoadEligible(bool $value = true)
    {
        $this->university->laurel_road_eligible = $value;

        return $this;
    }
}
