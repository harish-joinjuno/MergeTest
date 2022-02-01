<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $school_vs_school_competition_id
 * @property string $colloquial_slug
 * @property string $first_name
 * @property string $email
 * @property bool $wants_to_host_party
 * @property string $recommended_location
 * @property bool $verified
 * @property string $verification_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read SchoolVsSchoolCompetition $competition
 */
class SchoolVsSchoolCompetitionEntrant extends Model
{
    protected $casts = [
        'verified' => 'boolean',
        'wants_to_host_party' => 'boolean'
    ];

    public function competition()
    {
        return $this->belongsTo(SchoolVsSchoolCompetition::class,'school_vs_school_competition_id');
    }
}
