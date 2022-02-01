<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserClientRepositoryInterface;
use App\UserClient;

class UserClientRepository extends Repository implements UserClientRepositoryInterface
{
    protected $model = UserClient::class;

    public function forUser(int $userId)
    {
        return $this->model->where('user_id', $userId);
    }
}
