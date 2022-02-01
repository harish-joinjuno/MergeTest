<div class="container-fluid">
    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-12 col-sm-4 mb-4">
                <h4 class="underlined d-inline-block">How it Works</h4>
            </div>
            <div class="col-12 col-sm-8 mb-4">
                <h2>
                    {{ $customDescription ?? 'We gather large groups of students who need help paying for
                    school and get lenders to compete for our business.' }}
                </h2>
            </div>
            <div class="col-12 mb-5 slide-fade-in">
                <img src="{{ $customImg ?? asset('/img/how-it-works-block-3.png') }}" class="img-fluid">
            </div>
            <div class="col-12 col-sm-4">
                <small class="text-muted mb-0">Step 1.</small>
                <h2 class="mb-4">You sign up.</h2>
                <p>
                    {!! $stepOne ?? 'Sign up for free and tell us a little bit about yourself and the type of
                    student loan you need.<a href="' . url('/eligibility') . '">
                        Am I eligible?
                    </a>' !!}
                </p>
            </div>
            <div class="col-12 col-sm-4">
                <small class="text-muted mb-0">Step 2.</small>
                <h2 class="mb-4">We run a bid.</h2>
                <p>
                    {!! $step2 ?? 'We run a bidding process between banks, credit unions, and other lenders.
                    They compete for our collective business by offering exclusive discounts.' !!}
                </p>
            </div>
            <div class="col-12 col-sm-4">
                <small class="text-muted mb-0">Step 3.</small>
                <h2 class="mb-4">We compare.</h2>
                <p>
                    {!! $step3 ?? 'We compare all offers, negotiate terms, and select the best options for the group.
                    We share the negotiated deals with you and you can decide to use it or not.
                    There’s no commitment.' !!}
                </p>
            </div>
            @if(empty($hideJoin))
                @if(Auth::guest() || ($no_completed_application ?? ''))
                    <div class="col-12 text-center py-5">
                        <a href="{{ $linkUrl ?? route('auto_refinance-get_redirect')}}" class="btn btn-secondary rounded-pill py-3 px-5">
                            {{ $linkText ?? 'Get Started' }}
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
