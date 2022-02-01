@extends('template.public')

@section('content')


    <div class="jumbotron mt-0 mb-0 bg-transparent flanked-images" id="product-hero">
        <div class="container pt-4 text-center text-md-left">
            <div class="row">

                <div class="col-12">

                    <h2 class="text-uppercase text-center text-md-left">Negotiated Refi Deal</h2>

                    <h4 class="mt-3 mt-md-0 text-center text-md-left">Earnest is offering Juno Members a <strong>$500 Bonus</strong> when you refinance your loans.</h4>

                    <table class="mt-5 d-none d-md-table">
                        <tr>
                            <td><img src="{{ url('/img/earnest/earnest-logo.svg') }}" width="180" class="d-inline"></td>
                            <td class="pl-5 pr-5"><h3><i class="fas fa-plus"></i></h3></td>
                            <td><img src="{{ url('/img/logo/new-logo.svg') }}" width="220" class="d-inline"></td>
                            <td class="pl-5 pr-5"><h3><i class="fas fa-equals"></i></h3></td>
                            <td><h2 style="letter-spacing: 0;"><strong>$500 Bonus</strong></h2></td>
                        </tr>
                    </table>

                    <div class="mt-5 d-md-none">
                        <div class="mt-3"><img src="{{ url('/img/earnest/earnest-logo.svg') }}" width="180" class="d-inline"></div>
                        <div class="mt-3"><h3><i class="fas fa-plus"></i></h3></div>
                        <div class="mt-3"><img src="{{ url('/img/logo/new-logo.svg') }}" width="220" class="d-inline"></div>
                        <div class="mt-3"><h3><i class="fas fa-equals"></i></h3></div>
                        <div class="mt-3"><h2 style="letter-spacing: 0;"><strong>$500 Bonus</strong></h2></div>
                    </div>

                    <h4 class="mt-4 text-center text-md-left">Now that you're here, you have access to our deal.</h4>
                    <h4 class="text-center text-md-left mt-3 mt-md-0">We welcome you to check your rates in 2 minutes using the link below.</h4>

                    <p class="mt-5">
                        <a href="{{ url('/negotiated-refinance-deal/access') }}" class="btn btn-primary btn-lg pl-3 pr-3">
                            Check Your Rates
                        </a>
                    </p>

                    <p class="mt-3">
                        <a id="how-did-we-evaluate-the-bids" class="text-underline" data-toggle="collapse" data-target="#collapseEvaluateBids" aria-expanded="false" aria-controls="collapseEvaluateBids" href="#collapseEvaluateBids">How does Juno work?</a>
                    </p>
                </div>

                <div class="col-12 text-left">
                    <div id="collapseEvaluateBids" class="collapse">

                        <p class="mt-3">
                            We negotiate student loan rates using collective bargaining.
                        </p>

                        <p class="mt-3">
                            We built a large member base of students looking to negotiate loan rates, took our group to several lenders, and picked the best offer from 7 different lenders who bid.
                        </p>

                        <p class="mt-3">
                            You don’t pay anything to utilize the deal, just click through our link and you’ll have access to our exclusive rates. It’s that simple. No strings attached.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.deal_rates')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.compare_rates')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.rate-check')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.refi-calculator')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.deal_benefits')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.faq')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

    <div class="jumbotron pt-0 pb-0 mb-0 mt-0 bg-transparent">
        @include('refinance.negotiated_deal.eligibility')
    </div>

    <hr class="mt-0 mb-0 pt-0 pb-0">

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

            var loan_balance = removeCommas($('#loan_balance').val());

            var interest_rate = loan_option[0];
            var loan_term = loan_option[1];
            var option_name = loan_option[2];

            var monthly_payment = -1*PMT(interest_rate/12/100, loan_term*12, loan_balance);
            var total_payments = (monthly_payment*loan_term*12);

            $('#compare-options').append(
                '<tr class="loan_option" id="loan_option_' + (loan_options.length) + '">' +
                    "<td>" + option_name + "</td>" +
                    "<td>" + interest_rate + "% APR" + "</td>" +
                    "<td>" + loan_term + " years" + "</td>" +
                    "<td>" + "$" + Math.round(monthly_payment).toLocaleString() + "</td>" +
                    "<td>" + "$" + Math.round(total_payments).toLocaleString() + "</td>" +
                    "<td>" + '<a onclick="deleteRow(' + loan_options.length + ')"' +  ' class="deleteLink" href="javascript:void(0);"><i class="fas fa-trash"></i></a>' + "</td>" +
                "</tr>"
            );

        }

        function addRow(e){
            // Prevent Default
            e.preventDefault();

            try {

                // Get the information on the calculator
                var interest_rate = $('#interest_rate').val();
                var loan_term = $('#loan_term').val();
                var option_name = $('#option_name').val();

                // Store the loan inputs
                loan_options.push([interest_rate, loan_term, option_name]);

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
            $('#compare-options .loan_option').remove();

            // Create new rows for every loan option
            loan_options.forEach(function(loan_option){
                pushToTable(loan_option);
            })
        }

        function deleteRow(rowNumber){
            // Delete from the table
            $('#loan_option_' + rowNumber).remove();

            // Delete from the Loan Options Array
            var removed = loan_options.splice(rowNumber - 1,1);
        }

    </script>

@endpush
