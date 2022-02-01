@extends('template.public')

@push('footer-scripts')
    <script>
        $(document).ready(function() {
            const ajaxForm = $('.ajax-form');

            ajaxForm.on('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();
                const reportID = $(this).find('[name="laurel_road_refinance_report_id"]').val();

                $.ajax({
                    method: 'POST',
                    url: 'match-laurel-road-refinance-reports',
                    data: $(this).serialize(),
                    success: function() {
                        const rowsToDelete = $('[data-report-id="' + reportID + '"]');
                        rowsToDelete.remove();
                    }
                });

                return false;
            });
        });
    </script>
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <form method="get">
                    <div class="form-group">
                        <label for="limit">Limit</label>
                        <input type="number" class="form-control" name="limit" id="limit" value="{{ $limit }}"></input>
                    </div>

                    <div class="form-group">
                        <label for="amount_sensitivity">Amount Sensitivity</label>
                        <input type="number" class="form-control" name="amount_sensitivity" id="amount_sensitivity" value="{{ $amountSensitivity }}"></input>
                    </div>

                    <div class="form-group">
                        <label for="days_sensitivity">Days Sensitivity</label>
                        <input type="number" class="form-control" name="days_sensitivity" id="days_sensitivity" value="{{ $daysSensitivity }}"></input>
                    </div>

                    <div class="form-group">
                        <label for="hide_red_line">Hide Red Line</label>
                        <input type="number" min="0" max="1" class="form-control" name="hide_red_line" id="hide_red_line" value="{{ $hideRedLine }}"></input>
                    </div>

                    <div class="form-group">
                        <label for="show_only_signed">Show Only Signed</label>
                        <input type="number" min="0" max="1" class="form-control" name="show_only_signed" id="show_only_signed" value="{{ $showOnlySigned }}"></input>
                    </div>

                    <button type="submit" value="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <p>
                        Limit is set to {{ $limit }}. This means that we are only evaluating the first 100
                        laurel road reports that do not have an access the deal id already assigned. We put
                        a limit because this operation takes some juice from the database and I didn't want to
                        risk overloading it.
                    </p>

                    <p class="mt-3">
                        Amount sensitivity is set to {{ $amountSensitivity }}. This means that we are looking for
                        users who told us they want to refinance an amount that is +/- {{ $amountSensitivity }} of
                        the amount they requested from Laurel Road.
                    </p>

                    <p class="mt-3">
                        Days sensitivity is set to {{ $daysSensitivity }}. This means that we are looking for
                        users who clicked to Laurel Road upto and including {{ $daysSensitivity }} before the
                        application date provided by Laurel Road.
                    </p>

                    <p class="mt-3">
                        Each Red Line is the "end" of the potential matches for a given record from Laurel Road.
                    </p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <table class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th style="min-width: 175px;">App Date</th>
                            <th style="min-width: 175px;">Closed Date</th>
                            <th>App Amount</th>
                            <th>User ID</th>
                            <th style="min-width: 175px;">Access The Deal Date</th>
                            <th>User Reported Amount</th>
                            <th>Actions</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Utm Source</th>
                            <th>Utm Campaign</th>
                            <th>Utm Medium</th>
                            <th>Utm Content</th>
                            <th>Utm Term</th>
                            <th>Utm ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reportsWithoutMatches as $report)
                            @php
                                $potentialAccessTheDeals = $report->getPotentialAccessTheDealRecords($amountSensitivity,$daysSensitivity);
                            @endphp

                            @if($potentialAccessTheDeals->count())
                            @foreach($potentialAccessTheDeals as $accessTheDeal)
                            @php
                            /** @var \App\LaurelRoadRefinanceReport $report */
                            /** @var \App\AccessTheDeal $accessTheDeal */
                            @endphp
                            <tr data-report-id="{{ $report->id }}">
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->application_date->format('M jS') }}</td>
                                <td>{{ $report->closing_date ? $report->closing_date->format('M jS') : "" }}</td>
                                <td>{{ number_format($report->app_amount,0) }}</td>
                                <td>{{ $accessTheDeal->user_id }}</td>
                                @php
                                    $created_at_list = "";
                                    /** @var \App\AccessTheDeal $accessTheDeal */
                                    $dates = $accessTheDeal->user->accessTheDeals()->where('deal_id',14)->pluck('created_at');
                                    foreach($dates as $date){
                                        $created_at_list .= $date->format('M jS H:i') . "<br>";
                                    }
                                @endphp
                                <td>{!! $created_at_list  !!}</td>
                                <td>{{ number_format($accessTheDeal->user->negotiationGroupUsers->firstWhere('academic_year_id',1)->amount,0) }}</td>
                                <td>
                                    <form method="post" class="ajax-form">
                                        @csrf
                                        <input type="hidden" name="access_the_deal_id" value="{{ $accessTheDeal->id }}"></input>
                                        <input type="hidden" name="laurel_road_refinance_report_id" value="{{ $report->id }}"></input>
                                        <button type="submit" value="Submit">Select</button>
                                    </form>
                                </td>
                                <td>{{ $accessTheDeal->user->name }}</td>
                                <td>{{ $accessTheDeal->user->email }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_source }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_campaign }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_medium }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_content }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_term }}</td>
                                <td>{{ $accessTheDeal->user->profile->utm_id }}</td>
                            </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    <td>{{ $report->application_date->format('M jS') }}</td>
                                    <td>{{ $report->closing_date ? $report->closing_date->format('M jS') : "" }}</td>
                                    <td>{{ number_format($report->app_amount,0) }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                </tr>
                            @endif
                            @unless($hideRedLine)
                            <tr>
                                <td colspan="6" height="10" style="background-color: red"></td>
                            </tr>
                            @endunless
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


@endsection
