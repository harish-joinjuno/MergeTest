<?php


namespace App\Repositories\Contracts;


interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function createAsPartner(array $data);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function createAsPartnerWithPartnerProfile(array $data);
}
