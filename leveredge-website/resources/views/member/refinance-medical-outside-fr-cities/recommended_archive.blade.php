@extends('member.refinance-medical-in-fr-cities.recommended-base')

@section('deal-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center off-black mb-3">Negotiated just for you</h1>
                <p class="text-center primary"><a class="primary fw-600" href="{{ url('/member/negotiation-group/' . $negotiationGroupUser->negotiationGroup->id . '/refinance-deal-recommendation-questions' ) }}">Change my answers</a></p>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-translucent-green pt-3 mt-0 mb-0">
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-6 px-0 px-lg-3">
                    @include('member.deal.laurel-road-refinance._laurel_road_coming_soon_card')
                </div>
            </div>
        </div>
    </div>

    <div class="py-2 py-lg-4"></div>
@endsection
