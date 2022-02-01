<?php


namespace App\Policies\Nova;

use App\NegotiationGroupFaqCategory;

class NegotiationGroupFaqCategoryPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroupFaqCategory::class;
}
