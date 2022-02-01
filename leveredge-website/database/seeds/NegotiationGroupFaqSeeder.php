<?php

use Carbon\Carbon;
use App\NegotiationGroup;
use Illuminate\Database\Seeder;

class NegotiationGroupFaqSeeder extends Seeder
{

    public function run()
    {
        $negotiationGroups = NegotiationGroup::all();

        foreach ($negotiationGroups as $negotiationGroup) {

            $faqCategories = $negotiationGroup->faqCategories()->createMany([
                ['name' => 'Common Questions'],
                ['name' => 'Other Questions'],
            ]);

            $commonQuestions = $faqCategories->where('name', 'Common Questions')->first();

            $commonQuestions->negotiationGroupFaqs()->createMany([
                [
                    'title'          => 'How long will it take to close this deal?',
                    'body'           => 'It will take several months to close this deal',
                    'published_body' => 'It will take several months to close this deal',
                    'published_at'   => Carbon::now(),
                ],
                [
                    'title'          => 'How many banks are competing for our business?',
                    'body'           => 'There are more than 10 banks competing for your business.',
                    'published_body' => 'There are more than 10 banks competing for your business.',
                    'published_at'   => Carbon::now(),
                ],
                [
                    'title'          => 'How likely is it that you will be able to lower our rates?',
                    'body'           => 'LeverEdge has been successful in lowering rates every time we have attempted to do this since 2018 for domestic students.',
                    'published_body' => 'LeverEdge has been successful in lowering rates every time we have attempted to do this since 2018 for domestic students.',
                    'published_at'   => Carbon::now(),
                ],
            ]);

        }
    }
}
