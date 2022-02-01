@php

    $heading_1 = "Students Sign Up";
    $heading_2 = "Lenders Compete";
    $heading_3 = "Loans Offered";

    $body_1 = "Students join the Juno Student Loan Negotiation Group for free. Invite your friends.";
    $body_2 = "We ask lenders to submit their proposed loan rates and terms. We evaluate and select the best offer.";
    $body_3 = "Students apply directly to the lender via Juno to get the negotiated interest rates and terms!";


    $timeline_1 = "Ongoing";
    $timeline_2 = "Up to April 14th, 2020";
    $timeline_3 = "Starting June 1st, 2020";


@endphp

<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div id="how-it-works">
            <h4 class="mb-5">Negotiation Timeline</h4>
            <!-- Mobile -->
            <div class="how-it-works-mobile d-lg-none">
                <div class="mb-5">
                    <h4 class="title">{{ $heading_1 }}</h4>
                    <p class="date">{{ $timeline_1 }}</p>
                    <p class="mt-2">{{ $body_1 }}</p>
                </div>
                <div class="mb-5">
                    <h4 class="title">{{ $heading_2 }}</h4>
                    <p class="date">{{ $timeline_2 }}</p>
                    <p class="mt-2">{{ $body_2 }}</p>
                </div>
                <div class="">
                    <h4 class="title">{{ $heading_3 }}</h4>
                    <p class="date">{{ $timeline_3 }}</p>
                    <p class="mt-2">{{ $body_3 }}</p>
                </div>
            </div>

            <!-- Desktop -->
            <div class="d-none d-lg-block">
                <ul class="timeline">

                    <li>
                        <h6 class="mb-2">
                            <span style="font-size: 16px; font-weight: 700;">{{ $heading_1 }}</span>
                            <span class="badge badge-primary badge-pill float-right" style="font-size: 14px; font-weight: 400;">{{ $timeline_1 }}</span>
                        </h6>
                        <hr class="mb-1 mt-1">
                        <p>{{ $body_1 }}</p>
                    </li>

                    <li class="mt-5">
                        <strong>{{ $heading_2 }}</strong>
                        <strong><span class="float-right">{{ $timeline_2 }}</span></strong>
                        <hr class="mb-1 mt-1">
                        <p>{{ $body_2 }}</p>
                    </li>
                    <li class="mt-5">
                        <strong>{{ $heading_3 }}</strong>
                        <strong><span class="float-right">{{ $timeline_3 }}</span></strong>
                        <hr class="mb-1 mt-1">
                        <p>{{ $body_3 }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
