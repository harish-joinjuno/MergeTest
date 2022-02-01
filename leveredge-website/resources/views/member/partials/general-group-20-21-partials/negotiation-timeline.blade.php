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
            <div class="card active border-primary-green w-100">
                <div class="card-body text-center">
                    <div class="badge badge-primary badge-pill float-right mb-4 p-2">
                        Currently Ongoing
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/components/negotiation_timeline/students-sign-up.png') }}" class="mx-auto">
                    <h2>
                        Students Sign Up
                    </h2>
                    <p>
                        Students join the Juno Student Loan Negotiation Group for free.
                    </p>
                    @auth
                        <a href="{{ url('/member/referral-program') }}" class="btn btn-primary">Invite Friends</a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="card active border-primary-green w-100">
                <div class="card-body text-center">
                    <div class="badge badge-secondary badge-pill float-right mb-4 p-2">
                        Up to May 25th
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/components/negotiation_timeline/lenders-compete.png') }}" class="mx-auto">
                    <h2>
                        Lenders Compete
                    </h2>
                    <p>
                        Lenders compete for your business by offering lower rate options for us to evaluate.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body text-center">
                    <div class="badge badge-secondary badge-pill float-right mb-4 p-2">
                        Starting June 15th
                    </div>
                    <div class="clearfix"></div>
                    <img src="{{ url('img/components/negotiation_timeline/loans_offered.png') }}" class="mx-auto">
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
