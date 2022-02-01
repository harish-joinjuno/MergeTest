<?php


namespace Tests\Feature\Bold;

use App\Listeners\BoldPingListener;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Tests\Feature\FeatureTest;

class BoldPingTest extends FeatureTest
{
    public function test_it_should_store_utm_source_in_cookie_and_make_request_to_bold()
    {
        $this->withoutEvents();

        $urlParams = [
            'utm_source'  => 'bold',
            'subId1'      => '2047',
        ];

        $url = route('welcome', $urlParams);

        $this->get($url)
            ->assertCookie('tracking_sources', serialize($urlParams));

        $action = action('Auth\RegisterController@register');
        $email  = $this->faker->unique()->safeEmail;
        $this->call('POST', $action, [
            'email'    => $email,
            'password' => $this->faker->password,
        ], ['tracking_sources' => Crypt::encrypt($urlParams)]);

        $this->assertDatabaseHas('user_profiles', [
            'utm_source' => $urlParams['utm_source'],
        ]);

        // Enable this to test the listener
        // Need to get a subId from Bold before we can do this
        // They invalidate the subId once it is used
//        $listener = new BoldPingListener();
//        $response = $listener->handle(new Registered(User::where('email',$email)->first()));
//        $this->assertNotNull($response);
//        $this->assertEquals(200, $response->getStatusCode());
    }
}
