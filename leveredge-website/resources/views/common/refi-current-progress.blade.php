@php
    function custom_number_format($n, $precision = 1) {
            if ($n < 10000){
                // Anything less than 10K
                $n_format = number_format($n);
            } else if ($n < 1000000) {
                // Anything less than a million
                $n_format = number_format($n / 1000, $precision) . 'K';
            } else if ($n < 1000000000) {
                // Anything less than a billion
                $n_format = number_format($n / 1000000, $precision) . 'M';
            } else {
                // At least a billion
                $n_format = number_format($n / 1000000000, $precision) . 'B';
            }

            return $n_format;
        }
@endphp

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Negotiation Progress <span class="badge-pill badge badge-primary">Live Status</span> </h2>
            <div class="separator"></div>
        </div>
    </div>

    <div class="row mt--3">
        <div class="col-12 col-md-6 justify-content-center align-self-center">
            <div class="align-middle">
                <h4>Hundreds of students across top graduate programs have already joined the group. This represents <strong>more than ${{ custom_number_format($total_loan_amount) }}</strong> in loans under negotiation.</h4>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <canvas id="refi-penetration-chart" width="400" height="300"></canvas>
            <small>
                *8 universities with the largest number of students shown here.
            </small>
        </div>
    </div>
</div>

@php
    $wordlist = array("of", "university", "University");

    foreach ($wordlist as &$word) {
        $word = '/\b' . preg_quote($word, '/') . '\b/';
    }
@endphp

@push('footer-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>

    <script>
        var ctx = document.getElementById("refi-penetration-chart");
        var refi_penetration_chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($subscribers_by_school as $school)
                        "{{  preg_replace($wordlist, '', $school->university) }}",
                    @endforeach
                    // "Haas", "Stanford", "Booth", "Anderson", "Fuqua", "Sloan", "HBS", "Kellogg",
                ],
                datasets: [{
                    label: '# of Students',
                    data: [
                        @foreach($subscribers_by_school as $school)
                            {{ $school->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(183, 10, 255, 0.2)',
                        'rgba(203, 10, 25, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(183, 10, 255, 1)',
                        'rgba(203, 10, 25, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        formatter: function(value, context) {
                            return value;
                        },
                        textAlign: 'center'
                    }
                },

                legend:{
                    display: false
                },

                title: {
                    display: true,
                    text: '# of Students in Refinance Group*'
                },

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            callback: function (value, index, values) {
                                return value;
                            }
                        }
                    }]
                }
            }

        });





    </script>


@endpush
