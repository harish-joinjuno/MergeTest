@extends('landing-pages.landing-page-layout', [
    'pageHeading' => $pageHeading ?? 'We negotiated a deal for the best refinance options.',
    'headingFlavorText' => $headingFlavorText ?? 'Through collective bargaining we’ve been able to give more than
    $502,121 to our members.',
    'callToActionURL' => $callToActionURL ?? '/register',
    'headingBackgroundImage' => $headingBackgroundImage ??  '/assets/images/pink-balloon.png',
])

@section('page-body')
    @if(!empty($rates))
        @include('landing-pages.partials._rates-table', [
            'title' => $rates->title,
            'description' => $rates->description,
            'ctaLink' => $rates->cta_link,
            'ctaText' => $rates->cta_text,
            'rates' => $rates,
            'termTitle' => $rates->term_title,
            'aprTitle' => $rates->apr_title
        ])
    @endif

    @yield('pre-medical')

    @include('landing-pages.partials._leveredge-medical-benefits')

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
            "<strong>Lower Rates</strong> (Options available based on lender)",
            "<strong>Up to $1000 Cash Back</strong> (Options available based on lender)",
            "<strong>No Fees</strong> (No Application, No Origination and No Prepayment Fees)<sup class='foot-note-marker'>5</sup>",
        ]
    ])

    @include('landing-pages.partials._email-collection-toast')
@endsection

@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on your credit profile.
        Fixed rates range from 2.98% APR (with autopay) to 5.79% APR (excludes 0.25% Auto Pay discount). Variable
        rates range from 1.99% APR (with autopay) to 5.64% APR (excludes 0.25% Auto Pay discount). For variable rate
        loans, although the interest rate will vary after you are approved, the interest rate will never exceed
        8.95% if your loan term is 10 years or less. For loan terms of more than 10 years to 15 years, the interest
        rate will never exceed 9.95%. For loan terms over 15 years, the interest rate will never exceed 11.95%.
        Earnest variable interest rate student loan refinance loans are based on a publicly available index,
        the one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by adding a
        margin between 2.09% and 5.74% to the one month LIBOR. Earnest rate ranges are current as of 9/23/2020.
        Please note, Earnest is not able to offer variable rate loans in AK, IL, MN, NH, OH, TN, and TX.'
    ])
@endpush
