@extends('template.public')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Legal Documents and Information</h2>
                <div class="separator"></div>
                <ul class="mt--3">
                    <li><a href="{{ url('/terms-of-use') }}">Terms of Use</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ url('/how-we-make-money') }}">How We Make Money</a></li>
                </ul>

            </div>
        </div>
    </div>

@endsection
