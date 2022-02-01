<?php


namespace App\Repositories\Contracts;


interface MagicLoginLinkRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function exportAsCsv(int $id);
}
