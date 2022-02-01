@extends('template.public')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2><a href="{{ url('/admin/metrics/daily-performance') }}">Daily Performance Dashboard</a></h2>
                <h2><a href="{{ url('/admin/metrics/deal-performance') }}">Deal Performance Dashboard</a></h2>
            </div>
        </div>
    </div>

@endsection
