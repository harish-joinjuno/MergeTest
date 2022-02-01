<?php


namespace App\Integrations;

use App\Integrations\Contracts\PayableInterface;
use App\Payment;
use App\PaymentMethod;
use App\User;
use kamerk22\AmazonGiftCode\AmazonGiftCode;

class AmazonGiftCardClient implements PayableInterface
{
    const CURRENCY = 'USD';

    private $client;

    public function __construct()
    {
        $config       = config('services.aws_gift_card');
        $this->client = AmazonGiftCode::make($config['access_key'], $config['secret_key'], $config['partner_id'], $config['endpoint'], self::CURRENCY);
    }

    public function send(User $from, User $to, int $amount, string $description = null): Payment
    {
        $response = $this->client->buyGiftCard($amount);
        $referenceInformation =  [
            'amount'            => $amount,
            'creationRequestId' => $response->getCreationRequestId(),
            'claimCode'         => $response->getClaimCode(),
            'shouldNotifyUser'  => true,
        ];

        $payment                        = new Payment();
        $payment->user_id               = $to->id;
        $payment->payer_id              = $from->id;
        $payment->payment_method_id     = PaymentMethod::whereName(PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD)->first()->id;
        $payment->amount                = $amount;
        $payment->reference_information = $referenceInformation;
        $payment->status                = Payment::STATUS_PAID;
        $payment->save();

        return $payment;
    }
}
