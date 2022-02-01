@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .background-flavor {
            background-size:cover;
            background-position:center left 25%;
            background-repeat:no-repeat;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mixpanel.track('Page_View_PostReward_opt1');
        });
    </script>
@endpush

@section('content')
    @include('reward-program.partials._success-banner')

    <div class="container-fluid px-0 overflow-hidden">
        <div class="container-fluid position-relative" style="max-width:1280px;">
            <div class="row">
                <div
                    class="col-12 col-sm-4 background-flavor position-relative"
                    style="background-image:url({{ asset('/img/friends-at-table.png') }});min-height:150px;"
                >
                </div>
                <div class="col-12 col-sm-8 text-center py-5 px-lg-5">
                    @if(\View::exists('reward-program.partials.' . $referralProgramUser->referralProgram->slug))
                        @include('reward-program.partials.' . $referralProgramUser->referralProgram->slug, compact('referralProgramUser'))
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
