<div class="container-fluid py-3 bg-light-green">
    @if(!empty($faqs))
        @include('landing-pages.partials._faq-dropdown')
    @endif

    <div class="container px-0">
        <div class="row align-items-center justify-content-center text-center text-md-left py-5 mb-5">
            <div class="col-12 text-center px-0">
                <img
                    class="img-fluid mb-2 d-none d-sm-block"
                    src="{{ asset('/img/undergraduate-public-progress-bar.png') }}"
                >
                <img
                    class="img-fluid mb-2 d-block d-sm-none"
                    src="{{ asset('/img/undergraduate-public-progress-bar-mobile.png') }}"
                >
                <h1 class="off-black mb-3">Thousands of members helped us get here</h1>
            </div>
            <div class="col-12 col-lg-7 text-center">
                <p class="mb-5">
                    Thanks to our community, we’ve successfully negotiated a deal for our members.
                    Now, you’re free to join and access those same options.
                </p>
                <a
                    href="{{ $callToActionURL ?? url('/register') }}"
                    class="btn btn-lg bg-secondary font-weight-bold px-5 rates-button"
                >
                    Check my rate
                </a>
            </div>
        </div>
    </div>
</div>
