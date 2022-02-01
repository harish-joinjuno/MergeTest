@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
@endpush

@section('content')
    <div class="container-fluid py-5">
        <div class="container my-5 text-center">
            <h1>Studying for the SAT?</h1>
            <p>Get a Group Discount on Test Prep.</p>
            @php
                $checklist = [
                    'It takes <1 minute to join',
                ];
            @endphp
            <ul class="home-checklist list-unstyled list-inline small text-center mt-5 mt-sm-0">
                @foreach($checklist as $item)
                    @include('landing-pages.partials.home._checklist-item', ['item' => $item])
                @endforeach
            </ul>
        </div>
        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-12 col-lg-9">
                    <div class="row py-3">
                        <div class="col-12 col-sm-6 text-center py-3">
                            <h2 class="off-black">
                                <small>{{ $total_applications - $completed_applications }} spots left!</small>
                            </h2>
                            <div
                                class="col-8 col-sm-10 offset-2 offset-sm-1 rounded-pill px-0"
                                style="background:#F0F0F4;"
                            >
                                <div
                                    class="h-100 rounded-pill bg-secondary-green py-1"
                                    style="width:{{  min($progress, 100) }}%;"
                                ></div>
                            </div>
                            <div class="col-8 col-sm-10 offset-2 offset-sm-1 px-0 mt-1">
                                <p
                                    class="text-left text-muted"
                                    style="font-size:10px;">
                                    0 <span class="float-right text-right">{{ $total_applications ?? '0' }} people</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 text-center py-3">
                            <h2 class="off-black mb-0">
                                {{ $days_to_go }}
                            </h2>
                            <p class="small mb-0">days to go</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div
                class="justify-content-center"
            >
                <form action="/question-flow/{{ $questionPage->questionFlow->slug }}/{{ $questionPage->slug }}" method="post">
                    @csrf
                    @include('question-page.version-1.embed', ['question-page' => $questionPage])
                </form>
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
        ],
    ])

    <div
        id="campaignTab"
        aria-labelledby="navTab0"
        role="tabpanel"
        class="container-fluid px-0 tab-content-item"
    >
        <div class="container-fluid px-0 bg-light py-5">
            <div class="container text-center my-5">
                <h5>
                    Thanks to <span class="text-secondary-green">{{ $completed_applications }}</span> people,
                    the price is now <span class="text-secondary-green">${{ $goals[$currentGoalIndex]['price'] }}</span>.
                </h5>
                @if($currentGoalIndex < count($goals) - 1)
                <h5>
                    When we reach
                    <span class="text-secondary-green">{{ $goals[$currentGoalIndex + 1]['min'] }} people</span>,
                    the price will be lowered to
                    <span class="text-secondary-green">
                        ${{ $goals[$currentGoalIndex + 1]['price'] }}
                    </span>
                    for everyone.
                </h5>
                @endif
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    @include('landing-pages.partials._price-progress-slider', [
                        'progressPercent' => ($currentGoalIndex / (count($goals) - 1)) * 100,
                        'goals' => $goals,
                        'currentGoalIndex' => $currentGoalIndex,
                    ])
                </div>
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="container px-0">
                <div class="container-fluid">
                    <div class="container py-5 mt-5">
                        <div class="row">
                            <div class="col-12 col-sm-4 mb-4">
                                <h4 class="underlined d-inline-block">How it Works</h4>
                            </div>
                            <div class="col-12 col-sm-8 mb-4">
                                <h2>
                                    We gather groups of students who are taking the SAT/ACT and get top test prep
                                    companies to give us bulk discounts
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                src="{{ asset('img/auction-paddles-and-hammer.png') }}"
                                aria-hidden="true"
                                style="max-width:200px;"
                                class="mb-3"
                            >
                        </div>
                        <h6 class="text-secondary-green mb-3 h1-class">
                            Test prep companies spend way too much on marketing
                        </h6>
                        <p class="px-2 px-lg-5">
                            Regional sales reps, student reps, gift card incentives, and paid advertisement
                            costs add up. All those costs get passed along to students in the form of higher course
                            prices.
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
                        <h6 class="text-secondary-green mb-3 h1-class">
                            We get that money back to you
                        </h6>
                        <p class="px-2 px-lg-5">
                            Instead, we offer test prep providers an alternative: give our members cheaper courses
                            and avoid spending hundreds of dollars per customer on marketing. It saves them time and
                            money, and we end up getting our community lower prices for free.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mb-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col col-5">
                        <img
                            src="{{ asset('/img/students-on-bench-in-park.png') }}"
                            alt="Students on a bench in a park"
                            class="img-fluid"
                        >
                    </div>
                    <div class="col col-7 pl-lg-5">
                        <h2 class="text-primary mb-5">Why you should trust us</h2>
                        <h6 class="font-weight-bold">We’re committed to saving students money</h6>
                        <p>
                            Our founders Nikhil and Chris started Juno a few years ago when they were shopping
                            around for loans for Harvard Business School.
                        </p>
                        <p>
                            They gathered a group of 700 people who needed loans together. Then, they got a dozen
                            lenders to bid on the rates they would offer to members of the group.
                        </p>
                        <p>
                            They realized that lenders are willing to offer discounts to large groups that they
                            would not otherwise offer to individuals.
                        </p>
                        <h6 class="font-weight-bold">And now, they’re doing the same for test prep!</h6>
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
                  'text' => 'Signing up is free and takes less than 2 minutes. We don’t need any money from you and there is no commitment.',
                  'background' => 'bg-light-green',
                ],
                [
                  'img' => asset('/img/better-loans.png'),
                  'title' => 'Better Test Prep',
                  'text' => 'We promise not to make any money unless we are able to save you money. We’ll work very hard to maximize your savings.',
                  'background' => 'bg-light',
                ],
                [
                  'img' => asset('img/students-on-bench-better.png'),
                  'title' => 'Together',
                  'text' => 'Invite those you care about and help the negotiation be successful. The larger the group, the better our chances of success. Get rewarded for helping the group succeed.',
                  'background' => 'bg-light-green',
                ],
                [
                  'img' => asset('/img/transparent.png'),
                  'title' => 'Transparent',
                  'text' => 'We will keep you informed through the entire process so you can make informed decisions about your test prep options.',
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
@endsection
