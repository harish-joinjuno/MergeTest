<?php

namespace Tests\Unit\Integrations\MailChimp;

use App\Integrations\MailchimpClient;
use DrewM\MailChimp\MailChimp;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Mockery\Expectation;
use Tests\Unit\UnitTest;

class MailChimpTest extends UnitTest
{
    public function it_should_subscribe_new_user_with_email_only()
    {
        $email = 'jdoe@email.com';

        /** @var MailChimp $mailChimp */
        $mailChimp = $this->mock(MailChimp::class, function ($mock) use ($email) {
            $data = $this->getStub('/mailchimp/subscribe.valid-response.json');

            /** @var Expectation $subscriberHash */
            $subscriberHash = $mock->shouldReceive('subscriberHash');
            $subscriberHash
                ->once()
                ->with($email)
                ->andReturn('abc');

            /** @var Expectation $put */
            $put = $mock->shouldReceive('put');
            $put->once()
                ->with('lists//members/abc', [
                    'email_address' => $email,
                    'status'        => MailchimpClient::STATUS_SUBSCRIBED,
                ])
                ->andReturn($data);
        });

        $client     = new MailchimpClient($mailChimp);
        $subscribed = $client->subscribe('jdoe@email.com');

        $this->assertNotNull($subscribed);
    }

    public function it_should_subscribe_new_user_with_email_and_first_name()
    {
        $email = 'jdoe@email.com';

        /** @var MailChimp $mailChimp */
        $mailChimp = $this->mock(MailChimp::class, function ($mock) use ($email) {
            $data = $this->getStub('/mailchimp/subscribe.valid-response.json');

            /** @var Expectation $subscriberHash */
            $subscriberHash = $mock->shouldReceive('subscriberHash');
            $subscriberHash
                ->once()
                ->with($email)
                ->andReturn('abc');

            /** @var Expectation $put */
            $put = $mock->shouldReceive('put');
            $put->once()
                ->with('lists//members/abc', [
                    'email_address' => $email,
                    'status'        => MailchimpClient::STATUS_SUBSCRIBED,
                    'merge_fields'  => [
                        'FNAME' => 'John',
                    ],
                ])
                ->andReturn($data);
        });

        $client     = new MailchimpClient($mailChimp);
        $subscribed = $client->subscribe('jdoe@email.com', [
            'FNAME' => 'John',
        ]);

        $this->assertNotNull($subscribed);
    }

    /** @test */
    public function it_should_fail_if_name_is_invalid()
    {
        /** @var MailChimp $mailChimp */
        $mailChimp = $this->mock(MailChimp::class, function ($mock) {
            /** @var Expectation $subscriberHash */
            $subscriberHash = $mock->shouldReceive('subscriberHash');
            $subscriberHash->never();

            /** @var Expectation $put */
            $put = $mock->shouldReceive('put');
            $put->never();
        });

        $this->expectException(ValidationException::class);

        $client = new MailchimpClient($mailChimp);
        $client->subscribe('jdoe@email.com', [
            'FNAME' => Str::random(129),
        ]);
    }

}
