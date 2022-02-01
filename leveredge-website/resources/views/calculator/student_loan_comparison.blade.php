@extends('template.public')

@section('content')

    <div class="jumbotron pt-0 pb-0 mt-0 mb-0 bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>
                        Grad School Student Loan Comparison Calculator
                    </h2>
                    <div class="separator"></div>

                    <div class="d-md-none mt--3">
                        <h4>You require a wider screen to view the calculator</h4>
                        <p class="mt-3">
                            Expand your web browser or use a device with a wider screen.
                        </p>
                    </div>

                    <div class="d-none d-md-block mt--3">

                        <p class="mb-3">
                            Graduate students can use our calculator to compare different offers private student loan
                            options as well as the Federal Direct Plus and Grad Plus loan options.
                        </p>

                        <p>
                            Coming soon: this calculator will be replaced with a different calculator that provides
                            you with the ability to compare variable rate private student loan options.
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
                                        <form id="refinance-calculator" onsubmit="return addRow(event)">


                                            <!-- Loan Balance -->
                                            <div class="form-group">
                                                <label for="loan_balance">Loan Balance</label>
                                                <input value="70000" type="text" class="form-control" id="loan_balance" placeholder="Enter loan balance" name="loan_balance" onkeyup="loanBalanceUpdated()">
                                            </div>


                                            <!-- Years in College -->
                                            <div class="form-group mt-3">
                                                <label for="sl_years_in_college">{{ __('Years Left in School') }}</label>

                                                <select id="sl_years_in_college" class="form-control{{ $errors->has('sl_years_in_college') ? ' is-invalid' : '' }}" name="sl_years_in_college" required>
                                                    <option value="1">1 Year</option>
                                                    <option value="2">2 Years</option>
                                                    <option value="3">3 Years</option>
                                                    <option value="4">4 Years</option>
                                                    <option value="5">5 Years</option>
                                                    <option value="6">6 Years</option>
                                                </select>

                                                @if ($errors->has('sl_years_in_college'))
                                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sl_years_in_college') }}</strong>
                    </span>
                                                @endif
                                            </div>

                                        {{--<h4 class="mt-4">Option Details</h4>--}}

                                        <!-- Interest Rate -->
                                            <div class="form-group">
                                                <label for="interest_rate">Interest Rate</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" step="any" min="0" max="20" class="form-control" id="interest_rate" placeholder="Enter interest rate" name="interest_rate">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Loan Term -->
                                            <div class="form-group">
                                                <label for="loan_term">Loan Term (Years)</label>

                                                <div class="input-group mb-3">
                                                    <input type="number" step="any" min="1" max="30" class="form-control" id="loan_term" placeholder="Enter loan term" name="loan_term">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Years</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Repayment Option -->
                                            <div class="form-group">
                                                <label for="sl_repayment_option">{{ __('Repayment Option') }}</label>

                                                <select id="sl_repayment_option" class="form-control{{ $errors->has('sl_repayment_option') ? ' is-invalid' : '' }} mb-3" name="sl_repayment_option" required>
                                                    <option selected value="deferred">Deferred</option>
                                                    <option value="interest_only">Interest Only</option>
                                                    <option value="full_repayment">Full Repayment</option>
                                                </select>

                                                @if ($errors->has('sl_repayment_option'))
                                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sl_repayment_option') }}</strong>
                    </span>
                                                @endif
                                            </div>


                                            <div class="form-group">
                                                <label for="option_name">Option Name (Optional)</label>
                                                <input type="text" class="form-control" id="option_name" placeholder="Enter Option Name" name="option_name">
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block" id="add_option">Add Option to Table</button>
                                        </form>
                                    </div>

                                    <div class="col-12 col-md-9 text-center">
                                        <table id="compare-options-sl" class="table table-bordered bg-light-grey">

                                            <thead>

                                            <tr>
                                                <th rowspan="2">Option</th>
                                                <th rowspan="2">Interest</th>
                                                <th rowspan="2">Term (Years)</th>
                                                <th rowspan="2">Repayment Plan</th>
                                                <th colspan="2">Monthly Payment</th>
                                                <th rowspan="2">Total Payments</th>
                                                <th rowspan="2"><i class="fas fa-trash"></i></th>
                                            </tr>

                                            <tr>
                                                <th>In School</th>
                                                <th>After School</th>
                                            </tr>
                                            </thead>

                                            <tr id="federal-row">
                                                <td colspan="2">Federal Grad Loans</td>
                                                <td>10</td>
                                                <td>Deferred</td>
                                                <td>$0</td>
                                                <td id="monthly_federal"></td>
                                                <td id="total_federal"></td>
                                                <td></td>
                                            </tr>

                                            <tr id="empty-row">
                                                <td colspan="8">Enter your first option to see more information</td>
                                            </tr>

                                        </table>

                                    </div>



                                </div>


                            </div>
                        </div>


                    </div>


                </div>

                <div class="col-12">

                    <p class="mt-3">
                        <strong>Assumptions common to both calculations</strong>
                    </p>
                    <ul>
                        <li>Assumes interest accrues in college</li>
                        <li>Assumes interest accrues during grace period</li>
                        <li>Assumes the student uses a 6 month grace period</li>
                        <li>Accrued interest capitalizes upon entering repayment after college and grace period</li>
                    </ul>

                    <p class="mt-3">
                        <strong>Assumptions with the Federal Option Calculation</strong>
                    </p>
                    <ul>
                        <li>Assumes first disbursement is after Oct 1st, 2019 and before September 30th, 2020</li>
                        <li>4.30% Interest Rate for the First $20,500</li>
                        <li>5.30% Interest Rate for anything above that</li>
                        <li>1.059% Origination Fee for the First $20,500</li>
                        <li>4.236% Origination Fee for anything above that</li>
                    </ul>

                    <p class="mt-3">
                        <strong>For the Private Loan Calculations</strong>
                    </p>
                    <ul>
                        <li>Assumes interest rate as specified</li>
                        <li>Assumes no origination fee</li>
                        <li>Assumes no application fee</li>
                    </ul>


                    <p class="mt-4">
                        We do not guarantee the calculator's accuracy or applicability to your circumstances, and we encourage you to consult a qualified professional for assistance in analyzing your overall financial situation.
                    </p>

                </div>

            </div>
        </div>
    </div>




@endsection


@push('footer-scripts')


    <script src="{{ url('/lib/cleave/cleave.min.js') }}"></script>
    <script>
        var cleave = new Cleave('#loan_balance', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>


    <script>

        var loan_options = [];

        function PMT(ir, np, pv, fv, type) {
            /*
             * ir   - interest rate per month
             * np   - number of periods (months)
             * pv   - present value
             * fv   - future value
             * type - when the payments are due:
             *        0: end of the period, e.g. end of month (default)
             *        1: beginning of period
             */
            var pmt, pvif;

            fv || (fv = 0);
            type || (type = 0);

            if (ir === 0)
                return -(pv + fv)/np;

            pvif = Math.pow(1 + ir, np);
            pmt = - ir * pv * (pvif + fv) / (pvif - 1);

            if (type === 1)
                pmt /= (1 + ir);

            return pmt;
        }


        function removeCommas(str) {
            while (str.search(",") >= 0) {
                str = (str + "").replace(',', '');
            }
            return str;
        }


        function pushToTable(loan_option){

            var loan_balance = parseInt( removeCommas($('#loan_balance').val()) ) ;

            // Adding 0.5 year of grace period
            var years_in_college = parseInt( $('#sl_years_in_college option:selected').val() ) + 0.5;
            var interest_rate = loan_option[0];
            var loan_term = loan_option[1];
            var repayment_option = loan_option[2];
            var option_name = loan_option[3];

            var payments_in_college = 0;
            var interest_accrued_in_college = 0;
            switch(repayment_option){
                case "deferred":
                    repayment_option_text = "Deferred";
                    interest_accrued_in_college = loan_balance * years_in_college * interest_rate/100;
                    payments_in_college = 0;
                    break;
                case "interest_only":
                    repayment_option_text = "Interest Only";
                    interest_accrued_in_college = 0;
                    payments_in_college = loan_balance * years_in_college * interest_rate/100;
                    break;
                case "full_repayment":
                    repayment_option_text = "Full Repayment";
                    payments_in_college = 0;
                    interest_accrued_in_college = 0;
                    break;
            }

            var loan_balance_entering_repayment = loan_balance + interest_accrued_in_college;
            var monthly_payment = -1*PMT(interest_rate/12/100, loan_term*12, loan_balance_entering_repayment);
            var total_payments = (monthly_payment*loan_term*12) + payments_in_college;

            var monthly_payments_in_college = 0;
            switch(repayment_option){
                case "deferred":
                    monthly_payments_in_college = 0;
                    break;
                case "interest_only":
                    monthly_payments_in_college = payments_in_college / years_in_college / 12;
                    break;
                case "full_repayment":
                    monthly_payments_in_college = monthly_payment;
                    break;
            }

            $('#compare-options-sl').append(
                '<tr class="loan_option" id="loan_option_' + (loan_options.length) + '">' +
                "<td>" + option_name + "</td>" +
                "<td>" + interest_rate + "%" + "</td>" +
                "<td>" + loan_term + "</td>" +
                "<td>" + repayment_option_text + "</td>" +
                "<td>" + "$" + Math.round(monthly_payments_in_college).toLocaleString() + "</td>" +
                "<td>" + "$" + Math.round(monthly_payment).toLocaleString() + "</td>" +
                "<td>" + "$" + Math.round(total_payments).toLocaleString() + "</td>" +
                "<td>" + '<a onclick="deleteRow(' + loan_options.length + ')"' +  ' class="deleteLink" href="javascript:void(0);"><i class="fas fa-trash"></i></a>' + "</td>" +
                "</tr>"
            );

            // Clear the Interest Rate and Loan Term
            $('#interest_rate').val("");
            $('#loan_term').val("");

        }

        function addRow(e){
            // Prevent Default
            e.preventDefault();

            try {

                // Get the information on the calculator
                var interest_rate = $('#interest_rate').val();
                var loan_term = $('#loan_term').val();
                var repayment_option =  $('#sl_repayment_option').val();
                var option_name = $('#option_name').val();

                if( loan_term == null || loan_term == "" || interest_rate == "" || interest_rate == null ){
                    console.log('i am here');
                    return false;
                }

                // Store the loan inputs
                loan_options.push([interest_rate, loan_term, repayment_option, option_name]);

                // Push to Table
                pushToTable(loan_options[loan_options.length - 1]);

                // Delete the empty row first time
                if(loan_options.length === 1){
                    document.getElementById("empty-row").remove();
                }

            } catch (e) {
                throw new Error(e.message);
            }

            // So that the form doesn't actually submit
            return false;
        }



        function loanBalanceUpdated(){
            // Delete all the entries
            $('#compare-options-sl .loan_option').remove();

            // Create new rows for every loan option
            loan_options.forEach(function(loan_option){
                pushToTable(loan_option);
            });

            // Update the Federal
            addFederalRow();
        }


        $('#sl_years_in_college').change(function(){
            // Delete all the entries
            $('#compare-options-sl .loan_option').remove();

            // Create new rows for every loan option
            loan_options.forEach(function(loan_option){
                pushToTable(loan_option);
            });

            // Update the Federal
            addFederalRow();
        });

        function deleteRow(rowNumber){
            // Delete from the table
            $('#loan_option_' + rowNumber).remove();

            // Delete from the Loan Options Array
            var removed = loan_options.splice(rowNumber - 1,1);
        }


        function addFederalRow(){
            // Calculate Federal

            // Get the Inputs
            var loan_balance = parseInt( removeCommas($('#loan_balance').val()) ) ;
            var years_in_college = parseInt( $('#sl_years_in_college option:selected').val() ) + 0.5;

            var loan_balance_1 = Math.min(loan_balance, 20500);
            var loan_balance_2 = Math.max(loan_balance - 20500, 0);

            const interest_rate_1 = 4.30/100;
            const origination_rate_1 = 1.059/100;
            const interest_rate_2 = 5.30/100;
            const origination_rate_2 = 4.236/100;

            function monthlyFederalPayment(loan_balance,origination_rate,interest_rate, years_in_college){
                var balance_after_origination = loan_balance * (1 + origination_rate);
                var balance_at_end_of_college = balance_after_origination + ( balance_after_origination * interest_rate * years_in_college);

                return -1*PMT(interest_rate/12, 10*12, balance_at_end_of_college);
            }

            var monthly_payment_1 = monthlyFederalPayment(loan_balance_1, origination_rate_1, interest_rate_1, years_in_college);
            var monthly_payment_2 = monthlyFederalPayment(loan_balance_2, origination_rate_2, interest_rate_2, years_in_college);


            var total_monthly_payment = monthly_payment_1 + monthly_payment_2;
            var total_payments = total_monthly_payment*12*10;


            $('#monthly_federal').text( "$" + Math.round(total_monthly_payment) .toLocaleString());
            $('#total_federal').text( "$" +  Math.round(total_payments).toLocaleString());
        }


        $(document).ready(function(){
           addFederalRow();
        });

    </script>

@endpush
