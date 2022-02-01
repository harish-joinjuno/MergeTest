@php

    $enrollment_percentage = [];

    foreach($programs as $program){
        foreach($entrants as $entrant){
            if($program->university == $entrant->university){
                $enrollment_percentage[$program->program_name] = $entrant->total / $program->enrollment * 100;
            }
        }
    }

    arsort($enrollment_percentage);
    $enrollment_percentage = array_slice($enrollment_percentage,0,10);

@endphp

<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Who's in the group?</h3>
            <div class="separator"></div>
            <h5 class="mt--3">
                More than 2,000 students across top programs have already signed up for Juno.
            </h5>
        </div>

        <div class="d-none d-md-block col-md-8 offset-md-2">
            <p class="text-center mt-4">Percentage of students from each program who signed up for Juno</p>
            <canvas id="scholarship-penetration-chart" width="400" height="220"></canvas>
        </div>

        <div class="col-12 d-md-none">
            <p class="text-center mt-4">Percentage of students from each program who signed up for Juno</p>
            <canvas id="scholarship-penetration-chart-mobile" width="400" height="400"></canvas>
        </div>

    </div>
</div>

@push('footer-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>

    <script>
        var ctx = document.getElementById("scholarship-penetration-chart");
        var scholarship_penetration_chart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($enrollment_percentage as $name => $value)
                        "{{ $name }}",
                    @endforeach
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
                        'rgba(153, 102, 255, 0.2)',
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
                        'rgba(153, 102, 255, 1)',
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
                            return Math.round(value) + "%";
                        },
                        textAlign: 'center',
                        font: {
                            size: 14,
                            color: '#000'
                        }
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
                    xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function (value, index, values) {
                                return value + "%";
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 20
                        }
                    }]
                }
            }

        });
    </script>



    <script>
        var ctx_mobile = document.getElementById("scholarship-penetration-chart-mobile");
        var scholarship_penetration_chart = new Chart(ctx_mobile, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($enrollment_percentage as $name => $value)
                        "{{ $name }}",
                    @endforeach
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
                        'rgba(153, 102, 255, 0.2)',
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
                        'rgba(153, 102, 255, 1)',
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
                            return Math.round(value) + "%";
                        },
                        textAlign: 'center',
                        font: {
                            size: 14,
                            color: '#000'
                        }
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
                    xAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function (value, index, values) {
                                return value + "%";
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 16
                        }
                    }]
                }
            }

        });
    </script>

@endpush
