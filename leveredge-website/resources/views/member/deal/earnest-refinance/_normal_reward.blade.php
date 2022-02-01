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
            New Earnest customers receive cash back based on the amount you refinance when you go through Juno.<sup class="foot-note-marker">6</sup>
        </p>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered text-center table-striped mb-0 small">
            <thead>
            <tr class="row mx-0">
                <th class="col-3 d-flex flex-col justify-content-center align-items-center px-0">
                    Loan Amount
                </th>
                <th class="col-3 d-flex flex-col justify-content-center align-items-center text-center px-0">
                    Earnest<br>Reward<sup class="foot-note-marker">6</sup>
                </th>
                <th class="col-3 d-flex flex-col justify-content-center align-items-center text-center px-0">
                    Juno<br>Reward
                </th>
                <th class="col-3 d-flex flex-col justify-content-center align-items-center text-center px-0">
                    Total
                </th>
            </tr>
            </thead>

            <tbody>
            <tr class="row mx-0">
                <td class="col-3">Up to $75K</td>
                <td class="col-3 text-center">$500</td>
                <td class="col-3 text-center">$0</td>
                <td class="col-3 text-center">$500</td>
            </tr>

            <tr class="row mx-0">
                <td class="col-3">$75K to 100K</td>
                <td class="col-3 text-center">$500</td>
                <td class="col-3 text-center">$250</td>
                <td class="col-3 text-center">$750</td>
            </tr>

            <tr class="row mx-0">
                <td class="col-3">Above $100K</td>
                <td class="col-3 text-center">$500</td>
                <td class="col-3 text-center">$500</td>
                <td class="col-3 text-center">$1000</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center bg-white">
        @php
            $dealSlug = \App\Deal::DEAL_EARNEST_REFINANCE_WITH_REWARDS_20_SLUG;
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
        6 - Earnest Welcome Bonus Offer Disclosure: Terms and conditions apply. To qualify for this Earnest Welcome
        Bonus offer: 1) you must not currently be an Earnest client, or have received the bonus in the past, 2) you
        must submit a completed student loan refinancing application through the designated LeverEdge Association's link; 3)
        you must provide a valid email address and a valid checking account number during the application process; and
        4) your loan must be fully disbursed. The bonus will be automatically transmitted to your checking account after
        the final disbursement. There is a limit of one bonus per borrower. This offer is not valid for current Earnest
        clients who refinance their existing Earnest loans, clients who have previously received a bonus, or with any
        other bonus offers received from Earnest. Bonus cannot be issued to residents in KY, MA, or MI. Individual bonus offers may not be combined.
    </p>
@endpush
