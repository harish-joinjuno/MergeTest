<script>
    // Disable submits on the Student Loan Calculator
    $('#student-loan-calculator').submit(false);

    // Constants
    // Federal Interest and Fees Calculation
    const fed_loan_1_limit = 20500;
    const fed_loan_1_ir = 6.08/100;
    const fed_loan_1_origination_rate = 1.062/100;
    const fed_loan_2_ir = 7.08/100;
    const fed_loan_2_origination_rate = 4.248/100;


    // Every time the loan amount changes, update everything else
    var slider = document.getElementById("sl_loan_amount");
    var loan_term_input = document.getElementById("sl_loan_term");
    var repayment_option_input = document.getElementById("sl_repayment_option");
    var output = document.getElementById("show_loan_amount");

    var federal_total = document.getElementById("federal_total");
    var federal_monthly = document.getElementById("federal_monthly");
    var lr_total = document.getElementById("lr_total");
    var lr_monthly = document.getElementById("lr_monthly");
    var lr_savings = document.getElementById("lr_savings");

    var lr_term = document.getElementById("lr_term");
    var lr_payment_plan = document.getElementById("lr_payment_plan");

    // output.innerHTML = parseInt( removeCommas(slider.value) ).toLocaleString(); // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    let updateTheCalculator = function() {
        // output.innerHTML = parseInt(  removeCommas(slider.value)  ).toLocaleString();


        // Calculate how much interest builds up over the years in college
        var loan_balance = parseInt(removeCommas(slider.value));

        var fed_loan_1_amount = Math.min(loan_balance, fed_loan_1_limit);
        var fed_loan_2_amount = Math.max(0, loan_balance - fed_loan_1_limit);

        var fed_loan_1_accrual_in_college = interest_and_fees_accrued_in_college(fed_loan_1_amount, "deferred", 2.5, fed_loan_1_origination_rate, fed_loan_1_ir);
        var fed_loan_2_accrual_in_college = interest_and_fees_accrued_in_college(fed_loan_2_amount, "deferred", 2.5, fed_loan_2_origination_rate, fed_loan_2_ir);

        var fed_loan_1_balance_when_entering_repayment = fed_loan_1_amount + fed_loan_1_accrual_in_college.accrued_amount;
        var fed_loan_2_balance_when_entering_repayment = fed_loan_2_amount + fed_loan_2_accrual_in_college.accrued_amount;

        // Calculate the Monthly and Total Payments once you enter repayment
        var fed_loan_1_monthly_payment = -1 * PMT(fed_loan_1_ir / 12, 10 * 12, fed_loan_1_balance_when_entering_repayment);
        var fed_loan_2_monthly_payment = -1 * PMT(fed_loan_2_ir / 12, 10 * 12, fed_loan_2_balance_when_entering_repayment);
        var fed_loan_combined_monthly_payments = fed_loan_1_monthly_payment + fed_loan_2_monthly_payment;

        var fed_loan_1_total_payments = fed_loan_1_monthly_payment * 120;
        var fed_loan_2_total_payments = fed_loan_2_monthly_payment * 120;
        var fed_loan_combined_total_payments = fed_loan_1_total_payments + fed_loan_2_total_payments;

        // Display
        federal_monthly.innerHTML = Math.round(fed_loan_combined_monthly_payments).toLocaleString();
        federal_total.innerHTML = Math.round(fed_loan_combined_total_payments).toLocaleString();

        // Calculate Option Selected
        var lr_loan_term = parseInt(loan_term_input.value);
        var lr_repayment_option = repayment_option_input.value;

        lr_term.innerHTML = loan_term_input.value;

        switch(lr_repayment_option){
            case "deferred":
                lr_payment_plan.innerHTML = "Deferred";
                break;

            case "fixed":
                lr_payment_plan.innerHTML = "Fixed";
                break;

            case "interest_only":
                lr_payment_plan.innerHTML = "Interest Only";
                break;

            case "full_repayment":
                lr_payment_plan.innerHTML = "Full Repayment";
                break;
        }

        // Calculate Laurel Road Interest Rate in College lr_ir_in_college
        // Calculate Repayment Term Interest Rate lr_ir_in_repayment

        var lr_ir_in_college;
        var lr_ir_in_college_2;
        var lr_ir_in_repayment;
        var lr_ir_in_repayment_2;


        // Set the Interest Rate Based on Loan Term
        // These do not include auto pay discount
        switch (lr_loan_term) {
            case 5:
                lr_ir_in_college = 4.98 / 100 + 0.25 / 100;
                lr_ir_in_college_2 = 5.19 / 100 + 0.25 / 100;
                break;

            case 7:
                lr_ir_in_college = 4.73 / 100 + 0.25 / 100;
                lr_ir_in_college_2 = 4.73 / 100 + 0.25 / 100;
                break;

            case 10:
                lr_ir_in_college = 5.06 / 100 + 0.25 / 100;
                lr_ir_in_college_2 = 5.19 / 100 + 0.25 / 100;
                break;

            case 15:
                lr_ir_in_college = 5.75 / 100 + 0.25 / 100;
                lr_ir_in_college_2 = 5.96 / 100 + 0.25 / 100;
                break;

            case 20:
                lr_ir_in_college = 6.38 / 100 + 0.25 / 100;
                lr_ir_in_college_2 = 6.61 / 100 + 0.25 / 100;
                break;
        }

        // Apply the Repayment Plan Discount and the Auto Pay Discount
        switch (lr_repayment_option) {
            case "fixed":
                lr_ir_in_college = lr_ir_in_college - 0.125 / 100 - 0.25 / 100;
                lr_ir_in_college_2 = lr_ir_in_college_2 - 0.125 / 100 - 0.25 / 100;
                break;

            case "deferred":
                break;

            case "interest_only":
                lr_ir_in_college = lr_ir_in_college - 0.250 / 100 - 0.25 / 100;
                lr_ir_in_college_2 = lr_ir_in_college_2 - 0.250 / 100 - 0.25 / 100;
                break;

            case "full_repayment":
                lr_ir_in_college_2 = lr_ir_in_college_2 - 0.375 / 100 - 0.25 / 100;
                break;
        }


        // Apply the Auto Pay Discount if it hasn't already been applied.
        if(lr_repayment_option === "deferred"){
            lr_ir_in_repayment = lr_ir_in_college - (0.25 / 100);
            lr_ir_in_repayment_2 = lr_ir_in_college_2 - (0.25 / 100);
        }else{
            lr_ir_in_repayment = lr_ir_in_college;
            lr_ir_in_repayment_2 = lr_ir_in_college_2;
        }

        // Reduce the Rate during Repayment by 0.25% (for graduation + 100K discount)
        // var lr_ir_in_repayment = lr_ir_in_college - (0.25 / 100);
        // var lr_ir_in_repayment_2 = lr_ir_in_college_2 - (0.25 / 100);

        // If anything but full repayment, calculate like the federal
        var lr_accrual_in_college = interest_and_fees_accrued_in_college(loan_balance, lr_repayment_option, 2.5, 0, lr_ir_in_college);
        var lr_balance_when_entering_repayment = loan_balance + lr_accrual_in_college.accrued_amount;
        var lr_monthly_payment = -1 * PMT(lr_ir_in_repayment / 12, lr_loan_term * 12, lr_balance_when_entering_repayment);
        var lr_total_payments = lr_monthly_payment * lr_loan_term * 12 + lr_accrual_in_college.payments;
        var lr_total_savings = fed_loan_combined_total_payments - lr_total_payments;

        var lr_accrual_in_college_2 = interest_and_fees_accrued_in_college(loan_balance, lr_repayment_option, 2.5, 0, lr_ir_in_college_2);
        var lr_balance_when_entering_repayment_2 = loan_balance + lr_accrual_in_college_2.accrued_amount;
        var lr_monthly_payment_2 = -1 * PMT(lr_ir_in_repayment_2 / 12, lr_loan_term * 12, lr_balance_when_entering_repayment_2);
        var lr_total_payments_2 = lr_monthly_payment_2 * lr_loan_term * 12 + lr_accrual_in_college_2.payments;
        var lr_total_savings_2 = fed_loan_combined_total_payments - lr_total_payments_2;

        if(loan_balance < 5000 || isNaN(loan_balance)){
            federal_monthly.innerHTML = "0";
            federal_total.innerHTML = "0";
            lr_total.innerHTML = "0";
            lr_monthly.innerHTML = "0";
            lr_savings.innerHTML = "0";
            return;
        }


        // Update the Monthly Payment Section
        if (lr_monthly_payment_2 === lr_monthly_payment) {
            lr_monthly.innerHTML = Math.round(lr_monthly_payment_2).toLocaleString();
        } else if (lr_monthly_payment_2 < lr_monthly_payment) {
            lr_monthly.innerHTML = Math.round(lr_monthly_payment_2).toLocaleString() + ' - $' + Math.round(lr_monthly_payment).toLocaleString();
        } else{
            lr_monthly.innerHTML = Math.round(lr_monthly_payment).toLocaleString() + ' - $' + Math.round(lr_monthly_payment_2).toLocaleString();
        }


        // Update the Total Payments Section
        if(lr_total_payments === lr_total_payments_2){
            lr_total.innerHTML = Math.round(lr_total_payments_2).toLocaleString();
        }else if(lr_total_payments_2 < lr_total_payments){
            lr_total.innerHTML = Math.round(lr_total_payments_2).toLocaleString()
                + ' - $'
                + Math.round(lr_total_payments).toLocaleString();
        }else{
            lr_total.innerHTML = Math.round(lr_total_payments).toLocaleString()
                + ' - $'
                + Math.round(lr_total_payments_2).toLocaleString();
        }


        // Update the Total Savings Section
        if(lr_total_savings === lr_total_savings_2){
            lr_savings.innerHTML = Math.round(lr_total_savings).toLocaleString();
        }else if(lr_total_savings > lr_total_savings_2){
            lr_savings.innerHTML = Math.round(lr_total_savings_2).toLocaleString()
                + ' - $'
                + Math.round(lr_total_savings).toLocaleString();
        }else{
            lr_savings.innerHTML = Math.round(lr_total_savings).toLocaleString()
                + ' - $'
                + Math.round(lr_total_savings_2).toLocaleString();
        }


    };


    let interest_and_fees_accrued_in_college = function(loan_amount, repayment_plan, years_in_college, origination_rate, interest_rate){

        if(repayment_plan === "full_repayment"){
            payments_in_college = 0;
            years_in_college = 0;
        }

        var orig_fee = loan_amount * origination_rate;
        var begin_balance = orig_fee + loan_amount;
        var interest_accrued = years_in_college*interest_rate*begin_balance;
        var end_balance = begin_balance + interest_accrued;

        var payments_in_college = 0;

        if(repayment_plan === "deferred"){
            payments_in_college = 0;
        }

        if(repayment_plan === "fixed"){
            payments_in_college = 50 * years_in_college * 12;
        }

        if(repayment_plan === "interest_only"){
            payments_in_college = years_in_college*interest_rate*begin_balance;
        }

        if(repayment_plan === "full_repayment"){
            payments_in_college = 0;
        }

        return {
            accrued_amount: (end_balance - loan_amount - payments_in_college),
            payments: payments_in_college
        };
    };


    // Update the Calculator on any inputs
    slider.oninput = function(){
        updateTheCalculator();
    };

    document.getElementById('sl_repayment_option').oninput = function(){
        updateTheCalculator();
    };

    document.getElementById('sl_loan_term').oninput = function(){
        updateTheCalculator();
    };

    $(document).ready(function(){
        updateTheCalculator();
    });


</script>
