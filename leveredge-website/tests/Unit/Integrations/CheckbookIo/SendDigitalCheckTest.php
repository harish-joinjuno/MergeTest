<?php

namespace Tests\Unit\Integrations\CheckbookIo;

use App\Exceptions\Payment\PayingUserWithoutFullNameException;
use App\Integrations\CheckbookIoClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\Builders\UserBuilder;
use Tests\Unit\UnitTest;

class SendDigitalCheckTest extends UnitTest
{
    use RefreshDatabase;

    /** @test */
    public function it_should_work()
    {
        $client      = new CheckbookIoClient();
        $from        = (new UserBuilder())->withEmail('nikhil@leverdge.org')->save()->get();
        $to          = (new UserBuilder())->withEmail('nikhil@joinjuno.com')->save()->get();
        $actualCheck = $client->send($from, $to, 200,'Test Check. Do not deposit.');
        $this->assertNotNull($actualCheck);
    }

    /** @test */
    public function it_should_fail_when_name_is_too_short()
    {
        $client = new CheckbookIoClient();
        $this->expectException(PayingUserWithoutFullNameException::class);
        $from = (new UserBuilder())->save()->get();
        $to   = (new UserBuilder())
            ->withFirstName('J')
            ->withName('J')
            ->withLastName('')
            ->save()
            ->get();
        $client->send($from, $to, 200);
    }

    /** @test */
    public function it_should_fail_when_payment_is_larger_than_2000()
    {
        $client = new CheckbookIoClient();
        $this->expectException(ValidationException::class);
        $from = (new UserBuilder())
            ->withName('J')
            ->save()
            ->get();
        $to = (new UserBuilder())->save()->get();
        $client->send($from, $to, 2001);
    }
}
