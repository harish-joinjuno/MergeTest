<?php


namespace Tests\Builders;

use App\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleBuilder
{
    use WithFaker;

    /** @var Role */
    public $role;

    public function __construct($attributes = [])
    {
        $this->faker = $this->makeFaker('en_US');
        $this->role  = factory(Role::class)->make($attributes);
    }

    public function save()
    {
        $this->role->save();

        return $this;
    }

    public function get()
    {
        return $this->role;
    }

    public function withName(string $name = null)
    {
        Validator::make(['name' => $name], [
            'name' => [
                'nullable',
                Rule::in([
                    Role::ROLE_NAME_ADMIN,
                    Role::ROLE_NAME_PARTNER,
                    Role::ROLE_NAME_LENDER,
                    Role::ROLE_NAME_BORROWER,
                ])],
        ]);

        $this->role->name = $name ?? $this->faker->randomElement([
                Role::ROLE_NAME_ADMIN,
                Role::ROLE_NAME_PARTNER,
                Role::ROLE_NAME_LENDER,
                Role::ROLE_NAME_BORROWER,
            ]);

        return $this;
    }
}
