<style src="../../../../node_modules/vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    h6{
        font-size: 18px;
        line-height: 1.5;
    }
</style>
<template>

    <div>
        <div v-if="success">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="alert alert-success">
                            Thanks for sharing! We will display your information anonymously to help your classmates.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form v-on:submit.prevent="submit" v-if="!success">

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Share your offers to make fin-aid more transparent</h2>
                        <h6 class="mt-3">
                            You may do so anonymously. If you include your email, we will notify you when students with similar profiles report their offers.
                        </h6>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div>
                            <h4 class="mt-5">1. Enter your current fin-aid offers</h4>
                            <div v-for="(report, i) in form.reports" :key="i" class="mt-3">
                                <div class="row" :class="{ 'mt-2': i !== 0 }">

                                    <div class="col-12">
                                        <p class="d-inline-block">Offer {{ i+1 }}</p>
                                        <button type="button" class="btn btn-link btn-sm" @click.prevent="removeReport(i)" v-if="i">
                                            Remove Offer
                                        </button>
                                    </div>

                                    <input
                                        type="hidden"
                                        value="1"
                                        v-model="report.degree_id"
                                    />

                                    <div class="col-12 mt-2">
                                        <multiselect
                                            v-model="report.university_object"
                                            label="name"
                                            track-by="name"
                                            placeholder="Select a University"
                                            :options="universities">
                                        </multiselect>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <select
                                            class="form-control"
                                            required="required"
                                            v-model="report.aid_qualification"
                                        >
                                            <option disabled value="">Select Basis of Aid</option>
                                            <option value="merit-based">Merit Based</option>
                                            <option value="need-based">Need Based</option>
                                            <option value="both">Both</option>

                                        </select>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <input
                                            type="number"
                                            class="form-control"
                                            required="required"
                                            v-model="report.aid_amount"
                                            placeholder="Total Aid for Program (Ex: 50,000 for 2 Years)"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button type="button" class="btn btn-link btn-sm" @click.prevent="addReport">
                                        + Add Offer
                                    </button>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-3">2. Enter your profile information</h4>

                                <div class="form-group mt-3">
                                    <label for="immigration_status">Immigration Status</label>
                                    <select
                                        class="form-control"
                                        id="immigration_status"
                                        name="immigration_status"
                                        required="required"
                                        v-model="form.immigration_status"
                                    >
                                        <option disabled value="">Select Status</option>
                                        <option
                                            v-for="immigration_status_option in immigration_status_options"
                                            :key="immigration_status_option"
                                            :value="immigration_status_option"
                                        >
                                            {{ immigration_status_option }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="graduation_year">Graduation Year</label>
                                    <input
                                        required="required"
                                        type="number"
                                        min="1990"
                                        max="2050"
                                        id="graduation_year"
                                        name="graduation_year"
                                        class="form-control"
                                        v-model.number="form.graduation_year"
                                        placeholder="Example: 2020"
                                    />
                                    <span class="text-danger" v-if="errors && errors.graduation_year">
                                        {{ errors.graduation_year[0] }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="gpa">Undergraduate GPA</label>
                                    <input
                                        required="required"
                                        type="text"
                                        id="gpa"
                                        name="gpa"
                                        class="form-control"
                                        v-model="form.gpa"
                                        placeholder="Example: 3.20"
                                    />

                                    <span class="text-danger" v-if="errors && errors.gpa">
                                        {{ errors.gpa[0] }}
                                    </span>

                                </div>

                                <div class="form-group">
                                    <label>Did you take the GMAT or GRE ?</label>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="taken_test"
                                            id="gmat"
                                            value="gmat"
                                            v-model="form.taken_test"
                                        />
                                        <label class="form-check-label" for="gmat">
                                            GMAT
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="taken_test"
                                            id="gre"
                                            value="gre"
                                            v-model="form.taken_test"
                                        >
                                        <label class="form-check-label" for="gre">
                                            GRE
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="taken_test"
                                            id="no_test"
                                            value="no_test"
                                            v-model="form.taken_test"
                                        >
                                        <label class="form-check-label" for="no_test">
                                            I haven't take any of the standardized tests yet.
                                        </label>
                                    </div>
                                    <span class="text-danger" v-if="errors && errors.taken_test">
                                        {{ errors.taken_test[0] }}
                                    </span>
                                </div>

                                <div class="form-group" v-if="form.taken_test === 'gmat'">
                                    <label for="gmat_score">GMAT Score</label>
                                    <input
                                        type="number"
                                        min="200"
                                        max="800"
                                        id="gmat_score"
                                        name="gmat_score"
                                        class="form-control"
                                        v-model="form.gmat_score"
                                        placeholder="Example: 760"
                                    />

                                    <span class="text-danger" v-if="errors && errors.gmat_score">
                                        {{ errors.gmat_score[0] }}
                                    </span>

                                </div>


                                <div class="form-group" v-if="form.taken_test === 'gre'">
                                    <label for="gre_score">GRE Score</label>
                                    <input
                                        type="number"
                                        min="260"
                                        max="340"
                                        id="gre_score"
                                        name="gre_score"
                                        class="form-control"
                                        v-model="form.gre_score"
                                        placeholder="Example: 320"
                                    />
                                    <span class="text-danger" v-if="errors && errors.gre_score">
                                        {{ errors.gre_score[0] }}
                                    </span>
                                </div>



                                <div id="aid_info" v-if="has_need_based_aid">

                                    <div class="form-group">
                                        <label for="current_income">Expected income in year applying for aid</label>
                                        <input
                                            type="text"
                                            id="current_income"
                                            name="current_income"
                                            class="form-control"
                                            v-model="currentIncome"
                                            @keypress="checkNumber"
                                            placeholder="Example: 110,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.current_income">
                                            {{ errors.current_income[0] }}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="income_3">Income 3 years prior to applying for aid</label>
                                        <input
                                            type="text"
                                            id="income_3"
                                            name="income_3"
                                            class="form-control"
                                            v-model="income3"
                                            @keypress="checkNumber"
                                            placeholder="Example: 100,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.income_3">
                                            {{ errors.income_3[0] }}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="income_2">Income 2 years prior to applying for aid</label>
                                        <input
                                            type="text"
                                            id="income_2"
                                            name="income_2"
                                            class="form-control"
                                            v-model="income2"
                                            @keypress="checkNumber"
                                            placeholder="Example: 90,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.income_2">
                                            {{ errors.income_2[0] }}
                                        </span>

                                    </div>
                                    <div class="form-group">
                                        <label for="income_1">Income 1 years prior to applying for aid</label>
                                        <input
                                            type="text"
                                            id="income_1"
                                            name="income_2"
                                            class="form-control"
                                            v-model="income1"
                                            @keypress="checkNumber"
                                            placeholder="Example: 80,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.income_1">
                                            {{ errors.income_1[0] }}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="liquid_assets">Total value of Liquid Assets</label>
                                        <input
                                            type="text"
                                            id="liquid_assets"
                                            name="liquid_assets"
                                            class="form-control"
                                            v-model="liquidAssets"
                                            @keypress="checkNumber"
                                            placeholder="Example: 75,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.liquid_assets">
                                {{ errors.liquid_assets[0] }}
                                        </span>

                                    </div>
                                    <div class="form-group">
                                        <label for="illiquid_assets">Total value of Illiquid Assets (Home value, retirement)</label>
                                        <input
                                            type="text"
                                            id="illiquid_assets"
                                            name="illiquid_assets"
                                            class="form-control"
                                            v-model="illiquidAssets"
                                            @keypress="checkNumber"
                                            placeholder="Example: 200,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.illiquid_assets">
                                {{ errors.illiquid_assets[0] }}
                                        </span>

                                    </div>
                                    <div class="form-group">
                                        <label for="liabilities">Total liabilities (Excluding Mortgage)</label>
                                        <input
                                            type="text"
                                            id="liabilities"
                                            name="liabilities"
                                            class="form-control"
                                            v-model="liabilities"
                                            @keypress="checkNumber"
                                            placeholder="Example: 35,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.liabilities">
                                {{ errors.liabilities[0] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_mortgage">Total Mortgage</label>
                                        <input
                                            type="text"
                                            id="total_mortgage"
                                            name="total_mortgage"
                                            class="form-control"
                                            v-model="totalMortgage"
                                            @keypress="checkNumber"
                                            placeholder="Example: 500,000"
                                        />

                                        <span class="text-danger" v-if="errors && errors.total_mortgage">
                                {{ errors.total_mortgage[0] }}
                                        </span>
                                    </div>
                                </div>

                        <h4 class="mt-3">3. Enter email to receive updates about similiar profiles ( Optional )</h4>

                                <div class="form-group mt-3">
                                    <label for="email">Email (Optional)</label>
                                    <input
                                        type="text"
                                        id="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Example: john@gmail.com"
                                        v-model="form.email"
                                    />

                                    <span class="text-danger" v-if="errors && errors.email">
                                        {{ errors.email[0] }}
                                    </span>
                                </div>

                                <button class="btn btn-primary mt-4 btn-xs-block btn-sm-block" type="submit">
                                    Submit Anonymously
                                </button>

                    </div>
                </div>
            </div>
        </form>


    </div>

</template>

<script>
import axios from 'axios'

const schemas = {
    form() {
        return {
            taken_test: '',
            current_income: '',
            gmat_score: '',
            gpa: '',
            graduation_year: '',
            gre_score: '',
            illiquid_assets: '',
            immigration_status: '',
            income_1: '',
            income_2: '',
            income_3: '',
            liabilities: '',
            liquid_assets: '',
            total_mortgage: '',
            reports: [],
            email: '',
        }
    },
    report() {
        return {
            aid_amount: '',
            aid_qualification: '',
            degree_id: '1',
            university_id: '',
            university_object: '',
        }
    },
};

export default {
    props: ['action', 'immigration_status_options', 'universities'],
    data() {
        return {
            form: {},
            errors: {},
            success: false,
            loaded: true,
        }
    },
    computed: {
        currentIncome: {
            get() {
                return this.numberFormat(this.form.current_income);
            },
            set(value) {
                this.form.current_income = this.toNumber(value);
            }
        },

        income3: {
            get() {
                return this.numberFormat(this.form.income_3);
            },
            set(value) {
                this.form.income_3 = this.toNumber(value);
            }
        },

        income2: {
            get() {
                return this.numberFormat(this.form.income_2);
            },

            set(value) {
                this.form.income_2 = this.toNumber(value);
            }
        },

        income1: {
            get() {
                return this.numberFormat(this.form.income_1);
            },

            set(value) {
                this.form.income_1 = this.toNumber(value);
            }
        },

        liquidAssets: {
            get() {
                return this.numberFormat(this.form.liquid_assets);
            },

            set(value) {
                this.form.liquid_assets = this.toNumber(value);
            }
        },

        illiquidAssets: {
            get() {
                return this.numberFormat(this.form.illiquid_assets);
            },

            set(value) {
                this.form.illiquid_assets = this.toNumber(value);
            }
        },

        liabilities: {
            get() {
                return this.numberFormat(this.form.liabilities);
            },

            set(value) {
                this.form.liabilities = this.toNumber(value);
            }
        },

        totalMortgage: {
            get() {
                return this.numberFormat(this.form.total_mortgage);
            },

            set(value) {
                this.form.total_mortgage = this.toNumber(value);
            }
        },

        has_need_based_aid: function(){
            return this.form.reports.some(
                ({ aid_qualification }) => aid_qualification && aid_qualification !== 'merit-based'
            );
        }
    },


    created() {
        this.form = schemas.form();
        this.addReport()
    },

    methods: {
        addReport() {
            if(this.form.reports.length < 5) {
                this.form.reports.push(schemas.report())
            }
        },
        removeReport(index){
            this.form.reports.splice(index, 1);
        },
        submit() {
            if(this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                this.form.reports.forEach((report, index) => {
                    this.form.reports[index].university_id = report.university_object.id
                });

                axios.post(this.action, this.form ).then(response => {
                    // Reset the Form
                    this.form = schemas.form();
                    this.form.reports.push(schemas.report());
                    this.loaded     = true;
                    this.success    = true;
                }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        console.log(this.errors);
                    }
                })
            }
        },

        numberFormat(num) {
            if (num === '')
                return '';

            return new Intl.NumberFormat().format(num);
        },

        toNumber(strNum) {
            return strNum.replace(/,/g, '');
        },

        checkNumber(event) {
            if (event.keyCode >= 48 && event.keyCode <= 57)
                return true;

            event.preventDefault();
            return false;
        }
    },
}
</script>
