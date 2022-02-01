@extends('template.public')

@section('content')


    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 flanked-images bg-white">
        <div class="container pb-5 pt-5">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-uppercase d-none d-md-block">Don't Leave Your Friends Behind</h5>
                    <h1 class="mt-3 brand-color text-uppercase text-center text-md-left" style="font-size: 34px; letter-spacing: 1.5px;">
                        <strong>
                            Invite Friends<span class="d-none d-md-inline"> &</span> Earn Rewards
                        </strong>
                    </h1>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2>Student Loan Referral Program</h2>
                            <a class="btn btn-primary mt-3" href="{{ url('/dashboard/student-loan-referral-program/' . $affiliate->code ) }}">Learn More</a>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <h2>Refinance Loan Referral Program</h2>
                            <a class="btn btn-primary mt-3" href="{{ url('/dashboard/refinance-loan-referral-program/' . $affiliate->code ) }}">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="pt-0 pb-0 mt-0 mb-0">

    @include('affiliate.referral-terms-and-conditions')


@endsection


@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>
@endpush
