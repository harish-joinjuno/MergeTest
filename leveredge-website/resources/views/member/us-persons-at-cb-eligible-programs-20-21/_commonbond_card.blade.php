{{--@php--}}
{{--    $path = \Illuminate\Support\Facades\Route::getCurrentRoute()->uri();--}}
{{--    if (strpos($path, 'variable') !== false) {--}}
{{--        $back_param = 'variable-deal';--}}
{{--    }else if (strpos($path, 'fixed') !== false) {--}}
{{--        $back_param = 'fixed-deal';--}}
{{--    }else{--}}
{{--        $back_param = null;--}}
{{--    }--}}
{{--@endphp--}}

{{--<div class="card lender-summary-card h-100 border-primary border-width-4">--}}
{{--    <div class="card-header bg-white">--}}
{{--        <h2 class="off-black text-center">CommonBond</h2>--}}
{{--        <h5 class="text-center">Variable rates between 3.15-4.45% (10 year)<sup class="foot-note-marker">5</sup></h5>--}}
{{--    </div>--}}

{{--    <div class="card-body">--}}
{{--        <p><i class="primary fad fa-check pr-2"></i>--}}
{{--            Only a <a href="javascript:void(0)" data-toggle="tooltip" title="does not affect credit score">soft credit check</a> is required to see your minimum rate. A <a href="javascript:void(0)" data-toggle="tooltip" title="has some impact on credit score">hard credit check</a>  is required to see all your rate options.--}}
{{--        </p>--}}
{{--        <p><i class="primary fad fa-check pr-2"></i>--}}
{{--            Often better if you have no co-signer and/or without income requirements.--}}
{{--        </p>--}}
{{--        <p><i class="primary fad fa-check pr-2"></i>--}}
{{--            For being a Juno member, we will give you <span class="primary fw-600">0.5%</span> of your loan amount as cash back. (e.g. you'll get $300 if you borrow $60K)--}}
{{--        </p>--}}

{{--    </div>--}}
{{--    <div class="card-footer text-center bg-white">--}}
{{--        <a href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/commonbond-mba-deal?back_param=' . $back_param) }}" class="btn btn-block-below-md btn-outline-primary mb-2 mb-md-0">View details</a>--}}
{{--        <a target="_blank" href="{{ url('/member/deal/'.\App\Deal::DEAL_COMMONBOND_MBA_STUDENT_LOAN_20_21_SLUG.'/hand-off') }}" class="btn btn-block-below-md btn-primary">Check my rate</a>--}}
{{--    </div>--}}
{{--</div>--}}


{{--@push('custom-disclaimers')--}}
{{--    <p class="text-footer-disclaimer">--}}
{{--        5 - For more information about CommonBond, visit commonBond.com.--}}
{{--        <br>--}}
{{--        Loan fees: See https://www.commonbond.co/disclaimers#Disclaimer-1--}}
{{--        <br>--}}
{{--        CommonBond’s Loan Cost Examples: https://www.commonbond.co/disclaimers#Disclaimer-1--}}
{{--    </p>--}}
{{--@endpush--}}
