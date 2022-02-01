@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'We negotiated discounted student loan options for 8K+ grad students',
    'callToActionURL' => '/register',
    'callToActionText' => 'Access the Deal',
    'headingBackgroundImage' => asset('/img/plane-background.png'),
])

@section('page-body')
    @if(!empty($rates))
        @include('landing-pages.partials._rates-table', [
            'title' => $rates->title,
            'description' => $rates->description,
            'ctaLink' => $rates->cta_link,
            'ctaText' => $rates->cta_text,
            'rates' => $rates,
        ])
    @endif

    <div class="container-fluid py-5 bg-light-green">
        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-sm-6 text-center mb-5">
                    <img src="{{ asset('/img/coins-falling-into-vault.png') }}" class="img-fluid">
                </div>
                <div class="col-12 col-sm-6 mb-5">
                    <h4 class="underlined d-sm-inline-block text-center text-sm-left mb-5">Juno Rewards</h4>
                    <h2 class="mb-5">
                        We give you at least 0.5% of your loan amount back when you use one of your negotiated deals
                    </h2>
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'What are Juno Rewards?',
                        'content' => 'Most partners who work with us pass along a referral fee when you take a loan.
                        Rather keep all of that to ourselves, we’re giving you a bonus using those funds. This is
                        separate from our existing referral bonuses and any additional discounts we’ve negotiated.',
                    ])
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'How are the rewards calculated?',
                        'content' => 'We’re giving you at least 0.5% of the loan you take using your special Juno
                        link. So if you take out a loan for $60,000, you’re going to get a check for at least $300.
                        No strings attached.',
                    ])
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'When will I receive Juno rewards?',
                        'content' => 'You’ll receive your Juno Reward once the partner confirms that Juno will be
                        paid for referring you to them. Typically, this happens a few days after when the loan amount
                        gets sent by the lender to the school. The exact date should be in your final loan documents.',
                    ])
                    <a href="{{ url('leveredge-rewards/terms') }}" class="mb-5 d-block">
                        You can find all the details here.
                    </a>

                    <a href="{{ url('/2020rewardsprogram') }}" class="btn btn-primary">
                        Request Your Reward
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container mt-5 narrow text-center">
            <h6 class="font-weight-bold">
                How does this compare to rates from other lenders?
            </h6>
            <p class="mb-5">
                To compare rates, you can apply to several lenders and receive your personalized quote.
                Then, you can compare the quotes to decide which one is best for you.
                Don't forget to consider Federally held student loans before any private student loans.
            </p>
            <h4 class="underlined pt-5">Negotiation Timeline</h4>
        </div>
    </div>
    @include('landing-pages.partials._timeline-item', [
        "image" => asset('/img/hands-on-laptop-with-coffee.png'),
        "tag" => "✓ Completed",
        "heading" => "Students Sign up",
        "description" => "Students join the Juno Student Loan Negotiation Group for free.",
        "backgroundColor" => "bg-light-green",
    ])
    @include('landing-pages.partials._timeline-item', [
        "image" => asset('/img/lenders-compete.png'),
        "tag" => "✓ Completed",
        "heading" => "Lenders Compete",
        "description" => "Lenders compete for your business by offering lower rate options for us to evaluate.",
    ])
    @include('landing-pages.partials._timeline-item', [
        "image" => asset('/img/loans-offered.png'),
        "tag" => "💵 Deal is now available!",
        "heading" => "Loans Offered",
        "description" => "Members apply directly to the lender offering the lowes rates exclusively via Juno.",
        "backgroundColor" => "bg-light-green",
    ])

    @include('landing-pages.partials._block-quote')

    @include('landing-pages.partials._benefits-of-the-deal', [
        "benefits" => [
            "<strong>Lower Rates</strong> (Options available based on lender)",
            "<strong>Option for Juno cash reward</strong>",
            "<strong>No Fees</strong> (No Application, No Origination and No Prepayment Fees)<sup class='foot-note-marker'>5</sup>",
        ]
    ])
@endsection

@section('post-body')
    @include('landing-pages.partials._got-questions')
@endsection

@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on credit profile.
        Fixed rates range from 3.49% APR (with autopay) to 6.90% APR (excludes 0.25% Auto Pay discount).
        Variable rates range from 1.24% APR (with autopay) to 6.50% APR (excludes 0.25% Auto Pay discount).
        For variable rate loans, although the interest rate will vary after you are approved, the interest rate
        will never exceed 36% (the maximum allowable for these loans). Earnest variable interest rates are based
        on a publicly available index, the one month London Interbank Offered Rate (LIBOR). Your rate will be
        calculated each month by adding a margin between 1.34% and 11.54% to the one month LIBOR. Earnest rate
        ranges are current as of 9/23/2020. Earnest Private Student Loans are not available in Nevada.'
    ])
@endpush
