<?php


namespace App\Policies\Nova;

use App\ContractTypeMetric;

class ContractTypeMetricPolicy extends AbstractNovaPermissionHandler
{
    public $resource = ContractTypeMetric::class;
}
