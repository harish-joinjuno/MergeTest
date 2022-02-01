<?php


namespace App\Jobs\CompleteFlow\Abstracts;

use App\Events\UserPlacedInNegotiationGroup;

abstract class AddToAcademicYear
{
    public $user;

    public function __construct()
    {
        $this->user = user();
    }
    public function handle()
    {
        $academicYear         = $this->getAcademicYear();
        $this->user->profile->placeInEligibleNegotiationGroups($academicYear);
        event(new UserPlacedInNegotiationGroup($this->user));

        if (method_exists($this, 'addLoanAmountToNegotiationGroupUser')) {
            $this->addLoanAmountToNegotiationGroupUser();
        }
    }

    abstract protected function getAcademicYear();
}
