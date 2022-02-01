<?php


namespace Tests\Feature\Functions;

use Tests\Feature\FeatureTest;

class AddUtmCodesFunctionTest extends FeatureTest
{
    private $url;

    private $utmObject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = config('app.url');

        $this->utmObject             = new \stdClass;
        $this->utmObject->utm_source = 'local';
    }

    public function test_it_should_build_url_with_trailing_slash()
    {
        $this->utmObject->gclid  = '1234';
        $this->utmObject->utm_id = 'utmId';
        $url                     = $this->url . '/website/';
        $expected                = $url . '?utm_source=local&utm_id=utmId&gclid=1234';


        $this->assertSame($expected, addUtmCodes($url, $this->utmObject));
    }

    public function test_it_should_build_url_without_trailing_slach()
    {
        $url      = $this->url . '/website';
        $expected = $url . '?utm_source=local';

        $this->assertSame($expected, addUtmCodes($url, $this->utmObject));
    }

    public function test_it_should_build_url_with_existing_query_params_with_trailing_slash()
    {
        $url      = $this->url . '/?param=value';
        $expected = $url . '&utm_source=local';

        $this->assertSame($expected, addUtmCodes($url, $this->utmObject));
    }

    public function test_it_should_build_url_with_existing_query_params_without_trailing_slash()
    {
        $this->utmObject->gclid = '1234';
        $url                    = $this->url . '?param=value';
        $expected               = $url . '&utm_source=local&gclid=1234';

        $this->assertSame($expected, addUtmCodes($url, $this->utmObject));
    }

    public function test_it_should_build_url_and_overwrite_existing_utm_param_in_url()
    {
        $url      = $this->url . '?utm_source=override_me&utm_campaign=something_else&param=value';
        $expected = $this->url . '?utm_source=local&utm_campaign=something_else&param=value';

        $this->assertSame($expected, addUtmCodes($url, $this->utmObject));
    }

    public function test_it_should_build_url_with_spaces()
    {
        $this->utmObject->utm_source = 'Some Campaign Name with Space';
        $expected                    = $this->url . '?utm_source=Some+Campaign+Name+with+Space';

        $this->assertSame($expected, addUtmCodes($this->url, $this->utmObject));
    }

    public function test_it_should_build_url_with_special_characters()
    {
        $this->utmObject->utm_source = 'Some + Campaign + Name';
        $expected                    = $this->url . '?utm_source=Some+%2B+Campaign+%2B+Name';

        $this->assertSame($expected, addUtmCodes($this->url, $this->utmObject));
    }
}
