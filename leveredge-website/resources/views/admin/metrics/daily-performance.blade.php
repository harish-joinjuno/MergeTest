@extends('template.public')

@push('footer-scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endpush

@section('content')
    <div class="container">

        <div class="row mt-5">
            <div class="col-12">


                @include('admin.metrics._combined._combined_applied_and_signed_amounts_moving_average')
                @include('admin.metrics._table._refinance_summary_by_source')
                @include('admin.metrics._combined._combined_users_clicks_applied_and_signed_moving_average')

                <h3>
                    Refinance - Applied and Signed Loan ($) - 7 Day MVA - By Source
                </h3>
                @include('admin.metrics._combined._combined_refinance_applied_and_signed_loan_amounts_moving_average_by_source')

                <h3>
                    Total - User, Clicks, Applied and Signed Loans (#) - 7 Day MVA - By Source
                </h3>
                @include('admin.metrics._combined._combined_users_clicks_applied_and_signed_moving_average_by_source')

{{--                <h3>--}}
{{--                    Combined Refinance Applied and Signed Loan (#) - 7 Day MVA--}}
{{--                </h3>--}}
{{--                @include('admin.metrics._combined._combined_refinance_applied_and_signed_loans_moving_average_by_source')--}}

            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">

{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_signed_loan_amounts_by_day_by_source" role="button" aria-expanded="true" aria-controls="_refinance_signed_loan_amounts_by_day_by_source">--}}
{{--                        Refinance Signed Loan Amounts By Day By Source--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_signed_loan_amounts_by_day_by_source">--}}
{{--                @include('admin.metrics._by_source._refinance_signed_loan_amounts_by_day_by_source')--}}
{{--                </div>--}}

{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_signed_loan_amounts_by_day_by_source_moving_average" role="button" aria-expanded="true" aria-controls="_refinance_signed_loan_amounts_by_day_by_source_moving_average">--}}
{{--                        Refinance Signed Loan Amounts By Day By Source - 7 Day MVA--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_signed_loan_amounts_by_day_by_source_moving_average">--}}
{{--                @include('admin.metrics._by_source._refinance_signed_loan_amounts_by_day_by_source_moving_average')--}}
{{--                </div>--}}


{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_applied_loan_amounts_by_day_by_source" role="button" aria-expanded="true" aria-controls="_refinance_applied_loan_amounts_by_day_by_source">--}}
{{--                        Refinance Applied Loan Amounts By Day By Source--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_applied_loan_amounts_by_day_by_source">--}}
{{--                    @include('admin.metrics._by_source._refinance_applied_loan_amounts_by_day_by_source')--}}
{{--                </div>--}}

{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_applied_loan_amounts_by_day_by_source_moving_average" role="button" aria-expanded="true" aria-controls="_refinance_applied_loan_amounts_by_day_by_source_moving_average">--}}
{{--                        Refinance Applied Loan Amounts By Day By Source - 7 Day MVA--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_applied_loan_amounts_by_day_by_source_moving_average">--}}
{{--                    @include('admin.metrics._by_source._refinance_applied_loan_amounts_by_day_by_source_moving_average')--}}
{{--                </div>--}}


{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_signed_loans_by_day_by_source" role="button" aria-expanded="true" aria-controls="_refinance_signed_loans_by_day_by_source">--}}
{{--                        Refinance Signed Loans By Day By Source--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_signed_loans_by_day_by_source">--}}
{{--                    @include('admin.metrics._by_source._refinance_signed_loans_by_day_by_source')--}}
{{--                </div>--}}


{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_signed_loans_by_day_by_source_moving_average" role="button" aria-expanded="true" aria-controls="_refinance_signed_loans_by_day_by_source_moving_average">--}}
{{--                        Refinance Signed Loans By Day By Source - 7 Day MVA--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_signed_loans_by_day_by_source_moving_average">--}}
{{--                    @include('admin.metrics._by_source._refinance_signed_loans_by_day_by_source_moving_average')--}}
{{--                </div>--}}

{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_applied_loans_by_day_by_source" role="button" aria-expanded="true" aria-controls="_refinance_applied_loans_by_day_by_source">--}}
{{--                        Refinance Applied Loans By Day By Source--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_applied_loans_by_day_by_source">--}}
{{--                    @include('admin.metrics._by_source._refinance_applied_loans_by_day_by_source')--}}
{{--                </div>--}}

{{--                <h3>--}}
{{--                    <a data-toggle="collapse" href="#_refinance_applied_loans_by_day_by_source_moving_average" role="button" aria-expanded="true" aria-controls="_refinance_applied_loans_by_day_by_source_moving_average">--}}
{{--                        Refinance Applied Loans By Day By Source - 7 Day MVA--}}
{{--                    </a>--}}
{{--                </h3>--}}
{{--                <div class="collapse show graphs" id="_refinance_applied_loans_by_day_by_source_moving_average">--}}
{{--                    @include('admin.metrics._by_source._refinance_applied_loans_by_day_by_source_moving_average')--}}
{{--                </div>--}}

{{--                <h3>User Registrations By Day</h3>--}}
{{--                @include('admin.metrics._user_registrations')--}}
{{--                @include('admin.metrics._user_registrations_seven_day_moving_average')--}}

{{--                <h3>Clicks By Day</h3>--}}
{{--                @include('admin.metrics._clicks_by_day')--}}
{{--                @include('admin.metrics._clicks_by_day_seven_day_moving_average')--}}

{{--                <h3>Unique Clicks By Day</h3>--}}
{{--                @include('admin.metrics._unique_clicks_by_day')--}}
{{--                @include('admin.metrics._unique_clicks_by_day_seven_day_moving_average')--}}

{{--                <h3>Refinance User Registrations</h3>--}}
{{--                @include('admin.metrics._refinance_user_registrations')--}}
{{--                @include('admin.metrics._refinance_user_registrations_seven_day_moving_average')--}}

{{--                <h3>Total Signed Loans By Day</h3>--}}
{{--                @include('admin.metrics._signed_loans_by_day')--}}
{{--                @include('admin.metrics._signed_loan_amounts_by_day')--}}

{{--                <h3>Total Applied Loans By Day</h3>--}}
{{--                @include('admin.metrics._applied_loans_by_day')--}}
{{--                @include('admin.metrics._applied_loan_amounts_by_day')--}}

                <h3>Refinance Applied Loans ($) By Day</h3>
                @include('admin.metrics._refinance_applied_loan_amounts_by_day')

{{--                <h3>Refinance Signed Loans ($) By Day</h3>--}}
{{--                @include('admin.metrics._refinance_signed_loan_amounts_by_day')--}}

{{--                <h3>Refinance Signed Loans (#) By Day</h3>--}}
{{--                @include('admin.metrics._refinance_signed_loans_by_day')--}}
{{--                @include('admin.metrics._signed_loans_by_day_seven_day_moving_average')--}}

{{--                <h3>Refinance Applied Loans (#) By Day</h3>--}}
{{--                @include('admin.metrics._refinance_applied_loans_by_day')--}}


            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <h3>Summary</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Total</th>
                        <th>Unique Users</th>
                    </tr>
                    </thead>

                    <tr>
                        <td>Registrations</td>
                        <td colspan="2">{{ number_format($totalUsers) }}</td>
                    </tr>
                    <tr>
                        <td>Clicks to Deals</td>
                        <td>{{ number_format($totalDealClicks) }}</td>
                        <td>{{ number_format($totalUniqueDealClicks) }}</td>
                    </tr>
                    <tr>
                        <td>Beyond Deal Clicks</td>
                        <td>{{ number_format($totalBeyondClicks) }}</td>
                        <td>{{ number_format($totalUniqueBeyondClicks) }}</td>
                    </tr>
                    <tr>
                        <td>Signed $</td>
                        <td colspan="2">${{ number_format($totalSigned) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3>Performance By Deal</h3>
                <table class="table">
                    <tr>
                        <th style="width: 50%">Deal</th>
                        <th style="width: 12.5%">Clicks</th>
                        <th style="width: 12.5%">Beyond Clicks</th>
                        <th style="width: 12.5%">Signed or Certified #</th>
                        <th style="width: 12.5%">Signed or Certified $</th>
                    </tr>
                    @foreach($deals as $deal)
                    <tr>
                        <td>{{ $deal->name }}</td>
                        <td class="text-right">{{  array_key_exists($deal->name,$clicksByDeal) ? number_format($clicksByDeal[$deal->name]) : 0}}</td>
                        <td class="text-right">{{  array_key_exists($deal->name,$beyondClickByDeal) ? number_format($beyondClickByDeal[$deal->name]) : 0}}</td>
                        <td class="text-right">{{  array_key_exists($deal->name,$signedOrCertifiedByDeal) ? number_format($signedOrCertifiedByDeal[$deal->name]) : 0}}</td>
                        <td class="text-right">{{  array_key_exists($deal->name,$signedOrCertifiedAmountByDeal) ? number_format($signedOrCertifiedAmountByDeal[$deal->name]) : 0}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                @include('admin.metrics._combined._combined_users_clicks_applied_and_signed')
            </div>
        </div>



    </div>
@endsection




