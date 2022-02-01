<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LrcNotificationSent
 * @package App
 *
 * @property int $id
 * @property int $leveredge_reward_claim_id
 * @property string $type
 * @property boolean $sent
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LrcNotificationSent extends Model
{
    const LIKELY_PAYABLE_PAID_ONCE = 'likely_payable_paid_once';

    const LIKELY_PAYABLE_EXCLUDED_PAID_ONCE = 'likely_payable_excluded_paid_once';

    protected $casts = [
        'sent' => 'boolean',
    ];
}
