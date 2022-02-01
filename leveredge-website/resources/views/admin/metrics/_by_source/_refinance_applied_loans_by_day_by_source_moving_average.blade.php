@foreach($refinanceAppliedLoansByDayBySourceMovingAverage as $index => $refinanceAppliedLoansByDayForSourceMovingAverage)
<div id="refinance_applied_loans_by_day_moving_average_{{ $loop->index }}"></div>
@endforeach

@push('footer-scripts')
    @foreach($refinanceAppliedLoansByDayBySourceMovingAverage as $index => $refinanceAppliedLoansByDayForSourceMovingAverage)
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
            data.addColumn('number', 'Refinance Applied Loans');
            data.addRows([
                @foreach($refinanceAppliedLoansByDayForSourceMovingAverage as $row)
                [new Date('{{ $row['date']."T00:00:00.000-04:00"  }}'), {{ $row['total'] ? $row['total'] : 0 }}],
                @endforeach
            ]);

            // Set chart options
            var options = {'title':'Refinance Applied Loans # - {{ $index }} - 7 Day MVA'};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById("refinance_applied_loans_by_day_moving_average_{{ $loop->index }}"));
            chart.draw(data, options);
        }
    </script>
    @endforeach
@endpush
