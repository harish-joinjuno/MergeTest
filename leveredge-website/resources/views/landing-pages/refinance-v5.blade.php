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

    <header class="container-fluid pt-5">
        <div
            class="container banner px-0 mt-5"
            style="background:url({{ asset('/img/students-both-sides-bg.png') }}) bottom center / contain no-repeat;z-index:2;position:relative;"
        >
            <div class="col-12 col-lg-8 offset-lg-2 text-center px-0">
                <h1 class="off-black mb-5 text-center">
                    How we got the best refinance options for 2021
                </h1>

                @include('landing-pages.partials.home._home-cta', [
                    'description' => 'Read our 3-minute analysis and explainer below'
                ])
            </div>
        </div>
    </header>

    @include('landing-pages.partials._video-dialog', [
        'youtubeId' => 'DrYh28mYFjE',
    ])

    @include('landing-pages.partials._press-banner')

    <div class="container-fluid bg-light py-5">
        <div class="container narrow px-0 my-5">
            <div class="row">
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Summary (TL;DR)</h4>
                    <p>
                        There’s no one size fits all for student loan refinance – that’s why it’s important to shop
                        around and see your options. Most of our picks allow you to see rates with a soft credit check,
                        so you can shop around without affecting your credit score.
                        <br><br>
                        For those in select cities who meet the requirements, we think First Republic’s Personal Line
                        of Credit may be the best option, and feature the lowest fixed rates we offer starting at
                        2.25%<sup class="foot-note-marker">*</sup>. For medical professionals, Laurel Road is
                        currently offering a .25%<sup class="foot-note-marker">*</sup> rate discount that may
                        make a substantial difference. For everyone else, Earnest and Splash are worth comparing to
                        see who can get you the best rates.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Why you should trust us</h4>
                    <p>
                        Our founders Nikhil and Chris started Juno a few years ago when they were shopping around
                        for loans for Harvard Business School. Since then, they’ve been immersed in the student loan
                        industry, regularly speaking with key players nationwide.
                        <br><br>
                        This year, we ran an auction, making all the lenders offer the best rates to our community.
                        In the process, we pored over dozens of rate tables, and stayed up all night crunching
                        spreadsheets to map out which lenders offered the most people the best rates.
                        <br><br>
                        Since members of the community never pay us, we charge all lenders a set fee that is
                        agreed before the negotiations begin. That way, we can’t be swayed by a larger financial
                        incentive. The only way to win the auction is to offer our community the best rate.
                    </p>
                </div>

                <div class="col-12 col-lg-8 offset-lg-2 p-0 d-flex flex-column justify-content-center mb-5">
                    <div
                        class="img-box video-box"
                        style="background:url({{ asset('/img/video-thumbnail-matt.jpg') }}) no-repeat center/cover;"
                        role="button"
                        tabindex="0"
                        data-toggle="modal"
                        data-target="#videoModal"
                    >
                        <div class="absolute-center p-5 bg-black text-center">
                            <span
                                class="d-inline-block play-button rounded-circle cursor-pointer"
                            >
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0
                                        37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"
                                    ></path>
                                </svg>
                            </span>
                        </div>
                    </div>
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
                    <h4 class="green-underline mb-4">Who is refinancing for?</h4>
                    <p>
                        Refinancing is great for people with high interest student loans, especially private. Right
                        now, those with federally held student loans aren’t incurring any interest until at least October
                        1st, 2021. As a result, borrowers of those loans are largely waiting until then before
                        considering refinancing.
                        <br><br>
                        For private loan borrowers, there’s little downside associated with refinance, and a large
                        potential upside in terms of savings, and reducing your monthly payment.
                        <br><br>
                        That said, you should always consult a financial advisor before taking any action. This
                        article is not intended to be financial advice, and we urge you to do your own research
                        independently.
                    </p>
                </div>

                @include('landing-pages.partials._email-collection-section')

                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Best For Most - Earnest</h4>
                    <p>
                        Earnest is owned by Navient, one of the largest student loan providers in America. While
                        they operate as a separate unit, they have the backing and security of an established lender.
                        Out of all our options, they also offer loans to the most people (along with Splash).
                        <br><br>
                        We like Earnest because it’s possible to get the most cash back by refinancing with them – up
                        to $1,000 total<sup class="foot-note-marker">*</sup>. They also have low rates, and a product that analyzes your risk based off a
                        variety of factors (called merit-based lending).
                        <br><br>
                        Still, you may want to compare Earnest and Splash to see who offers you the best rates and
                        cash back combination, especially since both let you view custom rates without a hard credit
                        check.
                        <br><br>
                        <strong>Rates:</strong> Fixed starting at 2.98%<sup class="foot-note-marker">*</sup>
                        APR, Variable at 1.99%<sup class="foot-note-marker">*</sup> APR
                        <br>
                        <strong>Cashback:</strong> Up to $1,000 via Juno and Earnest<sup class="foot-note-marker">*</sup>
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Alternative Best for Most - Splash</h4>
                    <p>
                        Splash is not a lender, but a marketplace for lenders. By trying their service, you’ll be
                        able to get quotes from a few different lenders, further helping you identify the best rates
                        available.
                        <br><br>
                        In comparison to Earnest, their starting rates are a bit lower, but the potential cash back
                        is also lower. If you’re shopping around these are both factors to consider depending on loan
                        amount and your preferences.
                        <br><br>
                        <strong>Rates:</strong> Fixed starting at 2.98%<sup class="foot-note-marker">*</sup>
                        APR, Variable starting at 1.89%<sup class="foot-note-marker">*</sup> APR
                        <br>
                        <strong>Cashback:</strong> Up to $600 via Juno and Splash with loans above
                        $50,000<sup class="foot-note-marker">*</sup>
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Best for Medical Professionals - Laurel Road</h4>
                    <p>
                        Laurel Road has some perks for medical professionals that make it our choice for physicians,
                        dentists, nurses, optometrists, and physician assistants.
                        <br><br>
                        As a Juno member, Laurel Road will offer you a rate reduction of
                        0.25%<sup class="foot-note-marker">*</sup>. In addition, you may be able to pay back your
                        medical school loans at only $100 per month while in residency or
                        fellowship.<sup class="foot-note-marker">*</sup>
                        <br><br>
                        <strong>Rates:</strong> Fixed starting at 2.75%<sup class="foot-note-marker">*</sup>
                        APR, Variable starting at 1.74%<sup class="foot-note-marker">*</sup> APR
                        <br>
                        <strong>Benefit:</strong> Rate reduction of .25%<sup class="foot-note-marker">*</sup>
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">Best Fixed Rates for those in Select Areas - First Republic</h4>
                    <p>
                        First Republic is interesting – they don’t do student loan refinancing specifically, but their
                        offering does allow you to pay off your student debt with a personal line of credit. Beginning
                        at 2.25%<sup class="foot-note-marker">*</sup>, they have the most conditions for
                        getting the best rate.
                        <br><br>
                        In order to get the best rates, you’ll need to maintain a minimum of
                        20%<sup class="foot-note-marker">*</sup> of your approved loan amount in a First Republic ATM
                        Rebate Checking account. You’re still free to hold less, and get good rates, and our site
                        will walk you through the various options.
                        <br><br>
                        Also note that a personal line of credit is not a student loan and you may be permanently
                        giving up the benefits of a student loan such as certain deferment, forbearance, and
                        forgiveness options.
                        <br><br>
                        That said, a Personal Line of Credit also allows you the flexibility to refinance additional
                        debt – such as auto loans – and can provide access to credit for future expenses.
                        <br><br>
                        <strong>Rates:</strong> Fixed rates starting at 2.25%<sup class="foot-note-marker">*</sup>
                        <br>
                        <strong>Cashback:</strong> Up to $800<sup class="foot-note-marker">*</sup>
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">What happens when you refinance?</h4>
                    <p>
                        Usually after people refinance a loan, we hear <em>“why was that so easy?”</em> The truth is that the
                        process is fairly straightforward.
                        <br><br>
                        On a basic level, you’re taking out a new loan to pay off your old loan.
                        <br><br>
                        Since you’re employed and are perceived as ‘less risky’, your new loan ideally has a lower
                        interest rate, saving you money in the long run.
                    </p>
                </div>
                <div class="col-12 mb-5">
                    <h4 class="green-underline mb-4">What about Parent PLUS loans?</h4>
                    <p>
                        All of our partners allow you to refinance Parent PLUS loans. Depending on the partner, it
                        may be possible to refinance the loan into your child’s name.
                        <br><br>
                        <strong class="mr-2">×</strong> With Earnest, you can only refinance loans already in your name. The original lender may
                        be able to transfer the loan from the parent to you, and then Earnest can refinance in your
                        name.
                        <br><br>
                        <strong class="mr-2">✓</strong> With Splash, you can apply to refinance a Parent PLUS loan into the student’s name, as
                        long as they have a credit score of 700+, a debt to income ratio below 40%, a bachelor's
                        degree, and a job making at least 25k a year (co-signer) and 42k a year (solo).
                        <br><br>
                        <strong class="mr-2">✓</strong> Laurel Road does allow you to refinance a Parent PLUS directly into your name.
                        <br><br>
                        <strong class="mr-2">✓</strong> First Republic can accomplish this goal through their Personal Line of Credit option as well.
                    </p>
                </div>
                <div class="col-12">
                    <h4 class="green-underline mb-4">Hear from a member!</h4>
                    <p>
                        <em>
                            “I was with Sallie Mae and my interest rate was 10.75%, but i refinanced with Earnest
                            through [Juno] and not only got my rate down to almost 4%, but I also got $1000 cash.
                            <br><br>
                            I got paid. To save money.
                            <br><br>
                            So make sure as soon as you graduate and get your first paystub to refi. It's super easy and
                            literally takes under 10 minutes, the hardest part is typing in how much you have saved in
                            all our accounts to prove assets as well as entering your social.
                            <br><br>
                            Their system literally automates all the hard parts out of it. Not everyone will save as
                            much as me because I'm kind of an extreme case.
                            <br><br>
                            I refinanced 170k at 10.75%V to 4.04%F, cutting my monthly payment from $2800 to $1250.
                            This is totally free and you can still write off payments on your taxes. Hope this helps
                            someone...
                            <br><br>
                            Of course, make sure you do plenty of research and ask tons of questions to the lender
                            before you refinance any debt.
                            <br><br>
                            I applied for refi literally everywhere and this was the best deal by like 1.2% and was
                            much easier to fill out the app than at other places.”
                            <br><br>
                        </em>
                        - Josh C.
                    </p>
                </div>
            </div>
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

    @push('custom-disclaimers')
        <p class="text-footer-disclaimer mt-5"><strong>Earnest Disclosures</strong></p>
        <p class="text-footer-disclaimer">
            Loan Cost Examples: These examples provide estimates based on payments beginning immediately upon
            loan disbursement. Variable APR: A $10,000 loan with a 20-year term (240 monthly payments of $75)
            and a 6.48% APR would result in a total estimated payment amount of $17,865.51. For a variable loan,
            after your starting rate is set, your rate will then vary with the market. Fixed APR: A $10,000 loan
            with a 20-year term (240 monthly payments of $75) and a 6.48% APR would result in a total estimated
            payment amount of $17,865.51. Your actual repayment terms may vary.
        </p>

        <p class="text-footer-disclaimer">
            Actual rate and available repayment terms will vary based on your credit profile. Fixed rates range
            from 2.98% APR (with autopay) to 5.79% APR (excludes 0.25% Auto Pay discount). Variable rates range
            from 1.99% APR (with autopay) to 5.64% APR (excludes 0.25% Auto Pay discount). For variable rate loans,
            although the interest rate will vary after you are approved, the interest rate will never exceed 8.95%
            if your loan term is 10 years or less. For loan terms of more than 10 years to 15 years, the interest
            rate will never exceed 9.95%. For loan terms over 15 years, the interest rate will never exceed 11.95%.
            Earnest variable interest rate student loan refinance loans are based on a publicly available index, the
            one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by adding a
            margin between 2.09% and 5.74% to the one month LIBOR. Earnest rate ranges are current as of 9/23/2020.
            Please note, Earnest is not able to offer variable rate loans in AK, IL, MN, NH, OH, TN, and TX.
        </p>

        <p class="text-footer-disclaimer">
            You can take advantage of the Auto Pay interest rate reduction by setting up and maintaining
            active and automatic ACH withdrawal of your loan payment. The interest rate reduction for Auto
            Pay will be available only while your loan is enrolled in Auto Pay. Interest rate incentives for
            utilizing Auto Pay may not be combined with certain private student loan repayment programs that
            also offer an interest rate reduction. For multi-party loans, only one party may enroll in Auto Pay.
        </p>

        <p class="text-footer-disclaimer">
            Earnest does not charge fees for origination, late payments, or prepayments. Florida Stamp Tax:
            For Florida residents, Florida documentary stamp tax is required by law, calculated as $0.35 for
            each $100 (or portion thereof) of the principal loan amount, the amount of which is provided in
            the Final Disclosure. Lender will add the stamp tax to the principal loan amount. The full amount
            will be paid directly to the Florida Department of Revenue. Certificate of Registration No.
            78-8016373916-1.
        </p>

        <p class="text-footer-disclaimer">
            Disclaimers: Product name, logo, brands, and other trademarks featured or referred to within LeverEdge
            / Juno are the property of their respective trademark holders. Please consult a licensed financial
            professional before making any financial decisions. This site is not endorsed or affiliated with
            the U.S. Department of Education.
        </p>

        <p class="text-footer-disclaimer">
            Earnest Loans are made by Earnest Operations LLC or One American Bank, Member FDIC. Earnest Operations
            LLC, NMLS #1204917, 303 2nd St. Suite 401N, San Francisco, CA 94107. Visit earnest.com/licenses
            for a full list of licensed states. One American Bank, 515 S. Minnesota Ave, Sioux Falls, SD 57104.
            Earnest loans are serviced by Earnest Operations LLC with support from Navient Solutions LLC
            (NMLS #212430). One American Bank and Earnest LLC and its subsidiaries are not sponsored by or
            agencies of the United States of America. © 2020 Earnest LLC. All rights reserved.
        </p>

        <p class="text-footer-disclaimer mt-5"><strong>Laurel Road Disclosures</strong></p>
        <p class="text-footer-disclaimer">
            ** Please note that you may or may not be eligible for interest deduction depending on your
            individual tax situation. Please consult your tax advisor for more information.
        </p>

        <p class="text-footer-disclaimer">
            <a
                href="{{ url('/img/laurel-road-refi-disclosure-for-100-per-month.png') }}"
                target="_blank"
                rel="noreferrer noopener"
            >
                See disclosures related to Laurel Road here.
            </a>
        </p>

        <p class="text-footer-disclaimer">
            Juno receives a fee when you take a loan from any of our partner lenders or a lender on a
            partner's marketplace.
        </p>

        <p class="text-footer-disclaimer">
            The 0.25% interest rate discount is for LeverEdge members employed as a Physician, Dentist, Nurse
            or Physician Assistant at time of application. The rate discount will end if LeverEdge notifies
            Laurel Road that borrower is no longer in good standing.
        </p>

        <p class="text-footer-disclaimer">
            The discount will not reduce the monthly payment; instead, the discount is applied to the principal
            to help pay the loan down faster.  The discount cannot be combined with other offers, except any
            discount for making automatic payments.
        </p>

        <p class="text-footer-disclaimer">
            Checking your rate with Laurel Road only requires a soft credit pull, which will not affect
            your credit score. To proceed with an application, a hard credit pull will be required, which
            may affect your credit score.
        </p>

        <p class="text-footer-disclaimer">
            Laurel Road is a brand of KeyBank N.A. Member FDIC.
        </p>

        <p class="text-footer-disclaimer mt-5"><strong>First Republic Disclosures</strong></p>
        <p class="text-footer-disclaimer">
            Disclaimers: Product name, logo, brands, and other trademarks featured or referred to within Juno
            are the property of their respective trademark holders. Please consult a licensed financial
            professional before making any financial decisions. This site is not endorsed or affiliated with
            the U.S. Department of Education.
        </p>

        <p class="text-footer-disclaimer">
            Juno Rewards are payable after Juno receives a referral fee for referring you to one of our partners
            and is contingent on our partner paying us the fee. The exact timing can differ depending on the
            partner. It is typically in the month subsequent to the month in which your loan is disbursed.
            The reward will be sent to you via Digital Check or Amazon Gift Card based on your preference.
            Any additional bonus from our partners will be credited separately.
        </p>

        <p class="text-footer-disclaimer">
          Personal Line of Credit consists of a two-year, interest-only, revolving draw period followed by a
          fully amortizing repayment period of the remainder of the term. Draws are not permitted during the
          repayment period. This product can only be used for personal, family or household purposes.
          It cannot be used for the following (among other prohibitions): to refinance or pay any First
          Republic loans or lines of credit, to purchase securities or investment products (including margin
          stock), for speculative purposes, for business or commercial uses, or for the direct payment of
          post-secondary educational expenses. This product cannot be used to pay off credit card debt at origination. The terms of this product may differ from terms of your current
          loan(s) that are being paid off, including but not limited to student loans. By repaying such loans,
          you may permanently be giving up tax and repayment benefits, including forbearance, deferment and
          forgiveness, and you may not be able to reobtain such benefits if this loan is refinanced with
          another lender in the future. Contact your legal, tax and financial advisors for advice on deciding
          whether this is the right product for you. Terms and conditions apply. Product is not available
          in all markets. For a complete list of locations, visit the locations page. Applicants must meet
          a First Republic banker to open account. This is not a commitment to lend; all lending is subject
          to First Republic’s underwriting standards. Applicants should discuss line of credit terms,
          conditions and account details with their banker.
        </p>

        <p class="text-footer-disclaimer">
          $400 First Republic offer is extended only to Personal Line of Credit clients who are new to First Republic,
          located within the First Republic footprint and use the First Republic referral link on the LeverEdge Association website to access the Personal Line of Credit calculator. For a
          list of locations, please visit firstrepublic.com/locations. To qualify for the offer, your loan
          application must be received by First Republic between 1/1/2021 and  3/31/2021, and booked. $400 will be
          credited in your ATM Rebate Checking account once the loan has been approved and booked. $400 bonus is
          reportable for tax purposes in the year credited. Limited one bonus per new client. Offer is nontransferable,
          cannot be combined with other offers and is subject to change without notice. The $400 bonus from Juno will
          be credited separately.
        </p>

        <p class="text-footer-disclaimer">
            Annual Percentage Rate. Rates effective as of 6/15/2020 and are subject to change. Borrower must
            open a First Republic ATM Rebate Checking account (“Account”). Terms and conditions apply to the
            Account. If the Account is closed, the rate will increase by 5.00%. Rates shown include
            relationship-based pricing adjustments of: 1) 2.00% for maintaining automatic payments and direct
            deposit with the Account, 2) 0.50% for depositing and maintaining a deposit balance of at least 10%
            of the approved loan amount into the Account, and 3) an additional 0.25% for depositing and maintaining
            a deposit balance of at least 20% of the approved loan amount into the Account.
        </p>

        <p class="text-footer-disclaimer">
            Eligibility and rates offered will depend on your credit profile and other factors. Rates in the above
            table include a 0.25% discount for making automatic payments from a bank account. Variable APRs are
            subject to increase after consummation.
        </p>
    @endpush

    @include('template._footer')
@endsection
