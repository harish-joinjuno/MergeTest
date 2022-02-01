<div id="refinance_user_registrations_moving_average"></div>

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

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            data.addColumn('number', 'Users Registered');
            data.addRows([
                @foreach($refinanceUserRegistrationByDayMovingAverageSevenDays as $row)
                [new Date('{{ $row['date']."T00:00:00.000-04:00"  }}'), {{ $row['total'] ? $row['total'] : 0 }}],
                @endforeach
            ]);

            // Set chart options
            var options = {'title':'Refinance Users Registrations (7 Day Moving Average)'};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('refinance_user_registrations_moving_average'));
            chart.draw(data, options);
        }
    </script>
@endpush
