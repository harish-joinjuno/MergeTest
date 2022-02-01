@php

    $enrollment_percentage = [];

    foreach($programs as $program){
        foreach($entrants as $entrant){
            if($program->university . " " . $program->degree == $entrant->uni_and_program){
                $enrollment_percentage[$program->program_name] = $entrant->total / $program->enrollment * 100;
            }
        }
    }

    arsort($enrollment_percentage);
    $enrollment_percentage = array_slice($enrollment_percentage,0,10);

@endphp

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6">
            <h3 class="mb-3">Scholarship Leaderboard</h3>
            <canvas id="scholarship-penetration-chart" width="400" height="200"></canvas>
        </div>

        <div class="col-12 col-md-6 justify-content-center align-self-center">
            <div class="align-middle">
                <h4>A random student from the program with the highest participation rate will be selected for the scholarship.</h4>

                <h4 class="mt-3">
                    <strong>Does your school have what it takes to win?</strong>
                </h4>

            </div>
        </div>

    </div>
</div>

@push('footer-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>

    <script>
        var ctx = document.getElementById("scholarship-penetration-chart");
        var scholarship_penetration_chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($enrollment_percentage as $name => $value)
                        "{{ $name }}",
                    @endforeach
                    // "Haas", "Stanford", "Booth", "Anderson", "Fuqua", "Sloan", "HBS", "Kellogg",
                ],
                datasets: [{
                    label: '# of Students',
                    data: [
                        @foreach($enrollment_percentage as $name => $value)
                        {{ number_format($value,1) }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        formatter: function(value, context) {
                            return value + "%";
                        },
                        textAlign: 'center'
                    }
                },

                legend:{
                    display: false
                },

                title: {
                    display: false,
                    text: 'Scholarship Leaderboard'
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function (value, index, values) {
                                return value + "%";
                            }
                        }
                    }]
                }
            }

        });
    </script>

@endpush
