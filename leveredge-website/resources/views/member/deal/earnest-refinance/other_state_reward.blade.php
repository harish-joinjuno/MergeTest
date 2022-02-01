<div class="card lender-summary-card h-100 border-primary border-width-4">
    <div class="card-header bg-white">
        <h2 class="off-black text-center mb-3">Refinance with Earnest</h2>
        <h6 class="text-center">Fixed rates starting at 2.98% APR<sup class="foot-note-marker">2, 3</sup></h6>
        <h6 class="text-center">Variable rates starting at 1.99% APR<sup class="foot-note-marker">2, 3</sup></h6>
    </div>

    <div class="card-body">
        <p><i class="primary fad fa-check pr-2"></i>
            Checking your rates through this partner doesn’t impact your credit score and should take less than 2 minutes.
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            New Earnest customers receive 0.5% of the loan amount you refinance as cash back when you go through
            Juno.<sup class="foot-note-marker">6</sup>
        </p>
    </div>
    <div class="card-footer text-center bg-white">
        @php
            $dealSlug = \App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_OTHER_STATES_SLUG;
        @endphp
        <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/' . $dealSlug ) }}" class="btn btn-block-below-md btn-outline-primary mb-2 mb-md-0">View details</a>
        <a target="_blank" href="{{ url('/member/deal/'.$dealSlug.'/hand-off') }}" class="btn btn-block-below-md btn-primary">Check my rate</a>

    </div>
</div>

@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on your credit profile.
        Fixed rates range from 2.98% APR (with autopay) to 5.79% APR (excludes 0.25% Auto Pay discount). Variable
        rates range from 1.99% APR (with autopay) to 5.64% APR (excludes 0.25% Auto Pay discount). For variable rate
        loans, although the interest rate will vary after you are approved, the interest rate will never exceed
        8.95% if your loan term is 10 years or less. For loan terms of more than 10 years to 15 years, the interest
        rate will never exceed 9.95%. For loan terms over 15 years, the interest rate will never exceed 11.95%.
        Earnest variable interest rate student loan refinance loans are based on a publicly available index,
        the one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by adding a
        margin between 2.09% and 5.74% to the one month LIBOR. Earnest rate ranges are current as of 9/23/2020.
        Please note, Earnest is not able to offer variable rate loans in AK, IL, MN, NH, OH, TN, and TX.'
    ])
    <p class="text-footer-disclaimer">
        7 - Terms and conditions apply. To qualify for this signup bonus offer: 1) you must be a new customer;
        2) you must submit a completed student loan refinancing application through https://joinjuno.com; and
        3) you must provide a valid email address and a valid checking account number during the application process;
        and 4) your loan must be fully disbursed. Bonus will be automatically transmitted to your checking account
        after the final disbursement. Limit one bonus per borrower. This offer is not valid with any other bonus
        offers received. Earnest bonus not available for residents of Michigan, Kentucky, or Massachusetts.
    </p>
@endpush
