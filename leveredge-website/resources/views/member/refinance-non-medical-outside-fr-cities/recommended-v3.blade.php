@extends('member.refinance-medical-in-fr-cities.recommended-base')

@section('deal-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center off-black mb-3">Get paid to save</h1>
                <h6 class="text-center">Deals we guarantee you won't get elsewhere</h6>
                <p class="text-center primary"><a class="primary fw-600" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions' ) }}">Change my answers</a></p>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-translucent-green pt-3 mt-0 mb-0">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-6 px-0 px-lg-3">
                    @include('member.deal.earnest-refinance._earnest_refinance_card')
                </div>
                <div class="col-12 col-md-6 px-0 px-lg-3">
                    @include('member.deal.splash-refinance._splash_card')
                </div>
            </div>
        </div>
    </div>

    <div class="py-2 py-lg-4"></div>
@endsection
