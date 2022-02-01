@extends('member.refinance-medical-in-fr-cities.recommended-base')

@section('deal-content')

    <!--- We want to show a primary option coming soon (First Republic) and Earnest as a secondary Option --->
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
                    @include('member.deal.first-republic-refinance._first_republic_coming_soon_card')
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron bg-translucent-green pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">
                    <h1 class="text-center"><i class="fas fa-exclamation-circle"></i></h1>
                    <h3 class="text-center">If you can't wait for the other option to come, you can utilize our deal to refinance with Earnest</h3>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-12 col-md-6 px-0 px-lg-3">
                    @include('member.deal.earnest-refinance._earnest_refinance_card')
                </div>
            </div>
        </div>
    </div>




    <div class="py-2 py-lg-4"></div>
@endsection
