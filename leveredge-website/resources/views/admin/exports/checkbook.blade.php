@extends('template.public')

@section('content')
    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>
                    <a href="{{ route('checkbook.report') }}">
                        Download Checkbook Report
                    </a>
                </h4>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
@endsection
