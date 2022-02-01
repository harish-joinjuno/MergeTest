<?php

namespace App;

use App\Nova\Traits\MailableClaimTrait;
use App\Nova\Traits\PayableClaimTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

/**
 * Class ScreenshotClaim
 * @package App
 * @property int $user_id
 * @property int $payment_method_id
 * @property int $amount
 * @property int $payment_id
 * @property boolean $is_paid
 * @property-read User $user
 * @property-read PaymentMethod $paymentMethod
 * @property-read Payment $payment
 * @property File $file
 * @property string $status
 * @property Carbon deleted_at
 */
class ScreenshotClaim extends Model
{
    use PayableClaimTrait,
        Actionable,
        MailableClaimTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function getClaimantAttribute()
    {
        return $this->user;
    }
}
