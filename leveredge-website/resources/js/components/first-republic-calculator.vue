<template>
    <div class="py-5 px-0 bg-translucent-green mb-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <h2 class="section-title mb-4 half-underline">
                        Estimate your rate and payments
                    </h2>

                    <div class="form-group checklist py-4 px-3 mb-0 mt-5">
                        <table>
                            <tr>
                                <td class="republic-checkbox-disabled position-relative pb-5">
                                    <input
                                        id="openCheckingAccountCheckbox"
                                        v-model="openCheckingAccount"
                                        class="d-none"
                                        type="checkbox"
                                        :checked="openCheckingAccount"
                                        disabled>
                                    <label for="openCheckingAccountCheckbox">
                                        <i class="fas fa-check white d-none" />
                                        Enroll into auto-debit and direct deposit, with auto-debits from and direct
                                        deposits to a First Republic ATM Rebate Checking account.
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="republic-checkbox position-relative pb-5">
                                    <div
                                        v-if="showTryIt"
                                        class="try-it d-flex justify-content-center align-items-center position-absolute">
                                        <span>Try it</span>
                                    </div>
                                    <input
                                        id="smallBalanceCheckbox"
                                        v-model="smallBalance"
                                        class="d-none"
                                        type="checkbox"
                                        :checked="smallBalance">
                                    <label for="smallBalanceCheckbox">
                                        <i class="fas fa-check white d-none" />
                                        Maintain a minimum of 10% of your approved loan amount in a First Republic ATM Rebate Checking account.
                                        <sup class="foot-note-marker">3</sup>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="republic-checkbox position-relative pb-5">
                                    <input
                                        id="largeBalanceCheckbox"
                                        v-model="largeBalance"
                                        class="d-none"
                                        type="checkbox"
                                        :checked="largeBalance">
                                    <label for="largeBalanceCheckbox">
                                        <i class="fas fa-check white d-none" />
                                        Maintain a minimum of 20% of your approved loan amount in a First Republic ATM Rebate Checking account.
                                        <sup class="foot-note-marker">3</sup>
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-12 offset-lg-1 col-lg-6">
                    <div class="card">
<!--                        <div class="card-body mb-4">-->
<!--                            <div class="row justify-content-center">-->
<!--                                <div class="col-12 col-lg-8">-->
<!--                                    <div class="form-group mb-0 text-center">-->
<!--                                        <label for="loanAmount" class="mb-2">Enter Loan Amount <sup class="foot-note-marker">3</sup></label>-->
<!--                                        <input-->
<!--                                            id="loanAmount"-->
<!--                                            v-model="loanAmountModel"-->
<!--                                            type="text"-->
<!--                                            class="form-control"-->
<!--                                            @input="changeLoanAmount">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="card-body p-0">
                            <table class="table text-center mb-0">
                                <tr>
                                    <td class="bg-grey-heading" colspan="3">
                                        APR <sup class="foot-note-marker">3</sup>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 bg-pink-heading">
                                        7 YEARS
                                    </td>
                                    <td class="py-3 bg-pink-heading">
                                        10 YEARS
                                    </td>
                                    <td class="py-3 bg-pink-heading">
                                        15 YEARS
                                    </td>
                                </tr>
                                <tr>
                                    <td class="values-in-table">
                                        <span v-text="sevenYearApr" />%
                                    </td>
                                    <td class="values-in-table">
                                        <span v-text="tenYearApr" />%
                                    </td>
                                    <td class="values-in-table">
                                        <span v-text="fifteenYearApr" />%
                                    </td>
                                </tr>


<!--                                <tr>-->
<!--                                    <td class="bg-grey-heading" colspan="3">-->
<!--                                        <div class="pink-box bg-accent-pink d-inline-block mb-2 rounded-pill py-2 px-4">-->
<!--                                            First 2 Years-->
<!--                                        </div>-->
<!--                                        <div>Minimum Monthly Payment</div>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="sevenYearInterestOnlyPayment" />-->
<!--                                    </td>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="tenYearInterestOnlyPayment" />-->
<!--                                    </td>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="fifteenYearInterestOnlyPayment" />-->
<!--                                    </td>-->
<!--                                </tr>-->

<!--                                <tr>-->
<!--                                    <td class="bg-grey-heading" colspan="3">-->
<!--                                        <div class="pink-box bg-accent-pink d-inline-block mb-2 rounded-pill py-2 px-4">-->
<!--                                            After 2 Years-->
<!--                                        </div>-->
<!--                                        <div>Minimum Monthly Payment</div>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                                <tr>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="sevenYearFullPayment" />-->
<!--                                    </td>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="tenYearFullPayment" />-->
<!--                                    </td>-->
<!--                                    <td class="values-in-table">-->
<!--                                        $<span v-text="fifteenYearFullPayment" />-->
<!--                                    </td>-->
<!--                                </tr>-->
                            </table>
                        </div>
                    </div>

                    <p class="text-small mt-3">
                        All rates shown include a 2% discount for automatic payments and direct deposit.
                    </p>

                    <h2 class="section-title mt-5 mb-4 half-underline">
                        Considerations
                    </h2>
                    <p>
                        A personal line of credit is <u>not</u> a student loan and you may be permanently giving up the benefits of a
                        student loan such as certain deferment, forbearance, and forgiveness options.
                    </p>
                    <p class="mt-3">
                        That said, a Personal Line of Credit also allows you the flexibility to refinance additional
                        debt – such as auto loans – and can provide access to credit for future expenses.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import numeral from 'numeral';

    export default {
        data() {
            return {
                loanAmountModel:     '$60,000',
                openCheckingAccount: true,
                smallBalance:        true,
                largeBalance:        true,
                tryIt:               true,
            };
        },
        computed: {
            sevenYearApr() {
                return this.adjustRate(2.25);
            },
            tenYearApr() {
                return this.adjustRate(2.75);
            },
            fifteenYearApr() {
                return this.adjustRate(3.50);
            },
            sevenYearInterestRate() {
                return this.lookUpInterestRate(this.sevenYearApr, 7);
            },
            tenYearInterestRate() {
                return this.lookUpInterestRate(this.tenYearApr, 10);
            },
            fifteenYearInterestRate() {
                return this.lookUpInterestRate(this.fifteenYearApr, 15);
            },
            sevenYearInterestOnlyPayment() {
                return (this.sevenYearInterestRate / 100 / 12 * this.loanAmount).toFixed(0);
            },
            tenYearInterestOnlyPayment() {
                return (this.tenYearInterestRate / 100 / 12 * this.loanAmount).toFixed(0);
            },
            fifteenYearInterestOnlyPayment() {
                return (this.fifteenYearInterestRate / 100 / 12 * this.loanAmount).toFixed(0);
            },
            sevenYearFullPayment() {
                return -1 * this.PMT(this.sevenYearInterestRate / 100 / 12, 7 * 12, this.loanAmount, 0).toFixed(0);
            },
            tenYearFullPayment() {
                return -1 * this.PMT(this.tenYearInterestRate / 100 / 12, 10 * 12, this.loanAmount, 0).toFixed(0);
            },
            fifteenYearFullPayment() {
                return -1 * this.PMT(this.fifteenYearInterestRate / 100 / 12, 15 * 12, this.loanAmount, 0).toFixed(0);
            },
            showTryIt() {
                return this.tryIt;
            },
            loanAmount() {
                return parseInt(numeral(this.loanAmountModel).format('0'), 10);
            },
        },

        watch: {
            openCheckingAccount(updatedOpenCheckingAccount) {
                if (!updatedOpenCheckingAccount) {
                    this.smallBalance = false;
                    this.largeBalance = false;
                }

                this.tryIt = false;
            },
            smallBalance(updatedSmallBalance) {
                if (!updatedSmallBalance) {
                    this.largeBalance = false;
                }

                if (updatedSmallBalance) {
                    this.openCheckingAccount = true;
                }

                this.tryIt = false;
            },
            largeBalance(updatedLargeBalance) {
                if (updatedLargeBalance) {
                    this.smallBalance = true;
                    this.openCheckingAccount = true;
                }

                this.tryIt = false;
            },


        },
        methods: {
            adjustRate(startingRate) {
                let rate = startingRate;

                if (!this.openCheckingAccount) {
                    rate += 2;
                }

                if (!this.smallBalance) {
                    rate += 0.5;
                }

                if (!this.largeBalance) {
                    rate += 0.25;
                }
                return rate;
            },
            lookUpInterestRate(apr, years) {
                const table = [
                    {apr: 2.25, years: 7, interest_rate: 2.23},
                    {apr: 2.50, years: 7, interest_rate: 2.47},
                    {apr: 3.00, years: 7, interest_rate: 2.96},
                    {apr: 5.00, years: 7, interest_rate: 4.89},
                    {apr: 4.75, years: 7, interest_rate: 4.65},
                    {apr: 2.75, years: 10, interest_rate: 2.72},
                    {apr: 3.00, years: 10, interest_rate: 2.96},
                    {apr: 3.50, years: 10, interest_rate: 3.45},
                    {apr: 5.50, years: 10, interest_rate: 5.37},
                    {apr: 5.25, years: 10, interest_rate: 5.13},
                    {apr: 3.50, years: 15, interest_rate: 3.45},
                    {apr: 3.75, years: 15, interest_rate: 3.69},
                    {apr: 4.25, years: 15, interest_rate: 4.17},
                    {apr: 6.25, years: 15, interest_rate: 6.08},
                    {apr: 6.00, years: 15, interest_rate: 5.85},
                ];

                for (let i = 0; i < table.length; i++) {
                    if (table[i].apr === apr && table[i].years === years) {
                        return table[i].interest_rate;
                    }
                }

                throw 'APR and Year Combination not in Table';
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
                let pmt;
                let pvif;

                fv || (fv = 0);
                type || (type = 0);

                if (ir === 0) return -(pv + fv) / np;

                pvif = Math.pow(1 + ir, np);
                pmt = -ir * pv * (pvif + fv) / (pvif - 1);

                if (type === 1) pmt /= (1 + ir);

                return pmt;
            },
            changeLoanAmount() {
                this.loanAmountModel = this.loanAmountModel === '' ? '' : numeral(this.loanAmountModel).format('$0,0');
            },
        },

    };
</script>
