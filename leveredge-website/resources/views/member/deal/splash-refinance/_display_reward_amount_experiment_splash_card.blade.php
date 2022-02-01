<div class="card lender-summary-card h-100 border-primary border-width-4">
    <div class="card-header bg-white">
        <h2 class="off-black text-center mb-3">Refinance with Splash Financial</h2>
        <h6 class="text-center">Fixed rates starting at 2.88% APR<sup class="foot-note-marker">7</sup></h6>
        <h6 class="text-center">Variable rates starting at 1.98% APR<sup class="foot-note-marker">7</sup></h6>
    </div>

    <div class="card-body">
        <p><i class="primary fad fa-check pr-2"></i>
            Checking your rates through this partner doesn’t impact your credit score and should take less than 2 minutes.
        </p>
        <p><i class="primary fad fa-check pr-2"></i>
            New Splash customers refinancing a loan above $50k receive $600 total cash back when you go through Juno.<sup class="foot-note-marker">7</sup>
        </p>

    </div>
    <div class="card-footer text-center bg-white">
        @php
            $dealSlug = \App\Deal::DEAL_SPLASH_REFINANCE_SLUG;
        @endphp
        <a target="_blank" href="{{ url('/member/deal/'.$dealSlug.'/hand-off') }}" class="btn btn-block-below-md btn-primary">{{ $splash_reward_text }}</a>

    </div>
</div>

@push('custom-disclaimers')
    <p class="text-footer-disclaimer">7 - Terms and conditions apply. May include auto pay discount. See Splash Financial for full details.</p>
@endpush
