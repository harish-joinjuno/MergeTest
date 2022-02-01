@extends('template.public')

@push('header-scripts')
    <style>
        h1 {
            font-size: 32px;
        }
        h4 {
            font-weight: 500;
        }
        @media screen and (min-width: 768px) {
            h1 {
                font-size: 48px;
            }
        }
        .square {
            height: 0;
            padding-bottom:100%;
            position:relative;
        }
        .square img {
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            height:auto;
        }
        a.btn-rounded {
            border-radius:26px;
        }
        .deal-box {
            box-shadow:0 20px 13px rgba(0,0,0,.1);
        }
    </style>
@endpush

@section('content')
    <div class="py-3 py-lg-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="off-black">
                    The next step is with Laurel Road.
                    <br>
                    You're in good hands!
                </h1>

                <div class="row justify-content-center mt-5">
                    <div class="col-12">
                        <h4 class="mt-4 mb-3">
                            You’re officially leaving our website to apply for the deal of your dreams.
                        </h4>
                    </div>
                </div>

            </div>
            <div class="deal-box col-12 text-center mt-5 py-5">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="square">
                            <img class="img-fluid" src="{{ asset('/img/students-sign-up.png') }}">
                        </div>
                        <h4>Enter in your information</h4>
                        <p>Heads up, you'll be entering in all of your information on Laurel Road's site.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="square">
                            <img class="img-fluid" src="{{ asset('/img/components/negotiation_timeline/loans_offered.png') }}">
                        </div>
                        <h4>Loans offered</h4>
                        <p>You’re the VIP here. They know you’re coming and will have the deal ready for you. </p>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="square">
                            <img class="img-fluid" src="{{ asset('/img/selfless.png') }}">
                        </div>
                        <h4>We’re still here for you!</h4>
                        <p>
                            Seriously, if you run into any hiccups along the way, or want to comment about your
                            experience, email us at Support@Juno.org
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 offset-sm-3">
                        <a href="{{ $url ?? '#' }}" class="btn btn-lg btn-block btn-primary btn-rounded mt-4">
                            Start your application
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
