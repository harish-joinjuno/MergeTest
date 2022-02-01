<?php


namespace Tests\Builders;

use App\AcademicYear;
use App\NegotiationGroup;
use Illuminate\Foundation\Testing\WithFaker;

class NegotiationGroupBuilder
{
    use WithFaker;

    /** @var NegotiationGroup */
    public $negotiationGroup;

    public function __construct($attributes = [])
    {
        $this->faker            = $this->makeFaker('en_US');
        $this->negotiationGroup = factory(NegotiationGroup::class)->make($attributes);
    }

    public function save()
    {
        $this->negotiationGroup->save();

        return $this;
    }

    public function get()
    {
        return $this->negotiationGroup;
    }

    public function withName(string $name = null)
    {
        if (!$name) {
            $name = $this->faker->word;
        }

        $this->negotiationGroup->name = $name;

        return $this;
    }

    public function withSlug(string $slug = null)
    {
        if(!$slug) {
            $slug = $this->faker->slug;
        }

        $this->negotiationGroup->slug = $slug;

        return $this;
    }

    public function withPriority(int $priority = null)
    {
        $this->negotiationGroup->priority = $priority ?? $this->faker->randomElement([
                0,
                1,
                2,
                3,
                4,
                5,
            ]);

        return $this;
    }

    public function withDealConfidence(int $dealConfidence = null)
    {
        $this->negotiationGroup->deal_confidence = $dealConfidence ?? $this->faker->randomElement([
                10,
                25,
                33,
                50,
                75,
                95,
            ]);

        return $this;
    }

    public function withAcademicYear(AcademicYear $academicYear = null)
    {
        if (!$academicYear) {
            $academicYear = (new AcademicYearBuilder())->save()->get();
        }

        $this->negotiationGroup->academic_year_id = $academicYear->id;

        return $this;
    }

}
