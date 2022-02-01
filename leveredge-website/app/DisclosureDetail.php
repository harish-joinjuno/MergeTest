<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DisclosureDetail
 * @package App
 * @property int $id
 * @property int $leveredge_reward_claim_id
 * @property string $s3_url
 * @property object $response
 * @property boolean $response_received
 * @property boolean $response_expanded
 * @property boolean $response_has_error
 * @property string $document
 * @property string $creditor
 * @property string $borrower_name
 * @property string $cosigner_name
 * @property float $interest_rate
 * @property string $rate_type
 * @property integer $loan_term
 * @property float $apr
 * @property float $finance_charge
 * @property float $total_payments
 * @property float $total_loan_amount
 * @property boolean $right_to_cancel
 * @property Carbon $right_to_cancel_date
 * @property string $repayment_plan
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read LeveredgeRewardClaim $leveredgeRewardClaim
 */
class DisclosureDetail extends Model
{
    protected $fillable = [
        's3_url',
    ];

    protected $dates = [
        'right_to_cancel_date',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'response' => 'object',
    ];

    public function leveredgeRewardClaim(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LeveredgeRewardClaim::class);
    }
}
