<?php


namespace App\Contracts;


interface DisplayCountAndProgressStageInterface
{
    const DISPLAY_COUNT_BASED_ON_ACADEMIC_YEARS = 1;

    const DISPLAY_COUNT_BASED_ON_NEGOTIATION_GROUP = 2;

    const PROGRESS_STAGE_YET_TO_START = 1;

    const PROGRESS_STAGE_STEP_ONE_COMPLETE = 2;

    const PROGRESS_STAGE_STEP_TWO_COMPLETE = 3;

    const PROGRESS_STAGE_STEP_THREE_COMPLETE = 4;

    const DISPLAY_COUNT_BASED_ON_LIST = [
        self::DISPLAY_COUNT_BASED_ON_ACADEMIC_YEARS    => 'Academic Year',
        self::DISPLAY_COUNT_BASED_ON_NEGOTIATION_GROUP => 'Negotiation Group',
    ];

    const PROGRESS_STAGE_LIST = [
        self::PROGRESS_STAGE_YET_TO_START        => 'Yet to Start',
        self::PROGRESS_STAGE_STEP_ONE_COMPLETE   => 'Step One Complete',
        self::PROGRESS_STAGE_STEP_TWO_COMPLETE   => 'Step Two Complete',
        self::PROGRESS_STAGE_STEP_THREE_COMPLETE => 'Step Three Complete',
    ];
}
