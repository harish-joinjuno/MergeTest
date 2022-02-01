@push('header-scripts')
    <style>
        .referral-banner {
            background: linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }

        .referral-banner .container {
            max-width:540px;
        }

        @media screen and (max-width:768px) {
            .referral-banner h6 {
                font-size:14px;
            }
            .referral-banner p {
                font-size:12px;
            }
            .referral-banner .btn {
                font-size:12px;
            }
        }
    </style>
@endpush

<div class="container-fluid py-3 referral-banner">
    <div class="container px-0">
        <div class="row justify-content-center align-items-center">
            <div class="col-2 pr-0">
                <img
                    src="{{ asset('/img/group-shot-illustration.png') }}"
                    class="img-fluid"
                >
            </div>
            <div class="col-6 pr-0">
                <h6 class="mb-0"><strong>{{ $referringMember->name }}</strong></h6>
                <p class="small mb-0">is a Juno member. Join us now!</p>
            </div>
            <div class="col-4 col-sm-4">
                <a
                    href="{{ url('/register') }}"
                    class="btn btn-primary text-white btn-sm px-0 btn-block"
                >
                    Get Started
                </a>
            </div>
        </div>
    </div>
</div>
