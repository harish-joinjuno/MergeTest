<style src="../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>

<template>

    <div>
        <div class="row">
            <div class="col-md-6">
                <multiselect
                    v-model="value"
                    :options="universities"
                    :multiple="true"
                    :close-on-select="false"
                    :clear-on-select="true"
                    :preserve-search="true"
                    placeholder="Select Universities"
                    label="name"
                    :show-labels="true"
                    track-by="name"
                    :preselect-first="true"
                    @input="updateChart"
                >

                    <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} schools selected</span>
                    </template>
                </multiselect>
            </div>

            <div class="col-md-6 mt-3 mt-md-0">
                <multiselect
                    v-model="gmat_ranges_selection"
                    :options="gmat_ranges"
                    :multiple="false"
                    :searchable="false"
                    :close-on-select="true"
                    placeholder="Select GMAT/GRE Score"
                    label="name"
                    track-by="name"
                    :preselect-first="true"
                    @input="updateChart"
                >

                    <template slot="selection" slot-scope="{ values, search, isOpen }">
                        <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} options selected</span>
                    </template>
                </multiselect>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "university-filter",

        props: ['universities' ],

        beforeCreate() {
            if ($(window).width() <= 768) {
                this.initial_universities = [16, 3, 10];
            }else{
                this.initial_universities = [16, 3, 10, 2, 47, 37, 74, 31, 38, 27];
            }
        },

        data() {
            return {
                value: this.universities.filter( university => this.initial_universities.includes(university.id) ),
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

                gmat_ranges: [
                    {name: 'All Scores' , value: null},
                    {name: 'GRE: More than 333, GMAT: More than 760', value: 780 },
                    {name: 'GRE: 330 to 332, GMAT: 740 to 759', value: 750 },
                    {name: 'GRE: 328 to 329, GMAT: 720 to 739', value: 730 },
                    {name: 'GRE: 326 to 327, GMAT: 700 to 719', value: 710 },
                    {name: 'GRE: 321 to 325, GMAT: 650 to 699', value: 675 },
                    {name: 'GRE: Less than 321; GMAT: Less than 650' , value: 640},
                ],
                gmat_ranges_selection: [
                    {name: 'All Scores' , value: null},
                ],
            }
        },

        methods: {
            updateChart(){

                let programIds = [];
                this.value.forEach(function(university){
                    programIds.push([university.id, 1]);
                });

                let data = {
                    program_ids: programIds,
                    _token: this.csrf,
                    gmat_score: this.gmat_ranges_selection.value,
                };

                axios.post(
                    '/financial-aid-tracker/chart-data/',
                    data ).then(response => {
                        let selectDataPoints = response.data.dataPoints;
                        let selectUniversityNames = response.data.universityNames;
                        let selectMedians = response.data.medians;
                        buildChart(selectDataPoints, selectUniversityNames, selectMedians, '#universityAidAmountChart')
                }).catch(error => {
                        console.log(error);

                })
            }
        }
    }
</script>

<style scoped>

</style>

