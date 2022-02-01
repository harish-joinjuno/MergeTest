<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Builders\RoleBuilder;
use Tests\Builders\UserBuilder;

abstract class AdminFeatureTest extends FeatureTest
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $role = (new RoleBuilder())
            ->withName('admin')
            ->save()
            ->get();

        $this->admin = (new UserBuilder())
            ->withRole($role)
            ->get();
    }
}
