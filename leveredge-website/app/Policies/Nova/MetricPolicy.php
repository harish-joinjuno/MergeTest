<?php


namespace App\Policies\Nova;


use App\Metric;

class MetricPolicy extends AbstractNovaPermissionHandler
{
    public $resource = Metric::class;
}
