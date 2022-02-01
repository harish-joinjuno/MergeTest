<?php


namespace App\Policies\Nova;

use App\NegotiationGroupAnnouncement;

class NegotiationGroupAnnouncementPolicy extends AbstractNovaPermissionHandler
{
	public $resource = NegotiationGroupAnnouncement::class;
}
