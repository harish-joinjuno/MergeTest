<?php


namespace App\Repositories\Contracts;


interface AutoRefinanceApplicationRepositoryInterface extends RepositoryInterface
{
    public function basicDetails(): array;
}
