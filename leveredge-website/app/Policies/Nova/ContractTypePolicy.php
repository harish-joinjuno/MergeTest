<?php


namespace App\Policies\Nova;

use App\ContractType;

class ContractTypePolicy extends AbstractNovaPermissionHandler
{
	public $resource = ContractType::class;
}
