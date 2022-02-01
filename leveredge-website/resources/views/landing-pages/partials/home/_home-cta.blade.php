<p class="text-center">
    {!! $description ?? '' !!}
</p>
<form
    action="{{ $callToActionURL ?? url('/register') }}"
    class="pt-3"
    style="max-width:480px;margin:0 auto;"
>
    <div class="form-group">
        <div class="text-box col-12 px-0">
            <input
                type="text"
                name="email"
                placeholder="Enter your email"
                class="bg-light pl-4 pr-5"
            />
            <div class="input-group-append">
                <button
                    id="submit-enroll-form-button"
                    type="submit"
                    class="bg-secondary"
                >
                    Get Started
                </button>
            </div>
        </div>
    </div>
</form>
@php
    $checklist = [
        'Free for you -
        <span
            style="border-bottom:1px dashed #000;"
            data-toggle="tooltip"
            title="We charge lenders a fee that is set at the beginning of the process.
            The only way for a lender to win the auction is to offer the lowest rates to our members."
        >
            How?
        </span>',
        'It takes <1 minute to join',
        'No credit check',
    ];
@endphp
<ul class="home-checklist list-unstyled list-inline small text-center mt-5 mt-sm-0">
    @foreach($checklist as $item)
        @include('landing-pages.partials.home._checklist-item', ['item' => $item])
    @endforeach
</ul>
