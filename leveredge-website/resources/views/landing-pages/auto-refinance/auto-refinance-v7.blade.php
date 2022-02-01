@extends('landing-pages.landing-page-layout', [
    'pageHeading' => $pageHeading ?? 'Refinance your auto loan and save big',
    'headingColor' => 'text-primary',
    'headingFlavorText' => $headingFlavorText ?? 'Get a group discount through Juno',
    'headingBackgroundImage' => $headingBackgroundImage ??  '',
    'centerHeading' => true,
    'hideBottom' => true,
    'hideForm' => true,
    'hidePressBanner' => true,
    'customBannerClasses' => 'pb-0',
])

@push('header-scripts')
    <style>
        .number-background {
            position:relative;
        }
        .number-background:after {
            position: absolute;
            top: 0;
            left:0;
            font-family:sans-serif;
            font-size:72px;
            line-height:1em;
            font-weight:900;
            transform:translate(-50%, -40%);
            z-index:0;
            opacity:.1;
        }

        .number-background:after {
            content: attr(data-number);
        }
    </style>
@endpush

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


        <div class="container my-5">
            <div class="row">
                <div class="col-xs-12 col-sm-6 text-right">
                    <div class="col text-center px-0">
                        <img
                            aria-hidden="true"
                            src="{{ asset('/img/students-on-bench-better.png') }}"
                            alt="File folder with cheque"
                            class="img-fluid"
                        >
                    </div>
                </div>
                @php
                    $trustQuestions = [
                        [
                            'question' => 'Exceptional Founders',
                            'answer' => 'Our founders Nikhil and Chris started Juno a few years ago when they were
                            shopping around for loans for Harvard Business School.
                            <br><br>
                            They gathered a group of 700 people who needed loans together. Then, they got a dozen
                            lenders to bid on the rates they would offer to members of the group.
                            <br><br>
                            They realized that lenders are willing to offer discounts to large groups that they would
                            not otherwise offer to individuals.',
                        ],
                        [
                            'question' => 'Proven Track Record',
                            'answer' => 'Since then, Juno has helped over 30,000 members create negotiation pods
                            for various financial products.
                            <br><br>
                            We are thrilled to bring our expertise to the auto loan industry and to help you get the
                            rates you deserve.',
                        ],
                        [
                            'question' => 'Free for you and aligned with your incentives',
                            'answer' => 'Since members of the community never pay us, we charge all lenders a set fee
                            that is agreed before the negotiations begin. That way, we can’t be swayed by a larger
                            financial incentive. The only way to win the auction is to offer our community the best
                            rates and terms.',
                        ],
                    ];
                @endphp
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 common-questions mt-5 px-0 px-sm-3">
                        @foreach($trustQuestions as $question)
                            @include('landing-pages.partials._dropdown', [
                                'trigger' => $question['question'],
                                'content' => $question['answer'],
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-5">
            <h2 class="text-primary text-center mb-5">How we save you money</h2>
        </div>

        <div class="container-fluid bg-light-green py-5">
            <div class="container my-lg-5">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4 text-center">
                        <img
                            src="{{ asset('/img/hands-on-laptop.png') }}"
                            alt="Flavor Image"
                            style="max-width:200px;"
                        >
                    </div>
                    <div class="col-12 col-sm-8">
                        <h4
                            class="text-primary number-background"
                            data-number="01"
                        >
                            Lenders spend way too much on marketing
                        </h4>
                        <p>
                            Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on the
                            naming rights to a stadium. All those costs get passed along to borrowers in the form of
                            higher interest rates.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-5">
            <div class="container my-lg-5">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4 text-center order-md-2">
                        <img
                            src="{{ asset('/img/better-loans.png') }}"
                            alt="Flavor Image"
                            style="max-width:200px;"
                        >
                    </div>
                    <div class="col-12 col-sm-8">
                        <h4
                            class="text-primary number-background"
                            data-number="02"
                        >
                            We get that money back to you
                        </h4>
                        <p>
                            Instead, we pitch lenders an alternative: give our members better rates and avoid
                            spending thousands of dollars per customer on marketing. It saves them time and money,
                            and we end up getting our community better rates for free.
                        </p>
                    </div>
                </div>
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
