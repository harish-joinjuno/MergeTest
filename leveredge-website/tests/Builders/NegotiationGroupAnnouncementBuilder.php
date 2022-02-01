<?php


namespace Tests\Builders;

use App\AcademicYear;
use App\NegotiationGroup;
use App\NegotiationGroupAnnouncement;
use Illuminate\Foundation\Testing\WithFaker;

class NegotiationGroupAnnouncementBuilder
{
    use WithFaker;

    /** @var NegotiationGroupAnnouncement */
    public $negotiationGroupAnnouncement;

    public function __construct($attributes = [])
    {
        $this->faker                        = $this->makeFaker('en_US');
        $this->negotiationGroupAnnouncement = factory(NegotiationGroupAnnouncement::class)->make($attributes);
    }

    public function save()
    {
        $this->negotiationGroupAnnouncement->save();

        return $this;
    }

    public function get()
    {
        return $this->negotiationGroupAnnouncement;
    }

    public function withTitle(string $title = null)
    {
        $this->negotiationGroupAnnouncement->title = $title ?? $this->faker->word;

        return $this;
    }

    public function withAcademicYear(AcademicYear $academicYear = null)
    {
        if (!$academicYear) {
            $academicYear = (new AcademicYearBuilder())->save()->get();
        }

        $this->negotiationGroupAnnouncement->academic_year_id = $academicYear->id;

        return $this;
    }

    public function withNegotiationGroup(NegotiationGroup $negotiationGroup = null)
    {
        if (!$negotiationGroup) {
            $negotiationGroup = (new NegotiationGroupBuilder())->save()->get();
        }

        $this->negotiationGroupAnnouncement->negotiation_group_id = $negotiationGroup->id;

        return $this;
    }
}
