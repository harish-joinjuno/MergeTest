@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container signup-container">

        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">We'll be in touch</h2>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            <div class="col-12 col-md-4">
                <img class="img-fluid" src="{{ asset('/img/hands-on-laptop-with-coffee.png') }}" style="max-height: 180px;">
                <h4 class="fw-500 mb-4">Check out what we have now</h4>
                <p>
                    Click below to check out what’s in store for you once you’re ready to refi
                </p>
            </div>
            <div class="col-12 col-md-4">
                <img class="img-fluid" src="{{ asset('/img/together.png') }}" style="max-height: 180px;">
                <h4 class="fw-500 mb-4">Ask us anything!</h4>
                <p>
                If there’s anything on your mind, just drop us a line or <a href="{{ url('/contact') }}">give us a call</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <div class="sign-up-next form-group mb-0 mt-5">
                    <div class="mb-2">
                        <a href="{{ url('/member/academic-year/1') }}" class="btn btn-primary" id="go-to-the-deals">Go to the deals</a>
                    </div>
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-link">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection

@push('footer-scripts')
    <script>
        dataLayer.push({'profile_quality': '{{ user()->profile->quality }}'});
    </script>
@endpush
