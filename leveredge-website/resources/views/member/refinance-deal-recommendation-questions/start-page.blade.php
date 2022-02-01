@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <h1 class="off-black">{{ $totalPages > 1 ? 'Three' : 'One' }} important question{{ $totalPages > 1 ? 's' : '' }}</h1>
                <h4 class="mt-3 mb-4">
                    Along with your profile information, your answers will help us recommend which of our deals is the best fit for you.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6 col-md-3 col-lg-3">
                <img src="{{ asset('/img/hands-on-laptop-coffee-pink-bg.png') }}" class="img-fluid">
            </div>
        </div>

        @php
            $nextPage = $totalPages > 1 ? 'loan-amount' : 'medical';
        @endphp

        <div class="row mt-5">
            <div class="col-12 text-center">
                <a
                    href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiation_group_id.'/refinance-deal-recommendation-questions/'.$nextPage.'') }}"
                    class="btn btn-primary">
                    Continue
                </a>
            </div>

        </div>
    </div>

    <div class="py-5"></div>
@endsection
