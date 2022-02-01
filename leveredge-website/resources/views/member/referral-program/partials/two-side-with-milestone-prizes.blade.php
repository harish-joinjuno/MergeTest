@php
    $prizes = [
        [1, 'Juno T-Shirt', 'leveredge-t-shirt-square.jpg',''],
        [5, 'Herschel Backpack', 'herschel-backpack-square.jpg','https://www.herschel.com/shop/backpacks/herschel-little-america-backpack?v=10014-00001-OS'],
        [10, 'Apple Air Pods', 'apple-air-pods-medium.png','https://www.apple.com/shop/product/MV7N2AM/A/airpods-with-charging-case'],
        [25, 'Apple Watch', 'apple-watch-medium.png','https://www.apple.com/shop/buy-watch/apple-watch/silver-aluminum-white-sport-band?preSelect=false&product=MU642LL/A&step=detail#'],
        [50, '$3K' , '3k-cash-square.png',''],
        [100, '$10K', '10k-cash-square.png',''],
        [500, 'Tuition', 'tuition-square.png',''],
    ];
@endphp

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center flex-column">
            <h1 class="mt-3 brand-color text-uppercase text-md-left" style="font-size: 34px; letter-spacing: 1.5px;">
                <strong>
                    Invite Friends & Earn Prizes
                </strong>
            </h1>
        </div>
        <div class="col-12 d-flex justify-content-center flex-column">
            <p class="mt-3 d-none d-md-block">
                Share your unique link to earn rewards for each friend who takes the negotiated deal for student
                loans or refinancing.
            </p>
            <p>
                For each friend who takes the deal: <strong>You get $25. They get $25. You unlock prizes</strong>.
            </p>
        </div>

        <!-- Prizes -->
        <div class="col-12 mt-3">
            <img src="{{ url('/img/referral-prizes/referrals-prizes-summary.png') }}" class="img-fluid mt-2 d-none d-lg-inline">
            <img src="{{ url('/img/referral-prizes/referrals-prizes-summary-vertical.png') }}" class="img-fluid mt-2 img-thumbnail d-lg-none">
        </div>
    </div>
</div>


@section('content-after-referral-program-standard-sections')
    @include('affiliate.referral-terms-and-conditions')
@endsection
