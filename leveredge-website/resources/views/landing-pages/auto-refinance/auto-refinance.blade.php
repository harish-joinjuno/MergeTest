@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
@endpush

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="container narrow px-0 mb-5">
            <div class="col-12 text-center px-lg-5">
                <h1 class="off-black mb-5 px-lg-5">
                    Refinance your auto loan and <span class="text-secondary-green">save big</span>
                </h1>
                <p class="font-semibold">
                    Get a group discount through Juno.
                </p>
            </div>
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
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 px-lg-5 order-md-2 mb-5">
                    <h5 class="mb-3">
                        <i class="fas fa-users text-secondary-green"></i>
                        {{$completed_applications}} out of {{$total_applications}} have signed up
                    </h5>

                    <div class="col-12 rounded-pill mb-3 mb-lg-5 px-0 shadow" style="background:#B3DAD9;">
                        <div
                            class="h-100 rounded-pill bg-secondary-green py-2"
                            style="width:{{ $progress > 100 ? 100 : $progress }}%;"
                        ></div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-0 font-weight-bold">${{$refinance_amount}}</h5>
                            <p class="mb-3">To be refinanced</p>
                        </div>
                    </div>

                    <a
                        href="{{ route('auto_refinance-get_redirect') }}"
                        class="btn btn-secondary rounded-pill py-2 px-5 mb-3 font-weight-bold shadow
                        flashing-button"
                    >
                        Join the group
                    </a>

                    <p>
                        <small>
                            <u>All or nothing:</u> We will negotiate a deal if this group reaches 1,000 people
                        </small>
                    </p>
                </div>
                <div class="col-12 col-md-5 mb-5">
                    <img
                        src="{{ asset('/img/car-blue.png') }}"
                        alt="Car Travelling"
                        class="img-fluid"
                    >
                </div>
            </div>
        </div>
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

        <div class="container-fluid bg-light-green pt-5">
            <div class="container narrow text-center">
                <h4 class="underlined text-center my-5">Why Juno?</h4>
                <p class="mb-5">
                    We’re the first collective bargaining group for financial products. We’ve helped 40,000+ members
                    access over $200M in loans at the lowest costs available.
                </p>
                <div class="row">
                    <div class="col-12 col-sm-4 slide-fade-in mb-5">
                        <h1 class="mb-4">$40M</h1>
                        <p style="font-weight:600;">
                            Aggregate amount our members saved in interests and fees on their loans.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 slide-fade-in mb-5 order-md-3">
                        <h1 class="mb-4">$500k</h1>
                        <p style="font-weight:600;">
                            Additional cashback distributed to our members.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 order-md-2">
                        <img
                            src="{{ asset('/img/coins-falling-into-vault.png') }}"
                            class="img-fluid"
                            alt="Coins Falling into Vault">
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-light py-5">
            <div class="container narrow px-0 my-5">
                <div class="row">
                    <div class="col-12 mb-5">
                        <h4 class="green-underline mb-4">Summary (TL;DR)</h4>
                        <p>
                            There’s no one size fits all for auto loans  – that’s why it’s important to shop around
                            and see your options. We help you get access to group discounts you wouldn’t be able to
                            get on your own, at no cost to you.
                        </p>
                    </div>
                    <div class="col-12 mb-5">
                        <h4 class="green-underline mb-4">Why you should trust us</h4>
                        <p>
                            Our founders Nikhil and Chris started Juno a few years ago when they were shopping
                            around for loans for Harvard Business School.
                            <br><br>
                            They gathered a group of 700 people who needed loans together. Then, they got a dozen
                            lenders to bid on the rates they would offer to members of the group.
                            <br><br>
                            They realized that lenders are willing to offer discounts to large groups that they
                            would not otherwise offer to individuals.
                            <br><br>
                            Since then, Juno has helped over 30,000 members create negotiation pods for various
                            financial products.
                            <br><br>
                            We are thrilled to bring our expertise to the auto loan industry and to help you get
                            the rates you deserve.
                            <br><br>
                            Since members of the community never pay us, we charge all lenders a set fee that is
                            agreed before the negotiations begin. That way, we can’t be swayed by a larger
                            financial incentive. The only way to win the auction is to offer our community
                            the best rates and terms.
                        </p>
                    </div>
                    <div class="col-12">
                        <h4 class="green-underline mb-4">How we save you money</h4>
                        <p>
                            Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars
                            on the naming rights to a stadium. All those costs get passed along to borrowers in
                            the form of higher interest rates.
                            <br><br>
                            Instead, we pitch lenders an alternative: give our members better rates and avoid
                            spending thousands of dollars per customer on marketing. It saves them time and money,
                            and we end up getting our community better rates for free.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @include('landing-pages.partials.home._why-juno', [
            'hideWhyJuno' => true,
            'staticSections' => [
                [
                  'img' => asset('/img/hands-on-laptop.png'),
                  'title' => 'Free, Fast and Easy',
                  'text' => 'Signing up is free and takes less than 1 minute. We don’t run a credit check and don’t need your
                  social security number.',
                  'background' => 'bg-light-green',
                ],
                [
                  'img' => asset('/img/better-loans.png'),
                  'title' => 'Better Loans',
                  'text' => 'Months of research and the competitive process ensure that our members get the best
                  rates in the market and you’re always free to compare yourself!',
                  'background' => 'bg-light',
                ],
                [
                  'img' => asset('/img/hands-on-laptop.png'),
                  'title' => 'Together',
                  'text' => 'Invite those you care about and help the negotiation be successful. The larger the group,
                  the better our chances of success. You\'ll also get rewarded for helping the group succeed.',
                  'background' => 'bg-light-green',
                ],
                [
                  'img' => asset('/img/transparent.png'),
                  'title' => 'Transparent',
                  'text' => 'We will keep you informed through the entire process so you can make informed
                  decisions about your auto financing.',
                  'background' => 'bg-light',
                ],
            ]
        ])

        <div class="container-fluid py-5">
            <div class="container narrow text-center my-5">
                <svg
                    width="54"
                    height="54"
                    viewBox="0 0 54 54"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="mb-4"
                >
                    <path d="M27 0C12.09 0 0 12.09 0 27C0 41.91 12.09 54 27 54C41.91 54 54 41.91 54 27C54 12.09 41.91 0
                27 0ZM32.74 43.83L27 43.84V43.82V43.84C27 43.84 21.39 44.5 18.34 41.45C15.29 38.4 15.95 32.79 15.95
                32.79C15.95 32.79 21.56 32.13 24.61 35.18C26.29 36.86 26.85 39.32 27 41.19V37.96H27.01C27.17 34.58
                30.31 31.98 33.87 32.76C35.96 33.21 37.64 34.9 38.09 36.99C38.86 40.58 36.18 43.75 32.74 43.83ZM38.22
                27C38.22 30.1 35.71 32.61 32.61 32.61C29.51 32.61 27 30.1 27 27C27 23.9 29.51 21.39 32.61 21.39C29.51
                21.39 27 18.88 27 15.78C27 14.81 27.25 13.9 27.68 13.11C28.63 11.36 30.48 10.17 32.61 10.17C34.74
                10.17 36.59 11.36 37.54 13.11C37.97 13.91 38.22 14.82 38.22 15.78C38.22 18.88 35.71 21.39 32.61
                21.39C35.71 21.39 38.22 23.9 38.22 27Z" fill="#444444"/>
                </svg>

                <h4 class="off-black mb-2">Got questions?</h4>
                <p>
                    Drop us a line at
                    <a
                        href="mailto:hello@joinjuno.com?subject=Question+About+Juno"
                        target="_blank">
                        hello@joinjuno.com.
                    </a>
                </p>
            </div>
        </div>
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
