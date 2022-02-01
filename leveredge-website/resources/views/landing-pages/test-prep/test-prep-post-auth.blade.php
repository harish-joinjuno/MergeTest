@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    @include('landing-pages.partials._slide-fade-observer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyAndShareButton = document.getElementById('copyAndShare');
            const copyAndShareInput = document.getElementById('copyAndShareInput');
            const oldTitle = copyAndShareButton.title;

            copyAndShareButton.addEventListener('click', function() {
                copyAndShareInput.select();
                document.execCommand('copy');
                $(copyAndShareButton)
                    .attr('data-original-title', 'Copied to Clipboard!')
                    .tooltip('show');

                setTimeout(function() {
                    copyAndShareInput.blur();
                    $(copyAndShareButton)
                        .attr('data-original-title', oldTitle)
                        .tooltip('show');
                }, 2500);
            });
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid py-5 bg-light">
        <div class="container px-0 mb-5">
            <div class="col-12 text-center px-lg-5">
                <h1 class="text-primary">
                    We need your help to grow the test prep group
                </h1>
                <p class="font-semibold">
                    The more people who join, the more negotiating power we all have.
                </p>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-4 offset-lg-1 pr-5">
                    <div class="bg-secondary px-3 px-lg-4 py-4 shadow">
                        <h6 class="font-weight-bold mb-3">
                            Thank you, {{optional(user())->first_name}} {{optional(user())->last_name}}
                        </h6>
                        <p class="mb-n2">Nikhil & Chris</p>
                        <p class="mb-0"><small>Founders, Juno</small></p>
                        <svg
                            width="50"
                            height="50"
                            viewBox="0 0 59 59"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="position-absolute"
                            style="top:-20px;left:-20px;"
                        >
                            <path
                                d="M18.8832 27.1934C17.4301 26.7751 15.9769 26.5628 14.5634 26.5628C12.3806 26.5628
                                10.5592 27.0616 9.14692 27.6725C10.5085 22.6879 13.7793 14.0872 20.2949 13.1187C20.8983
                                13.0289 21.3928 12.5926 21.5574 12.0053L22.9814 6.91181C23.1015 6.48106 23.0303 6.01999
                                22.7846 5.64618C22.5389 5.27237 22.1441 5.02295 21.7016 4.9623C21.2207 4.8967 20.7306
                                4.86328 20.2447 4.86328C12.4239 4.86328 4.67858 13.0264 1.41026 24.7148C-0.508277
                                31.5721 -1.07084 41.8815 3.65495 48.3706C6.29944 52.0016 10.1576 53.9406 15.1222
                                54.1343C15.1427 54.1349 15.1625 54.1356 15.1829 54.1356C21.3086 54.1356 26.7405 50.0101
                                28.393 44.104C29.3801 40.5732 28.9339 36.8704 27.1354 33.6751C25.3561 30.5156 22.4257
                                28.2128 18.8832 27.1934Z"
                                fill="#278D87"
                            />
                            <path
                                d="M57.2286 33.6757C55.4493 30.5156 52.5189 28.2128 48.9764 27.1934C47.5232 26.7751
                                46.0701 26.5628 44.6572 26.5628C42.4744 26.5628 40.6524 27.0616 39.2401 27.6725C40.6017
                                22.6879 43.8725 14.0872 50.3887 13.1187C50.9921 13.0289 51.486 12.5926 51.6512
                                12.0053L53.0752 6.91181C53.1953 6.48106 53.1241 6.01999 52.8784 5.64618C52.6334
                                5.27237 52.2385 5.02295 51.7954 4.9623C51.3151 4.8967 50.825 4.86328 50.3385
                                4.86328C42.5177 4.86328 34.7724 13.0264 31.5035 24.7148C29.5855 31.5721 29.023
                                41.8815 33.7494 48.3718C36.3933 52.0023 40.252 53.9419 45.216 54.1349C45.2365
                                54.1356 45.2563 54.1362 45.2773 54.1362C51.4024 54.1362 56.835 50.0107 58.4874
                                44.1046C59.4733 40.5738 59.0264 36.8704 57.2286 33.6757Z"
                                fill="#278D87"
                            />
                        </svg>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <h6>
                        You have {{ $days_to_go }} days to get your friends in on this.
                    </h6>
                    <div class="col-12 rounded-pill mb-3 px-0 shadow" style="background:#B3DAD9;">
                        <div
                            class="h-100 rounded-pill bg-secondary-green py-2"
                            style="width:{{ $progress }}%;"
                        ></div>
                    </div>
                    <p class="small mb-1">
                        {{ $total_applications - $completed_applications }} spots left!
                    </p>
                    <p class="small">
                        Almost 10 million people take the SAT/ACT each year. We only need 1,000 to get affordable test prep for all.
                    </p>
                </div>
            </div>

            @php
                $shareLink = url('/test-prep/college-test-prep/?grow=' . user()->referral_code);
            @endphp

            <div class="row mt-5">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="row">
                        <div class="col-4">
                            <a
                                href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ urlencode($shareLink) }}"
                                class="btn btn-block text-white"
                                style="background-color:#445691;"
                            >
                                Facebook
                            </a>
                        </div>
                        <div class="col-4">
                            <a
                                href="https://twitter.com/intent/tweet?url={{ urlencode($shareLink) }}"
                                class="btn btn-block text-white"
                                style="background-color:#64A6E4;"
                            >
                                Twitter
                            </a>
                        </div>
                        <div class="col-4">
                            <button
                                id="copyAndShare"
                                href=""
                                class="btn btn-block text-white"
                                style="background-color:#3F3356;"
                            >
                                Copy &amp; Share
                            </button>

                            <input
                                aria-hidden="true"
                                class="form-control"
                                id="copyAndShareInput"
                                type="text"
                                value="{{ $shareLink }}"
                                style="position:absolute;top:-9999%;left:-9999%;"
                                readonly
                            >
                        </div>
                    </div>
                    <p class="text-center mt-5 mb-0">
                        All or nothing: We will negotiate a deal if this group reaches 1,000 people
                    </p>
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
                    'customImg' => asset('/img/how-it-works-sat-act.png'),
                    'customDescription' => 'We gather groups of students who are taking the SAT/ACT and get top
                    test prep companies to give us bulk discounts',
                    'stepOne' => 'Tell us a little bit about yourself and what you are looking for from a test
                    prep company.',
                    'step2' => 'Once we hit 1,000 people, we get well-known test prep companies to bid on
                    the exclusive discounts they’ll offer the group',
                    'step3' => 'We share the negotiated deals with you and you can decide to use it or not.
                    <br><br>
                    <strong>There’s no commitment.</strong>',
                    'linkText' => 'JOIN THE GROUP',
                    'hideJoin' => true,
                ])
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
