<?php

namespace App;

use App\Facades\AmazonGiftCard;
use App\Facades\CheckBookIo;
use App\Mail\AmazonGiftCardSent;
use App\Mail\CheckbookLeveredgeRewardClaimMail;
use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
class PaymentMethod extends Model
{
    use SoftDeletes;

    public const PAYMENT_METHOD_DIGITAL_CHECK    = 'Digital Check';
    public const PAYMENT_METHOD_AMAZON_GIFT_CARD = 'Amazon Gift Card';
    public const PAYMENT_METHOD_SCHOLARSHIP_POT  = 'LeverEdge Scholarship Pot';

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaymentProvider()
    {
        switch ($this->name) {
            case self::PAYMENT_METHOD_DIGITAL_CHECK:
                return CheckBookIo::class;

                break;
            case self::PAYMENT_METHOD_AMAZON_GIFT_CARD:
                return AmazonGiftCard::class;

                break;
            default: break;
        }
    }

    public function getMailable()
    {
        switch ($this->name) {
            case self::PAYMENT_METHOD_AMAZON_GIFT_CARD:
                return AmazonGiftCardSent::class;

                break;
            default: break;
        }
    }
}
