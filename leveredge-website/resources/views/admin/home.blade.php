@extends('template.public')

@section('content')
    <div id="admin-dashboard">
        <div id="safeApp">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/marketing-emails') }}">Marketing Emails</a></h4>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/credible-attribution-issues') }}">Credible Attribution Issues</a></h4>
                                <h4><a href="{{ url('/admin/credible-attribution-issues-v2') }}">Credible Attribution Issues V2</a></h4>
                                <h4><a href="{{ url('/admin/credible-attribution-potential-cases') }}">Credible Attribution Potential Cases</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/partners/create') }}">Partners</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/view-user-by-phone-number') }}">View SMS Messages</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/nova') }}">Nova</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/horizon') }}">Horizon</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/imports') }}">Imports</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/missing-access-the-deals-dates') }}">Missing Access The Deals Dates</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/metrics') }}">Metrics</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/exports/checkbook') }}">Checkbook Export</a></h4>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h4><a href="{{ url('/admin/exports/magic-links') }}">Magic Link Export</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
