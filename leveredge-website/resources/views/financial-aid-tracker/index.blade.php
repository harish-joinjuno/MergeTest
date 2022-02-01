@extends('template.public')

@push('header-scripts')
    <!--suppress VueDuplicateTag -->
    <style>
        h2{
            font-size: 32px;
            text-transform: none;
            line-height: 1.25;
        }

        h5{
            line-height: 1.5;
        }

        .container{
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .container.first-container{
            padding-top: 60px;
            padding-bottom: 60px;
        }


    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" type="text/css" rel="stylesheet">
@endpush

@section('content')

    <div id="safeApp">

        <div class="container first-container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="text-center">MBA Financial Aid Tracker</h1>
                    <h5 class="mt-3 text-center">
                        Did you know people with similar profiles can get different financial aid offers from the same school?
                    </h5>
                    <h5 class="text-center mt-3 mt-md-0">
                        We’re helping incoming business school students compare their financial aid award letters.
                    </h5>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center form-group">
                <div class="col-12">
                    <h2 class="mb-4">Explore Financial Aid Offers by School</h2>
                    <university-filter :universities='@json($universities)'></university-filter>
                    <div class="pt-5 pb-3"></div>
                    <canvas id="universityAidAmountChart"></canvas>
                    <div class="pt-3"></div>
                </div>
            </div>
        </div>

        <report-aid-offers-form
            :universities='@json($universities)'
            :action='@json(route('financial-aid-tracker.store'))'
            :immigration_status_options='@json(config('constant.immigration_status_options'))'
        ></report-aid-offers-form>

    </div>
@endsection

@push('footer-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <script type="text/javascript">
        let dataPoints      = {!! $dataPoints !!};
        let universityNames = {!! $universityNames !!};
        let medians         = {!! $medians !!};


        if ($(window).width() <= 768) {
            universityNames = universityNames.slice(0,3);
            dataPoints = dataPoints.filter(function(dataPoint){
                return dataPoint.x < 3
            });
            medians = medians.slice(0,3);
        }

        buildChart(dataPoints, universityNames, medians, '#universityAidAmountChart');

        function buildChart(dataPoints, universityNames, medians, canvas_id) {

            let aspectRatio = 0;
            if ($(window).width() <= 768) {
                aspectRatio     = 1;
            }else{
                aspectRatio     = 3;
            }

            dataPoints.forEach(function(dataPoint){
               dataPoint.x = dataPoint.x + 1;
            });
            medians.forEach(function(median){
                median.x = median.x + 1;
            });
            universityNames.unshift('');
            universityNames.push('');

            let ctx = document.getElementById(canvas_id.slice(1))
            if (ctx && ctx.universityAidAmountChart) {
                ctx.universityAidAmountChart.destroy()
            }
            ctx.universityAidAmountChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [
                        {
                            label: 'Aid Amount',
                            data: dataPoints,
                            pointRadius: 6,
                            hoverPointRadius: 10,
                            backgroundColor: 'rgba(59, 97, 227, 0.1)',
                            borderColor: 'rgba(0, 0, 0, 0)',
                        },
                        {
                            label: 'Median Aid Amount',
                            data: medians,
                            pointStyle: 'line',
                            borderColor: 'rgb(255,161,80,1)',
                            borderWidth: 5,
                            hoverBorderWidth: 5,

                            pointRadius: 15,
                            hoverPointRadius: 15,
                            radius: 15,
                            hoverRadius: 15,
                            backgroundColor: 'rgb(255,161,80,1)',
                        },
                    ]
                },
                options: {
                    aspectRatio: aspectRatio,
                    legend:{
                        onClick: function(){

                        },
                        labels:{
                            fontSize: 14,
                            filter: function(item, chart){
                                return item.text.includes('Median Aid Amount');
                            }
                        },
                        display: true,
                    },
                    tooltips: {
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';

                                if (label) {
                                    label += ': ';
                                }
                                label += '$ ' + Math.round(tooltipItem.yLabel) / 1000 + 'K';
                                return label;
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            type: 'linear',
                            ticks: {
                                autoSkip: false,
                                fontSize: 16,
                                min: 0,
                                max: universityNames.length - 1,
                                stepSize: 1,
                                callback: function (value) {
                                    label = universityNames[value];
                                    if (/\s/.test(label)) {
                                        return label.split(" ");
                                    }else{
                                        return label;
                                    }
                                },
                                minRotation: 0,
                                maxRotation: 0
                            },
                            gridLines: {
                                display:true,
                                drawBorder: true,
                                drawOnChartArea: false,
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 200000,
                                callback: function (value) {
                                    return  '$' + (value / 1000) + 'K';
                                },
                            },
                            gridLines: {
                                display:true,
                                drawBorder: true,
                                drawOnChartArea: false,
                            }
                        }]
                    }
                }
            });
        }
    </script>
@endpush
