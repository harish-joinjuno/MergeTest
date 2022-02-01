@extends('template.public')

@section('content')
    <div class="py-3 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <h1 class="off-black">
                    Do you want to help bring transparency to student loans?
                </h1>
                <h4 class="mt-4">
                    You submit the quotes you have received from lenders and we'll share it and other student's quotes anonymously with your peers.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-6 col-lg-4">
                <p class="mb-2">
                    <a href="{{ url('/data-transparency/submit-a-quote') }}" class="btn btn-block btn-secondary-green">Yes, I want to help</a>
                </p>
                <p>
                    <a href="{{ url('/data-transparency/decline-submit-a-quote') }}" class="btn btn-block btn-outline-primary">No, I'm not interested</a>
                </p>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
