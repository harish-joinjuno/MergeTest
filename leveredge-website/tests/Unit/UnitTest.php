<?php

namespace Tests\Unit;

use Tests\TestCase;

abstract class UnitTest extends TestCase
{
    public function getStub(string $name, bool $decodeJson = true)
    {
        $testsDir = substr(__DIR__, 0, (strpos("Unit", __DIR__) - 5));
        $content  = file_get_contents("{$testsDir}/Stubs/{$name}");

        return $decodeJson ? json_decode($content, true) : $content;
    }
}
