<?php

namespace App;

use App\Nova\Traits\MailableClaimTrait;
use App\Nova\Traits\PayableClaimTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Laravel\Nova\Actions\Actionable;

/**
 * @property int                  $id
 * @property int                  $user_id
 * @property int                  $campus_ambassador_task_id
 * @property int                  $payment_method_id
 * @property int                  $payment_record_id
 * @property int                  $amount
 * @property string               $ambassador_notes
 * @property string               $admin_notes
 * @property bool                 $payment_completed
 * @property array                $files
 * @property Carbon               $created_at
 * @property Carbon               $updated_at
 * @property User                 $campusAmbassador
 * @property CampusAmbassadorTask $task
 * @property PaymentMethod        $paymentMethod
 * @property Payment              $paymentRecord
 */
class CompletedCampusAmbassadorTask extends Model
{
    use PayableClaimTrait,
        Actionable,
        MailableClaimTrait;

    protected $table = 'campus_ambassador_task_user';

    protected $fillable = [
        'campus_ambassador_task_id',
        'user_id',
        'amount',
        'ambassador_notes',
        'admin_notes',
        'payment_completed',
        'files',
    ];

    protected $casts = [
        'files'             => 'array',
        'payment_completed' => 'bool',
    ];

    public function campusAmbassador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task()
    {
        return $this->belongsTo(CampusAmbassadorTask::class, 'campus_ambassador_task_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentRecord()
    {
        return $this->belongsTo(Payment::class);
    }

    public function getClaimantAttribute()
    {
        return $this->campusAmbassador;
    }

    public function setPaymentIdAttribute($value)
    {
        $this->attributes['payment_record_id'] = $value;
    }
}
