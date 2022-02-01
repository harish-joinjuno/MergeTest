@extends('template.public')

@section('content')

    <div class="jumbotron bg-white">
        <div id="safeApp">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>
                            <a href="{{ url('admin/dashboard') }}">Back</a>
                        </h3>
                    </div>
                </div>


                @if(\Illuminate\Support\Facades\Session::has('failed_imports'))
                <div class="row mt-4">
                    <div class="col">
                        <h4>Failed Imports</h4>
                        @foreach(\Illuminate\Support\Facades\Session::get('failed_imports') as $policy_number => $status)
                        <div class="alert alert-danger mb-4">
                            Policy Number: {{ $policy_number }} <br>
                            Error Message: {{ $status }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(count($unmatchedReports) > 0)
                <div class="row mt-4">
                    <div class="col">
                        <h3>Unmatched Reports</h3>

                        @php
                        /** @var \App\GbgReport[] $unmatchedReports */
                        /** @var \App\GbgReport $unmatchedReport */
                        @endphp
                        @foreach($unmatchedReports as $unmatchedReport)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Policy Number</th>
                                <th>Name</th>
                                <th colspan="2">Added to Database On</th>
                                <th>Premium Amount</th>
                            </tr>

                            <tr>
                                <td>{{ $unmatchedReport->policy_number }}</td>
                                <td>{{ $unmatchedReport->policy_holder }}</td>
                                <td colspan="2">{{ $unmatchedReport->created_at->format('M d, Y') }}</td>
                                <td>{{ $unmatchedReport->premium_amount }}</td>
                            </tr>

                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>First Click Date</th>
                                <th>Last Click Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unmatchedReport->getPotentialMatches() as $user)
                                @php
                                    /** @var \App\User $user */
                                    /** @var \App\AccessTheDeal $firstClick */
                                    /** @var \App\AccessTheDeal $lastClick */
                                    $firstClick = $user->accessTheDeals()->where('deal_id',\App\Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID)->orderBy('id')->first();
                                    $lastClick = $user->accessTheDeals()->where('deal_id',\App\Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20_ID)->orderBy('id','desc')->first();
                                @endphp
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $firstClick->created_at->format('M d, Y') }}</td>
                                    <td>{{ $lastClick->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form method="post" action="{{ url('admin/gbg/match') }}">
                                            @csrf
                                            <input type="hidden" name="access_the_deal_id" value="{{ $lastClick->id }}"></input>
                                            <input type="hidden" name="gbg_report_id" value="{{ $unmatchedReport->id }}"></input>
                                            <button type="submit" value="Submit">Select</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @endforeach

                    </div>
                </div>
                @endif

                <div class="row mt-4">
                    <div class="col">
                        <div class="header">
                            <h1 class="h1">Import GBG Report</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h3>
                            Upload Report
                        </h3>
                        <form method="post" action="{{ route('gbg.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input id="file-input" name="template_file" type="file"></input>
                            </div>

                            <button type="submit" id="submit-upload" class="d-none btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#file-input').change(function () {
                $('#submit-upload').removeClass('d-none');
            })
        })
    </script>
@endpush

