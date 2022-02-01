<?php


namespace Tests\Builders;

use App\AcademicYear;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;

class AcademicYearBuilder
{
    use WithFaker;

    /** @var AcademicYear */
    public $academicYear;

    public function __construct($attributes = [])
    {
        $this->faker        = $this->makeFaker('en_US');
        $this->academicYear = factory(AcademicYear::class)->make($attributes);
    }

    public function save()
    {
        $this->academicYear->save();

        return $this;
    }

    public function get()
    {
        return $this->academicYear;
    }

    public function withName(string $name = null)
    {
        if (!$name) {
            $name = $this->faker->word;
        }

        $this->academicYear->name = $name;

        return $this;
    }

    public function withStartsOn(Carbon $date = null)
    {
        if (!$date) {
            $date = now()->startOfMonth();
        }

        $this->academicYear->starts_on = $date;

        return $this;
    }

    public function withEndsOn(Carbon $date = null)
    {
        if (!$date) {
            $date = now()->startOfMonth()->addMonths(6);
        }

        $this->academicYear->ends_on = $date;

        return $this;
    }

    public function withRefinance(bool $refinance = true)
    {
        $this->academicYear->refinance = $refinance;

        return $this;
    }


}
