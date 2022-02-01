<div class="container" id="products">

    <div class="row">
        <div class="col-12">
            <h2 class="text-left">Select a Group to Join</h2>
            <div class="separator"></div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6 col-12">
            <div class="card" id="join-refi">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 offset-3 pl-4">
                            {{--<span class="badge badge-pill badge-primary mb-3">{{ \Carbon\Carbon::create(2019,4,30)->diffInDays() }} days left</span>--}}
                            <span class="badge badge-pill badge-primary mb-3">Negotiation In Progress</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src=" {{ url('/img/graduate_icon.png') }}" class="img-fluid" style="max-height: 100px;">
                        </div>
                        <div class="col-9 pl-4">

                            <p class="card-heading">Refinance my existing student loans</p>
                            <p class="card-eligibility mt-3">
                                For people who have student debt and are graduating soon or have already graduated
                            </p>
{{--                            <a href="{{ url('/join/refi/') }}" class="btn btn-outline-primary btn-sm mt-3">Learn More</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-6 col-12 mt-4 mt-md-0">
            <div class="card" id="join-in-school">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 offset-3">
{{--                            <span class="badge badge-pill badge-primary mb-3">{{ \Carbon\Carbon::create(2019,6,1)->diffInDays() }} days left</span>--}}
                            <span class="badge badge-pill badge-primary mb-3">Negotiation In Progress</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 text-center">
                            <img src=" {{ url('/img/book_icon.png') }}" class="img-fluid" style="max-height: 100px;">
                        </div>
                        <div class="col-9">

                            <p class="card-heading">Get a loan for law school</p>
                            <p class="card-eligibility mt-3">
                                For graduate students who need a loan for Fall 2019
                            </p>
                            {{--<a href="{{ url('/join/in-school/') }}" class="btn btn-outline-primary btn-sm mt-3">Learn More</a>--}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script>
        $("#join-refi").click(function() {
            window.location = '{{ url('/join/refi') }}';
            return false;
        });
    </script>

    <script>
        $("#join-in-school").click(function() {
            window.location = '{{ url('/join/in-school/law') }}';
            return false;
        });
    </script>
@endpush
