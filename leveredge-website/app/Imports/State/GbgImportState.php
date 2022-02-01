<?php


namespace App\Imports\State;


class GbgImportState
{
    protected static $status = [];

    /**
     * @return array
     */
    public static function getStatus(): array
    {
        return self::$status;
    }

    /**
     * @param array $status
     */
    public static function setStatus(array $status): void
    {
        self::$status = $status;
    }
}
