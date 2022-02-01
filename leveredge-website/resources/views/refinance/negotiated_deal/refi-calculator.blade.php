<div class="container">
    <div class="row">
        <div class="col-12">

            <h2>The Juno Calculator</h2>
            <div class="separator"></div>

            <p class="mt--3">
                If you have been shopping around, you can use our calculator to compare different offers that you have received including the negotiated deal from Earnest.
            </p>

            <div class="card mt-3 negotiated-deal-shadow border-0">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <h2>Compare your refinance options</h2>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-12 col-md-3">
                            <form id="refinance-calculator" onsubmit="return addRow(event)">
                                <div class="form-group">
                                    <label for="loan_balance">Loan Balance</label>
                                    <input type="text" class="form-control" id="loan_balance" placeholder="Enter loan balance" name="loan_balance" onkeyup="loanBalanceUpdated()">
                                </div>

                                <h4 class="mt-4">Option Details</h4>

                                <div class="form-group">
                                    <label for="interest_rate">Interest Rate</label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="any" min="0" max="20" class="form-control" id="interest_rate" placeholder="Enter interest rate" name="interest_rate">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="loan_term">Loan Term (Years)</label>

                                    <div class="input-group mb-3">
                                        <input type="number" step="any" min="1" max="30" class="form-control" id="loan_term" placeholder="Enter loan term" name="loan_term">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Years</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="option_name">Option Name (Optional)</label>
                                    <input type="text" class="form-control" id="option_name" placeholder="Enter Option Name" name="option_name">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block" id="add_option">Add Option</button>
                            </form>
                        </div>

                        <div class="col-12 col-md-9 text-center">
                            <table id="compare-options" class="table table-bordered bg-light-grey table-responsive">

                                <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Interest Rate</th>
                                    <th>Loan Term</th>
                                    <th>Monthly Payment</th>
                                    <th>Total Payments</th>
                                    <th><i class="fas fa-trash"></i></th>
                                </tr>
                                </thead>

                                <tr id="empty-row">
                                    <td colspan="6">Enter your first option to see more information</td>
                                </tr>

                            </table>

                        </div>



                    </div>


                </div>
            </div>


        </div>
    </div>
</div>
