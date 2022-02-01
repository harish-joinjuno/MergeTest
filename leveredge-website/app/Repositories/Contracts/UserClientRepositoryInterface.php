<?php


namespace App\Repositories\Contracts;


interface UserClientRepositoryInterface extends RepositoryInterface
{
    public function forUser(int $userId);
}
