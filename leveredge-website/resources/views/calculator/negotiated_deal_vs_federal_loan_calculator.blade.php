@extends('template.public')

@section('content')

    @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator',[
            'call_to_action_text' => 'See the Deal',
            'call_to_action_link' => url('/negotiated-in-school-deal')
        ])

    <hr class="pt-0 pb-0 mt-0 mb-0">

    @include('ad.student-loan-competition-series.how-the-deal-was-negotiated')

    <hr class="pt-0 pb-0 mt-0 mb-0">

    @include('ad.common.switch-from-federal-loan')

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

    </script>

    @include('in-school.negotiated_deal.federal-loan-vs-laurel-road-calculator-js')

@endpush


@section('legal-disclosures')
    <p>
        4 - This is not a federal student loan. The terms of this product may differ from terms available with a federal student loan. For example, this product does not contain special features such as income-based repayment plans. Also deferment, forbearance options, and loan forgiveness options may differ from those available for federally held student loans, and privately-funded student loans are not eligible to be included in a Federal Direct Consolidation Loan. For more information about Federal student loan programs, please visit https://studentloans.gov.
    </p>
@endsection
