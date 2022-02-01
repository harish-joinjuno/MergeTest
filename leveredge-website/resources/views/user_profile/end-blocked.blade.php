@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container signup-container">

        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="mb-3">The deals we negotiated will be available within a week</h2>
                <h4>We'll send you an email as soon as it is your turn to access it.</h4>
            </div>
        </div>

        <div class="row text-center justify-content-center">
{{--            <div class="col-12 col-md-4">--}}
{{--                <img class="img-fluid" src="{{ url('/img/sit-back-and-relax.png') }}" style="max-height: 180px;">--}}
{{--                <h4 class="fw-500 mb-4">Sit back and relax!</h4>--}}
{{--                <p>--}}
{{--                    We're working on student loan negotiations right now. When we've got a deal, we'll send you an email with your own special link, so stay tuned.--}}
{{--                </p>--}}
{{--            </div>--}}

            <div class="col-12 col-md-4">
                <img class="img-fluid" src="{{ asset('/img/hands-on-laptop-with-coffee.png') }}" style="max-height: 180px;">
                <h4 class="fw-500 mb-4">Coming soon!</h4>
                <p>
                    There are so many of you that we need to release the deal in phases to avoid technical & capacity issues with our partners. <br />
                </p>
            </div>

            <div class="col-12 col-md-4">
                <img class="img-fluid" src="{{ url('/img/ask-us-anything.png') }}" style="max-height: 180px;">
                <h4 class="fw-500 mb-4">Ask us anything!</h4>
                <p>
                    We’re happy to speak if there’s anything on your mind. You can <a href="{{ url('/contact') }}">email or call us here.</a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <div class="sign-up-next form-group mb-0 mt-5">
                    <div class="mb-2">
                        <a href="{{ route('member.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    </div>
                    <div>
                        <a href="{{ route('user-profile.financials')  }}" class="btn btn-link">Back</a>
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
