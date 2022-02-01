<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class AccessTheDeal
 * @package App
 * @property int $id
 * @property User $user
 * @property Deal $deal
 * @property int $deal_id
 * @property int $user_id
 * @property int $loan_status_id
 * @property int $loan_amount
 * @property int $disbursed_amount
 * @property float $gross_revenue
 * @property float $net_revenue
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $applied_on
 * @property Carbon $signed_on
 * @property string $result
 * @property string $loan_status
 * @property object $properties
 * @property-read DealStatus $dealStatus
 * @property bool $reported_application_to_facebook
 * @property bool $reported_signature_to_facebook
 */
class AccessTheDeal extends Model
{
    protected $fillable = [
        'user_id',
        'deal_id',
        'loan_status',
        'loan_amount',
        'loan_status_id',
        'properties',
        'applied_on',
        'signed_on',
        'reported_application_to_facebook',
        'reported_signature_to_facebook',
    ];

    protected $casts = [
        'properties' => 'object',
        'applied_on' => 'date:Y-m-d',
        'signed_on'  => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deal()
    {
        return $this->belongsTo(\App\Deal::class);
    }

    public function getRedirectUrl()
    {
        $redirectUrl = $this->deal->redirect_url;
        if (! Str::contains($this->deal->redirect_url,'?')) {
            $redirectUrl = $redirectUrl . '?';
        } else {
            $redirectUrl = $redirectUrl . '&';
        }

        return $redirectUrl . $this->deal->tracked_query_parameter . '=' . $this->id;
    }

    public function dealStatus()
    {
        return $this->belongsTo(DealStatus::class, 'loan_status_id');
    }

    public function calculateGrossRevenue()
    {
        return $this->deal->calculateGrossRevenue($this);
    }

    public function calculateNetRevenue()
    {
        return $this->deal->calculateNetRevenue($this);
    }
}
