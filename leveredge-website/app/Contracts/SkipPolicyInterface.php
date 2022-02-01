<?php


namespace App\Contracts;

interface SkipPolicyInterface
{
    /**
     * @return boolean
     * Return True if it should be skipped
     * Return False if it should not be skipped
     */
    public function check();

}
