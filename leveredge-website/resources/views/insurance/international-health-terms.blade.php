@extends('template.public')

@section('content')
    <div class="py-3"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h2>Health Insurance Terms</h2>

                <h4 class="mt-3">
                    Premium
                </h4>
                <p>
                    The upfront cost of the insurance. You’ll have to pay this even if you never use any of the insurance coverage. Think of it as the price to get into the insurance benefits.
                </p>

                <h4 class="mt-3">
                    Deductible
                </h4>
                <p>
                    It's a fixed dollar amount that you will need to spend before your insurance coverage kicks in. This is an aggregate amount between all your medical expenses. There are some services under your insurance where you don't need to cover your deductible before using them (immunizations is a common one).
                </p>

                <h4 class="mt-3">
                    Co-payments
                </h4>
                <p>
                    It's a fixed dollar amount that you pay every time you use certain services under your insurance. Not every service carries a copayment, and many times these payments are waived if you go to your university student health center.
                </p>

                <h4 class="mt-3">
                    Co-insurance
                </h4>
                <p>
                    After you paid your deductible the insurance company will cover a percentage of all the covered expenses. That percentage is called the co-insurance.
                </p>

                <h4 class="mt-3">
                    Out of pocket maximum
                </h4>
                <p>
                    The out of pocket maximum is the maximum amount you would have to pay for the covered services. At that point the co-insurance becomes 100%, the copayments are reduced to 0, and the insurance company takes care of all the covered expenses.
                </p>

                <h4 class="mt-3">
                    In-network/Out-of-network
                </h4>
                <p>
                    Insurance providers have a network of health centers . When possible, always prefer an in-network provider, it will be cheaper.
                </p>
            </div>
        </div>
    </div>
    <div class="py-3"></div>
@endsection
