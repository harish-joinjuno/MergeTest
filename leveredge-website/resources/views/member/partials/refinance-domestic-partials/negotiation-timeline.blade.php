<div class="container mb-5" id="negotiation-timeline">

    <div class="row mb-5">
        <div class="col-12">
            <h1 class="font-size-40 text-center">
                Negotiation Timeline
            </h1>
        </div>
    </div>

    <div class="pt-3 pb-3"></div>

    <div class="row">
        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body text-center">
                    <div class="badge badge-secondary badge-pill float-right mb-4 p-2">
                        Currently Ongoing
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/icons/teamwork.svg') }}" class="mx-auto">
                    <h2>
                        Members Sign Up
                    </h2>
                    <p>
                        Members join the Juno Refinance Loan Negotiation Group for free.
                    </p>
                    @auth
                        <a href="{{ url('/member/referral-program') }}" class="btn btn-outline-primary">Invite Friends</a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="card w-100">
                <div class="card-body text-center">
                    <div class="badge badge-secondary badge-pill float-right mb-4 p-2">
                        Up to June 5th
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/icons/relationship.svg') }}" class="mx-auto">
                    <h2>
                        Lenders Compete
                    </h2>
                    <p>
                        Lenders compete for your business by offering lower rate options for us to evaluate.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="card active w-100">
                <div class="card-body text-center">
                    <div class="badge badge-primary badge-pill float-right mb-4 p-2">
                        Starting end of July
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/icons/loan-money.svg') }}" class="mx-auto">
                    <h2>
                        Loans Offered
                    </h2>
                    <p>
                        Members apply directly to the lender offering the lowest rates exclusively via Juno.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
