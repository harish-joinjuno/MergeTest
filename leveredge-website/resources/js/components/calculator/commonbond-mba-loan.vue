<!--suppress SpellCheckingInspection -->
<template>
    <div class="col-12">
        <h2>
            Commonbond Mba Loan Cost Calculator
        </h2>
        <div class="separator"></div>

        <div class="d-md-none mt--3">
            <h4>You require a wider screen to view the calculator</h4>
            <p class="mt-3">
                Expand your web browser or use a device with a wider screen.
            </p>
        </div>

        <div class="d-none d-md-block mt--3">

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

                    <div class="row mt-3">

                        <div class="col-12 col-md-3">
                            <div class="form-group">
                                <label for="loan_amount">Loan Amount</label>
                                <input type="number"
                                    class="form-control"
                                    placeholder="Enter loan amount"
                                    name="loan_amount"
                                    @input="calculate"
                                    v-model.number="loanAmount">
                            </div>
                            <div class="form-group">
                                <label for="apr">APR</label>
                                <div class="input-group mb-3">
                                    <input type="number"
                                        class="form-control"
                                        placeholder="Enter apr"
                                        name="apr"
                                        step=".1"
                                        @input="calculate"
                                        v-model.number="apr">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="years_of_school_left">Years of School Left</label>

                                <select id="years_of_school_left"
                                        class="form-control"
                                        @change="calculate"
                                        v-model.number="yearOfSchoolLeft"
                                        name="years_of_school_left">
                                    <option v-for="(text, value) in yearOfSchoolLefts"
                                        v-text="text"
                                        :value="value"></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="term">Term</label>
                                <select id="term"
                                    class="form-control"
                                    v-model.number="term"
                                    name="years_of_school_left">
                                    <option v-for="(text, value) in terms"
                                        v-text="text"
                                        @change="calculate"
                                        :value="value"></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rate_type">Repayment Type</label>
                                <select id="repayment_type"
                                    class="form-control"
                                    @change="calculate"
                                    v-model="repaymentType"
                                    name="years_of_school_left">
                                    <option v-for="(text, value) in repaymentTypes"
                                        v-text="text"
                                        :value="text"></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="rate_type">Rate Type</label>
                                <select id="rate_type"
                                    class="form-control"
                                    v-model="rateType"
                                    @change="calculate"
                                    name="years_of_school_left">
                                    <option v-for="(text, value) in rateTypes"
                                        v-text="text"
                                        :value="value"></option>
                                </select>
                            </div>

                            <div class="form-group" v-if="showVariableAssumption">
                                <label for="variable_assumption">Variable Assumption</label>
                                <select id="variable_assumption"
                                    class="form-control"
                                    v-model="variableAssumption"
                                    @change="calculate"
                                    name="years_of_school_left">
                                    <option v-for="(text, value) in variableAssumptions"
                                        v-text="text"
                                        :value="value"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-9 text-center">
                            <table id="compare-options-sl" class="table table-bordered bg-light-grey">

                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>In School</th>
                                    <th>After School</th>
                                    <th>Total Financing Cost</th>
                                    <th>Effective APR</th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>Life of Loan</td>
                                    <td v-text="lifeOfLoan.in_school"></td>
                                    <td v-text="lifeOfLoan.after_school"></td>
                                    <td v-text="lifeOfLoan.total_financing_cost"></td>
                                    <td v-text="lifeOfLoan.effective_apr"></td>
                                </tr>
                                <tr>
                                    <td>Refi after Grace</td>
                                    <td v-text="refiAfterGrace.in_school"></td>
                                    <td v-text="refiAfterGrace.after_school"></td>
                                    <td v-text="refiAfterGrace.total_financing_cost"></td>
                                    <td v-text="refiAfterGrace.effective_apr"></td>
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

    import xirr    from 'xirr';

    export default {
        data() {
            return {
                loanAmount:          null,
                apr:                 null,
                yearOfSchoolLeft:    1,
                term:                10,
                repaymentType:       'Fully Deferred',
                rateType:            'fixed_rate',
                variableAssumption:  'base_case',
                yearOfSchoolLefts:   {
                    1: '1 Year',
                    2: '2 Year',
                    3: '3 Year',
                    4: '4 Year'
                },
                terms:                {
                    10: '10 Years',
                    15: '15 Years',
                },
                repaymentTypes:       {
                    'fully_deferred':      'Fully Deferred',
                    'interest_only':       'Interest Only',
                    'fixed_payments':       'Fixed Payments',
                    'immediate_repayment': 'Immediate Repayment'
                },
                rateTypes:            {
                    'fixed_rate':    'Fixed Rate',
                    'variable_rate': 'Variable Rate'
                },
                variableAssumptions:   {
                    'base_case':      'Base case',
                    'agressive':      'Agressive',
                    'very_agressive': 'Very agressive'
                },
                lifeOfLoan: {
                    in_school:            null,
                    after_school:         null,
                    total_financing_cost: null,
                    effective_apr:        null
                },
                refiAfterGrace: {
                    in_school:            null,
                    after_school:         null,
                    total_financing_cost: null,
                    effective_apr:        null
                },


                LIBOR_1_MONTH: '1 Month LIBOR',
                LIBOR_3_MONTH: '3 Month LIBOR',
            }
        },

        computed: {
            showVariableAssumption() {
                return this.rateType === 'variable_rate'
            },
            lenders: function() {
                return {
                    'CommonBond': {
                        fixed_amount:               null,
                        origination_fee_rate:       2,
                        leveredge_reward_rate:      0.5,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                        eligible_repayment_types:   [
                            this.repaymentTypes.fully_deferred,
                            this.repaymentTypes.interest_only,
                            this.repaymentTypes.immediate_repayment
                        ],
                    },
                    'FederalDirect': {
                        fixed_amount:               null,
                        origination_fee_rate:       1.059,
                        months_of_grace_period:     6,
                        variable_benchmark:         null,
                        auto_pay_discount:          0,
                        eligible_repayment_types:   [
                            this.repaymentTypes.fully_deferred,
                        ],
                    },
                    'FederalPlus': {
                        fixed_amount:               null,
                        origination_fee_rate:       4.236,
                        months_of_grace_period:     6,
                        variable_benchmark:         null,
                        auto_pay_discount:          0,
                        eligible_repayment_types:   [
                            this.repaymentTypes.fully_deferred,
                        ],
                    },
                    'Earnest': {
                        fixed_amount:               25,
                        origination_fee_rate:       0,
                        leveredge_reward_rate:     0.5,
                        months_of_grace_period:     6,
                        variable_benchmark:         this.LIBOR_1_MONTH,
                        auto_pay_discount:          0.25,
                        eligible_repayment_types:   [
                            this.repaymentTypes.fully_deferred,
                            this.repaymentTypes.fixed_payments,
                            this.repaymentTypes.interest_only,
                            this.repaymentTypes.immediate_repayment
                        ],
                    },
                }
            },
        },

        methods: {
            calculate(){
                let interestRate = this.calculateInterestRate();

                // With Refi and Without Refinance

                // Calculate Monthly Payment In School
                // Calculate Monthly Payment Out of School
                // Calculate LeverEdge Benefit
                // Calculate Total Payments



                console.log(interestRate);
            },
            calculateInterestRate() {

                let interest_rate_guess = 0.5;
                const increment = 0.001;

                if(!(this.apr > 0) || !(this.loanAmount > 0)){
                    return 0;
                }

                let apr = 0;
                let loop = 0;
                while( apr < this.apr ){
                    try{
                        apr = this.getApr( this.loanAmount, interest_rate_guess, this.term, this.yearOfSchoolLeft, this.repaymentType, this.lenders.Earnest );
                    }catch(err){
                        console.log(err);
                    }
                    interest_rate_guess += increment;

                    loop++;
                    if(loop > 10000){
                        apr = null;
                        interest_rate_guess = null;
                        break;
                    }
                }

                if(interest_rate_guess !== 0 && interest_rate_guess != null){
                    return interest_rate_guess;
                }else{
                    throw 'Could not compute the interest rate';
                }
            },
            getApr(loanAmount, interestRate, loanTerm, yearsOfSchoolLeft, repaymentType, lender){
                let transactions = null;
                switch(repaymentType){
                    case this.repaymentTypes.fully_deferred:
                        transactions = this.getTransactionsForFullyDeferred(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, true);
                        break;

                    case this.repaymentTypes.fixed_payments:
                        transactions = this.getTransactionsForFixedPayments(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, true);
                        break;

                    case this.repaymentTypes.interest_only:
                        transactions = this.getTransactionsForInterestOnly(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, true);
                        break;

                    case this.repaymentTypes.immediate_repayment:
                        transactions = this.getTransactionsForImmediateRepayment(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, true);
                        break;

                    default:
                        throw 'Invalid Repayment Type';
                }

                if(transactions.length < 2){
                    throw 'Too few transactions. Something is wrong';
                }
                return this.XIRR(transactions)*100;
            },
            getTransactionsForFullyDeferred(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, applyAutoPayDiscount){
                const months_of_grace_period = lender.months_of_grace_period;
                const months_to_repayment = yearsOfSchoolLeft*12 + months_of_grace_period;
                const months_to_pay_off = months_to_repayment + loanTerm*12;
                const origination_fee = loanAmount * lender.origination_fee_rate / 100;
                const principal = loanAmount + origination_fee;
                const interest_accrued = this.calculateSimpleInterestAccrual(principal, interestRate, months_to_repayment);
                const principal_at_repayment = principal + interest_accrued;

                if(applyAutoPayDiscount){
                    interestRate -= lender.auto_pay_discount;
                }
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
                return transactions;
            },
            getTransactionsForInterestOnly(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, applyAutoPayDiscount){
                if(applyAutoPayDiscount){
                    interestRate -= lender.auto_pay_discount;
                }
                const months_of_grace_period = lender.months_of_grace_period;
                const months_to_repayment = yearsOfSchoolLeft*12 + months_of_grace_period;
                const months_to_pay_off = months_to_repayment + loanTerm*12;
                const origination_fee = loanAmount * lender.origination_fee_rate / 100;
                const principal = loanAmount + origination_fee;
                const payments_during_school = principal * interestRate/12/100;
                const principal_at_repayment = principal;
                const monthly_payment = -1 * this.PMT(interestRate / 12 / 100, loanTerm*12, principal_at_repayment, null, null);
                const transactions = [];
                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        transactions[i] = {amount: -1 * loanAmount, when: new Date(2010, 1, 1)};
                    } else if (i <= months_to_repayment) {
                        transactions[i] = {amount: payments_during_school, when: this.addMonth(transactions[i - 1].when)};
                    } else {
                        transactions[i] = {amount: monthly_payment, when: this.addMonth(transactions[i - 1].when)};
                    }
                }
                return transactions;
            },
            getTransactionsForFixedPayments(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, applyAutoPayDiscount){
                if(applyAutoPayDiscount){
                    interestRate -= lender.auto_pay_discount;
                }
                const months_of_grace_period = lender.months_of_grace_period;
                const months_to_repayment = yearsOfSchoolLeft*12 + months_of_grace_period;
                const months_to_pay_off = months_to_repayment + loanTerm*12;
                const origination_fee = loanAmount * lender.origination_fee_rate / 100;
                const principal = loanAmount + origination_fee;

                const interest_accrued_upto_repayment = this.calculateSimpleInterestAccrual(principal, interestRate, months_to_repayment);
                const payments_during_school = lender.fixed_amount;
                const total_payments_upto_repayment = months_to_repayment * payments_during_school;

                const principal_at_repayment = principal + interest_accrued_upto_repayment - total_payments_upto_repayment;
                const monthly_payment = -1 * this.PMT(interestRate / 12 / 100, loanTerm*12, principal_at_repayment, null, null);
                const transactions = [];
                for (let i = 0; i <= months_to_pay_off; i++) {
                    if (i === 0) {
                        transactions[i] = {amount: -1 * loanAmount, when: new Date(2010, 1, 1)};
                    } else if (i <= months_to_repayment) {
                        transactions[i] = {amount: payments_during_school, when: this.addMonth(transactions[i - 1].when)};
                    } else {
                        transactions[i] = {amount: monthly_payment, when: this.addMonth(transactions[i - 1].when)};
                    }
                }
                return transactions;
            },
            getTransactionsForImmediateRepayment(lender, yearsOfSchoolLeft, loanTerm, loanAmount, interestRate, applyAutoPayDiscount){
                if(applyAutoPayDiscount){
                    interestRate -= lender.auto_pay_discount;
                }
                const months_to_repayment = 0;
                const months_to_pay_off = months_to_repayment + loanTerm*12;
                const origination_fee = loanAmount * lender.origination_fee_rate / 100;
                const principal = loanAmount + origination_fee;
                const principal_at_repayment = principal;
                const monthly_payment = -1 * this.PMT(interestRate / 12 / 100, loanTerm*12, principal_at_repayment, null, null);
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
        },
    }
</script>
