@php

    $heading_1 = "Students Sign Up";
    $heading_2 = "Lenders Compete";
    $heading_3 = "Loans Offered";

    $body_1 = "Students join the Juno Student Loan Negotiation Group for free. Just provide your name and email address.";
    $body_2 = "We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.";
    $body_3 = "Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!";


    $timeline_1 = "Ongoing";
    $timeline_2 = "Up to June 14th";
    $timeline_3 = "Starting July 1st";


@endphp
<div id="how-it-works">

    <div class="container pb-0 mt-0">
        <div class="row">
            <div class="col-md-12">
                <h2>Negotiation Timeline</h2>
                <div class="separator"></div>
            </div>
        </div>
    </div>


    <!-- Mobile -->
    <div class="container d-lg-none pt-0 mt-0">
        <div class="row">
            <div class="col-12 how-it-works-mobile">
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
        </div>
    </div>

    <!-- Desktop -->
    <div class="container d-none d-lg-block pt-0 mt-0">
        <div class="row">
            <div class="col-md-6 offset-md-3 d-none d-lg-block">
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

