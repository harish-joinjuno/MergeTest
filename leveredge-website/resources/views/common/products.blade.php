<div class="container">

    @if(isset($hide_products_heading) && $hide_products_heading)

    @else
        <div class="row">
            <div class="col-12">
                <h2 class="text-left">Access the Negotiated Deals</h2>
                <div class="separator"></div>
            </div>
        </div>
    @endif


    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card-deck">
                <div class="card border-0 product-shadow pt-4 pb-5">
                    <div class="card-body text-center mb-0">
                        <h2>Graduate <nobr>Student Loans</nobr></h2>
                        <p class="mt-4">
                            Join 2,000+ graduate students using a <strong>negotiated</strong> loan to pay for school.
                        </p>
                    </div>
                    <div class="card-footer text-center bg-transparent border-0 pt-0 mt-4">
                        <a class="btn btn-primary btn-block" href="{{ url('/negotiated-in-school-deal') }}">See the Deal</a>
                    </div>
                </div>

{{--                <div class="card border-0 product-shadow pt-4 pb-5">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h2>Student Loan <nobr>Refinancing</nobr></h2>--}}
{{--                        <p class="mt-4">--}}
{{--                            Get the <strong>negotiated</strong> rates: 0.25% lower than Earnest's regular rates.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer text-center bg-transparent border-0 pt-0 mt-4">--}}
{{--                        <a class="btn btn-primary btn-block" href="{{ url('/negotiated-refinance-deal') }}">See the Deal</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card border-0 product-shadow pt-4 pb-5">--}}
{{--                    <div class="card-body text-center pb-0">--}}
{{--                        <h2>Stay Informed</h2>--}}
{{--                        <p class="mt-3">--}}
{{--                            For anyone who is interested in future loan deals or is not ready to apply--}}
{{--                        </p>--}}

{{--                        <form class="mt-4" method="post" action="{{ url('/enroll') }}" id="enroll-form">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group text-left mb-0">--}}
{{--                                <input class="form-control" type="email" name="email" id="email" placeholder="Email Address">--}}
{{--                            </div>--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                    <div class="card-footer text-center bg-transparent border-0 pt-0 mt-0">--}}
{{--                        <button id="submit-enroll-form-button" class="btn btn-primary btn-block">Get Started</button>--}}

{{--                        @push('footer-scripts')--}}

{{--                            <script>--}}
{{--                                $( document ).ready(--}}
{{--                                    $('#submit-enroll-form-button').click(function(){--}}
{{--                                        $('#enroll-form').submit();--}}
{{--                                    })--}}
{{--                                );--}}
{{--                            </script>--}}
{{--                        @endpush--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>


        </div>
    </div>
</div>
