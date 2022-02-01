<div class="container">
    @unless(isset($use_alternate_introduction) && $use_alternate_introduction)
    <div class="row">
        <div class="col-12">
            <h2>Estimate Savings Compared to Federal Loan Options <sup>4</sup></h2>
            <div class="separator"></div>
                <p class="mt--3">
                    We encourage you to learn about features available via student loans from the government. Many Juno Members find that they don't anticipate needing those features. If you are in the same boat, the calculator below helps you estimate your savings if you choose to use the Juno + Laurel Road deal.
                </p>
        </div>
    </div>
    @endunless

    <div class="row mt-5">

        <div class="col-12 col-md-4 d-flex flex-column">
            <div class="card border-0 bg-light-grey mt-auto">
                <div class="card-body">
                    <form id="student-loan-calculator" onsubmit="">
                        <div class="form-group ">
                            <label for="sl_loan_amount">{{ __('Loan Amount') }}</label>
                            <input type="text" value="70000" id="sl_loan_amount" class="form-control{{ $errors->has('sl_loan_amount') ? ' is-invalid' : '' }}" name="sl_loan_amount" required>

                            @if ($errors->has('sl_loan_amount'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sl_loan_amount') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <label for="sl_loan_term">{{ __('Loan Term') }}</label>

                            <select id="sl_loan_term" class="form-control{{ $errors->has('sl_loan_term') ? ' is-invalid' : '' }}" name="sl_loan_term" required>
                                <option value="5">5 Year</option>
                                <option value="7">7 Year</option>
                                <option selected value="10">10 Year</option>
                                {{--<option value="15">15 Year</option>--}}
                                {{--<option value="20">20 Year</option>--}}
                            </select>

                            @if ($errors->has('sl_loan_term'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sl_loan_term') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="sl_repayment_option">{{ __('In School Repayment Option') }}</label>

                            <select id="sl_repayment_option" class="form-control{{ $errors->has('sl_repayment_option') ? ' is-invalid' : '' }}" name="sl_repayment_option" required>
                                <option selected value="deferred">Deferred</option>
                                <option value="fixed">$50 Fixed</option>
                                <option value="interest_only">Interest Only</option>
                                <option value="full_repayment">Full Repayment</option>
                            </select>

                            @if ($errors->has('sl_repayment_option'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('sl_repayment_option') }}</strong>
                    </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 mt-4 mt-md-0">

            <div class="row">
                <div class="col-12 col-md-6 offset-md-3 text-center">
                    <h3>Estimated Savings</h3>
                    <h1 class="">$<span id="lr_savings"></span></h1>
                    <p>Over the Life of the Loan</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered mt-3 mb-0">

                        <tr>
                            <td>Payments</td>
                            <td class="selected-col bg-light-blue">Our Deal</td>
                            <td>Federal</td>
                        </tr>

                        <tr>
                            <td>Monthly (After School)</td>
                            <td class="bg-light-blue">$<span id="lr_monthly"></span></td>
                            <td>$<span id="federal_monthly"></span></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td class="bg-light-blue">$<span id="lr_total"></span></td>
                            <td>$<span id="federal_total"></span></td>
                        </tr>

                        <tr>
                            <td>Term</td>
                            <td class="bg-light-blue"><span id="lr_term"></span> Yr</td>
                            <td>10 Yr</td>
                        </tr>

                        <tr>
                            <td>Payment Plan</td>
                            <td class="bg-light-blue"><span id="lr_payment_plan"></span></td>
                            <td>Deferred</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">

            <a data-toggle="collapse" data-target="#collapseCalculatorAssumptions" aria-expanded="false" aria-controls="collapseBuiltTable" href="#collapseCalculatorAssumptions">View assumptions used by the calculator</a>

            <div id="collapseCalculatorAssumptions" class="collapse">
                <p class="mt-3">
                    <strong>Assumptions common to both calculations</strong>
                </p>
                <ul class="mt-3">
                    <li>Assumes interest accrues in college</li>
                    <li>Assumes interest accrues during grace period</li>
                    <li>Assumes that the student is in college for 2 years + 6 month grace</li>
                    <li>Accrued interest capitalizes upon entering repayment</li>
                </ul>

                <p class="mt-4">
                    <strong>Assumptions with the Federal Loan Calculation</strong>
                </p>

                <ul class="mt-3">
                    <li>Assumes first disbursement is after July 1st 2019 and before September 30th</li>
                    <li>6.08% Interest Rate for the First $20,500</li>
                    <li>7.08% Interest Rate for anything above that</li>
                    <li>1.062% Origination Fee for the First $20,500</li>
                    <li>4.248% Origination Fee for anything above that</li>
                </ul>

                <p class="mt-4">
                    <strong>For the Laurel Road Calculation</strong>
                </p>

                <ul class="mt-3">
                    <li>Assumes FICO score between 740 and 760</li>
                    <li>Assumes auto-pay discount when applicable</li>
                </ul>
            </div>

            @if(isset($call_to_action_text) && isset($call_to_action_link))
            <div class="mt-4">
                <a href="{{ $call_to_action_link }}" class="btn btn-primary">
                    {{ $call_to_action_text }}
                </a>
            </div>
            @endif
        </div>
    </div>
</div>


