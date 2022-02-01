<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

abstract class FeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function getValidationErrors()
    {
        if (!optional(session())->has('errors')) {
            return [];
        }
        $errors = session()->get('errors');

        return $errors->toArray();
    }

    private function replaces(array $map)
    {
        $result = [];
        foreach ($map as $key => $value) {
            $result[$key] = str_replace('_', ' ', Str::snake($value));
        }

        return $result;
    }

    public function assertValidationError(string $attribute, string $validationMessageKey, array $replaces = [])
    {
        $errors = $this->getValidationErrors();
        $this->assertArrayHasKey($attribute, $errors);

        $replaces = array_merge([
            'attribute' => $attribute,
        ], $replaces);

        $expected = __($validationMessageKey, $this->replaces($replaces));
        $actual   = $errors[$attribute][0];

        $this->assertEquals($expected, $actual);
    }

    public function getStub(string $name, bool $decodeJson = true)
    {
        $content = file_get_contents(base_path('tests/Stubs/' . $name));

        return $decodeJson ? json_decode($content, true) : $content;
    }

    public function expectsRepository($repository)
    {
        $mock = \Mockery::mock($repository);

        $this->app->instance($repository, $mock);

        return $mock;
    }

}
