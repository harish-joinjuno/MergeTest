@extends('template.public')

@section('content')

    <div class="container pb-0 pt-0 mt-4">
        <div class="row">
            <div class="col-12">
                <h2>How much will it cost your children to go to {{ $university->university_name }}?</h2>
                <div class="separator"></div>
            </div>
            <div class="col-12 col-md-6 mt--3">
                <canvas id="four-year-tuition-and-fees"></canvas>
            </div>
            <div class="col-12 mt-3 col-md-6 mt-md-0 justify-content-center align-self-center">
                <h5>If you are a Freshman at {{ $university->university_name }} today, your child could pay an estimated

                    @if($university->getAttribute('3_year_CAGR') < $university->getAttribute('10_year_CAGR') )
                        ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR*4/1000) }}K
                     to
                        ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR*4/1000) }}K
                    @else
                        ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR*4/1000) }}K
                    @endif



                    for tuition and fees, in today’s dollars, to attend the same school. That's @if( $university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR > $university->tuition_in_2017_18_in_2019_dollars ) an increase @else a decrease @endif of ${{ round( ($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR - $university->tuition_in_2017_18_in_2019_dollars)*4/1000) }}K compared to the cost today.</h5>


                    @if($university->getAttribute('3_year_CAGR') < $university->getAttribute('10_year_CAGR'))
                    <p class="text-muted mb-0" style="font-size: 14px;">
                        Estimate 1 is based on the school's average tuition increase over the last 10 years.
                    </p>
                    <p class="text-muted mt-2 mt-md-0" style="font-size: 14px;">
                        Estimate 2 is based on the school's average tuition increase over the last 3 years.
                    </p>
                    @else
                        <p class="text-muted" style="font-size: 14px;">
                            Estimate is based on the school's average tuition increase over the last 3 years.
                        </p>
                    @endif

            </div>
        </div>
    </div>


    {{--<div class="container d-none d-md-block">--}}
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<h2>How did we get here? Scroll down to learn more.</h2>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    <div class="container pb-0">
        <div class="row">
            <div class="col-12">
                <h2>Annual Inflation vs. Tuition Change at {{ $university->university_name }}</h2>
                <div class="separator"></div>
            </div>
        </div>
        <div class="row mt--3">
            <div class="col-12 col-md-8">
                <canvas id="annual-inflation-vs-tuition-change"></canvas>
            </div>
            <div class="col-12 mt-3 col-md-4 mt-md-0 justify-content-center align-self-center">
                <h5>For the past decade, annual inflation has averaged 1.8%, while {{ $university->university_name }} has @if($university->getAttribute('10_year_CAGR') > 0) increased @else decreased @endif costs {{ round($university->getAttribute('10_year_unadjusted_CAGR')*100, 1)  }}% per year.</h5>
            </div>
        </div>


    </div>
    <div class="container pb-0">


        <div class="row mt-5">
            <div class="col-12">
                <h2>{{ $university->university_name }} Annual Tuition in 2019 Dollars</h2>
                <div class="separator"></div>
            </div>
        </div>
        <div class="row mt--3">
            <div class="col-12 col-md-6">
                <canvas id="tuition-over-time"></canvas>
            </div>
            <div class="col-12 mt-3 col-md-6 mt-md-0 justify-content-center align-self-center">
                <h5>After adjusting for inflation, {{ $university->university_name }} tuition & fees are @if($university->getAttribute('10_year_CAGR') > 0) up @else down @endif {{ round( ((($university->tuition_in_2017_18_in_2019_dollars / $university->tuition_in_2007_08_in_2019_dollars) - 1)*100) , 1)  }}% over the past decade</h5>
            </div>
        </div>


    </div>
    <div class="container">
        <div class="row mt-5 d-none d-md-flex">
            <div class="col-md-12">
                <h2 class="mb-0">Projected Tuition & Fees Over Time</h2>
                <div class="separator"></div>
            </div>
            <div class="col-md-8">
                <canvas id="tuition-over-time-extended"></canvas>
            </div>
            <div class="col-md-4 justify-content-center align-self-center">
                <h5>
                    If you are a Freshman today, your child will pay @if($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR > $university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR) ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR/1000) }}K to ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR/1000) }}K @else ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR/1000) }}K to ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR/1000) }}K @endif  / year, in today’s dollars, to attend {{ $university->university_name }}.
                </h5>
                <p class="text-muted mb-0" style="font-size: 14px;">
                    Estimate 1 is based on the school's average tuition increase over the last 10 years.
                </p>
                <p class="text-muted mt-2 mt-md-0" style="font-size: 14px;">
                    Estimate 2 is based on the school's average tuition increase over the last 3 years.
                </p>
            </div>
        </div>


        <div class="row mt-4 d-flex d-md-none">
            <div class="col-12">
                <h2>Projected Tuition & Fees Over Time</h2>
                <div class="separator"></div>
                <canvas id="tuition-over-time-extended-mobile"></canvas>
            </div>

            <div class="col-12">
                <h5>
                    If you are a Freshman today, your child will pay @if($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR > $university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR) ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR/1000) }}K to ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR/1000) }}K @else ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR/1000) }}K to ${{ round($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR/1000) }}K @endif  / year, in today’s dollars, to attend {{ $university->university_name }}.
                </h5>

                <p class="text-muted mb-0" style="font-size: 14px;">
                    Estimate 1 is based on the school's average tuition increase over the last 10 years.
                </p>
                <p class="text-muted mt-2 mt-md-0" style="font-size: 14px;">
                    Estimate 2 is based on the school's average tuition increase over the last 3 years.
                </p>
            </div>

        </div>

    </div>



    @include('data.university-financial.select-university')

    @include('data.university-financial.how-we-got-there')


@endsection


@push('footer-scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
    <script src="{{ url('/lib/chartjs-plugin-annotation/chartjs-plugin-annotation.js') }}"></script>

    <script>

        var ctx_1 = document.getElementById("four-year-tuition-and-fees");
        var ctx_2 = document.getElementById("annual-inflation-vs-tuition-change");
        var ctx_3 = document.getElementById("tuition-over-time");
        var ctx_4 = document.getElementById("tuition-over-time-extended").getContext('2d');
        var ctx_5 = document.getElementById("tuition-over-time-extended-mobile").getContext('2d');

        var color_helper = {
            red: 'rgba(192,0,0,1)',
            blue: 'rgba(0,0,255,1)',
            green: 'rgba(0,255,0,1)',
            white: '#FFF',
            black: '#000',
            light_blue: 'rgba(0,0,255,0.3)',
            light_red: 'rgba(255, 99, 132, 1)',
            annotation_border: 'rgb(68,84,106)'
        };

        ctx_1_options = {

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                }
            },

            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    filter: function(item, chart){
                        return !item.text.includes('Total');
                    }
                }
            },

            // title: {
            //     display: true,
            //     text: "{{ $university->university_name }} Tuition & Fees for 4 years",
            //     fontSize: 24,
            //     fontColor: color_helper.black,
            //     padding: 50
            // },

            tooltips: {
                enabled: false
            },

            scales:{

                xAxes:[{
                    stacked: true
                }],

                yAxes:[{
                    display: false,
                    stacked: true,
                    ticks:{
                        beginAtZero: true
                    }
                }]

            },

            plugins: {
                datalabels: {

                    anchor: function(context){


                        if(context.datasetIndex == 0 || context.datasetIndex == 1){
                            return 'center';
                        }else{
                            if(context.datasetIndex == 2){
                                return 'end';
                            }
                        }
                    },


                    align: function(context){
                        if(context.datasetIndex == 0 || context.datasetIndex == 1){
                            return 'center';
                        }else{
                            if(context.datasetIndex == 2){
                                return 'end';
                            }
                        }
                    },


                    offset: function(context){
                        if(context.datasetIndex == 0 || context.datasetIndex == 1){
                            return 0;
                        }else{
                            if(context.datasetIndex == 2){
                                return 5;
                            }
                        }
                    },


                    formatter: function(value, context){

                        if(context.datasetIndex == 0 || context.datasetIndex == 1){
                            return '$' + Math.round(value) + 'K';
                        }else{
                            if(context.datasetIndex == 2){
                                // return four_year_tuition_and_fees.data.datasets[0].data[context.dataIndex];
                                return '$' + Math.round((context.chart.data.datasets[0].data[context.dataIndex] + context.chart.data.datasets[1].data[context.dataIndex])) + 'K';
                            }
                        }
                    },
                    color: color_helper.black,
                    textAlign: 'center',
                    font: {
                        weight: 'bold'
                    }
                },
            }
        };

        ctx_1_data = {

            @if($university->getAttribute('3_year_CAGR') < $university->getAttribute('10_year_CAGR'))
            labels: ['Estimate 1', 'Estimate 2'],
            @endif

            datasets: [

                {
                    label: 'Base Cost',
                    data: [
                        {{ $university->tuition_in_2017_18_in_2019_dollars*4/1000 }},
                        @if($university->getAttribute('3_year_CAGR') < $university->getAttribute('10_year_CAGR'))
                        {{ $university->tuition_in_2017_18_in_2019_dollars*4/1000 }}
                        @endif
                    ],
                    backgroundColor: color_helper.light_blue,
                    borderColor: color_helper.blue,
                    borderWidth: 2
                },
                {
                    label: 'Incremental Cost',
                    data: [
                        {{ ($university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR - $university->tuition_in_2017_18_in_2019_dollars)*4/1000 }},
                        @if($university->getAttribute('3_year_CAGR') < $university->getAttribute('10_year_CAGR'))
                        {{ ($university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR - $university->tuition_in_2017_18_in_2019_dollars)*4/1000 }},
                        @endif
                    ],
                    backgroundColor: color_helper.light_red,
                    borderColor: color_helper.red,
                    borderWidth: 2
                },
                {
                    label: 'Total',
                    data: [0, 0],
                    backgroundColor: color_helper.light_blue,
                    borderColor: color_helper.blue,
                    borderWidth: 2
                }

            ]

        };

        ctx_2_options = {

            aspectRatio: 1.5,

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                }
            },

            legend: {
                display: true,
                position: 'bottom'
            },

            // title: {
            //     display: true,
            //     text: "Annual Inflation vs. Tuition Change: {{ $university->university_name }}",
            //     fontSize: 24,
            //     fontColor: color_helper.black,
            //     padding: 20
            // },

            tooltips: {
                enabled: false
            },

            scales: {

                xAxes: [{

                    scaleLabel: {
                        display: true,
                        labelString: 'Academic Year'
                    },

                    ticks:{
                        minRotation: 90,
                        maxRotation: 90
                    }

                }],

                yAxes: [{

                    display: false,

                    ticks: {
                        beginAtZero: true,

                        callback: function(value){
                            return  value + '%';
                        }
                    },

                    gridLines:{
                        display: false
                    }
                }]
            },

            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    offset: 5,
                    formatter: function(value, context){

                        if(context.chart.width >400 ){
                            return Math.round(value*10)/10  + '%';
                        }
                        return Math.round(value) + '%';


                    },
                    color: color_helper.black,
                    textAlign: 'center',
                    font: {
                        size: 10,
                        weight: 'bold'
                    }
                },
            }
        };

        ctx_2_data = {
            labels: ['2008-09', '2009-10', '2010-11', '2011-12', '2012-13', '2013-14', '2014-15', '2015-16', '2016-17', '2017-18'],
            datasets:[
                {
                    label: 'Annual Tuition Increase',
                    data: [{{ $university->nominal_tuition_inflation_in_2008_09*100 }}, {{ $university->nominal_tuition_inflation_in_2009_10*100 }}, {{ $university->nominal_tuition_inflation_in_2010_11*100 }}, {{ $university->nominal_tuition_inflation_in_2011_12*100 }}, {{ $university->nominal_tuition_inflation_in_2012_13*100 }}, {{ $university->nominal_tuition_inflation_in_2013_14*100 }}, {{ $university->nominal_tuition_inflation_in_2014_15*100 }}, {{ $university->nominal_tuition_inflation_in_2015_16*100 }}, {{ $university->nominal_tuition_inflation_in_2016_17*100 }}, {{ $university->nominal_tuition_inflation_in_2017_18*100 }}],
                    backgroundColor: color_helper.light_blue,
                    borderColor: color_helper.blue,
                    borderWidth: 2
                },
                {
                    label: 'Inflation',
                    data: [2.5, 1.7, 1.6, 1.0, 2.3, 1.9, 1.6, 1.6, 2.2, 2.3],
                    backgroundColor: color_helper.light_red,
                    borderColor: color_helper.red,
                    borderWidth: 2
                }
            ]
        };

        ctx_3_options = {

            aspectRatio: 1.8,

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 30,
                    bottom: 0
                }
            },

            legend: {
                display: false
            },

            // title: {
            //     display: true,
            //     text: "{{ $university->university_name }} Tuition in 2019 Dollars",
            //     fontSize: 24,
            //     fontColor: color_helper.black,
            //     padding: 20
            // },

            tooltips: {
                enabled: false
            },

            scales: {

                xAxes: [{

                    scaleLabel: {
                        display: true,
                        labelString: 'Academic Year'
                    },

                    ticks:{
                        minRotation: 90,
                        maxRotation: 90
                    }

                }],

                yAxes: [{

                    ticks: {
                        beginAtZero: true,

                        callback: function(value){
                            return  '$' + value/1000 + 'K';
                        }
                    },

                    gridLines:{
                        display: false
                    }
                }]
            },

            plugins: {
                datalabels: {

                    anchor: 'end',
                    align: 'end',
                    offset: 5,

                    formatter: function(value, context){
                        return '$' + Math.round(value / 1000)  + 'K';
                    },

                    color: color_helper.black,
                    textAlign: 'center',
                    font: {
                        weight: 'bold'
                    }


                },
            }

        };

        ctx_3_data = {

            labels: ['2007-08' ,'2008-09', '2009-10', '2010-11', '2011-12', '2012-13', '2013-14', '2014-15', '2015-16', '2016-17', '2017-18'],

            datasets:[{
                label: '{{ $university->university_name }} Tuition in 2019 Dollars',
                data: [{{ $university->tuition_in_2007_08_in_2019_dollars }}, {{ $university->tuition_in_2008_09_in_2019_dollars }}, {{ $university->tuition_in_2009_10_in_2019_dollars }}, {{ $university->tuition_in_2010_11_in_2019_dollars }}, {{ $university->tuition_in_2011_12_in_2019_dollars }}, {{ $university->tuition_in_2012_13_in_2019_dollars }}, {{ $university->tuition_in_2013_14_in_2019_dollars }}, {{ $university->tuition_in_2014_15_in_2019_dollars }}, {{ $university->tuition_in_2015_16_in_2019_dollars }}, {{ $university->tuition_in_2016_17_in_2019_dollars }}, {{ $university->tuition_in_2017_18_in_2019_dollars }}],
                backgroundColor: color_helper.light_blue,
                borderColor: color_helper.blue,
                borderWidth: 2
            }]

        };

        ctx_4_options = {

            aspectRatio: 1.5,

            legend: {
                display: true,
                position: 'bottom'
            },

            tooltips: {
                enabled: true,

                callbacks:{
                    label: function(tooltipItem, data){


                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += '$' + Math.round(tooltipItem.yLabel * 10) / 10 + 'K';
                        return label;
                    }
                }

            },

            layout: {
                padding: {
                    left: 0,
                    right: 100,
                    top: 100,
                    bottom: 0
                }
            },

            plugins: {
                datalabels: {

                    // Only show Datalabels for 1 Dataset and 2018, 2028 and 2046 years
                    // 0 is 10 year, 1 is 3 year
                    display: function(context){
                        if(context.chart.width > 400){
                            if((context.dataIndex == 5 || context.dataIndex == 10 || context.dataIndex == 19) && context.datasetIndex == @if($university->getAttribute('3_year_CAGR') > $university->getAttribute('10_year_CAGR')) 1 @else 0 @endif ){
                                return context.dataset.data[context.dataIndex];
                            }else{
                                return false;
                            }
                        }else{
                            return false;
                        }
                    },

                    anchor: 'end',
                    align: 'end',
                    offset: 20,

                    formatter: function(value, context){

                        if(context.dataIndex == 5){
                            return 'Freshman Year:\n18 years old'
                        }

                        if(context.dataIndex == 10){
                            return 'Have a Kid:\n28 years old'
                        }

                        if(context.dataIndex == 19){
                            return 'Kid goes to College:\n18 years later'
                        }

                    },

                    backgroundColor: '#FFF',
                    borderColor: color_helper.annotation_border,
                    borderWidth: 2,
                    padding: 10,
                    color: color_helper.black,
                    textAlign: 'center',
                    font: {
                        lineHeight: 1.5,
                        weight: 'bold'
                    }


                },
            },

            scales: {
                yAxes: [{
                    // id: 'y-axis-0',

                    beginAtZero: true,

                    ticks: {
                        callback: function(value){
                            return  '$' + value + 'K';
                        }
                    },

                    gridLines:{
                        display: true
                    }
                }],

                xAxes: [{

                    // id: 'x-axis-0',

                    ticks: {
                        padding: 10
                    },

                    gridLines:{
                        display: true,
                        color: ['rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000'],

                        lineWidth: 2,
                        borderDash: [15,5],
                        tickMarkLength: 5
                    }
                }]
            }
        };

        ctx_4_data = {
            labels: ['2008-09', '2010-11', '2012-13', '2014-15', '2016-17', '2018-19', '2020-21', '2022-23', '2024-25', '2026-27', '2028-29', '2030-31', '2032-33', '2034-35', '2036-37', '2038-39', '2040-41', '2042-43', '2044-45', '2046-47'],
            datasets: [
                {
                    label: 'Estimate 1',
                    data: [
                        {{ $university->tuition_in_2008_09_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2010_11_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2012_13_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2014_15_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2016_17_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2018_19_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2020_21_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2022_23_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2024_25_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2026_27_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2028_29_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2030_31_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2032_33_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2034_35_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2036_37_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2038_39_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2040_41_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2042_43_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2044_45_in_2019_dollars_using_ten_year_CAGR/1000 }},
                        {{ $university->tuition_in_2046_47_in_2019_dollars_using_ten_year_CAGR/1000 }}
                    ],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color_helper.red,
                    borderWidth: 2,
                    lineTension: 0,

                    pointBackgroundColor: '#FFF',
                    pointBorderColor: color_helper.red,
                    pointBorderWidth: 2,
                    pointRadius: [ 0 , 0, 0, 0, 0, 6, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 6],

                    pointHoverBackgroundColor: color_helper.red,
                    pointHoverBorderColor: color_helper.red,
                    pointHoverBorderWidth: 2,
                    pointHoverRadius: [ 0 , 0, 0, 0, 0, 6, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 6]
                },

                {
                    label: 'Estimate 2',
                    data: [
                        {{ $university->tuition_in_2008_09_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2010_11_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2012_13_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2014_15_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2016_17_in_2019_dollars/1000 }},
                        {{ $university->tuition_in_2018_19_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2020_21_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2022_23_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2024_25_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2026_27_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2028_29_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2030_31_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2032_33_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2034_35_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2036_37_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2038_39_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2040_41_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2042_43_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2044_45_in_2019_dollars_using_three_year_CAGR/1000 }},
                        {{ $university->tuition_in_2046_47_in_2019_dollars_using_three_year_CAGR/1000 }}
                    ],
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    borderColor: color_helper.blue,
                    borderWidth: 2,
                    lineTension: 0,

                    pointBackgroundColor: '#FFF',
                    pointBorderColor: color_helper.blue,
                    pointBorderWidth: 2,
                    pointRadius: [ 0 , 0, 0, 0, 0, 6, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 6],

                    pointHoverBackgroundColor: color_helper.blue,
                    pointHoverBorderColor: color_helper.blue,
                    pointHoverBorderWidth: 2,
                    pointHoverRadius: [ 0 , 0, 0, 0, 0, 6, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0, 6]
                }
            ]
        };

        ctx_5_options = {

            aspectRatio: 1.2,

            legend: {
                display: true,
                position: 'bottom'
            },

            tooltips: {
                enabled: false
            },

            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 30,
                    bottom: 0
                }
            },

            plugins: {
                datalabels: {

                    // Only show Datalabels for 1 Dataset and 2018, 2028 and 2046 years
                    display: function(context){

                        if((context.dataIndex == 5 || context.dataIndex == 10 || context.dataIndex == 19) && context.datasetIndex == 1 ){
                            return context.dataset.data[context.dataIndex];
                        }else{
                            return false;
                        }
                    },

                    anchor: 'end',
                    align: 'end',
                    offset: 5,

                    formatter: function(value, context){

                        return '$' + Math.round(value) + 'K'

                    },

                    backgroundColor: '#FFF',
                    // borderColor: color_helper.annotation_border,
                    // borderWidth: 2,
                    // padding: 10,
                    // color: color_helper.black,
                    // textAlign: 'center',
                    // font: {
                    //     lineHeight: 1.5,
                    //     weight: 'bold'
                    // }


                },
            },

            scales: {
                yAxes: [{
                    // id: 'y-axis-0',

                    beginAtZero: true,

                    ticks: {
                        callback: function(value){
                            return  '$' + Math.round(value) + 'K';
                        }
                    },

                    gridLines:{
                        display: true
                    }
                }],

                xAxes: [{

                    // id: 'x-axis-0',

                    ticks: {
                        padding: 10
                    },

                    gridLines:{
                        display: true,
                        color: ['rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', 'rgba(0, 0, 0, 0)', '#000'],

                        lineWidth: 2,
                        borderDash: [15,5],
                        tickMarkLength: 5
                    }
                }]
            }
        };

        // ctx_5 uses data of ctx_4 since it is the same chart but with different formatting options.

        four_year_tuition_and_fees = new Chart(ctx_1, {
            type: 'bar',
            data: ctx_1_data,
            options: ctx_1_options
        });

        annual_inflation_vs_tuition_change = new Chart(ctx_2,{
            type: 'bar',
            data: ctx_2_data,
            options: ctx_2_options
        });

        tuition_over_time = new Chart(ctx_3, {
            type: 'bar',
            data: ctx_3_data,
            options: ctx_3_options
        });

        tuition_over_time_extended = new Chart(ctx_4, {
            type: 'line',
            data: ctx_4_data,
            options: ctx_4_options
        } );

        tuition_over_time_extended_mobile = new Chart(ctx_5, {
            type: 'line',
            data: ctx_4_data,
            options: ctx_5_options
        } );

    </script>


@endpush
