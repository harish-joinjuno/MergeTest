@foreach($combinedRefinanceAppliedAndSignedLoanAmountsByDayBySourceMovingAverage as $index => $combinedRefinanceAppliedAndSignedLoanAmountsByDayForSourceMovingAverage)
    <div id="refinance_applied_and_signed_loan_amounts_by_day_{{ $loop->index }}"></div>
@endforeach

@push('footer-scripts')
    @foreach($combinedRefinanceAppliedAndSignedLoanAmountsByDayBySourceMovingAverage as $index => $combinedRefinanceAppliedAndSignedLoanAmountsByDayForSourceMovingAverage)
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            //Get Keys
            @php
                $keys = array_keys($combinedRefinanceAppliedAndSignedLoanAmountsByDayForSourceMovingAverage->first());
                array_shift($keys);
            @endphp
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            @foreach($keys as $key)
            data.addColumn('number', '{{ $key }}');
            @endforeach
            data.addRows([
                @foreach($combinedRefinanceAppliedAndSignedLoanAmountsByDayForSourceMovingAverage as $row)
                [
                    new Date('{{ $row['date']."T00:00:00.000-04:00"  }}'),
                    @foreach($keys as $key)
                    {{ $row[$key] ? $row[$key] : 0 }} @if(!$loop->last),@endif
                    @endforeach
                ],
                @endforeach
            ]);

            // Set chart options
            var options = {
                'title':'Refinance Applied and Signed Loans ($) (7 Day Moving Average) - {{ $index }}',
                'height': 600
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('refinance_applied_and_signed_loan_amounts_by_day_{{ $loop->index }}'));
            chart.draw(data, options);
        }
    </script>
    @endforeach
@endpush
