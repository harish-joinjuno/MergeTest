@extends('template.public')

@section('content')

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-brand-highlight text-light border-radius-0 animated slideInDown" style="animation-delay: 1s;">
        <div class="container pb-2 pt-2">
            <div class="row">
                <div class="col-12 text-center">
                    Already secured a federal or private loan? <a href="{{ url('/negotiated-in-school-deal/how-to-switch-loan-provider') }}" class="text-white text-underline">Learn how to switch to the negotiated deal.</a>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-transparent flanked-images" id="product-hero">
        <div class="container">
            <div class="row">

                <div class="col-12 text-center text-md-left">
                    <h2 class="text-uppercase">Negotiated Student Loan Deal</h2>
                </div>

                <div class="col-12 text-center text-md-left">

                    <h4 class="mt-3">Join thousands of MBA, JD, and other graduate students using a negotiated rate for their school loans. Check your rates and access the deal for free.</h4>

                    <table class="mt-5 d-none d-md-table">
                        <tr>
                            <td>@include('in-school.negotiated_deal.laurel_road_logo')</td>
                            <td class="pl-5 pr-5"><h3><i class="fas fa-plus"></i></h3></td>
                            <td><img src="{{ url('/img/logo/new-logo.svg') }}" width="220" class="d-inline"></td>
                            <td class="pl-5 pr-5"><h3><i class="fas fa-equals"></i></h3></td>
                            <td><h4><strong>0.4% Exclusive Rate Reduction</strong></h4></td>
                        </tr>
                    </table>

                    <div class="mt-5 d-md-none text-center">
                        <div class="mt-3">@include('in-school.negotiated_deal.laurel_road_logo')</div>
                        <div class="mt-3"><h3><i class="fas fa-plus"></i></h3></div>
                        <div class="mt-3"><img src="{{ url('/img/logo/new-logo.svg') }}" width="220" class="d-inline"></div>
                        <div class="mt-3"><h3><i class="fas fa-equals"></i></h3></div>
                        <div class="mt-3"><h4><strong>0.4% Exclusive Rate Reduction</strong></h4></div>
                    </div>

                    <p class="mt-5 text-center text-md-left">
                        <a href="{{ url('/negotiated-in-school-deal/access') }}" class="btn btn-primary btn-lg pl-3 pr-3">
                            Check Your Rates
                        </a>
                    </p>

                    <p class="mt-3 text-center text-md-left">
                        <a id="how-did-we-evaluate-the-bids" class="text-underline" data-toggle="collapse" data-target="#collapseEvaluateBids" aria-expanded="false" aria-controls="collapseEvaluateBids" href="#collapseEvaluateBids">How does Juno work?</a>
                    </p>


                </div>


                <div class="col-12">
                    <div id="collapseEvaluateBids" class="collapse">

                        <p class="mt-3">
                            We negotiate student loan rates using collective bargaining.
                        </p>

                        <p class="mt-3">
                            We built a large member base of students looking to negotiate loan rates, took our group to several lenders, and picked the best offer from 7 different lenders who bid.
                        </p>

                        <p class="mt-3">
                            The deal is now available to eligible graduate students visiting this site across MBA, JD, Medical, Dental, Engineering, Pharma and Nursing programs. Check your school’s eligibility by clicking the ‘Check Your Rates’ button on this page.
                        </p>

                        <p class="mt-3">
                            You don’t pay anything to utilize the deal, just click through our link and you’ll have access to our exclusive rates if your program qualifies. It’s that simple. No strings attached.
                        </p>

                        {{--<p class="mt-3">--}}
                            {{--Juno asked for information from each lender to estimate the rates and terms that each member could reasonably expect to receive if the lender was selected. Once lenders submitted the necessary information, we developed a model to evaluate:--}}
                        {{--</p>--}}

                        {{--<ul class="mt-3">--}}
                            {{--<li>How many members would receive an offer that would be better than their best alternative in the market?</li>--}}
                            {{--<li>How much each member could save and what does the distribution of those savings look like?</li>--}}
                            {{--<li>How much the total group would save?</li>--}}
                        {{--</ul>--}}

                        {{--<p class="mt-3">--}}
                            {{--We are unable to share the actual bids we received or the names of the lenders that submitted bids. Fewer lenders would be willing to submit bids in the future if we were to reveal the names of the lenders that did not win. Secondly, we sign non-disclosure agreements with most lenders and the proposals from lenders are typically confidential information.--}}
                        {{--</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.deal_details')
    </div>

    {{--<hr class="pb-0 pt-0 mt-0 mb-0">--}}

    {{--<div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">--}}
        {{--@include('in-school.negotiated_deal.comparison_table')--}}
    {{--</div>--}}

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.reviews')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator',[
            'call_to_action_text' => 'Access the Negotiated Deal',
            'call_to_action_link' => url('/negotiated-in-school-deal/access')
        ])
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.repayment_options')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.graduation-discount')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.auto-pay-discount')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.deal_benefits')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.faq')
    </div>

    <hr class="pb-0 pt-0 mt-0 mb-0">

    <div class="jumbotron pb-0 pt-0 mb-0 mt-0 bg-transparent">
        @include('in-school.negotiated_deal.eligibility')
    </div>

@endsection


@section('legal-disclosures')

    <p>
        1 - Checking your rate with Laurel Road only requires a soft credit pull, which will not affect your credit score. To proceed with an application, a hard credit pull will be required, which may affect your credit score. Additionally, as part of the application process Laurel Road will request and your school must verify enrollment and cost of attendance.
    </p>

    <p class="mt-3">
        2 - If you successfully graduate from an eligible program at an eligible institution and provide us with acceptable documentation that you have graduated and accepted employment, your interest rate will be reduced by 0.25%. Employment does not need to be in your field of study to qualify. Any rate reduction will be effective only after lender has confirmed and approved eligibility for the rate reduction. If the interest rate is adjusted due to the Employment Discount, your required monthly payment amount will be reduced in the next billing cycle following confirmation of eligibility.
    </p>

    <p class="mt-3">
        3 - When selecting a fixed, interest only, or an immediate repayment option, payment is required only after the final disbursement for loans with multiple disbursements. Interest that accrues and is unpaid between disbursements and during any deferment period, as applicable (including any interest that accrues in excess of required in-school payments), is capitalized at the beginning of the full repayment period.
    </p>

    <p class="mt-3">
        4 - This is not a federal student loan. The terms of this product may differ from terms available with a federal student loan. For example, this product does not contain special features such as income-based repayment plans. Also deferment, forbearance options, and loan forgiveness options may differ from those available for federally held student loans, and privately-funded student loans are not eligible to be included in a Federal Direct Consolidation Loan. For more information about Federal student loan programs, please visit https://studentloans.gov.
    </p>

@endsection


@push('footer-scripts')



    <script src="{{ url('/lib/cleave/cleave.min.js') }}"></script>
    <script>
        // var cleave = new Cleave('#loan_balance', {
        //     numeral: true,
        //     numeralThousandsGroupStyle: 'thousand'
        // });


        var cleave_2 = new Cleave('#sl_loan_amount', {
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


    @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator-js')

@endpush
