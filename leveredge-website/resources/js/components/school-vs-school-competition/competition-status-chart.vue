<template>
    <div>
        <h6 class="sub-heading text-muted mb-5">
            {{ leadingSchool }} is leading by
            <span class="bg-light-green px-2 text-white" style="background:#ADD3D2;">
                {{ leadingAmount }} signups
            </span>
        </h6>

        <canvas ref="canvas" width="320" height="200" />
        <div class="row mx-0" style="padding-left:45px;">
            <div class="col-6">
                <img
                    src="/img/temple-logo.png"
                    alt="Temple Logo"
                    style="max-width:75px;height:auto;">
            </div>
            <div class="col-6">
                <img
                    src="/img/penn-state-logo.png"
                    alt="UPenn Logo"
                    style="max-width:75px;height:auto;">
            </div>
        </div>
    </div>
</template>

<script>
    import Chart           from 'chart.js';
    import ChartDataLabels from 'chartjs-plugin-datalabels';

    export default {
        props: {
            competition: {
                type:    Object,
                default: () => ({
                    entrants: 0,
                    colloquial_slug_one: '',
                    colloquial_slug_two: '',
                    colloquial_name_one: '',
                    colloquial_name_two: '',
                    logo_one: '',
                    logo_two: '',
                }),
            },
        },
        data() {
            return {
                chart: null,
            };
        },
        computed: {
            primaryEntrants() {
                return this.competition.entrants.filter((item) => item.colloquial_slug === this.competition.colloquial_slug_one).length;
            },
            secondaryEntrants() {
                return this.competition.entrants.filter((item) => item.colloquial_slug === this.competition.colloquial_slug_two).length;
            },
            logos() {
                return [this.competition.logo_one, this.competition.logo_two];
            },
            names() {
                return [this.competition.colloquial_name_one, this.competition.colloquial_name_two];
            },
            leadingSchool() {
                return this.primaryEntrants > this.secondaryEntrants
                    ? this.competition.colloquial_name_one : this.competition.colloquial_name_two;
            },
            leadingAmount() {
                return Math.abs(this.primaryEntrants - this.secondaryEntrants);
            },
        },
        mounted() {
            const {canvas} = this.$refs;

            this.chart = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels:   [this.competition.colloquial_name_one, this.competition.colloquial_name_two],
                    datasets: [{
                        datalabels: {
                            align:  'top',
                            anchor: 'end',
                            color: 'rgba(173, 211, 210, .7)',
                            font:   {
                                size: 14,
                                weight: 700,
                            },
                        },
                        barThickness: 30,
                        maxBarThickness: 30,
                        data: [this.primaryEntrants, this.secondaryEntrants],
                        backgroundColor: [
                            'rgba(72, 140, 137, 1)',
                            'rgba(72, 140, 137, 1)',
                        ],
                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 1000,
                                min: 0,
                                fontColor: 'rgba(173, 211, 210, .7)',
                                fontSize: 14,
                                fontStyle: 'bold',
                                padding: 10,
                                callback: (value) => value != 0 ? value : '',
                            },
                            gridLines: {
                                drawOnChartArea: false,
                                color: 'rgba(173, 211, 210, .7)',
                                lineWidth: 3,
                                drawTicks: false,
                                zeroLineWidth: 0,
                                zeroLineColor: 'rgba(0,0,0,0)',
                            },
                        }],
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: false,
                                color: 'rgba(173, 211, 210, .7)',
                                lineWidth: 3,
                                drawTicks: false,
                            },
                            ticks: {
                                fontColor: 'rgba(173, 211, 210, .7)',
                                padding: 10,
                                fontSize: 0,
                            },
                        }],
                    },
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: false,
                    },
                },
            });
        },
    };
</script>
