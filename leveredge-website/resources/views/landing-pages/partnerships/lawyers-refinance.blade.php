@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'We use group buying power to negotiate better student loan rates.',
    'headingColor' => 'text-primary custom-header',
    'callToActionURL' => '/register',
    'callToActionText' => 'Access the Deal',
    'headingBackgroundImage' => '',
    'centerHeading' => true,
    'hideForm' => true,
    'narrowHeading' => true,
])

@section('pre-header')
    @if(!empty($partner))
        @include('landing-pages.partnerships._partnership-header', [
            'partner' => $partner,
        ])
    @endif
@endsection

@section('customCTA')
    <p class="text-center mb-0" style="font-weight:600;">
        The average attorney can save $30,000 over federal loans.
        <sup class="foot-note-marker font-weight-normal">1</sup>
    </p>
    @include('landing-pages.partials.home._home-cta', [
        'customFootnote' => '2'
    ])
@endsection

@section('pre-body')
    <div class="container-fluid px-0">
        <div class="container home-header-image">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('/img/welcome-hero.png') }}" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="bg-light-green py-5 mt-n5"></div>
    </div>
@endsection

@section('page-body')
    @include('landing-pages.partials.home._how-it-works', [
        'customDescription' => 'We gather large groups of people with student loans and get lenders to compete for
        our business.'
    ])

    <div class="container-fluid py-5 bg-translucent-green">
        <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-12 col-sm-6">
                    <h1 class="off-black" style="font-size: 22px;">
                        The average attorney can save $30,000 over federal loans with
                        Juno<sup class="foot-note-marker" style="font-size:24px;">1</sup>
                    </h1>
                </div>
                <div class="col-12 col-sm-6">
                    <img src="{{ asset('/img/lawyer_savings_v2.png') }}" aria-hidden="true" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    @include('landing-pages.partials._common-question', [
        'questions' => [
            [
                'question' => 'Reason one: Lower your interest rate',
                'answer' => 'By refinancing your existing student loan, you may qualify for a lower interest rate and
                save money on your student loan. This is often because lenders view a graduated student with a
                full-time job as more likely to pay off the loan than a student that has not yet graduated.
                Additionally, the interest rate environment may also contribute to a lower rate.'
            ],
            [
                'question' => 'Reason two: Consolidate your loans',
                'answer' => 'Let’s say your student loans are split between Lender X, Lender Y, and Lender Z. Keeping
                up three different accounts to pay off can be hard to manage. Refinancing allows you to only pay one
                entity.'
            ],
            [
                'question' => 'Reason three: Lower your monthly payment',
                'answer' => 'Refinancing your student loan could lower your monthly loan payments. A lower interest
                rate or a longer term often results in lower monthly payments.
                <br><br>
                For example, you might have set things up so that you pay your loan back in 10 years. Let’s say after
                6 years you’d be paying a lower monthly payment. You could decide to replace that loan with a new loan
                that you pay back over a new 15 year term. This plan would reduce your minimum payment, though it
                would also increase the total cost of the loan because there is more time for interest to rack up.'
            ],
            [
                'question' => 'Am I a good fit for refinancing?',
                'answer' => 'Refinancing is a great option for people who have a solid grasp on their financial
                security already and are looking to lower their interest rates or pay off their loans faster.
                <br><br>
                If you haven’t graduated yet, if you aren’t up to date on your student loan payments, if you don’t
                have a steady income, if your credit score isn’t at least in the high 600’s, then refinancing is
                probably not for you.
                <br><br>
                Additionally, consider if you might need the safety nets that federally held student loans offer such as
                public service loan forgiveness or income driven repayment plans before you refinance.'
            ],
        ]
    ])

    @include('landing-pages.partials._benefits-of-the-deal', [
        "benefits" => [
            "<strong>No Fees</strong> (No Application, No Origination and No Prepayment Fees)",
            "<strong>Lower Rates</strong> (Options available based on lender)",
            "<strong>Up to $1000 Cash Back</strong> (Options available based on lender)",
        ]
    ])
@endsection

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">
        1 - Assumes 10-year fixed interest rate. Federal interest rate of 6.81% (2017-2019 weighted average
        federal student loan rate), dropping to 3.50% APR, plus additional Juno benefits, including cash back,
        are included in total savings above. Average law school debt for a recent graduate is approximately $150,000.
    </p>
    <p class="text-footer-disclaimer">
        2 - APR Rates shown are effective as of 7/1/2020 to the best of our knowledge. For the most up to
        date rates, we recommend contacting our partners. APRs include discounts such as autopay discounts and/or
        relationship discounts. If approved for a loan, the rates and terms offered will depend on things like
        creditworthiness, the loan term, and other factors. Not all applicants qualify for the lowest rate.
        If approved for a loan, to qualify for the lowest rate, you must have a responsible financial history and
        meet other conditions. Each lender reserves the right to change interest rates at any time without notice.
    </p>
@endpush

