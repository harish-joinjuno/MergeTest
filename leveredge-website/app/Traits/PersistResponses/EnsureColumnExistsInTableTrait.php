<?php


namespace App\Traits\PersistResponses;


use Illuminate\Support\Facades\DB;

trait EnsureColumnExistsInTableTrait
{
    public function acceptsFieldName(string $fieldName)
    {
        $defaultConnection = config('database.default');
        $database          = config("database.connections.{$defaultConnection}.database");
        $tableName         = $this->getTableName();
        $result            = DB::select("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA` = '{$database}' AND `TABLE_NAME` = '{$tableName}' AND `COLUMN_NAME` = '{$fieldName}'");

        return (count($result) !== 0);
    }

    abstract function getTableName(): string;
}
