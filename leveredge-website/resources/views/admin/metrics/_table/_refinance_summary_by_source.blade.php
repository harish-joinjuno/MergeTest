@push('header-scripts')

    <style>
        #refinance_summary_by_source_table td:nth-child(1),
        #refinance_summary_by_source_table td:nth-child(4),
        #refinance_summary_by_source_table td:nth-child(7),
        #refinance_summary_by_source_table td:nth-child(10),
        #refinance_summary_by_source_table th:nth-child(1),
        #refinance_summary_by_source_table th:nth-child(4),
        #refinance_summary_by_source_table th:nth-child(7),
        #refinance_summary_by_source_table th:nth-child(10)
        {
            border-right: #0b0b0b 2px solid;
        }

        #refinance_summary_by_source_table th{
            border-top: #0b0b0b 2px solid;
            border-bottom: #0b0b0b 2px solid;
        }

        #refinance_summary_by_source_table td:nth-child(1),
        #refinance_summary_by_source_table th:nth-child(1)
        {
            border-left: #0b0b0b 2px solid;
        }

        #refinance_summary_by_source_table tr:last-child td{
            border-bottom: #0b0b0b 2px solid;
        }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
@endpush

@push('footer-scripts')
    <script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
@endpush

<div class="row mt-5">
    <div class="col-12">
        <h3>Refinance Summary By Source</h3>
        <table id="refinance_summary_by_source_table"
               class="table"
               data-toggle="table"
               data-sort-name="clicks_yesterday"
               data-sort-order="desc"
               data-show-footer="true">
            <thead>
            <tr>
                <th style="border-right: #0b0b0b 2px solid;"></th>
                <th style="border-right: #0b0b0b 2px solid;" colspan="3">Sign ups</th>
                <th style="border-right: #0b0b0b 2px solid;" colspan="3">Clicks / Sign ups</th>
                <th style="border-right: #0b0b0b 2px solid;" colspan="3">Clicks</th>
            </tr>
            <tr>
                <th data-sortable="true">Source</th>
                <th data-sortable="true">Yesterday</th>
                <th data-sortable="true">8 Days Ago</th>
                <th data-sortable="true">Delta</th>
                <th data-sortable="true">Yesterday</th>
                <th data-sortable="true">8 Days Ago</th>
                <th data-sortable="true">Delta</th>
                <th data-field="clicks_yesterday" data-sortable="true">Yesterday</th>
                <th data-sortable="true">8 Days Ago</th>
                <th data-sortable="true">Delta</th>
            </tr>
            </thead>

            <tbody>
            @php
                $maxPositive = ['sign_ups' => 0, 'clicks' => 0, 'clicks over signups' => 0];
                $maxNegative = ['sign_ups' => 0, 'clicks' => 0, 'clicks over signups' => 0];

            $totalSignupsYesterday = 0;
            $totalSignupsEightDaysAgo = 0;
            $totalClicksYesterday = 0;
            $totalClicksEightDaysAgo = 0;
            @endphp
            @foreach($sources as $source)
                @php
                    $source_id = $source->id;
                    $signupsYesterday = isset($refinanceSignUpsYesterdayBySource[$source_id]) ? $refinanceSignUpsYesterdayBySource[$source_id]->total : 0;
                    $signupsEightDaysAgo = isset($refinanceSignUpsEightDaysAgoBySource[$source_id]) ? $refinanceSignUpsEightDaysAgoBySource[$source_id]->total : 0;
                    $signupsDelta = $signupsYesterday - $signupsEightDaysAgo;
                    $clicksYesterday = isset($refinanceClicksYesterdayBySource[$source_id]) ? $refinanceClicksYesterdayBySource[$source_id]->total : 0;
                    $clicksEightDaysAgo = isset($refinanceClicksEightDaysAgoBySource[$source_id]) ? $refinanceClicksEightDaysAgoBySource[$source_id]->total : 0;
                    $clicksDelta = $clicksYesterday - $clicksEightDaysAgo;
                    $ratioYesterday = $signupsYesterday > 0 ? $clicksYesterday / $signupsYesterday : 'NaN';
                    $ratioEightDaysAgo = $signupsEightDaysAgo > 0 ? $clicksEightDaysAgo / $signupsEightDaysAgo : 'NaN';
                    $ratioDelta = is_numeric($ratioYesterday) && is_numeric($ratioEightDaysAgo) ? $ratioYesterday - $ratioEightDaysAgo : 'NaN';

                     $totalSignupsYesterday += $signupsYesterday;
                     $totalSignupsEightDaysAgo += $signupsEightDaysAgo;
                     $totalClicksYesterday += $clicksYesterday;
                     $totalClicksEightDaysAgo += $clicksEightDaysAgo;

                    $maxPositive['sign_ups'] = max( $maxPositive['sign_ups'] , $signupsDelta );
                    $maxNegative['sign_ups'] = abs (  min( -1*$maxNegative['sign_ups'] , $signupsDelta ) );
                    $maxPositive['clicks'] = max( $maxPositive['clicks'] , $clicksDelta );
                    $maxNegative['clicks'] = abs (  min( -1*$maxNegative['clicks'] , $clicksDelta ) );
                    $maxPositive['clicks over signups'] = is_numeric($ratioDelta) ? max( $maxPositive['clicks over signups'] , $ratioDelta ) : $maxPositive['clicks over signups'];
                    $maxNegative['clicks over signups'] = is_numeric($ratioDelta) ? abs (  min( -1*$maxNegative['clicks over signups'] , $ratioDelta ) ) : $maxNegative['clicks over signups'];
                @endphp

                <tr>
                    <td>{{ $source->name }}</td>
                    <td class="text-right">{{ is_numeric($signupsYesterday) ? number_format($signupsYesterday) : $signupsYesterday }}</td>
                    <td class="text-right">{{ is_numeric($signupsEightDaysAgo) ? number_format($signupsEightDaysAgo) : $signupsEightDaysAgo }}</td>
                    <td class="text-right sign_up_delta">{{ is_numeric($signupsDelta) ? number_format_with_sign($signupsDelta) : $signupsDelta}}</td>
                    <td class="text-right">{{ is_numeric($ratioYesterday) ? number_format($ratioYesterday*100)."%" : $ratioYesterday }}</td>
                    <td class="text-right">{{ is_numeric($ratioEightDaysAgo) ? number_format($ratioEightDaysAgo*100)."%" : $ratioEightDaysAgo }}</td>
                    <td class="text-right ratio_delta">{{ is_numeric($ratioDelta) ? number_format_with_sign($ratioDelta*100)."%" : $ratioDelta }}</td>
                    <td class="text-right">{{ is_numeric($clicksYesterday) ? number_format($clicksYesterday) : $clicksYesterday }}</td>
                    <td class="text-right">{{ is_numeric($clicksEightDaysAgo) ? number_format($clicksEightDaysAgo) : $clicksEightDaysAgo }}</td>
                    <td class="text-right clicks_delta">{{ is_numeric($clicksDelta) ? number_format_with_sign($clicksDelta) : $clicksDelta }}</td>
                </tr>
            @endforeach
            </tbody>

            @php

                $signupsDelta = $totalSignupsYesterday - $totalSignupsEightDaysAgo;
                $clicksDelta = $totalClicksYesterday - $totalClicksEightDaysAgo;
                $ratioYesterday = $totalSignupsYesterday > 0 ? $totalClicksYesterday / $totalSignupsYesterday : 'NaN';
                $ratioEightDaysAgo = $totalSignupsEightDaysAgo > 0 ? $totalClicksYesterday / $totalSignupsEightDaysAgo : 'NaN';
                $ratioDelta = is_numeric($ratioYesterday) && is_numeric($ratioEightDaysAgo) ? $ratioYesterday - $ratioEightDaysAgo : 'NaN';
            @endphp

            <tfoot>
            <tr>
                <td>Total</td>
                <td class="text-right">{{ is_numeric($totalSignupsYesterday) ? number_format($totalSignupsYesterday) : $totalSignupsYesterday }}</td>
                <td class="text-right">{{ is_numeric($totalSignupsEightDaysAgo) ? number_format($totalSignupsEightDaysAgo) : $totalSignupsEightDaysAgo }}</td>
                <td class="text-right sign_up_delta">{{ is_numeric($signupsDelta) ? number_format_with_sign($signupsDelta) : $signupsDelta}}</td>
                <td class="text-right">{{ is_numeric($ratioYesterday) ? number_format($ratioYesterday*100)."%" : $ratioYesterday }}</td>
                <td class="text-right">{{ is_numeric($ratioEightDaysAgo) ? number_format($ratioEightDaysAgo*100)."%" : $ratioEightDaysAgo }}</td>
                <td class="text-right ratio_delta">{{ is_numeric($ratioDelta) ? number_format_with_sign($ratioDelta*100)."%" : $ratioDelta }}</td>
                <td class="text-right">{{ is_numeric($totalClicksYesterday) ? number_format($totalClicksYesterday) : $totalClicksYesterday }}</td>
                <td class="text-right">{{ is_numeric($totalClicksEightDaysAgo) ? number_format($totalClicksEightDaysAgo) : $totalClicksEightDaysAgo }}</td>
                <td class="text-right clicks_delta">{{ is_numeric($clicksDelta) ? number_format_with_sign($clicksDelta) : $clicksDelta }}</td>
            </tr>
            </tfoot>

            @push('footer-scripts')
                <script>
                    $( document ).ready(function() {
                        $('.sign_up_delta').each(function(){
                            value = parseInt($(this).text());
                            if(value > 0){
                                transparency = value / {{ $maxPositive['sign_ups'] }};
                                $(this).css('background-color','rgba(0,255,0,' + transparency +')');
                            }else{
                                transparency = Math.abs(value / {{ $maxNegative['sign_ups'] }}) ;
                                $(this).css('background-color','rgba(255,0,0,' + transparency +')');
                            }
                        });

                        $('.clicks_delta').each(function(){
                            value = parseInt($(this).text());
                            if(value > 0){
                                transparency = value / {{ $maxPositive['clicks'] }};
                                $(this).css('background-color','rgba(0,255,0,' + transparency +')');
                            }else{
                                transparency = Math.abs(value / {{ $maxNegative['clicks'] }}) ;
                                $(this).css('background-color','rgba(255,0,0,' + transparency +')');
                            }
                        });

                        $('.ratio_delta').each(function(){
                            value = parseInt($(this).text());
                            if(Number.isInteger(value)){
                                if(value > 0){
                                    transparency = value / {{ $maxPositive['clicks over signups']*100 }};
                                    $(this).css('background-color','rgba(0,255,0,' + transparency +')');
                                }else{
                                    transparency = Math.abs(value / {{ $maxNegative['clicks over signups']*100 }}) ;
                                    $(this).css('background-color','rgba(255,0,0,' + transparency +')');
                                }
                            }
                        });
                    });
                </script>
                @endpush
        </table>


    </div>
</div>
