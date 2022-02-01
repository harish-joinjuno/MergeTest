<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExperimentType
 * @package App
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Experiment[]|Collection experiments
 */
class ExperimentType extends Model
{
    const DEFAULT                         = 1;
    const AUTO_REFINANCE_LANDING_PAGE     = 2;
    const AUTO_REFINANCE_SIGN_UP          = 3;
    const SLR_LANDING_PAGE                = 4;
    const EMAIL_FROM_UPWORK               = 5;
    const POST_REWARD_CLAIM               = 6;
    const REFERRAL_PROGRAM_DIRECT_ACCESS  = 7;
    const AUTO_REFINANCE_POST_AUTH        = 8;
    const REFINANCE_RECOMMENDATION_PAGE   = 9;
    const COLLEGE_TEST_PREP_LANDING_PAGE  = 10;
    const TEMPLE_LANDING_PAGE             = 11;

    public function experiments()
    {
        return $this->hasMany(Experiment::class);
    }
}
