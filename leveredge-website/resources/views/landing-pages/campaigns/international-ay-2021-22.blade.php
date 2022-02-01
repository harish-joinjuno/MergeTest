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

        .bg-circle {
            position: relative;
            display:inline-block;
            z-index:1;
        }

        .bg-circle:after {
            content: '';
            position:absolute;
            top:50%;
            left:-5px;
            transform:translateY(-50%);
            height:74px;
            width:74px;
            border-radius:37px;
            background:#FFE1E7;
            z-index:-1;
        }

        @php
            $circumference = (80 * 2 * pi());
        @endphp

        .progress-ring__circle {
            transition: 0.35s stroke-dashoffset;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
            stroke-dasharray: {{ $circumference}}, {{ $circumference }};
            stroke-dashoffset: {{ $circumference - (min($progress, 100) / 100) * $circumference }};
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
                    Help friends save on student loans too!
                </h1>
                <p class="font-semibold">
                    Share far and wide to get everyone to the finish line.
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
                                <small>out of 10000</small>
                            </h2>
                        </div>
                        <div class="col">
                            <h4 class="mb-3">
                                We have {{$days_to_go}} days left to grow the group.
                            </h4>
                            <p class="mb-5">The bigger we are, the better the deal.</p>

                            @php
                                $facebookShareMessage = 'Hey everyone, wanted to share an opportunity to save us all some money on student loans for free: an organization called Juno will go negotiate with banks and lenders to get an exclusive deal for everyone in the group. It’s no commitment, no obligation, and they’ve done this successfully three times already. The more people we have in the group the better the deal will be. Add your name here:';
                                $twitterShareMessage = 'If anyone is looking to save money on student loans, consider joining the Juno group for free so they can negotiate a deal on everyone’s behalf:';
                            @endphp

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <a
                                        href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ urlencode(user()->referral_link) }}&quote={{ urlencode($facebookShareMessage) }}"
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
                                        href="https://twitter.com/intent/tweet?text={{ urlencode($twitterShareMessage) }}&url={{ urlencode(user()->referral_link) }}"
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
                'title' => 'Updates',
                'element' => '#updatesTab',
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
                @include('landing-pages.partials.home._how-it-works',['stepOne' => 'Sign up for free and tell us a little bit about yourself and the type of student loan you need.'])
            </div>
        </div>

        <div class="container-fluid bg-light-green py-5">
            <div
                class="container narrow bg-white text-center shadow py-5 px-4 px-sm-5 position-relative"
                style="border-radius:5px 5px 5px 35px;"
            >
                <h2 class="text-secondary-green mb-5">
                    Summary (TL;DR)
                </h2>

                <p>
                    This campaign has a singular goal:
                    <span class="text-secondary-green">to get you the most affordable student loans possible.</span>
                    We do this by leveraging group buying power. International students who may need loans for
                    Fall 2021 and/or Spring 2022 join the campaign by sharing some basic information about themselves.
                </p>
                <p>
                    We know that international students have limited options when it comes to student loans.
                    That’s why we’re so committed to doing whatever we can to negotiate an exclusive deal for our
                    international members next academic year.
                </p>
                <p>
                    The more people we have in the group, the more likely we’ll be successful. Once we have
                    enough voices behind our effort (typically a group of people needing ~$100M of loans), we
                    approach all the lenders who lend to international students and ask them to submit a “bid”.
                    The bid helps us evaluate which lender is offering the most affordable loans. We are also
                    exploring various ways to create a loan option for international students with lenders who
                    do not typically lend to internationals.
                </p>
                <p class="mb-5">
                    This campaign is
                    <span class="text-secondary-green">no obligation and no commitment</span>. By joining you are not
                    committed to using the loan we negotiate. You have simply indicated interest and a willingness
                    to consider the option we negotiate if you decide you need a private student loan for the
                    upcoming academic year.
                </p>

                <img
                    src="{{ asset('/assets/images/Peel.png') }}"
                    aria-hidden="true"
                    style="position:absolute;bottom:-1px;left:-1px;"
                    class="img-fluid"
                >
            </div>
        </div>

        <div class="container-fluid px-0">
            <div class="container text-center py-5">
                <h2 class="off-black text-center bg-circle mb-5">
                    $100,000,000
                </h2>

                <h2>
                    Group Discount, Individualized Rates
                </h2>
                <p class="mb-5">
                    Even though we negotiate as a group, each person in the group gets their own rate based on
                    their own credit profile and similar factors. While lenders are free to propose any structure,
                    the bids we’ve received historically, offer an equal discount to all members. For example, all
                    members may get 1% lower rate than what they would have gotten if they applied to the lender by
                    themselves.
                </p>

                <div class="text-left">
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'Why do we do this?',
                        'content' => 'The main reason for preferring this structure over a single rate for the entire group is to ensure the group remains attractive for all borrowers, regardless of their credit profile. For example, if we didn’t do this, someone with an excellent credit score is unlikely to join a group because they would assume most people in the group have a lower credit score than their own.',
                    ])
                    <div class="row border-bottom mb-5"></div>
                </div>

                <img
                    src="{{ asset('/img/free_badge.png') }}"
                    alt="Free and No Commitment"
                    style="max-width:175px;"
                    class="mb-4"
                >
                <h2>
                    Free and No Commitment
                </h2>
                <p class="mb-5">
                    Even though we negotiate as a group, each person in the group gets their own rate based on
                    their own credit profile and similar factors. While lenders are free to propose any structure,
                    the bids we’ve received historically, offer an equal discount to all members. For example, all
                    members may get 1% lower rate than what they would have gotten if they applied to the lender by
                    themselves.
                </p>

                <img
                    src="{{ asset('/img/percent_badge.png') }}"
                    alt="Aligned Incentives"
                    style="max-width:175px;"
                    class="mb-4"
                >
                <h2>
                    Aligned Incentives
                </h2>
                <p>
                    Whenever something is free, you have to wonder how the business makes money and if their
                    incentives are aligned with your goals. We’ve built our processes to ensure that is true.
                </p>
                <p>
                    We make money by charging lenders a percentage of the loan amount borrowed by this group.
                    Therefore, we don’t get paid unless you decide that this is the best option for you and decide
                    to use it for your loans.
                </p>
                <p class="mb-5">
                    To further ensure our incentives are aligned with yours, we set the fee up front when we contact
                    the lenders and invite them to bid to win our collective business. This way, lenders can’t sway
                    our decision with higher fees. The winning option is chosen solely based on who we believe will
                    provide the most affordable loans to you.
                </p>

                <img
                    src="{{ asset('/img/timeline-clock.png') }}"
                    alt="Aligned Incentives"
                    style="max-width:175px;"
                    class="mb-4"
                >
                <h2>
                    Timeline
                </h2>
                <p>
                    We’ve set up the timeline based on 3 years of experience working with students, families,
                    financial aid offices and lenders. This schedule allows us to demonstrate the power of the group
                    while balancing the time needed for each lender to make a thoughtful proposal.
                </p>
            </div>
        </div>

        @include('landing-pages.partials._numbered-static-image-text', [
            'number' => '01',
            'heading' => 'Phase One: Grow the Group',
            'text' => 'During this phase, we reach out to our community to gauge their interest in joining the group.
            Most members who’ve taken a loan through the group deal re-join and help spread the word.
            <br><br>
            In addition to this, we work with partners like financial aid offices, student groups, high school
            guidance counselors and networks of financial planners to further boost awareness of our group’s existence.
            <br><br>
            Finally, we spend a small amount on Facebook ads and other paid marketing channels to help further grow
            the group. Our marketing budget is a fraction of the budget lenders spend and we are counting on the
            members of our community to help grow the group. The most important thing to do during this phase is to
            grow the size of the group as large as possible.',
            'image' => asset('/img/students-standing-around.png'),
            'imageRight' => true,
            'bgColor' => 'bg-light-green',
        ])

        @include('landing-pages.partials._numbered-static-image-text', [
            'number' => '02',
            'heading' => 'Phase Two: Negotiation',
            'text' => 'During this phase, we continue our emphasis on growing the group. However, we have a more
            intense focus on starting the bidding process with lenders. We get NDA agreements in place, share a
            Request for Bids / Request for Proposals with each of the lenders. We meet with them and answer their
            questions.
            <br><br>
            We will keep you posted as we make progress. We’ll let you know how many lenders have agreed to
            participate and our opinions about their interest. We are aware that the timeline for international
            students is tighter due to the visa application process, and will be sure to work with you to meet
            your needs.',
            'image' => asset('/img/hands-on-laptop-with-coffee.png'),
        ])

        @include('landing-pages.partials._numbered-static-image-text', [
            'number' => '03',
            'heading' => 'Phase Three: Iron Out the Details',
            'text' => 'Should we reach a deal with a lender, we will work through the details. This typically
            involves lawyers going through legal documents, the lender inspecting our data security and privacy
            practices, our own due diligence of the lender’s claims (testing their customer service wait times,
            testing their web interface etc).
            <br><br>
            We’ll keep you informed as we get through everything here.',
            'image' => asset('/img/loans-offered.png'),
            'imageRight' => true,
            'bgColor' => 'bg-light-green',
        ])

        @include('landing-pages.partials._numbered-static-image-text', [
            'number' => '04',
            'heading' => 'Phase Four: Loans Available!',
            'text' => 'Finally! You’ll be able to submit an application to the lender through our special link.
            The lender will evaluate your application (often instantly) and show you the rates you can expect.
            You can shop around and check out other lenders as well to determine if we’ve actually negotiated the
            best deal for you. We’d love for you to post your thoughts in the chat section so others in the community
            can learn more.',
            'image' => asset('/img/refinance-with-check.png'),
        ])

        <div class="container-fluid bg-light-green pt-5">
            <div class="container">
                <h4 class="underlined text-center my-5">Why Juno?</h4>
                <p class="mb-5 text-center">
                    We’re the first collective bargaining group for financial products. We’ve helped 40,000+ members
                    access over $200M in loans at the lowest costs available.
                </p>
                <div class="row">
                    <div class="col-12 col-sm-4 slide-fade-in mb-5 text-center text-sm-right">
                        <h2 class="mb-4">$40M</h2>
                        <p class="mb-5">
                            Aggregate amount our members saved in interests and fees on their loans.
                        </p>
                        <h2 class="mb-4">Our Track Record</h2>
                        <p>
                            Juno is the only startup that has successfully negotiated discounts for student loans on
                            behalf of large groups of students. We’ve helped students and families borrow more
                            than $200M at discounted rates. Additionally, our cash back deals have given more than
                            $502,121 back to our members. Over 30,000 members have trusted Juno to negotiate more
                            affordable student loans for them.
                        </p>
                    </div>
                    <div class="col-12 col-sm-4 py-4 mb-5 text-center">
                        <img
                            src="{{ asset('/img/coins-falling-into-vault.png') }}"
                            class="img-fluid"
                            alt="Coins Falling into Vault">
                    </div>
                    <div class="col-12 col-sm-4 slide-fade-in mb-5 order-md-3 text-center text-sm-left">
                        <h2 class="mb-4">$500k</h2>
                        <p class="mb-5">
                            Additional cashback distributed to our members.
                        </p>
                        <h2 class="mb-4">We understand your perspective</h2>
                        <p>
                            Juno was founded by Chris and Nikhil during their graduate studies at Harvard. They
                            each have over $100K in debt and started Juno to help reduce the interest rate they and
                            their classmates had to pay on their debt. Now, Juno has expanded to cover all title IV
                            universities in the United States.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-5">
            <div class="container my-5">
                <h1>
                    Am I Eligible?
                </h1>
                <p>
                    International students pursuing any degree in the United States are eligible to join our
                    negotiation group, no Social Security Number, co-signer, or U.S. address required. However,
                    if you do have a U.S. Citizen/Permanent Resident co-signer and SSN, you may be eligible for
                    our student loan deals for domestic students. We will keep everyone updated on those
                    eligibility requirements, as they vary from lender to lender.
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
        id="updatesTab"
        aria-labelledby="navTab3"
        role="tabpanel"
        class="container-fluid px-0 d-none tab-content-item"
    >
        <div class="container py-5">
            <p>
                Check back for updates on the negotiation process!
            </p>
        </div>
    </div>
@endsection
