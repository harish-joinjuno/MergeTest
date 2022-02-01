<?php

namespace App\Console\Commands\Temporary;

use App\QuestionFlowResponder;
use App\User;
use Illuminate\Console\Command;

class SetCompletedAtInQuestionFlowResponders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'question-flows:set-completed-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $questionFlowMaps = collect([
            [
                'question_flow_id'   => 1,
                'negotiation_groups' => [
                    7,
                    8,
                    9,
                    10,
                    11,
                    12,
                    13,
                ],
            ],
            [
                'question_flow_id'   => 6,
                'negotiation_groups' => [
                    1,
                    2,
                    14,
                    15,
                    16,
                    17,
                ],
            ],
            [
                'question_flow_id'   => 3,
                'negotiation_groups' => [20],
            ],
            [
                'question_flow_id'   => 4,
                'negotiation_groups' => [
                    18,
                    19,
                ],
            ],
            [
                'question_flow_id'   => 5,
                'negotiation_groups' => [21],
            ],
            [
                'question_flow_id'   => 7,
                'negotiation_groups' => [24],
            ],
            [
                'question_flow_id'   => 8,
                'negotiation_groups' => [24],
            ],
        ]);

        $questionFlowResponders = QuestionFlowResponder::whereNull('completed_at')->get();

        foreach ($questionFlowResponders as $questionFlowResponder) {
            if ($questionFlowResponder->responder->negotiationGroupUsers) {
                $questionFLowMap = $questionFlowMaps->where('question_flow_id', $questionFlowResponder->question_flow_id)->first();
                if ($questionFlowResponder->responder->negotiationGroupUsers->count()) {
                    $negotiationGroupUser = $questionFlowResponder->responder->negotiationGroupUsers->whereIn('negotiation_group_id', $questionFLowMap['negotiation_groups'])->first();

                    if ($negotiationGroupUser) {
                        $questionFlowResponder->completed_at = $negotiationGroupUser->created_at;
                        $questionFlowResponder->save();
                    }
                }
            }
        }
    }
}
