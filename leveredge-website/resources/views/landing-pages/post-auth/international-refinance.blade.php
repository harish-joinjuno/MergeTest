@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .img-backdrop {
            position:relative;
            box-shadow:100px 50px 0 #ECF3F3;
        }

        h2 > small {
            font-size:16px;
        }

        .progress-ring {
            filter:drop-shadow(10px 10px 5px rgba(0,0,0,.1));
        }

        @php
            // TODO: EDIT THIS PROGRESS VARIABLE TO CHANGE THE CIRCLES PROGRESS
            $progress = 50;
            $circumference = (80 * 2 * pi());
        @endphp

        .progress-ring__circle {
            transition: 0.35s stroke-dashoffset;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
            stroke-dasharray: {{ $circumference}}, {{ $circumference }};
            stroke-dashoffset: {{ $circumference - ($progress / 100) * $circumference }};
        }
    </style>
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
        <div class="container px-0 mb-3 mb-sm-5">
            <div class="col-12 text-center px-lg-5">
                <h1 class="text-primary mb-4 px-lg-5">
                    Grow our negotiating power
                </h1>
                <p class="font-semibold">
                    Help us harness the power of collective bargaining
                </p>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-8 px-lg-5 mb-3 mb-sm-5">
                    <div class="row mb-5">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center
                        position-relative col-12 col-sm-auto mb-5">
                            <svg
                                class="progress-ring text-primary"
                                width="200"
                                height="200"
                            >
                                <circle
                                    stroke="#F0F0F4"
                                    stroke-width="15"
                                    fill="transparent"
                                    r="80"
                                    cx="100"
                                    cy="100"
                                />
                                <circle
                                    class="progress-ring__circle"
                                    stroke="currentColor"
                                    stroke-width="15"
                                    fill="transparent"
                                    r="80"
                                    cx="100"
                                    cy="100"
                                />
                            </svg>

                            <h2
                                class="text-dark position-absolute d-flex flex-column align-items-center
                                justify-content-center px-2"
                                style="height:100%;width:100%;"
                            >
                                {{ $completed_applications }}
                                <br>
                                <small>out of {{ $total_applications }}</small>
                            </h2>
                        </div>
                        <div class="col">
                            <p class="mb-5">The bigger we are, the better our chances.</p>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <a
                                        href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ urlencode(user()->referral_link) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        id="facebookButton"
                                        class="btn btn-sm btn-block text-white px-0"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Share on Facebook"
                                        style="background-color:#445691;"
                                    >
                                        <i class="fab fa-facebook mr-1"></i>
                                        Facebook
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a
                                        href="https://twitter.com/intent/tweet?url={{ urlencode(user()->referral_link) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-sm btn-block text-white px-0"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Share on Twitter"
                                        style="background-color:#64A6E4;"
                                    >
                                        <i class="fab fa-twitter mr-1"></i>
                                        Twitter
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <a
                                        href=""
                                        class="btn btn-sm btn-block text-white px-0"
                                        style="background-color:#01A6FF;"
                                    >
                                        <i class="fab fa-facebook-messenger mr-1"></i>
                                        Messenger
                                    </a>
                                </div>
                                <div class="col-6 mb-3">
                                    <button
                                        id="copyAndShare"
                                        class="btn btn-sm btn-block text-white px-0"
                                        style="background-color:#3F3356;"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Copy the URL"
                                    >
                                        <i class="fas fa-copy mr-1"></i>
                                        Copy &amp; Share
                                    </button>

                                    <input
                                        aria-hidden="true"
                                        class="form-control"
                                        id="copyAndShareInput"
                                        type="text"
                                        value="{{ user()->referral_link }}"
                                        style="position:absolute;top:-9999%;left:-9999%;"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-sm-8 col-lg-4 mb-5 pl-4 position-relative">
                    <img
                        src="{{ asset('/img/friends-smiling-at-laptop.png') }}"
                        alt="Friends Smiling at Laptop"
                        class="img-fluid img-backdrop"
                    >
                    <div
                        class="bg-secondary px-3 px-lg-4 py-4 position-absolute shadow"
                        style="top:-1px;left:-1px;"
                    >
                        <h6 class="font-weight-bold mb-3">
                            Thank you, Paniak Maksym
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
                    'customImg' => asset('/img/how-it-works-block-4.png'),
                    'customDescription' => 'We gather groups of people who want to save money by refinancing their
                    student loans and get lenders to compete for our business.',
                    'stepOne' => 'You answer a few questions about yourself and the student loan you want to refinance',
                    'step2' => 'Once we hit 2,000 people, we get lenders to bid on the exclusive discounts they’ll
                    offer the group',
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
                        <p class="border-bottom pb-4" style="font-weight:600;height:125px;border-color:#8BD3D1;">
                            Aggregate amount our members saved in interests and fees on their loans.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 slide-fade-in mb-5 order-md-3">
                        <h1 class="mb-4">$500k</h1>
                        <p class="border-bottom pb-4" style="font-weight:600;height:125px;border-color:#8BD3D1;">
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
                            As you know, options are currently limited for internationals looking to refinance their student loans (i.e. there are none).
                            <br><br>
                            But, if we gather a large group together, we believe we can help you refinance those loans at much lower rates. We can’t make any promises about the outcome, but the larger we grow the group, the harder it is to ignore.
                            <br><br>
                            We are assembling a large group of international students & alumni who are looking to refinance their student loans in 2021 (or beyond). We will use our combined leverage to get everyone a better refinancing option. The only requirement is that you are currently working and that you reside in the United States. Where you attended school & the denomination the loan is in do not matter. If you are still in school, sign up now and we’ll try to negotiate a deal for when you graduate.
                        </p>
                    </div>
                    <div class="col-12 mb-5">
                        <h4 class="green-underline mb-4">What do you need from me?</h4>
                        <p>
                            We need basic information about your degree, school, terms of your current loan, and employer. We’d also love it if you could help spread the word so that we can bring a more powerful hand at the negotiating table. We need to hit $100M of loans to be refinanced before we can engage lenders. Remember, there’s no commitment and it’s always free.
                            <br><br>
                            We are confident that if we can get enough international students looking to refinance together, we can either get a domestic lender to offer the group a better refinancing option.
                        </p>
                    </div>
                    <div class="col-12 mb-5">
                        <h4 class="green-underline mb-4">Why you should trust us</h4>
                        <p>
                            Our founders Nikhil and Chris started Juno a few years ago when they were shopping around for loans for Harvard Business School.
                            <br><br>
                            They gathered a group of 700 people who needed loans together. Then, they got a dozen lenders to bid on the rates they would offer to members of the group.
                            <br><br>
                            They realized that lenders are willing to offer discounts to large groups that they would not otherwise offer to individuals.
                            <br><br>
                            Since then, Juno has helped over 30,000 members create negotiation pods for various financial products.
                            <br><br>
                            We are thrilled to expand our offering to include international students and to help you get the rates you deserve.
                            <br><br>
                            Since members of the community never pay us, we charge all lenders a set fee that is agreed before the negotiations begin. That way, we can’t be swayed by a larger financial incentive. The only way to win the auction is to offer our community the best rates and terms.

                        </p>
                    </div>
                    <div class="col-12">
                        <h4 class="green-underline mb-4">How this works</h4>
                        <p>
                            Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on the naming rights to a stadium. All those costs get passed along to borrowers in the form of higher interest rates.
                            <br><br>
                            Instead, we pitch lenders an alternative: give our members better rates and avoid spending thousands of dollars per customer on marketing. It saves them time and money, and we end up getting our community better rates for free.
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
                  'img' => asset('/img/together.png'),
                  'title' => 'Together',
                  'text' => 'Invite those you care about and help the negotiation be successful. The larger the group,
                  the better our chances of success. You\'ll also get rewarded for helping the group succeed.',
                  'background' => 'bg-light-green',
                ],
                [
                  'img' => asset('/img/transparent.png'),
                  'title' => 'Transparent',
                  'text' => 'We will keep you informed through the entire process so you can make informed
                  decisions about your financing.',
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
