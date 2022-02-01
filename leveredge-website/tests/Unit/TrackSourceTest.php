<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\MigrateFreshDatabaseOnce;

class TrackSourceTest extends UnitTest
{
    use WithFaker, MigrateFreshDatabaseOnce;

    private $trackingSourceParams = [
        'utm_source'   => 'google',
        'utm_medium'   => 'email',
        'utm_campaign' => 'student_loans',
        'utm_term'     => 'scholarship',
        'utm_content'  => 'logolink',
        'utm_id'       => 'utmId',
        'gclid'        => '1234',
    ];

    /** @test */
    public function it_can_store_last_url_params_in_cookies()
    {
        $url = route('welcome', $this->trackingSourceParams);
        $this->get($url)
            ->assertCookie('tracking_sources', serialize($this->trackingSourceParams));
    }

    /** @test */
    public function it_should_store_last_tracking_source_value_only()
    {
        $firstVisit = [
            'utm_source' => 'google',
            'utm_medium' => 'email',
        ];

        $secondVisit = [
            'utm_campaign' => 'student_loans',
            'utm_term'     => 'scholarship',
            'utm_content'  => 'logolink',
            'utm_id'       => 'utmId',
            'gclid'        => '1234',
        ];

        $url = route('welcome', $firstVisit);
        $this->get($url);

        $url = route('welcome', $secondVisit);
        $this->get($url)
            ->assertCookie('tracking_sources', serialize($secondVisit));
    }

    /** @test */
    public function it_should_save_tracking_source_after_user_signup()
    {
        $action = action('Auth\RegisterController@register');

        $this->call('POST', $action, [
            'email'    => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
        ], ['tracking_sources' => Crypt::encrypt($this->trackingSourceParams)]);

        $this->assertDatabaseHas('user_profiles', $this->trackingSourceParams);
    }
}
