<div id="_combined_users_clicks_applied_and_signed_moving_average"></div>

@push('footer-scripts')
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
                $keys = array_keys($combinedUsersClicksAppliedAndSignedMovingAverage->first());
                array_shift($keys);
            @endphp
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            @foreach($keys as $key)
            data.addColumn('number', '{{ $key }}');
            @endforeach
            data.addRows([
                @foreach($combinedUsersClicksAppliedAndSignedMovingAverage as $row)
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
                'title':'Users, Unique Clicks, Applied and Signed - 7 Day MVA',
                'height': 600
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('_combined_users_clicks_applied_and_signed_moving_average'));
            chart.draw(data, options);
        }
    </script>
@endpush
