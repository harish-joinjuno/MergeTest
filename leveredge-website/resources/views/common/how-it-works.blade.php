
@php

$heading_1 = "Students Sign Up";
$heading_2 = "Lenders Compete";
$heading_3 = "Loans Offered";

$body_1 = "Students join a Juno Negotiation Group for free. Just provide your name and email address.";
$body_2 = "We ask lenders to submit their proposed loan terms for students in the group. We evaluate and select one offer to share with students.";
$body_3 = "Students apply directly to the lender via our unique link to get the negotiated interest rates and terms!";

@endphp


<div id="how-it-works">

    <div class="container pb-0 mt-0">
        <div class="row">
            <div class="col-md-12">
                <h2>How It Works</h2>
                <div class="separator"></div>
            </div>
        </div>
    </div>

    <div class="container d-lg-none pt-0 mt-0">
        <div class="row">
            <div class="col-12 how-it-works-mobile">
                <div class="mb-5">
                    <h4 class="title">{{ $heading_1 }}</h4>
                    <p class="mt-2">{{ $body_1 }}</p>
                </div>
                <div class="mb-5">
                    <h4 class="title">{{ $heading_2 }}</h4>
                    <p class="mt-2">{{ $body_2 }}</p>
                </div>
                <div class="">
                    <h4 class="title">{{ $heading_3 }}</h4>
                    <p class="mt-2">{{ $body_3 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-none d-lg-block pt-0 mt-0">

        <div class="row">
            <div class="col-4 pl-5 pr-5 text-center">
                <div class="first-dot mx-auto text-center">1</div>
                <div class="pt-4">
                    <h3 class="mb-3">{{ $heading_1 }}</h3>
                    <p>{{ $body_1 }}</p>
                </div>

            </div>

            <div class="col-4 pl-5 pr-5 text-center">
                <div class="dot mx-auto text-center">2</div>
                <div class="pt-4">
                    <h3 class="mb-3">{{ $heading_2 }}</h3>
                    <p>{{ $body_2 }}</p>
                </div>
            </div>

            <div class="col-4 pl-5 pr-5 text-center">
                <div class="dot mx-auto text-center">3</div>
                <div class="pt-4">
                    <h3 class="mb-3">{{ $heading_3 }}</h3>
                    <p>{{ $body_3 }}</p>
                </div>
            </div>
        </div>

    </div>

    @if(isset($call_to_action_link) && isset($call_to_action_text))
    <div class="container pt-0 pb-0 mt-0 mb-0">
        <div class="row">
            <div class="col-12">
                <!-- Get Started Button -->
                <div class="row">
                    <div class="col-lg-12 text-center get-started-button">
                        <a href="{{ $call_to_action_link }}" class="btn btn-primary btn-lg">{{ $call_to_action_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
