<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * Class Deal
 * @package App
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $redirect_url
 * @property string $tracked_query_parameter
 * @property bool $allow_guest_access
 * @property int $deal_type_id
 * @property DealType $dealType
 * @property int $fee_type_id
 * @property int $fee_amount
 * @property int $estimated_loan_amount
 * @property string $reward_program
 * @property string $percentage_of_loan_amount
 * @property string $slug
 * @property string $revenue_calculator
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read MailchimpAutomatedCampaignMailable $mailable
 */




class Deal extends Model implements Sortable
{
    use SortableTrait;

    const SENT_TO_LAUREL_ROAD  = 1;
    const SENT_TO_EARNEST      = 2;
    const SENT_TO_NOT_ELIGIBLE = 3;
    const SENT_TO_CREDIBLE     = 3;

    const DEAL_CREDIBLE_STUDENT_LOAN_SLUG                                = 'credible-student-loan';
    const DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG                      = 'earnest-graduate-loan-20-21';
    const DEAL_ENHANCED_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG             = 'earnest-graduate-loan-20-21-enhanced';
    const DEAL_EARNEST_UNDERGRAD_STUDENT_LOAN_20_21_SLUG                 = 'earnest-undergraduate-loan-20-21';
    const DEAL_COMMONBOND_MBA_STUDENT_LOAN_20_21_SLUG                    = 'commonbond-mba-20-21';
    const DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG                    = 'earnest-refinance-with-rewards-20';
    const DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_OTHER_STATES_SLUG       = 'earnest-refinance-with-rewards-20-other-states';
    const DEAL_INTERNATIONAL_HEALTH_INSURANCE_20                         = 'international-health-insurance-20';


    const DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID                 = 11;

    const DEAL_FIRST_REPUBLIC_PLOC_SLUG                             = 'first-republic-ploc-deal';
    const DEAL_SPLASH_REFINANCE_SLUG                                = 'splash-refinance-deal';
    const DEAL_LAUREL_ROAD_REFINANCE_SLUG                           = 'laurel-road-refinance-deal';

    public $sortable = [
        'order_column_name'  => 'deal_sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'redirect_url', 'tracked_query_parameter',
        'allow_guest_access', 'deal_type_id', 'fee_type_id', 'fee_amount', 'percentage_of_loan_amount','slug',
    ];

    protected $casts = [
        'allow_guest_access' => 'boolean',
        'start_date'         => 'date',
        'end_date'           => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('deal_sort_order', 'asc');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function dealType()
    {
        return $this->belongsTo(DealType::class, 'deal_type_id');
    }

    public function feeType()
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function accessRecords()
    {
        return $this->hasMany(AccessTheDeal::class, 'deal_id');
    }

    public function dealStatuses()
    {
        return $this->belongsToMany(DealStatus::class, 'deal_status_applicabilities');
    }

    public function calculateRewardAmount($loan_amount)
    {
        if (class_exists($this->reward_program)) {
            return call_user_func($this->reward_program . '::calculateRewardAmount', $loan_amount);
        }

        return 0;
    }

    public function calculateGrossRevenue(AccessTheDeal $accessTheDeal)
    {
        if (class_exists($this->revenue_calculator)) {
            return call_user_func($this->revenue_calculator . '::calculateGrossRevenue', $accessTheDeal);
        }

        return null;
    }

    public function calculateNetRevenue(AccessTheDeal $accessTheDeal)
    {
        if (class_exists($this->revenue_calculator)) {
            return call_user_func($this->revenue_calculator . '::calculateNetRevenue', $accessTheDeal);
        }

        return null;
    }

    public function mailable()
    {
        return $this->morphOne(MailchimpAutomatedCampaignMailable::class, 'mailable');
    }

    public function getHandoffUrlAttribute()
    {
        return url('member/deal/' . $this->slug . '/hand-off');
    }
}
