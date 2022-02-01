<template>
    <div class="col-12">
        <h2>
            Federal Student Loan Cost Calculator
        </h2>
        <div class="separator" />

        <div class="d-md-none mt--3">
            <h4>You require a wider screen to view the calculator</h4>
            <p class="mt-3">
                Expand your web browser or use a device with a wider screen.
            </p>
        </div>

        <div class="mt--3">
            <p>
                If you have been shopping around, you can use our calculator to compare different offers that you have received.
            </p>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2>Compare your student loan options</h2>
                        </div>
                    </div>

                    <div class="row compare-options-row mt-3">
                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="loan_amount">Loan Amount</label>
                                <input id="loan_amount"
                                       v-model="loanAmount"
                                       type="number"
                                       class="form-control"
                                       placeholder="Enter loan amount"
                                       name="loan_amount"
                                       @change="calculate">
                            </div>

                            <div class="form-group mt-3">
                                <label for="years_of_school_left">Years of School Left</label>

                                <select id="years_of_school_left"
                                        v-model="yearOfSchoolLeft"
                                        class="form-control"
                                        name="years_of_school_left"
                                        @change="calculate">
                                    <option v-for="(text, value) in yearOfSchoolLefts"
                                            :value="value"
                                            v-text="text" />
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-9 text-center p-0">
                            <table id="compare-options-sl" class="table table-bordered bg-light-grey d-flex d-md-table">
                                <thead>
                                    <tr class="d-flex flex-column d-md-table-row">
                                        <th class="p-3 p-md-2">&nbsp;</th>
                                        <th class="p-1 p-md-2">Loan Amount</th>
                                        <th class="p-1 p-md-2">Interest Rate</th>
                                        <th class="p-1 p-md-2">Origination Fee</th>
                                        <th class="p-1 p-md-2">In School</th>
                                        <th class="p-1 p-md-2">After School</th>
                                        <th class="p-1 p-md-2">If you don't refinance</th>
                                        <th class="p-1 p-md-2">If you Refi after 30 Months</th>
                                    </tr>
                                </thead>
                                <tr class="d-flex flex-column d-md-table-row">
                                    <td class="p-1 p-md-2">Direct Plus Loan</td>
                                    <td class="p-1 p-md-2" v-text="formatCurrency(directPlusLoan.loan_amount)" />
                                    <td class="p-1 p-md-2" v-text="formatPercentage(directPlusLoan.interest_rate)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(directPlusLoan.origination_fee)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(directPlusLoan.in_school)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(directPlusLoan.after_school)" />
                                    <td class="p-1 p-md-2 py-3" v-text="formatPercentage(directPlusLoan.dont_refinance)" />
                                    <td class="p-1 p-md-2 py-3" v-text="formatPercentage(directPlusLoan.refi_after_30_month)" />
                                </tr>
                                <tr class="d-flex flex-column d-md-table-row">
                                    <td class="p-1 p-md-2">Grad Plus Loan</td>
                                    <td class="p-1 p-md-2" v-text="formatCurrency(gradPlusLoan.loan_amount)" />
                                    <td class="p-1 p-md-2" v-text="formatPercentage(gradPlusLoan.interest_rate)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(gradPlusLoan.origination_fee)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(gradPlusLoan.in_school)" />
                                    <td class="p-1 p-md-2" v-text="formatCurrency(gradPlusLoan.after_school)" />
                                    <td class="p-1 p-md-2 py-3" v-text="formatPercentage(gradPlusLoan.dont_refinance)" />
                                    <td class="p-1 p-md-2 py-3" v-text="formatPercentage(gradPlusLoan.refi_after_30_month)" />
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script scoped>
    import numeral from 'numeral';
    import xirr    from 'xirr';

    export default {
        data() {
            return {
                loanAmount:        null,
                yearOfSchoolLeft:  1,
                yearOfSchoolLefts: {
                    1: '1 Year',
                    2: '2 Year',
                    3: '3 Year',
                    4: '4 Year',
                },
                directPlusLoan: {
                    loan_amount:         null,
                    interest_rate:       4.30,
                    origination_fee:     null,
                    in_school:           0,
                    after_school:        null,
                    dont_refinance:      null,
                    refi_after_30_month: null,
                },
                gradPlusLoan: {
                    loan_amount:         null,
                    interest_rate:       5.30,
                    origination_fee:     null,
                    in_school:           0,
                    after_school:        null,
                    dont_refinance:      null,
                    refi_after_30_month: null,
                },
            };
        },

        methods: {
            calculate() {
                const direct_loan_limit = 20500;
                const direct_origination_fee_rate = 1.059;
                const plus_origination_fee_rate = 4.236;

                const months_to_repayment = this.yearOfSchoolLeft * 12 + 6;
                const months_to_pay_off = months_to_repayment + 120;

                this.directPlusLoan.loan_amount = Math.min(direct_loan_limit, this.loanAmount);
                this.gradPlusLoan.loan_amount =   Math.max(0, this.loanAmount - direct_loan_limit);

                this.directPlusLoan.origination_fee = this.directPlusLoan.loan_amount * direct_origination_fee_rate / 100;
                this.gradPlusLoan.origination_fee = this.gradPlusLoan.loan_amount * plus_origination_fee_rate / 100;

                const direct_principal = this.directPlusLoan.loan_amount + this.directPlusLoan.origination_fee;
                const plus_principal = this.gradPlusLoan.loan_amount + this.gradPlusLoan.origination_fee;

                const direct_interest_accrued = this.calculateSimpleInterestAccrual(direct_principal, this.directPlusLoan.interest_rate, months_to_repayment);
                const plus_interest_accrued = this.calculateSimpleInterestAccrual(plus_principal, this.gradPlusLoan.interest_rate, months_to_repayment);

                const direct_principal_at_repayment = direct_principal + direct_interest_accrued;
                const plus_principal_at_repayment = plus_principal + plus_interest_accrued;

                this.directPlusLoan.after_school = -1 * this.PMT(this.directPlusLoan.interest_rate / 12 / 100, 120, direct_principal_at_repayment, null, null);
                this.gradPlusLoan.after_school = -1 * this.PMT(this.gradPlusLoan.interest_rate / 12 / 100, 120, plus_principal_at_repayment, null, null);

                const direct_plus_transaction = [];
                const grad_plus_transaction = [];

                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        direct_plus_transaction[i] = {amount: -1 * this.directPlusLoan.loan_amount, when: new Date(2010, 1, 1)};
                        grad_plus_transaction[i] = {amount: -1 * this.gradPlusLoan.loan_amount, when: new Date(2010, 1, 1)};
                    } else if (i <= months_to_repayment) {
                        direct_plus_transaction[i] = {amount: 0, when: this.addMonth(direct_plus_transaction[i - 1].when)};
                        grad_plus_transaction[i] = {amount: 0, when: this.addMonth(grad_plus_transaction[i - 1].when)};
                    } else {
                        direct_plus_transaction[i] = {amount: this.directPlusLoan.after_school, when: this.addMonth(direct_plus_transaction[i - 1].when)};
                        grad_plus_transaction[i] = {amount: this.gradPlusLoan.after_school, when: this.addMonth(grad_plus_transaction[i - 1].when)};
                    }
                }

                this.directPlusLoan.dont_refinance = this.getApr(
                    this.directPlusLoan.loan_amount,
                    direct_origination_fee_rate,
                    this.directPlusLoan.interest_rate,
                    10,
                    this.yearOfSchoolLeft
                );

                this.gradPlusLoan.dont_refinance = this.getApr(
                    this.gradPlusLoan.loan_amount,
                    plus_origination_fee_rate,
                    this.gradPlusLoan.interest_rate,
                    10,
                    this.yearOfSchoolLeft
                );

                direct_plus_transaction.splice(months_to_repayment + 1);
                direct_plus_transaction[months_to_repayment].amount = direct_principal_at_repayment;
                this.directPlusLoan.refi_after_30_month = this.XIRR(direct_plus_transaction) * 100;

                grad_plus_transaction.splice(months_to_repayment + 1);
                grad_plus_transaction[months_to_repayment].amount = plus_principal_at_repayment;
                this.gradPlusLoan.refi_after_30_month = this.XIRR(grad_plus_transaction) * 100;
            },
            getFederalApr(loanAmount, originationFeeRate, interestRate, loanTerm, yearsOfSchoolLeft){
                const months_of_grace_period = 6;
                const months_to_repayment = yearsOfSchoolLeft*12 + months_of_grace_period;
                const months_to_pay_off = months_to_repayment + loanTerm*12;
                const origination_fee = loanAmount * originationFeeRate / 100;
                const principal = loanAmount + origination_fee;
                const interest_accrued = this.calculateSimpleInterestAccrual(principal, interestRate, months_to_repayment);
                const principal_at_repayment = principal + interest_accrued;
                const monthly_payment = -1 * this.PMT(interestRate / 12 / 100, loanTerm*12, principal_at_repayment, null, null);

                const transactions = [];
                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        transactions[i] = {amount: -1 * loanAmount, when: new Date(2010, 1, 1)};
                    } else if (i <= months_to_repayment) {
                        transactions[i] = {amount: 0, when: this.addMonth(transactions[i - 1].when)};
                    } else {
                        transactions[i] = {amount: monthly_payment, when: this.addMonth(transactions[i - 1].when)};
                    }
                }
                return this.XIRR(transactions)*100;
            },
            XIRR(transactions) {
                let return_value = 0;
                try {
                    return_value = xirr(transactions);
                } catch (err) {
                    transactions.forEach((value) => {
                        value.amount = -1 * value.amount;
                    });
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
            formatCurrency(value) {
                return numeral(value).format('$0,0');
            },
            formatPercentage(value) {
                return numeral(value / 100).format('0.00%');
            },
        },
    };
</script>

<style>
    .compare-options-row {
        margin-right: -21px;
        margin-left: -21px;
    }
    #compare-options-sl th {
        font-weight: 600;
        font-size: 16px;
        border-bottom-width: 1px;
    }
    #compare-options-sl td {
        font-size: 16px;
    }
</style>
