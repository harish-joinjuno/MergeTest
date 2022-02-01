<div class="container" id="products">

    @if(isset($hide_products_heading) && $hide_products_heading)

    @else
    <div class="row">
        <div class="col-12">
            <h2 class="text-left">Access the Negotiated Deals</h2>
            <div class="separator"></div>
        </div>
    </div>
    @endif

    <div class="row mb-5">
        <div class="col-12">
            <div class="card-deck">

                <div class="card" id="join-in-school">
                    <div class="card-body text-center">
                        <img src=" {{ url('/img/book_icon.png') }}" class="img-fluid mt-3 mb-3" style="max-height: 100px;">

                        <p class="card-heading mt-4">Get a loan for grad school</p>
                        <p class="card-eligibility mt-2">
                            For graduate students who need a loan for Fall 2019
                        </p>
                        <a href="{{ url('/negotiated-in-school-deal') }}" class="btn btn-primary btn-sm mt-4 pr-3 pl-3">View the Student Loan Deal</a>

                    </div>

                </div>

                <div class="card" id="join-refi">
                    <div class="card-body text-center">
                        <img src=" {{ url('/img/graduate_icon.png') }}" class="img-fluid mt-3 mb-3" style="max-height: 100px;">
                        <p class="card-heading mt-4">Refinance my existing student loans</p>
                        <p class="card-eligibility mt-2">
                            For people who have student debt and have already graduated
                        </p>
                        <a href="{{ url('/negotiated-refinance-deal') }}" class="btn btn-primary btn-sm mt-4 pr-3 pl-3">View the Refinance Deal</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script>
        $("#join-refi").click(function() {
            window.location = '{{ url('/negotiated-refinance-deal') }}';
            return false;
        });
    </script>

    <script>
        $("#join-in-school").click(function() {
            window.location = '{{ url('/negotiated-in-school-deal') }}';
            return false;
        });
    </script>
@endpush
