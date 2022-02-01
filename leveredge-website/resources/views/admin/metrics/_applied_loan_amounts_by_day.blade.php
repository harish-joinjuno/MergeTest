<div id="applied_loan_amounts_by_day"></div>

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
            data.addColumn('number', 'Applied Loans $');
            data.addRows([
                @foreach($appliedLoanAmountsByDay as $row)
                [new Date('{{ $row['date']."T00:00:00.000-04:00"  }}'), {{ $row['total'] ? $row['total'] : 0 }}],
                @endforeach
            ]);

            // Set chart options
            var options = {'title':'Applied Loans $'};

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.LineChart(document.getElementById('applied_loan_amounts_by_day'));
            chart.draw(data, options);
        }
    </script>
@endpush