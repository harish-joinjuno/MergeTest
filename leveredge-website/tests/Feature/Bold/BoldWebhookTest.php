<?php


namespace Tests\Feature\Bold;


use Tests\Feature\FeatureTest;

class BoldWebhookTest extends FeatureTest
{
    /** @test */
    public function test_it_should_fail_for_no_secret_key_input()
    {
        $response = $this->post('webhook/bold', [], ['HTTP_REFERER' => 'http://prodbe.bold.org']);
        $response->assertStatus(400);
        $this->assertEquals([
            "status"  => "error",
            "code"    => 400,
            "message" => "Secret key is missing",
        ],$response->json());
    }

    /** @test */
    public function test_it_should_fail_for_wrong_secret_key()
    {
        $response = $this->post('webhook/bold', [
            config('services.bold.secret_key_name') => 'base64:fRzyFYcT45ekZkNW2978ZGtyu3Y0pBVEehrOxdxFYhc=', //random key
        ], ['HTTP_REFERER' => 'http://prodbe.bold.org']);
        $response->assertStatus(400);
        $this->assertEquals([
            "status"  => "error",
            "code"    => 400,
            "message" => "Secret key is not matching",
        ],$response->json());
    }

    /** @test */
    public function test_it_should_store_bold_request_data_in_database()
    {
        $this->withoutEvents();

        $name                            = $this->faker->name;
        $streetAddress                   = $this->faker->streetAddress;
        $email                           = $this->faker->email;
        $phoneNumber                     = $this->faker->phoneNumber;
        $citizenship                     = 'us_citizen';
        $creditScore                     = 5;
        $educationDegreeType             = '_bachelors';
        $educationSchoolName             = 'School Name';
        $educationExpectedGraduationYear = $this->faker->year('now');

        $data = [
            config('services.bold.secret_key_name')      => config('services.bold.secret_key'),
            'fullName'                                   => $name,
            'streetAddress'                              => $streetAddress,
            'email'                                      => $email,
            'phoneNumber'                                => $phoneNumber,
            'citizenship'                                => $citizenship,
            'creditScore'                                => $creditScore,
            'education'                                  => [
                'degreeType'             => $educationDegreeType,
                'schoolName'             => $educationSchoolName,
                'expectedGraduationYear' => $educationExpectedGraduationYear,
            ],
        ];
        $response = $this->post('webhook/bold', $data, ['HTTP_REFERER' => 'http://prodbe.bold.org']);
        $response->assertOk();
        $this->assertDatabaseHas('bold_students', [
            'full_name'                          => $name,
            'street_address'                     => $streetAddress,
            'email'                              => $email,
            'phone_number'                       => $phoneNumber,
            'citizenship'                        => $citizenship,
            'credit_score'                       => $creditScore,
            'education_degree_type'              => $educationDegreeType,
            'education_school_name'              => $educationSchoolName,
            'education_expected_graduation_year' => $educationExpectedGraduationYear,
        ]);
    }
}
