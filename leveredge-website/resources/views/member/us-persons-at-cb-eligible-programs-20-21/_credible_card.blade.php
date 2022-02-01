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
        <h2 class="off-black text-center">Credible</h2>
        <h5 class="text-center">Variable rates starting at 1.24% APR<sup style="font-size: 16px" class="foot-note-marker">*</sup> <br> <span style="font-size: 16px;">(with Cosigner & autopay discount)</span></h5>
    </div>

    <div class="card-body">

        <p><i class="primary fad fa-check pr-2"></i>
            Only a <a href="javascript:void(0)" data-toggle="tooltip" title="does not affect credit score">soft credit check</a> is required to see your prequalified rates.
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            Often better for people with a <a href="javascript:void(0)" data-toggle="tooltip" title="a good credit score, high income, low existing debt and/or with a co-signer">strong credit profile</a>.
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            New Credible customers will receive 1.0% of your loan amount as cash back from Juno. (e.g. you'll get $600 if you borrow $60K)<sup class="foot-note-marker">*</sup>
        </p>


    </div>
    <div class="card-footer text-center bg-white">
{{--        <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/credible-graduate-deal?back_param=' . $back_param) }}" class="btn btn-outline-primary">View details</a>--}}
        <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_CREDIBLE_STUDENT_LOAN_SLUG.'/hand-off') }}" class="btn btn-block-below-md btn-primary">Check my rate at Credible</a>
    </div>
</div>

@push('custom-disclaimers')
<p class="text-footer-disclaimer">
    * - See Credible Operations, Inc., NMLS # 1681276, www.credible.com, for more information
    <br><br>
    Student Loan Rate and Terms Disclosure: Rates displayed include Automatic Payment and Loyalty Discounts,
    where applicable. Note that such discounts do not apply while loans are in deferment. The lenders on the
    Credible.com platform offer fixed rates ranging from 3.82% - 14.50% APR and Variable interest rates from
    1.29% - 12.99% APR. Variable rates will fluctuate over the term of the borrower’s loan with changes in the
    applicable index rate. Rates are subject to change at any time without notice. Your actual rate may be different from
    the rates advertised and/or shown above and will be based on factors such as the term of your loan, your
    financial history (including your cosigner’s (if any) financial history) and the degree you are in the process
    of achieving or have achieved. While not always the case, lower rates typically require creditworthy applicants
    with creditworthy co-signers, graduate degrees, and shorter repayment terms (terms vary by lender and can range
    from 5-20 years) and include Automatic Payment and Loyalty discounts, where applicable. Loyalty and Automatic
    Payment discount requirements as well as Lender terms and conditions will vary by lender and therefore, reading
    each lender’s disclosures is important. Additionally, lenders may have loan minimum and maximum requirements,
    degree requirements, educational institution requirements, citizenship and residency requirements as well as
    other lender-specific requirements. Prequalified rates available on www.credible.com are based on a soft credit pull
    that does not impact your credit score. If you choose to apply for a loan, the lender will perform a hard credit pull
    that will impact your credit score.
    <br><br>
    Visit Credible.com for loan cost examples
</p>

<p class="text-footer-disclaimer">
Cash back amount and rate offered by Juno subject to change. Please read all details of Juno's cash back program
here: https://joinjuno.com/leveredge-rewards/terms
</p>
@endpush
