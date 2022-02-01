@extends('template.public')

@section('content')

    @if (session('status'))
        <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-light-grey">
            <div class="container mt-0 pt-4 mb-0 pb-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{ url('/img/thumbs-up.png') }}" class="img-fluid" style="max-height: 40px;"><h4 class="d-md-inline mt-3 mt-md-0 ml-3">{{ session('status') }}</h4>
                    </div>
                </div>

            </div>
        </div>
    @endif

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-transparent">
        <div class="container mt-0 mb-0 pt-0 pb-0">
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <h1 style="line-height: 1.5">Invite your Friends. Improve your Odds.</h1>
                    {{--<h2 style="text-transform: none">The scholarship is awarded to a student at the program with the highest participation.</h2>--}}
                    <div class="separator mx-auto mb-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt--3">
    @include('scholarship-2019.scholarship-current-progress')
    </div>

    @php
        $message = "Juno uses group buying power to reduce interest rates on graduate school loans. The launched a $5K scholarship, awarded to a student at the program with the highest participation. Let’s all sign up so that one us can win! Check it out here: https://joinjuno.com/scholarship-2019";
    @endphp


    <div class="container pt-0 mt-0">
        <div class="row mt-4">
            <div class="col-12">
                <h3 class="mb-3">invite your classmates</h3>
                <div class="card">
                    <div class="card-body">
                        "<span id="text-for-sharing">{{ $message }}</span>"
                    </div>
                    <button class="btn btn-primary copy-button" data-clipboard-target="#text-for-sharing">Copy to Clipboard</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
                <div class="card social-card" id="whatsapp-card">
                    <div class="card-body text-center">
                        <h1 class="whatsapp-color">
                            <i class="fab fa-whatsapp"></i>
                        </h1>
                        <p class="mt-2">
                            WhatsApp
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
                <div class="card social-card" id="email-card">
                    <div class="card-body text-center">
                        <h1 class="email-color">
                            <i class="far fa-envelope"></i>
                        </h1>
                        <p class="mt-2">
                            Email
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
                <div class="card social-card" id="facebook-card">
                    <div class="card-body text-center">
                        <h1 class="facebook-color">
                            <i class="fab fa-facebook"></i>
                        </h1>
                        <p class="mt-2">
                            Facebook
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
                <div class="card social-card" id="linkedin-card">
                    <div class="card-body text-center">
                        <h1 class="linkedin-color">
                            <i class="fab fa-linkedin"></i>
                        </h1>
                        <p class="mt-2">
                            LinkedIn
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mt-4">
                <div class="card social-card" id="twitter-card">
                    <div class="card-body text-center">
                        <h1 class="twitter-color">
                            <i class="fab fa-twitter"></i>
                        </h1>
                        <p class="mt-2">
                            Twitter
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>



    @include('scholarship-2019.scholarship-terms-and-conditions')

@endsection



@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>


    <script>
        $("#whatsapp-card").click(function() {
            window.location = "https://api.whatsapp.com/send?text={{ rawurlencode($message) }}";
            return false;
        });


        $("#email-card").click(function() {
            window.location = "mailto:?&body={{ rawurlencode($message) }}";
            return false;
        });


        $("#twitter-card").click(function() {
            window.location = "https://twitter.com/home?status=Juno%20uses%20group%20buying%20power%20to%20offer%20you%20low-interest%20rate%20loans!%20Learn%20more%20at%20https%3A//joinjuno.com/scholarship-2019";
            return false;
        });

        $("#facebook-card").click(function() {
            window.location = "https://www.facebook.com/sharer/sharer.php?u=https%3A//joinjuno.com/scholarship-2019";
            return false;
        });

        $("#linkedin-card").click(function() {
            window.location = "https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fjoinjuno.com/scholarship-2019";
            return false;
        });

    </script>

@endpush

