@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .backsplash > div {
            z-index:1;
        }
        .backsplash:after {
            content: '';
            position:absolute;
            z-index:0;
            left:-20%;
            top:50%;
            transform: translateY(-50%);
            background: url({{ asset('/img/balloon-2.png') }}) no-repeat;
            height:100%;
            width:100%;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mixpanel.track('Page_View_PostReward_opt2');
        });
    </script>
@endpush

@section('content')
    @include('reward-program.partials._success-banner')

    <div class="container-fluid bg-light px-0">
        <div class="container">
            <div class="row justify-content-center py-md-5">
                <div class="col-12 py-5 px-3 px-md-5 backsplash">
                    <div class="bg-white text-center shadow px-3 px-md-5 py-5 rounded-lg position-relative">
                        <img
                            src="{{ asset('/img/students-sitting-on-ground-with-laptop.png') }}"
                            alt="Students sitting on the ground with a laptop"
                            style="position:absolute;top:-50px;right:60px;max-width:150px;"
                        >

                        @if(\View::exists('reward-program.partials.' . $referralProgramUser->referralProgram->slug))
                            @include('reward-program.partials.' . $referralProgramUser->referralProgram->slug, compact('referralProgramUser'))
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
