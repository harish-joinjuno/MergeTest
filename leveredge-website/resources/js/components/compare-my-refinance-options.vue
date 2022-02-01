<template>
    <div class="compare-my-options">
        <div class="bg-secondary-green">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <div class="white pt-4 pb-3">
                            <h1 class="white">
                                Refinance Student Loan Calculator
                            </h1>
                            <p>
                                Use this calculator to compare all your refinance student loan options and make an informed decision.
                            </p>
                            <div class="text-left">
                                <p class="mt-3 mt-md-4">
                                    This calculator is different from others in one key way:
                                </p>
                                <p class="mb-2 mb-md-3"><strong>Want to learn about variable rates?</strong><br>This lets you project the lifetime cost of a variable rate loan using market projections for how variable rates will change over time.</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="form-group">
                                    <label class="white" for="loan_amount">Loan Amount</label>
                                    <div class="input-group">
                                        <input id="loan_amount"
                                               v-model="loanAmountModel"
                                               type="text"
                                               class="form-control border-white"
                                               placeholder="Enter loan amount"
                                               name="loan_amount"
                                               @input="calculate('loanAmountModel')">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white border-0">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="form-group calculator-select">
                                    <label class="white" for="variable_assumption">
                                        <a href="javascript:void(0)" class="white" data-toggle="tooltip" title="To learn more about market projections for how variable rates might change, please see this detailed breakdown.">
                                            <i class="fal fa-info-circle font-weight-bold" />
                                        </a>
                                        <strong>Variable Assumption</strong>
                                    </label>
                                    <select id="variable_assumption"
                                            v-model="variableAssumption"
                                            class="form-control border-white"
                                            :class="{open: openSelect === 'variable_assumption'}"
                                            name="variable_assumption"
                                            @change="calculate"
                                            @click="selectChange('variable_assumption')"
                                            @focusout="selectFocusOut('variable_assumption')">
                                        <option v-for="(value, text) in variableAssumptions"
                                                :key="text"
                                                :value="value"
                                                v-text="value" />
                                    </select>
                                    <div class="select-addison w-100 position-absolute d-flex justify-content-between align-items-center px-2">
                                        <span :class="{empty: !variableAssumption}" class="placeholder">Variable assumption</span>
                                        <i class="fas fa-chevron-down secondary-green" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-3">
            <div class="container mb-4">
                <div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8">
                            <h2 class="h1 text-center primary-black" v-text="tableTitle" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center p-0">
                            <table id="total-cost" class="table table-bordered table-responsive bg-light-grey mb-0">
                                <tbody class="d-flex d-md-table">
                                    <tr class="white d-flex flex-column d-md-table-row thead">
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Lender
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Loan Amount
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Term
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Original APR
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Rate Type
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Monthly payment
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Cash Back
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            <a href="javascript:void(0)" class="d-none d-md-block" data-toggle="tooltip" title="Total interest rate and fees minus cash back" style="color: white;"><i class="fal fa-info-circle" /></a>
                                            Financing Cost <br> (Minus Cash Back)
                                        </th>
                                        <th class="p-1 py-2 p-md-2 bg-secondary-green">
                                            Effective APR
                                        </th>
                                    </tr>
                                    <template v-if="calculating">
                                        <tr
                                            v-for="(val, index) in calculatedValues.length"
                                            :key="'B' + index"
                                            class="load d-none d-md-table-row">
                                            <td class="td-1" colspan="2">
                                                <span />
                                            </td>
                                            <td class="td-2">
                                                <span />
                                            </td>
                                            <td class="td-3" colspan="3">
                                                <span />
                                            </td>
                                            <td class="td-4" />
                                            <td class="td-5" colspan="2">
                                                <span />
                                            </td>
                                        </tr>
                                    </template>
                                    <template v-if="! calculating">
                                        <template v-for="(value, index) in calculatedValues">
                                            <tr
                                                v-if="showTr(index, true)"
                                                :key="'A' + index"
                                                :class="{'border-right': showBorder(index)}"
                                                class="bg-secondary-off-white d-flex flex-column d-md-table-row">
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="value.title" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="formatCurrency(loanAmount)" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="`${value.term} years`" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="formatPercentage(value.apr)" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3 mb-4 mb-md-0" v-text="value.rateType" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3 mb-4 mb-md-0" v-text="value.inSchool" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="formatCurrency(value.leverEdgeBenefit)" />
                                                <td class="border-white p-1 py-3 p-md-2 py-md-3 two-line" v-text="formatCurrency(value.financing_cost)" />
                                                <td class="border-white p-1 py-2 p-md-2 py-md-3" v-text="formatPercentage(value.effective_apr)" />
                                            </tr>
                                        </template>

                                    </template>
                                </tbody>
                            </table>
                            <div
                                v-if="columns !== colCount"
                                class="dots d-flex justify-content-center my-2">
                                <div class="arrow">
                                    <i
                                        :class="{disabled: activeStep === 0}"
                                        class="fas fa-angle-left primary-green mx-3"
                                        @click="changeStep(activeStep - 1)" />
                                </div>
                                <div
                                    v-for="(val, index) in new Array(dotsCount)"
                                    :key="index"
                                    :class="{ active: activeStep === index }"
                                    class="dot rounded-circle m-2 bg-primary-green"
                                    @click="changeStep(index)" />
                                <div class="arrow">
                                    <i
                                        :class="{disabled: activeStep === (this.dotsCount - 1)}"
                                        class="fas fa-angle-right primary-green mx-3"
                                        @click="changeStep(activeStep + 1)" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 bg-secondary-off-white py-4 px-2 order-first order-md-last overflow-hidden">
                            <div
                                v-if="addLender"
                                class="d-flex justify-content-center"
                                @click="addLender = false">
                                <button class="btn btn-outline off-black border-off-black add-lender">
                                    <i class="fas fa-plus" style="font-size: 14px;" />
                                    <span>Add a lender</span>
                                </button>
                            </div>
                            <div v-show="!addLender" class="row justify-content-center">
                                <div class="close-lender px-3 px-md-4 w-100 d-flex justify-content-end">
                                    <i class="fas fa-times" @click="addLender = true;" />
                                </div>
                                <div class="col-12 col-lg-8 col-xl-7">
                                    <div class="row lender-row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-group calculator-select">
                                                <label class="off-black" for="lender"><a class="off-black" href="javascript:void(0)" data-toggle="tooltip" title="Use this tool to compare any refinance student loan lenders, including lenders we are not partnered with!" style="text-decoration: none !important;"><i class="fal fa-info-circle font-weight-bold" /></a> <strong>Lender</strong></label>
                                                <select id="lender"
                                                        v-model="lender"
                                                        class="form-control border-off-black"
                                                        name="lender"
                                                        :class="{open: openSelect === 'lender'}"
                                                        @click="selectChange('lender')"
                                                        @focusout="selectFocusOut('lender')">
                                                    <template v-for="(value, text) in lenders">
                                                        <option
                                                            :key="text"
                                                            :value="value"
                                                            v-text="text" />
                                                    </template>
                                                </select>
                                                <div class="select-addison w-100 position-absolute d-flex justify-content-between align-items-center px-2">
                                                    <span :class="{empty: !lender}" class="placeholder">-Eight options-</span>
                                                    <i class="fas fa-chevron-down secondary-green" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-group">
                                                <label class="off-black" for="years">Loan term (years)</label>
                                                <input
                                                    id="years"
                                                    v-model.number="years"
                                                    class="form-control border-off-black"
                                                    placeholder="-5 to 20 years-"
                                                    type="number"
                                                    :min="5"
                                                    :max="20">
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-group">
                                                <label class="off-black" for="apr"><a class="off-black" href="javascript:void(0)" data-toggle="tooltip" title="Enter the APR you’ve been quoted in any of your loan options.
Earnest quotes you an APR that does NOT include an auto-pay discount while other lenders do include it. Please subtract 0.25% from your Earnest APR before you enter it here.
" style="text-decoration: none !important;"><i class="fal fa-info-circle font-weight-bold" /></a> <strong>APR</strong></label>
                                                <div class="input-group mb-3 border-off-black rounded border" style="border-width: 2px!important;">
                                                    <input id="apr"
                                                           v-model.number="apr"
                                                           type="number"
                                                           class="form-control border-0"
                                                           placeholder="0.00"
                                                           name="apr"
                                                           step=".01"
                                                           max="10"
                                                           @input="aprChange">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="form-group calculator-select">
                                                <label class="off-black" for="rate_type">Rate Type</label>
                                                <select id="rate_type"
                                                        v-model="rateType"
                                                        class="form-control border-off-black"
                                                        name="rate-type"
                                                        :class="{open: openSelect === 'rate-type'}"
                                                        @click="selectChange('rate-type')"
                                                        @focusout="selectFocusOut('rate-type')">
                                                    <option v-for="(value, text) in rateTypes"
                                                            :key="text"
                                                            :value="value"
                                                            v-text="value" />
                                                </select>
                                                <div class="select-addison w-100 position-absolute d-flex justify-content-between align-items-center px-2">
                                                    <span :class="{empty: !rateType}" class="placeholder">Fixed / Variable</span>
                                                    <i class="fas fa-chevron-down secondary-green" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4 d-flex align-items-end">
                                            <div class="form-group w-100">
                                                <button
                                                    type="button"
                                                    class="btn btn-warning border-0 px-2 w-100 bg-accent-pink off-black"
                                                    :class="{disabled: calculateOptionDisabled}"
                                                    style="height: 54px;"
                                                    @click="addCalculatedValue">
                                                    <i class="fas fa-plus" style="font-size: 14px;" />
                                                    <span>Create option</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-center">
                            <a href="https://leveredge.org/variable-forecast" target="_blank">Learn more about our variable assumptions</a>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="py-3 py-md-5" />
        </div>
        <div class="bg-translucent-green">
            <div class="container">
                <div class="row py-2 py-md-5 calculator-data justify-content-center">
                    <div class="col-12 col-md-8">
                        <h4 class="mb-4">
                            How does this calculator evaluate variable rates?
                        </h4>
                        <p class="mb-3">
                            We use the APR and other details of the loan quote that you enter and convert it into a starting interest rate.
                        </p>
                        <p class="mb-3">
                            Then, we break up the starting interest into two components: the spread and the benchmark.
                        </p>
                        <p class="mb-3">
                            Finally, we adjust your interest rate, each month, for the life of the loan, based on market projections for the benchmark LIBOR rate (downloaded from Bloomberg).
                        </p>
                        <p class="mb-3">
                            You have the added options of swapping out the market projections for more conservative options to see a more conservative view. The “aggressive” assumption assumes +1 Standard Deviation of what the market expects LIBOR to be. The “very aggressive” assumption assumes +2 Standard Deviations higher.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import numeral from 'numeral';
import xirr from 'xirr';

let timeout;

    export default {
        name:  'CompareMyOptions',
        data() {
            return {
                openSelect:              '',
                addLender:               true,
                calculatedValues:        [],
                applyAutoPayDiscount:    true,
                rateTypes:               {
                    fixed_rate:    'Fixed Rate',
                    variable_rate: 'Variable Rate',
                },
                variableAssumptions:   {
                    base_case:       'Market Projection',
                    aggressive:      '+1 Standard Deviation',
                    very_aggressive: '+2 Standard Deviation',
                },
                variableAssumption: 'Market Projection',
                loanAmountModel:    '60,000',
                rateType:           null,
                lender:             null,
                years:              null,
                apr:                null,

                oneMonthLiborMarket: [
                    0.18788,
                    0.18788,
                    0.20142,
                    0.20249,
                    0.20056,
                    0.17933,
                    0.17176,
                    0.17114,
                    0.17660,
                    0.18038,
                    0.16203,
                    0.14112,
                    0.12839,
                    0.15067,
                    0.14617,
                    0.13592,
                    0.14490,
                    0.13897,
                    0.13138,
                    0.14979,
                    0.14823,
                    0.14495,
                    0.14168,
                    0.13830,
                    0.13482,
                    0.19351,
                    0.19881,
                    0.19992,
                    0.20100,
                    0.20209,
                    0.20321,
                    0.20421,
                    0.20530,
                    0.20636,
                    0.20739,
                    0.20839,
                    0.20947,
                    0.30096,
                    0.31686,
                    0.32327,
                    0.32958,
                    0.33609,
                    0.34259,
                    0.34847,
                    0.35496,
                    0.36123,
                    0.36719,
                    0.37366,
                    0.38011,
                    0.45146,
                    0.47734,
                    0.48732,
                    0.49665,
                    0.50645,
                    0.51622,
                    0.52584,
                    0.53590,
                    0.54452,
                    0.55378,
                    0.56348,
                    0.57317,
                    0.64073,
                    0.66417,
                    0.67630,
                    0.68882,
                    0.70128,
                    0.71236,
                    0.72403,
                    0.73623,
                    0.74722,
                    0.75903,
                    0.77114,
                    0.78210,
                    0.78897,
                    0.79992,
                    0.81066,
                    0.82230,
                    0.83390,
                    0.84512,
                    0.85557,
                    0.86691,
                    0.87765,
                    0.88861,
                    0.89985,
                    0.91055,
                    0.87695,
                    0.88061,
                    0.89084,
                    0.90115,
                    0.91083,
                    0.92096,
                    0.93106,
                    0.94049,
                    0.95054,
                    0.96056,
                    0.96974,
                    0.97974,
                    0.95646,
                    0.96158,
                    0.97076,
                    0.97976,
                    0.98907,
                    0.99828,
                    1.00664,
                    1.01586,
                    1.02453,
                    1.03314,
                    1.04167,
                    1.05049,
                    1.01680,
                    1.01857,
                    1.02685,
                    1.03422,
                    1.04239,
                    1.05046,
                    1.05778,
                    1.06572,
                    1.07319,
                    1.08074,
                    1.08875,
                    1.09669,
                    1.030300,
                    1.036600,
                    1.043600,
                    1.049900,
                    1.056500,
                    1.063600,
                    1.069500,
                    1.076000,
                    1.083100,
                    1.088600,
                    1.082900,
                    1.076700,
                    1.070300,
                    1.076100,
                    1.082500,
                    1.088000,
                    1.093800,
                    1.100000,
                    1.105400,
                    1.111300,
                    1.117200,
                    1.122700,
                    1.087400,
                    1.049900,
                    1.013900,
                    1.018200,
                    1.022300,
                    1.026400,
                    1.030900,
                    1.034900,
                    1.038800,
                    1.043400,
                    1.047100,
                    1.051100,
                    1.055600,
                    1.059300,
                    1.063500,
                    1.067700,
                    1.071600,
                    1.075600,
                    1.079800,
                    1.083700,
                    1.087500,
                    1.091700,
                    1.095500,
                    1.099400,
                    1.103400,
                    1.107200,
                    1.111400,
                    1.115200,
                    1.119000,
                    1.123100,
                    1.126800,
                    1.130700,
                    1.134600,
                    1.138200,
                    1.142000,
                    1.145900,
                    1.105200,
                    1.060500,
                    1.011900,
                    1.014200,
                    1.016700,
                    1.019200,
                    1.021500,
                    1.024100,
                    1.026400,
                    1.028700,
                    1.031300,
                    1.033500,
                    1.035800,
                    1.038300,
                    1.040600,
                    1.042900,
                    1.045400,
                    1.047600,
                    1.049900,
                    1.052400,
                    1.054500,
                    1.056800,
                ],
                oneMonthLiborAggressive: [
                    0.18788,
                    0.18788,
                    0.26564,
                    0.29158,
                    0.31069,
                    0.29971,
                    0.30588,
                    0.31899,
                    0.33192,
                    0.33706,
                    0.30979,
                    0.29681,
                    0.29491,
                    0.36299,
                    0.36405,
                    0.35004,
                    0.37558,
                    0.37331,
                    0.36746,
                    0.41882,
                    0.42141,
                    0.41926,
                    0.41628,
                    0.44789,
                    0.48502,
                    0.70583,
                    0.73529,
                    0.75014,
                    0.76477,
                    0.77908,
                    0.79373,
                    0.80747,
                    0.82189,
                    0.83616,
                    0.84915,
                    0.85787,
                    0.86023,
                    1.08614,
                    1.13729,
                    1.17082,
                    1.20435,
                    1.23841,
                    1.27330,
                    1.30535,
                    1.34067,
                    1.37581,
                    1.40861,
                    1.40645,
                    1.39405,
                    1.48408,
                    1.53893,
                    1.58071,
                    1.62123,
                    1.66265,
                    1.70490,
                    1.74652,
                    1.78976,
                    1.83112,
                    1.87185,
                    1.96960,
                    2.06601,
                    2.25620,
                    2.34339,
                    2.39824,
                    2.45508,
                    2.51023,
                    2.56329,
                    2.61726,
                    2.67318,
                    2.72760,
                    2.78152,
                    2.65569,
                    2.51738,
                    2.33830,
                    2.36557,
                    2.40756,
                    2.45220,
                    2.49530,
                    2.53925,
                    2.57983,
                    2.62383,
                    2.66822,
                    2.70960,
                    2.86252,
                    3.03675,
                    3.14706,
                    3.18439,
                    3.23339,
                    3.28334,
                    3.33022,
                    3.37961,
                    3.42783,
                    3.47573,
                    3.52585,
                    3.57376,
                    3.48891,
                    3.37162,
                    3.21216,
                    3.23188,
                    3.27306,
                    3.31403,
                    3.35549,
                    3.39770,
                    3.43586,
                    3.47834,
                    3.52027,
                    3.55880,
                    3.36196,
                    3.14981,
                    2.91649,
                    2.91045,
                    2.94112,
                    2.97082,
                    3.00165,
                    3.03254,
                    3.06170,
                    3.09302,
                    3.12405,
                    3.15284,
                    3.36443,
                    3.58321,
                    3.530300,
                    3.536600,
                    3.543600,
                    3.549900,
                    3.556500,
                    3.563600,
                    3.569500,
                    3.576000,
                    3.583100,
                    3.588600,
                    3.582900,
                    3.576700,
                    3.570300,
                    3.576100,
                    3.582500,
                    3.588000,
                    3.593800,
                    3.600000,
                    3.605400,
                    3.611300,
                    3.617200,
                    3.622700,
                    3.587400,
                    3.549900,
                    3.513900,
                    3.518200,
                    3.522300,
                    3.526400,
                    3.530900,
                    3.534900,
                    3.538800,
                    3.543400,
                    3.547100,
                    3.551100,
                    3.555600,
                    3.559300,
                    3.563500,
                    3.567700,
                    3.571600,
                    3.575600,
                    3.579800,
                    3.583700,
                    3.587500,
                    3.591700,
                    3.595500,
                    3.599400,
                    3.603400,
                    3.607200,
                    3.611400,
                    3.615200,
                    3.619000,
                    3.623100,
                    3.626800,
                    3.630700,
                    3.634600,
                    3.638200,
                    3.642000,
                    3.645900,
                    3.605200,
                    3.560500,
                    3.511900,
                    3.514200,
                    3.516700,
                    3.519200,
                    3.521500,
                    3.524100,
                    3.526400,
                    3.528700,
                    3.531300,
                    3.533500,
                    3.535800,
                    3.538300,
                    3.540600,
                    3.542900,
                    3.545400,
                    3.547600,
                    3.549900,
                    3.552400,
                    3.554500,
                    3.556800,
                ],
                oneMonthLiborVeryAggressive: [
                    0.18788,
                    0.18788,
                    0.32985,
                    0.38066,
                    0.42082,
                    0.42009,
                    0.44000,
                    0.46684,
                    0.48723,
                    0.49374,
                    0.45755,
                    0.45251,
                    0.46142,
                    0.57531,
                    0.58192,
                    0.56417,
                    0.60627,
                    0.60765,
                    0.60354,
                    0.68784,
                    0.69459,
                    0.69356,
                    0.69088,
                    0.75748,
                    0.83521,
                    1.21815,
                    1.27177,
                    1.30036,
                    1.32855,
                    1.35607,
                    1.38425,
                    1.41073,
                    1.43848,
                    1.46596,
                    1.49091,
                    1.50736,
                    1.51100,
                    1.87131,
                    1.95772,
                    2.01838,
                    2.07912,
                    2.14074,
                    2.20402,
                    2.26223,
                    2.32638,
                    2.39039,
                    2.45003,
                    2.43925,
                    2.40799,
                    2.51671,
                    2.60052,
                    2.67410,
                    2.74581,
                    2.81886,
                    2.89358,
                    2.96721,
                    3.04362,
                    3.11771,
                    3.18993,
                    3.37573,
                    3.55884,
                    3.87167,
                    4.02261,
                    4.12018,
                    4.22133,
                    4.31918,
                    4.41421,
                    4.51049,
                    4.61013,
                    4.70799,
                    4.80401,
                    4.54024,
                    4.25267,
                    3.88763,
                    3.93123,
                    4.00446,
                    4.08211,
                    4.15669,
                    4.23339,
                    4.30410,
                    4.38075,
                    4.45879,
                    4.53060,
                    4.82518,
                    5.16295,
                    5.41717,
                    5.48817,
                    5.57594,
                    5.66552,
                    5.74961,
                    5.83825,
                    5.92459,
                    6.01098,
                    6.10115,
                    6.18696,
                    6.00809,
                    5.76349,
                    5.46786,
                    5.50218,
                    5.57536,
                    5.64830,
                    5.72192,
                    5.79713,
                    5.86508,
                    5.94082,
                    6.01601,
                    6.08446,
                    5.68225,
                    5.24912,
                    4.81619,
                    4.80232,
                    4.85539,
                    4.90741,
                    4.96090,
                    5.01463,
                    5.06563,
                    5.12032,
                    5.17492,
                    5.22494,
                    5.64011,
                    6.06973,
                    6.03030,
                    6.03660,
                    6.04360,
                    6.04990,
                    6.05650,
                    6.06360,
                    6.06950,
                    6.07600,
                    6.08310,
                    6.08860,
                    6.08290,
                    6.07670,
                    6.07030,
                    6.07610,
                    6.08250,
                    6.08800,
                    6.09380,
                    6.10000,
                    6.10540,
                    6.11130,
                    6.11720,
                    6.12270,
                    6.08740,
                    6.04990,
                    6.01390,
                    6.01820,
                    6.02230,
                    6.02640,
                    6.03090,
                    6.03490,
                    6.03880,
                    6.04340,
                    6.04710,
                    6.05110,
                    6.05560,
                    6.05930,
                    6.06350,
                    6.06770,
                    6.07160,
                    6.07560,
                    6.07980,
                    6.08370,
                    6.08750,
                    6.09170,
                    6.09550,
                    6.09940,
                    6.10340,
                    6.10720,
                    6.11140,
                    6.11520,
                    6.11900,
                    6.12310,
                    6.12680,
                    6.13070,
                    6.13460,
                    6.13820,
                    6.14200,
                    6.14590,
                    6.10520,
                    6.06050,
                    6.01190,
                    6.01420,
                    6.01670,
                    6.01920,
                    6.02150,
                    6.02410,
                    6.02640,
                    6.02870,
                    6.03130,
                    6.03350,
                    6.03580,
                    6.03830,
                    6.04060,
                    6.04290,
                    6.04540,
                    6.04760,
                    6.04990,
                    6.05240,
                    6.05450,
                    6.05680,
                ],

                oneMonthLiborAssumption: null,
                calculating: false,
                activeStep:  0,
                windowWidth: window.innerWidth,
            };
        },
        computed: {
            columns() {
                return this.calculatedValues.length;
            },
            colCount() {
                if (this.windowWidth > 768) {
                    return this.columns;
                }
                if (this.windowWidth > 570) {
                    return 3;
                }
                return 2;
            },
            dotsCount() {
                return Math.ceil(this.columns / this.colCount);
            },
            showVariableAssumption() {
                const filteredArray = this.calculatedValues.filter((calculatedValue) => calculatedValue.rateType === this.rateTypes.variable_rate);
                return filteredArray.length !== 0;
            },
            lenders() {
                return {
                    CommonBond: {
                        name:                       'CommonBond',
                        leveredge_reward_rate:      0.5,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                    },
                    Earnest: {
                        name:                       'Earnest',
                        leveredge_reward_rate:     0.5,
                        months_of_grace_period:     9,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                    },
                    Credible: {
                        name:                       'Credible',
                        leveredge_reward_rate:      1,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                    },
                    'Sallie Mae': {
                        name:                       'Sallie Mae',
                        leveredge_reward_rate:      0,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                    },
                    SoFi: {
                        name:                       'SoFi',
                        leveredge_reward_rate:      0,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                    },
                };
            },

            tableTitle() {
                return `Total Cost of your Student Loan Refinance Options`;
            },

            loanAmount() {
                return parseInt(numeral(this.loanAmountModel).format('0'), 10);
            },

            calculateOptionDisabled() {
                return !(!!this.rateType
                    && !!this.lender
                    && !!this.years
                    && !!this.apr);
            },
        },
        mounted() {
            window.addEventListener('resize', this.onResize);
        },

        beforeDestroy() {
            window.removeEventListener('resize', this.onResize);
        },
        methods: {
            selectChange(name) {
                if (this.openSelect === name) {
                    this.openSelect = null;
                } else {
                    this.openSelect = name;
                }
            },
            selectFocusOut(name) {
                if (this.openSelect === name) {
                    this.openSelect = null;
                }
            },
            getTotalPayments(transactions) {
                const transactions_but_first = JSON.parse(JSON.stringify(transactions)).splice(1);
                return _.sumBy(transactions, 'amount');
            },
            runCalculation(index, key = 'calculatedValues') {
                if (this.variableAssumption === this.variableAssumptions.base_case) {
                    this.oneMonthLiborAssumption = this.oneMonthLiborMarket;
                } else if (this.variableAssumption === this.variableAssumptions.aggressive) {
                    this.oneMonthLiborAssumption = this.oneMonthLiborAggressive;
                } else if (this.variableAssumption === this.variableAssumptions.very_aggressive) {
                    this.oneMonthLiborAssumption = this.oneMonthLiborVeryAggressive;
                }

                const calculatedValue = this[key][index];
                const interest_rate = this.calculateInterestRate(calculatedValue);
                calculatedValue.interest_rate = interest_rate;

                let transactions;
                if (calculatedValue.rateType === this.rateTypes.fixed_rate) {
                    transactions = this.getTransactionsForImmediateRepayment(calculatedValue.lender, calculatedValue.term, this.loanAmount, interest_rate, this.applyAutoPayDiscount);
                } else {
                    transactions = this.getTransactionsForImmediateRepaymentVariableRate(calculatedValue.lender, calculatedValue.term, this.loanAmount, interest_rate, this.applyAutoPayDiscount);
                }

                if (calculatedValue.rateType === this.rateTypes.fixed_rate) {
                    calculatedValue.inSchool = `${this.formatCurrency(Math.round(transactions[1].amount))}`;
                } else {
                    let transactions_but_first;
                    transactions_but_first = JSON.parse(JSON.stringify(transactions)).splice(1);
                    calculatedValue.inSchool = `${this.formatCurrency(Math.round(_.minBy(transactions_but_first, 'amount').amount))} - ${this.formatCurrency(Math.round(_.maxBy(transactions_but_first, 'amount').amount))}`;
                }

                // Calculate LeverEdge Benefit
                calculatedValue.leverEdgeBenefit = calculatedValue.lender.leveredge_reward_rate / 100 * this.loanAmount;

                let totalPayment = 0;
                transactions.forEach((transaction, index) => {
                    if (index !== 0) {
                        totalPayment += transaction.amount;
                    }
                });
                calculatedValue.totalPayments = totalPayment;
                calculatedValue.financing_cost = totalPayment - this.loanAmount - calculatedValue.leverEdgeBenefit;
                transactions[0].amount -= calculatedValue.leverEdgeBenefit;
                calculatedValue.effective_apr = this.XIRR(transactions) * 100;
                calculatedValue.transactions = transactions;
            },
            calculate(name = null, format = '0,0') {
                if (name !== null) {
                    this[name] = this[name] === '' ? '' : numeral(this[name]).format(format);
                }
                this.calculating = true;
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    this.calculatedValues.forEach((calculatedValue, index) => this.runCalculation(index));
                    this.calculating = false;
                }, 700);
            },
            addCalculatedValue() {
                if (!this.calculateOptionDisabled) {
                    this.calculatedValues.push({
                        apr:              this.apr,
                        term:             this.years,
                        lender:           this.lender,
                        rateType:         this.rateType,

                        interest:         null,

                        title:            this.lender.name,
                        inSchool:         null,
                        leverEdgeBenefit: null,
                        totalPayments:    null,
                    });
                    this.runCalculation(this.calculatedValues.length - 1);
                    this.addLender = true;
                    this.rateType =      null;
                    this.lender =        null;
                    this.years =         null;
                    this.apr =           null;
                }
            },
            calculateInterestRate(calculatedValue) {
                let interest_rate_guess = 0.5;
                const increment = 0.001;

                if (!(calculatedValue.apr > 0) || !(this.loanAmount > 0)) {
                    return 0;
                }

                let apr = 0;
                let loop = 0;
                while (apr < calculatedValue.apr) {
                    try {
                        apr = this.getApr(this.loanAmount, interest_rate_guess, calculatedValue.term, calculatedValue.lender);
                    } catch (err) {
                        console.log(err);
                    }
                    interest_rate_guess += increment;

                    loop++;
                    if (loop > 20 / increment) {
                        apr = null;
                        interest_rate_guess = null;
                        break;
                    }
                }

                if (interest_rate_guess !== 0 && interest_rate_guess != null) {
                    return interest_rate_guess;
                }
                throw 'Could not compute the interest rate';
            },
            getApr(loanAmount, interestRate, loanTerm, lender) {
                let transactions = null;
                transactions = this.getTransactionsForImmediateRepayment(lender, loanTerm, loanAmount, interestRate, this.applyAutoPayDiscount);
                if (transactions.length < 2) {
                    throw 'Too few transactions. Something is wrong';
                }
                return this.XIRR(transactions) * 100;
            },
            getTransactionsForImmediateRepaymentVariableRate(lender, loanTerm, loanAmount, interestRate, applyAutoPayDiscount) {

                const months_to_pay_off = loanTerm * 12;
                const principal = loanAmount;
                const spread = interestRate - this.oneMonthLiborAssumption[0];

                const transactions = [];
                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        transactions[i] = {
                            rate:                   this.oneMonthLiborAssumption[i] + spread,
                            amount:                 -1 * loanAmount,
                            when:                   new Date(2010, 1, 1),
                            principal,
                            uncapitalized_interest: 0,
                        };
                    } else {
                        transactions[i] = {};
                        // Adjust Rate for Auto Pay Discount (if Applicable)
                        transactions[i].rate = this.oneMonthLiborAssumption[i] + spread;
                        if (applyAutoPayDiscount) {
                            transactions[i].rate -= lender.auto_pay_discount;
                        }
                        transactions[i].np = loanTerm * 12 - i + 1;
                        transactions[i].amount =  -1 * this.PMT(transactions[i].rate / 12 / 100, transactions[i].np, (transactions[i - 1].principal + transactions[i - 1].uncapitalized_interest), null, null);
                        transactions[i].when = this.addMonth(transactions[i - 1].when);
                        transactions[i].uncapitalized_interest = 0;
                        transactions[i].principal = (transactions[i - 1].principal + transactions[i - 1].uncapitalized_interest) * (1 + transactions[i].rate / 12 / 100) - transactions[i].amount;
                    }
                }
                return transactions;
            },
            getTransactionsForImmediateRepayment(lender, loanTerm, loanAmount, interestRate, applyAutoPayDiscount) {
                if (applyAutoPayDiscount) {
                    interestRate -= lender.auto_pay_discount;
                }
                const months_to_pay_off = loanTerm*12;
                const monthly_payment = -1 * this.PMT(interestRate / 12 / 100, loanTerm * 12, loanAmount, null, null);
                const transactions = [];
                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        transactions[i] = {amount: -1 * loanAmount, when: new Date(2010, 1, 1)};
                    } else {
                        transactions[i] = {amount: monthly_payment, when: this.addMonth(transactions[i - 1].when)};
                    }
                }
                return transactions;
            },
            XIRR(transactions) {
                let return_value = 0;
                try {
                    return_value = xirr(transactions);
                } catch (err) {
                    transactions.forEach((value) => {
                        value.amount = -1 * value.amount;
                    });
                    this.calculating = false;
                    return_value  = xirr(transactions);
                }
                return return_value;
            },
            calculateSimpleInterestAccrual(amount, interest_rate, months) {
                return amount * interest_rate / 100 * months / 12;
            },
            addMonth(date) {
                const old_month = date.getMonth();
                const old_year = date.getFullYear();

                let new_month = old_month + 1;
                let new_year = old_year;

                if (old_month == 12) {
                    new_month = 1;
                    new_year = old_year + 1;
                }

                return new Date(new_year, new_month, 1);
            },
            PMT(ir, np, pv, fv, type) {
                /*
                 * ir   - interest rate per month
                 * np   - number of periods (months)
                 * pv   - present value
                 * fv   - future value
                 * type - when the payments are due:
                 *        0: end of the period, e.g. end of month (default)
                 *        1: beginning of period
                 */
                let pmt; let
                    pvif;

                fv || (fv = 0);
                type || (type = 0);

                if (ir === 0) return -(pv + fv) / np;

                pvif = Math.pow(1 + ir, np);
                pmt = -ir * pv * (pvif + fv) / (pvif - 1);

                if (type === 1) pmt /= (1 + ir);

                return pmt;
            },
            percentageValidation(name, event) {
                if (this[name] && this[name].split('.').length === 2) {
                    if (this[name].split('.')[1].length === 2 && event.key !== 'Backspace') {
                        event.preventDefault();
                    }
                }
            },
            formatCurrency(value) {
                if (Number.isFinite(value)) {
                    return numeral(value).format('$0,0');
                }
                return value;
            },
            formatPercentage(value) {
                return numeral(value / 100).format('0.00%');
            },
            onResize() {
                this.windowWidth = window.innerWidth;
            },
            showTr(i, calculated) {
                let num = i;
                if (!calculated) {
                    num += this.calculatedValues.length;
                }
                const index = this.activeStep * this.colCount;
                if (index + this.colCount > this.columns) {
                    return num >= (this.columns - this.colCount);
                }
                return num >= index && num < (index + this.colCount);
            },
            changeStep(index) {
                if (index >= 0 && index < this.dotsCount) {
                    this.activeStep = index;
                }
            },
            aprChange() {
                if (this.apr !== '') {
                    if (this.apr > 10) {
                        this.apr /= Math.pow(10, String(Math.floor(this.apr)).length - 1);
                    }
                    this.apr = numeral(this.apr).format('0.00');
                }
            },
            showBorder(index) {
                return (index === this.calculatedValues.length - 1) && this.showTr(0, false);
            },
        },
    };
</script>
