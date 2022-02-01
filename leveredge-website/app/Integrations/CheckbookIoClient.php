<?php


namespace App\Integrations;

use App\Exceptions\Payment\PayingUserWithoutFullNameException;
use App\Integrations\Contracts\PayableInterface;
use App\Payment;
use App\PaymentMethod;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Validator;

class CheckbookIoClient implements PayableInterface
{
    private $client;

    public function __construct(MockHandler $handlerStack = null)
    {
        $key    = config('services.checkbook_io.key');
        $secret = config('services.checkbook_io.secret');

        $options = [
            'base_uri'              => config('services.checkbook_io.base_uri'),
            RequestOptions::HEADERS => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => "{$key}:{$secret}",
            ],
        ];

        if ($handlerStack && $handlerStack->count() > 0) {
            $options['handler'] = $handlerStack;
        }

        $this->client = new Client($options);
    }

    private function sendDigitalCheck(string $recipientName, string $recipientEmail, int $amount, string $description = null)
    {
        $data = [
            'recipient' => $recipientEmail,
            'name'      => $recipientName,
            'amount'    => $amount,
        ];

        if ($description) {
            $data['description'] = $description;
        }

        Validator::make($data, [
            'recipient' => ['required', 'email'],
            'name'      => ['required', 'min:2'],
            'amount'    => ['required', 'integer', 'max:2000'],
        ])->validate();

        $response = $this->client->post('v3/check/digital', [
            RequestOptions::JSON => $data,
        ]);
        $contents = $response->getBody()->getContents();

        return json_decode($contents, true);
    }

    public function send(User $from, User $to, $amount, $description = null): Payment
    {
        if (!$to['first_name'] || !$to['last_name']) {
            throw new PayingUserWithoutFullNameException('To be paid, a user must have a full name');
        }

        $reference_information = $this->sendDigitalCheck($to['first_name'] . ' ' . $to['last_name'], $to['email'], $amount, $description);

        $payment                        = new Payment();
        $payment->user_id               = $to->id;
        $payment->payer_id              = $from->id;
        $payment->payment_method_id     = PaymentMethod::whereName(PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK)->first()->id;
        $payment->amount                = $amount;
        $payment->reference_information = $reference_information;
        $payment->status                = Payment::STATUS_PAID;
        $payment->save();

        return $payment;
    }
}
