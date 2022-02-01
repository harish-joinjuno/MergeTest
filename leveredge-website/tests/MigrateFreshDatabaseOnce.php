<?php
namespace Tests;

use Illuminate\Support\Facades\Artisan;

trait MigrateFreshDatabaseOnce
{
    protected static $setUpHasRunOnce = false;

    public function setUp(): void
    {
        parent::setUp();
        if (!static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
            static::$setUpHasRunOnce = true;
        }
    }
}
