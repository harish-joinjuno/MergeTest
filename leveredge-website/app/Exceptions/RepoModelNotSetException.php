<?php


namespace App\Exceptions;


class RepoModelNotSetException extends \Exception
{
    /**
     * Set the Repo that is missing it's model.
     *
     * @param $repo
     *
     * @return $this
     */
    public function setRepo($repo): RepoModelNotSetException
    {
        $this->message = "Model for repository [{$repo}] has not been set.";

        return $this;
    }
}
