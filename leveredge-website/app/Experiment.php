<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class Experiment
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $feature_one
 * @property string $feature_two
 * @property string $feature_three
 * @property string $feature_four
 * @property string $feature_five
 * @property int $experiment_type_id
 * @property-read ExperimentType  $experimentType
 * @property-read Collection $experimentClients
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Experiment extends Model
{
    const CONTROL_FOR_EXPERIMENTS_ID                              = 1;
    const OPTIONAL_BOOK_TIME_WITH_TEAM                            = 2;
    const DEALS_UP_FRONT_FOR_REFI_LANDING_PAGE                    = 3;
    const LONG_FORM_LANDING_PAGE                                  = 4;
    const EMAILS_TO_DENTISTS_FROM_UP_WORK                         = 5;
    const EMAILS_TO_SURGEONS_FROM_UP_WORK                         = 6;
    const EMAILS_TO_URGENT_CARE_FROM_UP_WORK                      = 7;
    const EMAILS_TO_EYE_CARE_FROM_UP_WORK                         = 8;
    const LONG_FORM_LANDING_PAGE_WITH_VIDEO                       = 9;
    const LONG_FORM_LANDING_PAGE_WITH_VIDEO_IN_BODY               = 10;
    const HOME_PAGE_AS_LANDING_PAGE                               = 11;
    const OPTION_TO_REGISTER_FOR_REFERRAL_PROGRAM_ONLY            = 12;
    const CONTROL_TO_OPTION_TO_REGISTER_FOR_REFERRAL_PROGRAM_ONLY = 13;
    const LONG_FORM_WITH_EMAIL_CAPTURE_AND_VIDEO_IN_BODY          = 14;

    const AUTO_REFINANCE_SIGN_UP_CONTROL                            = 16;
    const AUTO_REFINANCE_SIGN_UP_SKIP_PASSWORD                      = 17;
    const AUTO_REFINANCE_SIGN_UP_GET_LAST_4_SSN                     = 18;
    const AUTO_REFINANCE_SIGN_UP_MINIMUM_QUESTIONS                  = 19;
    const AUTO_REFINANCE_SIGN_UP_EXTREME_MINIMUM_QUESTIONS          = 22;
    const AUTO_REFINANCE_SIGN_UP_V6                                 = 29;
    const AUTO_REFINANCE_SIGN_UP_V7                                 = 30;

    const AUTO_REFINANCE_LANDING_PAGE_CONTROL                       = 20;
    const AUTO_REFINANCE_LANDING_PAGE_V2                            = 21;

    const AUTO_REFINANCE_LANDING_PAGE_V3                            = 23;
    const AUTO_REFINANCE_LANDING_PAGE_V4                            = 24;
    const AUTO_REFINANCE_LANDING_PAGE_V5                            = 25;
    const AUTO_REFINANCE_LANDING_PAGE_V6                            = 26;
    const AUTO_REFINANCE_LANDING_PAGE_V7                            = 27;

    const POST_REWARD_CLAIM_CONTROL                                 = 31;
    const POST_REWARD_CLAIM_V2                                      = 32;
    const POST_REWARD_CLAIM_V3                                      = 33;

    const AUTO_REFI_POST_AUTH_CONTROL                               = 34;
    const AUTO_REFI_POST_AUTH_LEADERBOARD                           = 35;
    const AUTO_REFI_POST_AUTH_VISUALIZED                            = 36;

    const SLR_LONG_FORM_VIDEO_IN_BODY_AUTO_PLAY                     = 37;
    const SLR_LONG_FORM_VIDEO_2_IN_BODY_AUTO_PLAY                   = 38;

    const AUTO_REFINANCE_LANDING_PAGE_V8                            = 39;
    const AUTO_REFINANCE_LANDING_PAGE_V9                            = 40;

    const RRP_CONTROL                                               = 41;
    const RRP_SIGNING_BONUS                                         = 42;
    const RRP_DEALS_GUARANTEE                                       = 43;

    const CTP_LANDING_PAGE_CONTROL                                  = 44;
    const CTP_LANDING_PAGE_V1                                       = 45;
    const CTP_LANDING_PAGE_V2                                       = 46;
    const RRP_DYNAMIC_REWARDS                                       = 47;

    const SLR_V8                                                    = 48;

    const TEMPLE_CONTROL                                            = 49;
    const TEMPLE_V2                                                 = 50;

    public function experimentClients()
    {
        return $this->hasMany(ExperimentClient::class);
    }

    public function experimentType()
    {
        return $this->belongsTo(ExperimentType::class);
    }
}
