@extends('landing-pages.landing-page-layout', [
    'pageHeading' => 'We negotiated discounted student loan options for 4k+ undergrad students',
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

    @include('landing-pages.partials._benefits-of-the-deal', [
        "benefits" => [
            "<strong>Lower Rates</strong> (Options available based on lender)",
            "<strong>Longer 9-month grace period</strong><sup class='foot-note-marker'>4</sup>",
            "<strong>No Fees</strong> (No Application, No Origination and No Prepayment Fees)<sup class='foot-note-marker'>5</sup>",
        ]
    ])
@endsection

@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on credit profile.
        Fixed rates range from 3.49% APR (with autopay) to 12.78% APR (excludes 0.25% Auto Pay discount).
        Variable rates range from 1.24% APR (with autopay) to 11.44% APR (excludes 0.25% Auto Pay discount).
        For variable rate loans, although the interest rate will vary after you are approved, the interest rate
        will never exceed 36% (the maximum allowable for these loans). Earnest variable interest rates are based
        on a publicly available index, the one month London Interbank Offered Rate (LIBOR). Your rate will be
        calculated each month by adding a margin between 1.34% and 11.54% to the one month LIBOR. Earnest rate
        ranges are current as of 9/23/2020. Earnest Private Student Loans are not available in Nevada.'
    ])
@endpush
