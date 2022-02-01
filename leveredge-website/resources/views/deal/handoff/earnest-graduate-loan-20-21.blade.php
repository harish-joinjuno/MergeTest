@extends('template.public')

@push('header-scripts')
    <style>
        h1{
            font-size: 32px;
        }
    </style>
@endpush

@section('content')
    <div class="py-3 py-lg-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="off-black">
                    The next step is with Earnest.
                </h1>

                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-4 mb-3">
                            Pro Tip: For those who don't have a cosigner. You can click on "apply independently".
                        </h4>

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <img src="{{ asset('img/earnest-no-co-signer-latest.png') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ $url }}" class="btn btn-lg btn-primary mt-4">Continue to Earnest</a>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
