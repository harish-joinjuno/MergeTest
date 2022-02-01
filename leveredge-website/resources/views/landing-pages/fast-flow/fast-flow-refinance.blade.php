@extends('template.public')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-8 col-lg-4">
                <h2 class="text-center off-black">
                    Unlock the best cash back refinancing deals on the market.
                </h2>
                <p class="text-center">
                    We used collective bargaining to get you more money in your pocket at no cost to you
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light py-5">
        <div class="container narrow px-0 my-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="col-12 bg-white py-3 rounded text-center h-100">
                        <h4 class="py-2">
                            $1000 cash back*
                        </h4>
                        <hr>
                        <ul class="list-unstyled">
                            <li class="py-3">
                                <strong>Fixed Rates:</strong>
                                <br>
                                starting at 2.98% APR
                            </li>
                            <li class="py-3">
                                <strong>Variable Rates:</strong>
                                <br>
                                starting at 1.99% APR
                            </li>
                            <li class="py-3">
                                <strong>Lender:</strong>
                                <br>
                                Earnest
                            </li>
                        </ul>
                        <a
                            href="{{ url('/register') }}"
                            class="btn btn-secondary rounded-pill py-2 px-5 font-weight-bold mb-2"
                        >
                            Unlock The Deal
                        </a>
                        <p class="small mb-3"><strong>Free to unlock.</strong></p>
                        <p class="small">
                            *excludes residents of MI, MA, KY. If this is applicable, you can register
                            as Juno member for free for an alternative reward. New customers only, see terms.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="col-12 bg-white py-3 rounded text-center h-100">
                        <h4 class="py-2">
                            $600 cash back*
                        </h4>
                        <hr>
                        <ul class="list-unstyled">
                            <li class="py-3">
                                <strong>Fixed Rates:</strong>
                                <br>
                                starting at 2.88% APR
                            </li>
                            <li class="py-3">
                                <strong>Variable Rates:</strong>
                                <br>
                                starting at 1.98% APR
                            </li>
                            <li class="py-3">
                                <strong>Lender:</strong>
                                <br>
                                Splash
                            </li>
                        </ul>
                        <a
                            href="{{ url('/register') }}"
                            class="btn btn-secondary rounded-pill py-2 px-5 font-weight-bold mb-2"
                        >
                            Unlock The Deal
                        </a>
                        <p class="small mb-3"><strong>Free to unlock.</strong></p>
                        <p class="small">
                            *must refinance more than $50,000. New customers only, terms and conditions apply.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('landing-pages.fast-flow.partials._trust-elements', [
        'hideHeader' => true,
    ])

    <div class="container narrow py-5">
        <h4 class="underlined text-center mb-5">
            Disclaimers
        </h4>
        <p class="small">
            Earnest Loans are made by Earnest Operations LLC or One American Bank, Member FDIC. Earnest Operations
            LLC, NMLS #1204917, 303 2nd St. Suite 401N, San Francisco, CA 94107. Visit earnest.com/licenses for a full
            list of licensed states. One American Bank, 515 S. Minnesota Ave, Sioux Falls, SD 57104. Earnest loans are
            serviced by Earnest Operations LLC with support from Navient Solutions LLC (NMLS #212430). One American
            Bank and Earnest LLC and its subsidiaries are not sponsored by or agencies of the United States of America.
            © 2020 Earnest LLC. All rights reserved.
            <br>
            <br>
            Loan fees: Earnest does not charge fees for origination, late payments, or prepayments. Florida Stamp Tax:
            For Florida residents, Florida documentary stamp tax is required by law, calculated as $0.35 for each $100
            (or portion thereof) of the principal loan amount, the amount of which is provided in the Final Disclosure.
            Lender will add the stamp tax to the principal loan amount. The full amount will be paid directly to the
            Florida Department of Revenue. Certificate of Registration No. 78-8016373916-1.
            <br>
            <br>
            The rates displayed may include a 0.25% autopay discount.
            <br>
            <br>
            Terms and Conditions apply. Splash reserves the right to modify or discontinue products and benefits at
            any time without notice. Rates and terms are also subject to change at any time without notice. Offers are
            subject to credit approval. To qualify, a borrower must be a U.S. citizen or permanent resident in an
            eligible state and meet applicable underwriting requirements. Not all borrowers receive the lowest rate.
            Lowest rates are reserved for the highest qualified borrowers. If approved, your actual rate will be
            within a range of rates and will depend on a variety of factors, including term of loan, a responsible
            financial history, income and other factors. Refinancing or consolidating private and federal student
            loans may not be the right decision for everyone. Federal loans carry special benefits not available
            for loans made through Splash Financial, for example, public service loan forgiveness and economic
            hardship programs, fee waivers and rebates on the principal, which may not be accessible to you after
            you refinance.
            <br>
            <br>
            The information you provide to us is an inquiry to determine whether we or our lenders can make a loan
            offer that meets your needs. If we or any of our lending partners has an available loan offer for you,
            you will be invited to submit a loan application to the lender for its review. We do not guarantee that
            you will receive any loan offers or that your loan application will be approved. Offers are subject to
            credit approval and are available only to U.S. citizens or permanent residents who meet applicable
            underwriting requirements. Not all borrowers will receive the lowest rates, which are available to
            the most qualified borrowers. Participating lenders, rates and terms are subject to change at any
            time without notice.
            <br>
            <br>
            Terms and conditions apply. To qualify for this signup bonus offer:
            1) you must be a new customer;
            2) you must submit a completed student loan refinancing application through https://joinjuno.com; and
            3) you must provide a valid email address and a valid checking account number during the application
            process; and
            4) your loan must be fully disbursed. Bonus will be automatically transmitted to your checking account
            after the final disbursement. Limit one bonus per borrower. This offer is not valid with any other bonus
            offers received. Earnest bonus not available for residents of Michigan, Kentucky, or Massachusetts.
            <br>
            <br>
            Juno receives a fee when you take a loan from any of our partner lenders or a lender on a partner's marketplace.
        </p>
    </div>
@endsection
