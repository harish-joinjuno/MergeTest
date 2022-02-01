@extends('template.public')


@php
if($negotiationGroupUser->negotiationGroup->id == \App\NegotiationGroup::NG_DOMESTIC_CB_ELIGIBLE){
    $number_of_deals = 3;
}else if($negotiationGroupUser->negotiationGroup->id == \App\NegotiationGroup::NG_DOMESTIC_NON_CB_GRAD){
    $number_of_deals = 2;
}else{
    $number_of_deals = "";
}

@endphp

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <h1 class="off-black">Two important questions</h1>
                <h4 class="mt-3 mb-4">
                    Along with your profile information, your answers will help us recommend which of our {{ $number_of_deals }} deals is the best fit for you.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6 col-md-3 col-lg-3">
                <img src="{{ asset('/img/hands-on-laptop-coffee-pink-bg.png') }}" class="img-fluid">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a id="continue-btn" href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiation_group_id.'/pre-deal-recommendation-questions/co-signer-question') }}" class="btn btn-primary">Continue</a>
            </div>

        </div>
    </div>

    <div class="py-5"></div>
@endsection
