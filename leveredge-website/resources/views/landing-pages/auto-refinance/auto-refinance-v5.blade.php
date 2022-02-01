@extends('landing-pages.landing-page-layout', [
    'pageHeading' => $pageHeading ?? 'We use group buying power to negotiate better auto loan rates.',
    'headingColor' => 'text-primary',
    'headingFlavorText' => $headingFlavorText ?? 'Get a group discount through Juno',
    'headingBackgroundImage' => $headingBackgroundImage ??  '',
    'centerHeading' => true,
    'hideBottom' => true,
    'hideForm' => true,
    'hidePressBanner' => true,
    'customBannerClasses' => 'pb-0',
])

@section('customCTA')
    @php
        $checklist = [
            'Free for you -
            <span
                style="border-bottom:1px dashed #000;"
                data-toggle="tooltip"
                title="We charge lenders a fee that is set at the beginning of the process.
                The only way for a lender to win the auction is to offer the lowest rates to our members."
            >
                How?
            </span>',
            'It takes <1 minute to join',
            'No credit check',
        ];
    @endphp
    <ul class="home-checklist list-unstyled list-inline small text-center mt-5 mt-sm-0">
        @foreach($checklist as $item)
            @include('landing-pages.partials.home._checklist-item', ['item' => $item])
        @endforeach
    </ul>

    <div class="row justify-content-center">
        <div class="col-10 col-sm-12 col-lg-9">
            @include('landing-pages.auto-refinance.partials._refinance-progress-banner', [
                'totalApplications' => $total_applications,
                'completedApplications' => $completed_applications,
                'currentProgress' => $progress,
                'refinanceAmount' => $refinance_amount
            ])
        </div>
        <div class="col-12 text-center">
            <a
                href="{{ route('auto_refinance-get_redirect') }}"
                class="btn btn-secondary rounded-pill py-2 px-5 mb-3 font-weight-bold shadow
                        flashing-button"
            >
                Join the group
            </a>

            <p class="small mt-2">
                <u>All or nothing:</u> We will negotiate a deal if this group reaches 1,000 people
            </p>
        </div>
    </div>
@endsection

@section('page-body')
    <div class="container px-0">
        <img
            class="img-fluid mt-n5"
            src="{{ asset('/img/parked-car-background.png') }}"
            alt="Car Parked infront of building"
        >
    </div>


    @include('landing-pages.partials._tab-nav-items', [
        'tabs' => [
            [
                'title' => 'Campaign',
                'element' => '#campaignTab',
                'selected' => true,
            ],
            [
                'title' => 'FAQs',
                'element' => '#faqsTab',
            ],
            [
                'title' => 'Community',
                'element' => '#communityTab',
            ],
        ],
    ])

    <div
        id="campaignTab"
        aria-labelledby="navTab0"
        role="tabpanel"
        class="container-fluid px-0 tab-content-item"
    >
        <div class="container-fluid bg-light-green py-5">
            <div class="container narrow text-center px-0">
                <h1 class="text-primary mb-5">
                    Why Juno
                </h1>
                <div class="row mb-5">
                    <div class="col-12 col-sm-4 py-3">
                        <h1 class="text-primary">$40M</h1>
                        <p>Aggregate amount our members saved in interests and fees on their loans</p>
                    </div>
                    <div class="col-12 col-sm-4 py-3">
                        <h1 class="text-primary">$500k</h1>
                        <p>Additional cashback distributed to our members</p>
                    </div>
                    <div class="col-12 col-sm-4 py-3">
                        <h1 class="text-primary">30k</h1>
                        <p>Happy members who recommend us to their friends</p>
                    </div>
                </div>
                <p class="font-semibold">
                    We’re the first collective bargaining group for financial products.
                </p>
                <p class="font-semibold">
                    We’ve helped 40,000+ members access over $200M in loans
                    at the lowest costs available.
                </p>
            </div>
        </div>
        <div class="container pt-5">
            <h2 class="text-primary text-center">Why you should trust us</h2>
        </div>

        @include('landing-pages.partials._static-image-text', [
            'h2' => true,
            'image' => asset('/img/chris-nikhil.png'),
            'heading' => 'Exceptional Founders',
            'description' => 'Our founders Nikhil and Chris started Juno a few years ago when they were shopping around for
            loans for Harvard Business School.
            <br><br>
            They gathered a group of 700 people who needed loans together. Then, they got a dozen lenders to bid on the
            rates they would offer to members of the group.
            <br><br>
            They realized that lenders are willing to offer discounts to large groups that they would not otherwise
            offer to individuals.',
            'alignRight' => true,
        ])

        @include('landing-pages.partials._static-image-text', [
            'h2' => true,
            'image' => asset('/img/loans-offered.png'),
            'heading' => 'Proven Track Record',
            'description' => 'Since then, Juno has helped over 30,000 members create negotiation pods for various
            financial products.
            <br><br>
            We are thrilled to bring our expertise to the auto loan industry and to help you get the rates you deserve.',
        ])

        @include('landing-pages.partials._static-image-text', [
            'h2' => true,
            'image' => asset('/img/better-loans.png'),
            'heading' => 'Free for you and aligned with your incentives',
            'description' => 'Since members of the community never pay us, we charge all lenders a set fee that is
            agreed before the negotiations begin. That way, we can’t be swayed by a larger financial incentive. The
            only way to win the auction is to offer our community the best rates and terms.',
            'alignRight' => true,
        ])

        <div class="container-fluid py-5">
            <div class="container">
                <h2 class="text-primary text-center mb-5">
                    How we save you money
                </h2>

                <div class="row">
                    <div class="col-12 col-sm-6 text-center">
                        <div
                            class="d-flex flex-column align-items-center justify-content-center"
                            style="height:200px;"
                        >
                            <img
                                src="{{ asset('/img/hands-on-laptop.png') }}"
                                aria-hidden="true"
                                style="max-width:200px;"
                                class="mb-3"
                            >
                        </div>
                        <h4 class="text-secondary-green mb-3">
                            Lenders spend way too much on marketing
                        </h4>
                        <p class="px-2 px-lg-5">
                            Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on
                            the naming rights to a stadium. All those costs get passed along to borrowers in the form
                            of higher interest rates.
                        </p>
                    </div>

                    <div class="col-12 col-sm-6 text-center">
                        <div
                            class="d-flex flex-column align-items-center justify-content-center"
                            style="height:200px;"
                        >
                            <img
                                src="{{ asset('/img/refinance-with-check.png') }}"
                                aria-hidden="true"
                                style="max-width:175px;"
                                class="mb-3"
                            >
                        </div>
                        <h4 class="text-secondary-green mb-3">
                            We get that money back to you
                        </h4>
                        <p class="px-2 px-lg-5">
                            Instead, we pitch lenders an alternative: give our members better rates and avoid spending
                            thousands of dollars per customer on marketing. It saves them time and money, and we end up
                            getting our community better rates for free.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="container px-0">
                @include('landing-pages.partials.home._how-it-works', [
                    'customImg' => asset('/img/how-it-works-block-5.png'),
                    'customDescription' => 'We gather groups of people who want to save money by refinancing their
                    car loans and get lenders to compete for our business.',
                    'stepOne' => 'You answer a few questions about yourself and the car loan you want to refinance.',
                    'step2' => 'Once we hit 1,000 people, we get lenders to bid on the exclusive discounts they’ll
                    offer the group.',
                    'step3' => 'We share the negotiated deals with you and you can decide to use it or not.
                    <br><br>
                    <strong>There’s no commitment.</strong>',
                    'linkText' => 'JOIN THE GROUP'
                ])
            </div>
        </div>

        @include('landing-pages.partials._got-questions')
    </div>

    <div
        id="faqsTab"
        aria-labelledby="navTab1"
        role="tabpanel"
        class="container-fluid d-none tab-content-item py-5 bg-light-green"
    >
        <div class="my-5" aria-hidden="true"></div>

        @if(!empty($faqs))
            @include('landing-pages.partials._faq-dropdown')
        @endif
    </div>

    <div
        id="communityTab"
        aria-labelledby="navTab3"
        role="tabpanel"
        class="container-fluid px-0 d-none tab-content-item"
    >
        @include('landing-pages.partials._community-section')
    </div>
@endsection
