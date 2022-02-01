@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/vue2Dropzone.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="py-3"></div>

    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="off-black text-center">International Health Insurance</h1>
                <p>
                    As a Juno Member, you can access health insurance options that are typically more affordable than the university's plan.
                </p>
                <p class="text-center">
                    <a class="btn btn-secondary mt-3 text-center" href="{{ url('/member/deal/'.\App\Deal::DEAL_INTERNATIONAL_HEALTH_INSURANCE_20.'/hand-off') }}">
                        Check Insurance Plans at GBG
                    </a>
                </p>
            </div>
        </div>
    </div>

    @php
        switch($referredMembersTakenDeal->count()){
            case 0:
                $progress_bar_heading = "Share with your friends to receive even more cash back!";
                break;

            case 1:
            case 2:
            case 3:
            case 4:
                 $progress_bar_heading = "You’re doing great! Keep sharing to continue to save more.";
                break;

            default:
                $progress_bar_heading = "You’re a super star! While you’ve hit your cap, you can still help your friends save by sharing.";
                break;
        }
    @endphp

    <div class="container-fluid bg-translucent-green py-5">
        <div class="container px-0">
            <div class="row align-items-center text-center text-md-left py-5">
                <div class="col-12 col-md-4">
                    <img
                        src="{{ asset('/img/spring-season-with-check.png') }}"
                        style="max-width:300px;"
                    >
                </div>
                <div class="col-12 offset-md-2 col-md-6 text-center text-md-right">
                    <h1 class="off-black mb-3">Guaranteed University Acceptance of Waiver</h1>
                    <p>
                        GBG will refund any amount that you have paid for the plan if
                        the university rejects your waiver request
                    </p>
                </div>
            </div>
        </div>
    </div>



{{--    <div class="container py-5">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-8 col-md-2">--}}
{{--                <img src="{{ asset('img/refinance-with-check.png') }}" class="img-fluid">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row justify-content-center mt-4">--}}
{{--            <div class="col-12 col-md-10 col-lg-8 text-center">--}}
{{--                <h2 class="off-black">Have you taken your insurance with GBG via Juno?</h2>--}}
{{--                <p>Share your plan documents to receive your Juno Reward</p>--}}
{{--                <p>--}}
{{--                    <a href="{{ url('/member/deal/request-gbg-reward') }}" class="btn btn-secondary btn-lg">Request Reward</a>--}}
{{--                </p>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection


@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>
@endpush
