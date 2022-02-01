@extends('template.public')

@section('content')

    <div class="py-5"></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Count of Access the Deals by Deal that don't have an applied on date
                </h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Missing Application On Date</th>
                    </tr>
                    </thead>

                    @foreach($summary as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h2>
                    Count of Access the Deals by Deal that don't have an signed on date
                </h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Missing Application On Date</th>
                    </tr>
                    </thead>

                    @foreach($summary_signed_on as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <h2>
                    This is the list of Access the Deal IDs that don't have an applied on date
                </h2>
                <table class="table">
                    @foreach($accessTheDeals as $accessTheDeal)
                        @php
                        /** @var \App\AccessTheDeal $accessTheDeal */
                        @endphp
                    <tr>
                        <td>{{ $accessTheDeal->id }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
