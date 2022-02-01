@extends('template.base')

@push('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}?ver=1.1" rel="stylesheet" type="text/css">
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('base-content')
    @if(request()->has('utm_source') && request()->get('utm_source') === 'facebook')
        @include('landing-pages.partials._simple-nav')
    @else
        @include('template._main-nav')
    @endif

    <div class="container py-5">
        <div class="row mt-5 py-5">
            <div class="col-12 col-md-8">
                <h1 class="off-black mb-5">
                    Use our deals and save big on your student loans
                </h1>
                <form action="{{ $callToActionURL ?? url('/register') }}" class="pt-3 mb-4">
                    <div class="form-group pr-lg-5">
                        <div class="text-box col-12 px-0">
                            <input
                                type="text"
                                name="email"
                                placeholder="Enter your email"
                                class="bg-light pl-3 pl-lg-5 pr-5"
                            />
                            <div class="input-group-append">
                                <button
                                    type="submit"
                                    class="bg-secondary"
                                >
                                    Access the Deal
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <p>Join for free to get exclusive APR discounts and cash signing bonuses.</p>
            </div>
            <div class="col-12 col-md-4">
                <img
                    src="{{ asset('/img/juno-notebook.png') }}"
                    alt="Juno Notebook"
                    class="img-fluid">
            </div>
        </div>
    </div>

    @include('landing-pages.partials._press-banner')

    @if(!empty($rates))
        @include('landing-pages.partials._rates-table', [
            'title' => $rates->title,
            'description' => $rates->description,
            'ctaLink' => $rates->cta_link,
            'ctaText' => $rates->cta_text,
            'rates' => $rates,
            'termFootNote' => \App\Facades\FootNote::addFootNote(\App\FootNote::EARNEST_SLO_TERM_FOOTNOTE),
            'aprFootNote' => \App\Facades\FootNote::addFootNote(\App\FootNote::EARNEST_SLO_GRAD_APR_FOOTNOTE),
            'autoPayFootNote' => \App\Facades\FootNote::addFootNote(\App\FootNote::EARNEST_SLO_AUTO_PAY_FOOTNOTE)
        ])
    @endif

    <div class="container-fluid py-5 bg-light-green">
        <div class="container my-5">
            <div class="row">
                <div class="col-12 col-sm-6 text-center mb-5">
                    <img src="{{ asset('/img/coins-falling-into-vault.png') }}" class="img-fluid">
                </div>
                <div class="col-12 col-sm-6 mb-5">
                    <h4 class="underlined d-sm-inline-block text-center text-sm-left mb-5">Juno Rewards</h4>
                    <h2 class="mb-5">
                        We give you at least 0.5% of your loan amount back when you use one of your negotiated deals
                    </h2>
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'What are Juno Rewards?',
                        'content' => 'Most partners who work with us pass along a referral fee when you take a loan.
                        Rather keep all of that to ourselves, we’re giving you a bonus using those funds. This is
                        separate from our existing referral bonuses and any additional discounts we’ve negotiated.',
                    ])
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'How are the rewards calculated?',
                        'content' => 'We’re giving you at least 0.5% of the loan you take using your special Juno
                        link. So if you take out a loan for $60,000, you’re going to get a check for at least $300.
                        No strings attached.',
                    ])
                    @include('landing-pages.partials._dropdown', [
                        'trigger' => 'When will I receive Juno rewards?',
                        'content' => 'You’ll receive your Juno Reward once the partner confirms that Juno will be
                        paid for referring you to them. Typically, this happens a few days after when the loan amount
                        gets sent by the lender to the school. The exact date should be in your final loan documents.',
                    ])
                    <a href="{{ url('leveredge-rewards/terms') }}" class="mb-5 d-block">
                        You can find all the details here.
                    </a>

                    <a href="{{ url('/2020rewardsprogram') }}" class="btn btn-primary">
                        Request Your Reward
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light py-5">
        <div class="container narrow px-0 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Benefits of joining Juno</h4>
                    <p>
                        Join us for free to access exclusive discounts that save you more money than if you went to
                        our partner directly, from rate discounts and/or cash back on student loans!
                        <br><br>
                        We negotiate exclusive deals with our lending partners. Some of our deals feature interest
                        rate discounts while some feature up to 1% cash back, or both. (What does cash back mean?
                        Think of it like a signing bonus – when you sign with one of our partners, you get paid.)
                        Either way, you'll save money, and you won’t get these deals anywhere else.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Why you should trust us</h4>
                    <p>
                        We started Juno a few years ago when we were shopping around for loans for Harvard Business
                        School. Since then, we’ve been immersed in the student loan industry, regularly speaking
                        with key players nationwide.
                        <br><br>
                        This year, we ran an auction, making all the lenders offer the best rates to our community.
                        In the process, we pored over dozens of rate tables, and stayed up all night crunching
                        spreadsheets to map out which lenders offered the most people the best rates.
                        <br><br>
                        Since our members never pay us, we charge all the lenders a set fee that is agreed before
                        the negotiations begin. That way, we can’t be swayed by a larger financial incentive.
                        The only way to win the auction is to offer our community the best rate.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Our Track Record</h4>
                    <p>
                        Juno is the only organization that has successfully negotiated discounts for student loans
                        on behalf of large groups of students. We’ve helped students and families borrow more than
                        $200M at discounted rates. Additionally, our cash back deals have given more than $502,121
                        back to our members. Over 40,000 members have trusted Juno to negotiate more affordable
                        student loans for them.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">By the numbers</h4>
                    <ul>
                        <li class="mb-2">
                            40,000+ members
                        </li>
                        <li class="mb-2">
                            $502,121+ in cash back earned by our community in 2020
                        </li>
                        <li class="mb-2">
                            $26,000,000+ in savings compared to federal rates
                        </li>
                    </ul>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">How we save you money</h4>
                    <p>
                        Lenders spend so much money on marketing. This year, SoFi spent 400 million dollars on the
                        naming rights to a stadium. All those costs get passed along to borrowers in the form of
                        higher interest rates.
                        <br><br>
                        Instead, we pitch lenders an alternative: give our members better rates and avoid spending
                        thousands of dollars per customer on marketing. It saves them time and money, and we end up
                        getting our community better rates for free.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Who this is for?</h4>
                    <p>
                        We currently have multiple deals with cash back and/or rate discounts for graduate students.
                        Our deals can be used to save you money in lieu of or in addition to federal loans– you
                        can easily compare your options against the federal rates and see how much you can save with
                        our comprehensive calculator.
                        <br><br>
                        If you’re an international student, we are continuing our efforts to negotiate better student
                        loan options for you. For now, we have a student health insurance deal for international
                        students that can save you thousands.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Do I need a co-signer? What does that mean?</h4>
                    <p>
                        A co-signer is a person who is obligated to pay back the loan if you, the student, cannot
                        make your payments. The co-signer can be a spouse, relative, parent or any adult that
                        is a U.S. Citizen or Permanent Resident.
                        <br><br>
                        Co-signers are generally not required for graduate students with established credit, but
                        many of our members have found dramatic savings when they provide a co-signer.
                        <br><br>
                        For international students as well as DACA recipients and Conditional Permanent Residents,
                        having a U.S. Citizen/Permanent Resident co-signer may make you eligible for a loan with a
                        U.S. lender. Policies and requirements vary by lender.
                    </p>
                </div>
                <div class="col-12">
                    <h4 class="green-underline mb-4">Hear from a member!</h4>
                    <p class="mb-4">
                        <em>
                            “Juno made the loan shopping process infinitely easier than if I had to source loan
                            quotes on my own. I was able to quickly compare and select the appropriate loan for my needs.”
                            <br>
                        </em>
                        - Josh C.
                    </p>
                    <p class="mb-4">
                        <em>
                            “It seems like your interests are aligned with ours, rather than the lenders.”
                            <br>
                        </em>
                        -  Yale SOM ‘21
                    </p>
                    <p class="mb-4">
                        <em>
                            “I really feel it helped me find a better deal and save money.”
                            <br>
                        </em>
                        -  Duke ‘22
                    </p>
                </div>
            </div>
        </div>
    </div>

    @include('landing-pages.partials._benefits-of-the-deal', [
        "benefits" => [
            "<strong>Lower Rates</strong> (Options available based on lender)",
            "<strong>Longer 9-month grace period</strong><sup class='foot-note-marker'>".\App\Facades\FootNote::addFootNote(\App\FootNote::EARNEST_SLO_GRACE_PERIOD_FOOTNOTE)."</sup>",
            "<strong>No Fees</strong> (No Application, No Origination and No Prepayment Fees)<sup class='foot-note-marker'>".\App\Facades\FootNote::addFootNote(\App\FootNote::EARNEST_SLO_NO_FEES_FOOTNOTE)."</sup>",
        ]
    ])

    <div class="container-fluid bg-light-green py-5">
        <div class="container narrow bg-white faq my-5">
            <div class="row">
                <div class="col-12 p-5">
                    <h5 class="font-weight-bold text-center">FAQs</h5>
                </div>
            </div>

            @foreach($faqs as $faq)
                @include('landing-pages.partials._dropdown', [
                    'trigger' => $faq['question'],
                    'content' => $faq['answer'],
                ])
            @endforeach
        </div>
    </div>

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


    @include('template._footer')
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
