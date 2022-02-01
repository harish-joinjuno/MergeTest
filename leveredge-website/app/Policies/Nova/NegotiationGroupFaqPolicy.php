<?php


namespace App\Policies\Nova;

use App\NegotiationGroupFaq;

class NegotiationGroupFaqPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroupFaq::class;
}
