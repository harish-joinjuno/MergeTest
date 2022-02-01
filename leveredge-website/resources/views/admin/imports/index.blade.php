@extends('template.public')

@section('content')

    <div id="safeApp">
        <div class="jumbotron bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Manage Imports</h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ url('/admin/imports/tracked-links') }}">
                                Import Tracked Links
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ url('/admin/imports/access-the-deals') }}">
                                Import Access the Deals
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ url('/admin/imports/facebook-ad-metrics') }}">
                                Import Facebook Ad Metrics
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ url('/admin/imports/laurel-road-refinance-report') }}">
                                Import Laurel Road Refinance Report
                            </a>
                        </h3>
                    </div>
                    <div class="col-12 mb-3">
                        <h3>
                            <a href="{{ url('/admin/imports/disclosure-details-repayment-plans') }}">
                                Import Disclosure Details Repayment Plans
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
