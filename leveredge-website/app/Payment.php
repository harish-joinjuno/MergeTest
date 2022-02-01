<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $payer_id
 * @property int $payment_method_id
 * @property int $amount
 * @property array $reference_information
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property-read PaymentMethod $paymentMethod
 * @property-read User $user
 * @property-read User $payer
 */
class Payment extends Model
{
    use SoftDeletes;

    const STATUS_SUBMITTED = 'submitted';

    const STATUS_PAID      = 'paid';

    protected $casts = [
        'reference_information' => 'array',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class);
    }

}
