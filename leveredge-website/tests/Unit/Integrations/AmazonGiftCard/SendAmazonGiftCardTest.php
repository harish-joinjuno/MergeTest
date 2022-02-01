<?php

namespace Tests\Unit\Integrations\AmazonGiftCard;

use App\Integrations\AmazonGiftCardClient;
use App\PaymentMethod;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Builders\UserBuilder;
use Tests\Unit\UnitTest;


class SendAmazonGiftCardTest extends UnitTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_work()
    {
        $client      = new AmazonGiftCardClient();
        $amount      = 100;
        $from        = (new UserBuilder())->save()->user;
        $to          = (new UserBuilder())->save()->user;
        $client->send($from, $to, $amount);

        $this->assertDatabaseHas('payments', [
            'user_id'           => $to->id,
            'payer_id'          => $from->id,
            'payment_method_id' => PaymentMethod::whereName(PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD)->first()->id,
            'amount'            => $amount,
        ]);
    }
}
