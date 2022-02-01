@php

    $heading_1 = "Students Sign Up";
    $heading_2 = "Lenders Compete";
    $heading_3 = "Loans Offered";

    $body_1 = "Students join the Juno Refi Negotiation Group for free. Just provide your name and email address.";
    $body_2 = "We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.";
    $body_3 = "Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!";


$timeline_1 = "Ongoing";
$timeline_2 = "Up to May 30th";
$timeline_3 = "Starting July 12th";


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


    <!-- Desktop --->
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



{{--<div class="container" id="how-it-works">--}}

    {{--<!-- Heading -->--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<h2>Negotiation Timeline</h2>--}}
            {{--<div class="separator"></div>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<!-- Mobile -->--}}
    {{--<div class="row">--}}
        {{--<div class="col-12 how-it-works-mobile d-lg-none">--}}
            {{--<div class="mobile-step">--}}
                {{--<h4 class="title"><a data-toggle="collapse" href="#stepOne" role="button" aria-expanded="false" aria-controls="stepOne" class=""><i class="fa fa-chevron-down"></i>Students Sign Up</a></h4>--}}
                {{--<h5>Up to April 15th</h5>--}}
                {{--<p class="description collapse show" id="stepOne">Students join the Juno Refi Negotiation Group for free. Just provide your name and email address.</p>--}}
            {{--</div>--}}
            {{--<div class="mobile-step">--}}
                {{--<h4 class="title"><a data-toggle="collapse" href="#stepTwo" role="button" aria-expanded="false" aria-controls="stepTwo" class=""><i class="fa fa-chevron-down"></i>Lenders Compete</a></h4>--}}
                {{--<h5>Up to May 15th</h5>--}}
                {{--<p class="description collapse show" id="stepTwo">We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.</p>--}}
            {{--</div>--}}
            {{--<div class="mobile-step">--}}
                {{--<h4 class="title"><a data-toggle="collapse" href="#stepThree" role="button" aria-expanded="false" aria-controls="stepThree" class=""><i class="fa fa-chevron-down"></i>Loans Offered</a></h4>--}}
                {{--<h5>Before May 30th</h5>--}}
                {{--<p class="description collapse show" id="stepThree">Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!</p>--}}
            {{--</div>--}}

            {{--@if(isset($call_to_action_link) && isset($call_to_action_text))--}}
                {{--<div class="row">--}}
                    {{--<div class="col-lg-12 text-center get-started-button">--}}
                        {{--<a href="{{ $call_to_action_link }}" class="btn btn-primary btn-lg">{{ $call_to_action_text }}</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}

        {{--</div>--}}
    {{--</div>--}}


    {{--<!-- Desktop -->--}}
    {{--<div class="row">--}}
         {{--<div class="col-md-6 offset-md-3 d-none d-lg-block">--}}
            {{--<ul class="timeline">--}}
                {{--<li>--}}

                    {{--<h6 class="mb-2">--}}
                        {{--<span style="font-size: 16px; font-weight: 700;">Students Sign Up</span>--}}
                    {{--<span class="badge badge-primary badge-pill float-right" style="font-size: 14px; font-weight: 400;">--}}
                        {{--Up to April 15th--}}
                    {{--</span>--}}
                    {{--</h6>--}}


                    {{--<hr class="mb-1 mt-1">--}}
                    {{--<p>Students join the Juno Refi Negotiation Group for free. Just provide your name and email address.</p>--}}
                {{--</li>--}}
                {{--<li class="mt-5">--}}
                    {{--<strong>Lenders Compete</strong>--}}
                    {{--<strong><span class="float-right">Up to May 15th</span></strong>--}}
                    {{--<hr class="mb-1 mt-1">--}}
                    {{--<p>We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.</p>--}}
                {{--</li>--}}
                {{--<li class="mt-5">--}}
                    {{--<strong>Loans Offered</strong>--}}
                    {{--<strong><span class="float-right">Before May 30th</span></strong>--}}
                    {{--<hr class="mb-1 mt-1">--}}
                    {{--<p>Juno shares details of the offer with all members in the group and students can now take advantage of the deal.</p>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
