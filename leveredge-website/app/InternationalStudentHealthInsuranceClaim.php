<?php

namespace App;

use App\Nova\Traits\MailableClaimTrait;
use App\Nova\Traits\PayableClaimTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 *
 * @property int $payment_record_id
 * @property-read Payment $payment
 *
 * @property int $user_id
 * @property-read User $user
 *
 * @property int $deal_id
 * @property-read Deal $deal
 *
 * @property int $payment_method_id
 * @property-read PaymentMethod $paymentMethod
 *
 * @property int $loan_amount
 * @property bool $payment_completed
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class InternationalStudentHealthInsuranceClaim extends Model
{
    use SoftDeletes,
        PayableClaimTrait,
        MailableClaimTrait;

    protected $appends = [
        'date_submitted',
        'amount',
    ];

    protected $with = [
        'deal',
        'user',
        'paymentMethod',
    ];

    public function getDateSubmittedAttribute()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_record_id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function getAmountAttribute()
    {
        $referredUsersCount = User::where('referred_by_id',user()->id)->whereHas('accessTheDeals', function (Builder $query) {
            $query
                ->where('deal_id',Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID)
                ->where('loan_status_id',DealStatus::SIGNED_THE_LOAN);
        })->take(5)->count();

        switch ($referredUsersCount) {
            case 0:
                $finalAmount = $this->loan_amount * 0.000;

                break;

            case 1:
                $finalAmount = $this->loan_amount * 0.001;

                break;

            case 2:
                $finalAmount = $this->loan_amount * 0.002;

                break;

            case 3:
                $finalAmount = $this->loan_amount * 0.003;

                break;

            case 4:
                $finalAmount = $this->loan_amount * 0.004;

                break;

            default:
                $finalAmount = $this->loan_amount * 0.005;

                break;
        }

        return $finalAmount;
    }

    public function getClaimantAttribute()
    {
        return $this->user;
    }
}
