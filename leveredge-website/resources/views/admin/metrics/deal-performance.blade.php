@extends('template.public')

@push('footer-scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endpush

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h3>Absolute Numbers</h3>
                @include('admin.metrics._combined._combined_clicks_applied_and_signed_loans_by_deal')

                <h3>7 Day Moving Average</h3>
                @include('admin.metrics._combined._combined_clicks_applied_and_signed_loans_moving_average_by_deal')
            </div>
        </div>
    </div>
@endsection




