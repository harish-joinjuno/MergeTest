<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int                                       $id
 * @property string                                    $name
 * @property string                                    $display_name
 * @property string                                    $slug
 * @property int                                       $priority
 * @property Carbon                                    $created_at
 * @property Carbon                                    $updated_at
 * @property Collection|User                           $referralProgramUsers
 * @property Collection|ReferralProgramEligibleProfile $referralProgramEligibleProfiles
 */
class ReferralProgram extends Model
{
    public const REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES = 'two-side-with-milestone-prizes';
    public const REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT  = 'two-side-with-scholarship-pot';
    public const REFERRAL_PROGRAM_QUARTER_PERCENT_OF_FIRST_LOAN       = 'quarter-percent-of-first-loan';
    public const REFERRAL_PROGRAM_TWO_HUNDRED_PER_LOAN_ABOVE_20K      = 'two-hundred-per-loan';

    protected $fillable = [
        'name',
        'display_name',
        'priority',
    ];

    public function referralProgramUsers()
    {
        return $this->hasMany(ReferralProgramUser::class);
    }

    public function referralProgramEligibleProfiles()
    {
        return $this->hasMany(ReferralProgramEligibleProfile::class);
    }
}
