@extends('template.public')

@section('content')
    <div class="py-5"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-center off-black">Oops! We tried to automatically log you into the website and take you to the deal, but that didn't work</h1>
                <a class="btn btn-lg btn-primary mt-5" href="{{ url('/login') }}">Login Manually</a>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
