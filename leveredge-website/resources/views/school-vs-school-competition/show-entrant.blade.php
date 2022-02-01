@extends('template.public')

@section('content')

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1 class="mb-5">You're In!</h1>
                    <h3 class="sub-heading">Share with your class to win the competition</h3>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    @include('reward-program.partials._share-links-with-prizes', [
                        'shareTitle' => '',
                        'shareUrl' => url('competition/' . $entrant->competition->id ),
                    ])
                </div>
            </div>
        </div>

        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <h2 class="mb-3">Current Status</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 text-center">
                        <competition-status-chart
                            :competition='@json($entrant->competition)'
                        >
                        </competition-status-chart>
                    </div>
                </div>
            </div>
        </section>

        @include('member.referral-program.partials.share-via-email', [
            'emailRoute' => url('competition/' . $entrant->id .'/share-via-email'),
        ])
    </section>

    <section>
        <div class="container">
            <h2 class="text-center mb-4">Don't know where to start? We got you!</h2>

            @include('member.referral-program.partials._share-templates', [
                'uniqueId' => 'copyShare',
                'referralLink' => url('competition/' . $entrant->competition->id ),
                'shareMessages' => [
'I just signed up to Juno to help ' . $entrant->competition->colloquial_name_one . ' students win $500 in scholarships!

All we have to do is get more signups than ' . $entrant->competition->colloquial_name_two . '... Lets do it!!',
'I just signed up to Juno to help ' . $entrant->competition->colloquial_name_one . ' students win $500 in scholarships!

All we have to do is get more signups to the competition than ' . $entrant->competition->colloquial_name_one . '. Lets do it!!',
'Together we can get 5 students at ' . $entrant->competition->colloquial_name_one . ' $100 in scholarships.
All we need to do is get more people than ' . $entrant->competition->colloquial_name_two . ' to join Juno!',
'I need everyone to go signup for the Juno scholarship competition! If we get more people to sign up for the competition than ' . $entrant->competition->colloquial_name_two . ' then we will win $' . ($entrant->competition->first_prize_amount * $entrant->competition->number_of_prizes) . ' worth of scholarships!!'
                ],
            ])
        </div>
    </section>
@endsection
