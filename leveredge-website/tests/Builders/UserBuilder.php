<?php


namespace Tests\Builders;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserBuilder
{
    use WithFaker;

    /** @var User */
    public $user;

    public function __construct($attributes = [])
    {
        $this->faker = $this->makeFaker('en_US');
        $this->user  = factory(User::class)->make($attributes);
    }

    public function save()
    {
        $this->user->save();

        return $this;
    }

    public function get()
    {
        return $this->user;
    }

    public function referredBy(User $user)
    {
        $this->user->referred_by_id = $user->id;

        return $this;
    }

    public function withEmail(string $email = null)
    {
        $this->user->email = $email ?: $this->faker->unique()->safeEmail;

        return $this;
    }

    public function withPassword(string $password = null)
    {
        $this->user->password = $password ?: $this->faker->password;

        return $this;
    }

    public function withRole(Role $role = null)
    {
        if ($role == null) {
            $role = (new RoleBuilder())
                ->withName()
                ->save()
                ->get();
        }
        if (!$this->user->id) {
            $this->save();
        }

        $role->users()->attach($this->user);

        return $this;
    }

    public function withRoleName(string $name)
    {
        $role = (new RoleBuilder())
            ->withName($name)
            ->save()
            ->get();
        if (!$this->user->id) {
            $this->save();
        }

        $role->users()->attach($this->user);

        return $this;
    }

    public function withName(string $name = null)
    {
        $this->user->name = $name ?? $this->faker->name;

        return $this;
    }

    public function withFirstName(string $firstName = null)
    {
        $this->user->first_name = $firstName ?? $this->faker->firstName;

        return $this;
    }

    public function withLastName(string $lastName = null)
    {
        $this->user->last_name = $lastName ?? $this->faker->lastName;

        return $this;
    }
}
