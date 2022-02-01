<?php


namespace App\Repositories;

use App\Repositories\Contracts\PartnerProfileRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Role;
use App\User;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function createAsPartner(array $data): object
    {
        $data['password'] = bcrypt($data['password']);
        $user             = $this->store($data);

        $user->roles()->attach(Role::ROLE_PARTNER);

        return $user;
    }

    public function createAsPartnerWithPartnerProfile(array $data): object
    {

        $user = $this->createAsPartner($data);
        resolve(PartnerProfileRepositoryInterface::class)
            ->createForUser($user->id, $data['partner_type'], $data['contract_type']);

        return $user;
    }
}
