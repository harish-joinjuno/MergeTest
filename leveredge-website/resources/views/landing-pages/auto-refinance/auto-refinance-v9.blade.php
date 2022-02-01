@extends('landing-pages.landing-page-layout', [
    'pageHeading' => $pageHeading ?? 'Refinance your auto loan <br>and save big',
    'headingColor' => 'text-primary',
    'headingFlavorText' => $headingFlavorText ?? 'Get a group discount through Juno',
    'headingBackgroundImage' => $headingBackgroundImage ?? asset('/img/real-truck.png'),
    'hideBottom' => true,
    'hideForm' => true,
    'hidePressBanner' => true,
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
    <ul class="home-checklist list-unstyled list-inline small text-left mt-5 mb-3 mt-sm-0">
        @foreach($checklist as $item)
            @include('landing-pages.partials.home._checklist-item', ['item' => $item])
        @endforeach
    </ul>

    <a
        href="{{ route('auto_refinance-get_redirect') }}"
        class="btn btn-primary text-white rounded-pill py-2 px-5 mb-3 font-weight-bold shadow
               flashing-button"
    >
        Join the group
    </a>
@endsection

@section('page-body')
    <div class="py-5" aria-hidden="true"></div>
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
        <div class="container-fluid py-5">
            <div class="container text-center mb-5">
                <h2 class="text-primary mb-4">How it works</h2>

                @include('landing-pages.partials._step-timeline', [
                    'steps' => 3,
                    'active' => 4,
                    'numberBackgrounds' => true,
                    'hideStepLabel' => true,
                ])

                <div class="row mb-5">
                    <div class="col-12 col-sm-4 text-center">
                        <h6 class="text-primary font-weight-bold h1-class">Step 1</h6>
                        <p>
                            We gather 1,000 people at a time who want to refinance their auto loans.
                        </p>
                    </div>

                    <div class="col-12 col-sm-4 text-center">
                        <h6 class="text-primary font-weight-bold h1-class">Step 2</h6>
                        <p>
                            Once we hit 1K people, we’ll get banks to bid on the discounts they’ll offer to the group.
                        </p>
                    </div>

                    <div class="col-12 col-sm-4 text-center">
                        <h6 class="text-primary font-weight-bold h1-class">Step 3</h6>
                        <p>
                            We compare offers and make them available to you, for free.
                        </p>
                    </div>
                </div>

                <h4 class="text-primary text-center my-3">
                    We can only negotiate discounts if we get 1,000+ people together
                </h4>
            </div>
        </div>

        <div class="container-fluid bg-light">
            <div class="container narrow py-5 position-relative">
                <h2 class="text-primary text-center mb-4">
                    Live Progress Tracker
                </h2>
                <div class="row justify-content-center">
                    <div class="col-12">
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
                            class="btn btn-primary text-white rounded-pill py-2 px-5 mb-3 font-weight-bold shadow
               flashing-button"
                        >
                            Join the group
                        </a>
                        <p class="small mt-2">
                            <u>All or nothing:</u> We will negotiate a deal if this group reaches 1,000 people
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-5">
            <h2 class="text-primary text-center">Why you should trust us</h2>
        </div>

        <div class="container-fluid py-3 overflow-hidden">
            <div class="container">
                <div class="row align-items-center text-center text-md-left py-5">
                    <div class="col-12 col-md-7 text-center text-md-left pr-md-5">
                        <span class="d-block d-md-none divider"></span>
                        <h2 class="text-primary mb-3">Exceptional Founders</h2>
                        <p>
                            Our founders Nikhil and Chris started Juno a few years ago when they were shopping around for
                            loans for Harvard Business School.
                            <br><br>
                            They gathered a group of 700 people who needed loans together. Then, they got a dozen lenders to bid on the
                            rates they would offer to members of the group.
                            <br><br>
                            They realized that lenders are willing to offer discounts to large groups that they would not otherwise
                            offer to individuals.
                        </p>
                    </div>
                    <div
                        class="col-12 col-md-5 my-5 text-center position-relative"
                    >
                        <img
                            src="{{ asset('/img/real-car2.png') }}"
                            class="img-fluid position-relative"
                            style="z-index:1;"
                        >
                        <img
                            src="{{ asset('/img/background-blob2.png') }}"
                            aria-hidden="true"
                            alt="Background Blob"
                            class="img-fluid position-absolute"
                            style="top:0;right:-10%;z-index:-1;"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-3 overflow-hidden">
            <div class="container">
                <div class="row align-items-center text-center text-md-left py-5">
                    <div
                        class="col-12 col-md-5 my-5 text-center position-relative"
                    >
                        <img
                            src="{{ asset('/img/real-car1.png') }}"
                            class="img-fluid position-relative"
                            style="z-index:1;"
                        >
                        <img
                            src="{{ asset('/img/background-blob1.png') }}"
                            aria-hidden="true"
                            alt="Background Blob"
                            class="img-fluid position-absolute"
                            style="top:-30%;left:-20%;z-index:-1;"
                        >
                    </div>
                    <div class="col-12 col-md-7 text-center text-md-left pl-md-5">
                        <span class="d-block d-md-none divider"></span>
                        <h2 class="text-primary mb-3">Proven Track Record</h2>
                        <p>
                            Since then, Juno has helped over 30,000 members create negotiation pods for various
                            financial products.
                            <br><br>
                            We are thrilled to bring our expertise to the auto loan industry and to help you get
                            the rates you deserve.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-3 overflow-hidden">
            <div class="container">
                <div class="row align-items-center text-center text-md-left py-5">
                    <div class="col-12 col-md-7 text-center text-md-left pr-md-5">
                        <span class="d-block d-md-none divider"></span>
                        <h2 class="text-primary mb-3">Free for you and aligned with your incentives</h2>
                        <p>
                            Since members of the community never pay us, we charge all lenders a set fee that is
                            agreed before the negotiations begin. That way, we can’t be swayed by a larger financial
                            incentive. The only way to win the auction is to offer our community the best rates and
                            terms.
                        </p>
                    </div>
                    <div
                        class="col-12 col-md-5 my-5 text-center position-relative"
                    >
                        <img
                            src="{{ asset('/img/real-car3.png') }}"
                            class="img-fluid position-relative"
                            style="z-index:1;"
                        >
                        <img
                            src="{{ asset('/img/background-blob2.png') }}"
                            aria-hidden="true"
                            alt="Background Blob"
                            class="img-fluid position-absolute"
                            style="top:-40%;left:-20%;z-index:-1;"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-5">
            <div class="container">
                <h2 class="text-primary text-center mb-5">
                    How we save you money
                </h2>

                <div class="row align-items-center">
                    <div
                        class="col-12 col-sm-6 text-center position-relative px-sm-5 my-5"
                    >
                        <img
                            src="{{ asset('/img/friends-at-table2.png') }}"
                            class="img-fluid position-relative"
                            style="z-index:1;"
                        >
                        <img
                            src="{{ asset('/img/background-blob3.png') }}"
                            aria-hidden="true"
                            alt="Background Blob"
                            class="img-fluid position-absolute"
                            style="top:-10%;left:0;z-index:-1;"
                        >
                    </div>

                    <div class="col-12 col-sm-6 text-left">
                        <h4 class="text-primary mb-3">
                            We get that money back to you
                        </h4>
                        <p class="mb-5">
                            Instead, we pitch lenders an alternative: give our members better rates and avoid spending
                            thousands of dollars per customer on marketing. It saves them time and money, and we end up
                            getting our community better rates for free.
                        </p>
                        <h4 class="text-primary mb-3">
                            Lenders spend way too much on marketing
                        </h4>
                        <p>
                            Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on
                            the naming rights to a stadium. All those costs get passed along to borrowers in the form
                            of higher interest rates.
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
