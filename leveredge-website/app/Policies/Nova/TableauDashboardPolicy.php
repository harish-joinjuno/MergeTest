<?php


namespace App\Policies\Nova;


use App\TableauDashboard;

class TableauDashboardPolicy extends AbstractNovaPermissionHandler
{
    public $resource = TableauDashboard::class;
}
