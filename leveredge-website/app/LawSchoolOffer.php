<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $program
 * @property int $application_year
 * @property int $amount
 * @property int $lsat_score
 * @property double $gpa
 * @property boolean $applied_early_decision
 * @property boolean $received_fee_waiver
 * @property string $state
 * @property string $race
 * @property string $sex
 * @property boolean $international
 * @property boolean $lgbt
 * @property boolean $teach_for_america
 * @property boolean $military
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LawSchoolOffer extends Model
{

    const LSAT_BREAKPOINTS = [120, 130, 140, 150, 160 ,170, 180];
    const GPA_BREAKPOINTS = [0, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 4.5, 5.0, 10];

    protected $casts = [
        'applied_early_decision' => 'bool',
        'received_fee_waiver' => 'bool',
        'international' => 'bool',
        'lgbt' => 'bool',
        'teach_for_america' => 'bool',
        'military' => 'bool',
    ];
}
