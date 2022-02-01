@php
    $path = \Illuminate\Support\Facades\Route::getCurrentRoute()->uri();
    if (strpos($path, 'variable') !== false) {
        $back_param = 'variable-deal';
    }else if (strpos($path, 'fixed') !== false) {
        $back_param = 'fixed-deal';
    }else{
        $back_param = null;
    }
@endphp

<div class="card lender-summary-card h-100 border-primary border-width-4">
    <div class="card-header bg-white">
        <h2 class="off-black text-center">Earnest Private Student Loan</h2>
        <h6 class="text-center">Fixed rates starting at 3.49% APR (with Cosigner) <sup class="foot-note-marker">2, 3</sup></h6>
        <h6 class="text-center">Fixed rates starting at 4.55% APR (No Cosigner) <sup class="foot-note-marker">2, 3</sup></h6>
    </div>

    <div class="card-body">

        <p><i class="primary fad fa-check pr-2"></i>
            A <a href="javascript:void(0)" data-toggle="tooltip" title="has some impact on credit score">hard credit check</a> is required to see your rate.
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            Exclusive rates (lower by up to 4.00%) for Juno Members
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            New Earnest customers will receive 0.5% of your loan amount as cash back from Juno.
            (e.g. you'll get $300 if you borrow $60K)<sup class="foot-note-marker">6</sup>
        </p>

    </div>
    <div class="card-footer text-center bg-white">
        <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/earnest-graduate-deal?back_param=' . $back_param) }}" class="btn btn-block-below-md btn-outline-primary mb-2 mb-md-0">View details</a>
        <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_EARNEST_GRAD_STUDENT_LOAN_20_21_SLUG.'/hand-off') }}" class="btn btn-block-below-md btn-primary">Check my rate</a>
    </div>
</div>

@push('custom-disclaimers')
    @include('legal._earnest-compliance-disclaimers', [
        'aprFootnote' => '2 - Actual rate and available repayment terms will vary based on credit profile. Fixed
        rates range from 3.49% APR (with autopay) to 6.90% APR (excludes 0.25% Auto Pay discount). Variable rates
        range from 1.24% APR (with autopay) to 6.50% APR (excludes 0.25% Auto Pay discount). For variable rate
        loans, although the interest rate will vary after you are approved, the interest rate will never exceed 36%
        (the maximum allowable for these loans). Earnest variable interest rates are based on a publicly available
        index, the one month London Interbank Offered Rate (LIBOR). Your rate will be calculated each month by
        adding a margin between 1.34% and 11.54% to the one month LIBOR. Earnest rate ranges are current as of
        9/23/2020. Earnest Private Student Loans are not available in Nevada.'
    ])
    <p class="text-footer-disclaimer">
        6 - Terms and conditions apply. To qualify for this signup bonus offer: 1) you must be a new customer;
        2) you must submit a completed student loan refinancing application through https://joinjuno.com; and
        3) you must provide a valid email address and a valid checking account number during the application process;
        and 4) your loan must be fully disbursed. Bonus will be automatically transmitted to your checking account
        after the final disbursement. Limit one bonus per borrower. This offer is not valid with any other bonus
        offers received. Earnest bonus not available for residents of Michigan, Kentucky, or Massachusetts.
    </p>
@endpush
