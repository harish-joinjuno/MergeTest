@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mixpanel.track('Page_View_PostReward_control');
        });
    </script>
@endpush

@section('content')
    @include('reward-program.partials._success-banner')

    <div class="container-fluid px-0 overflow-hidden">
        <div class="container-fluid" style="max-width:1280px;">
            <div class="row">
                <div
                    class="col-12 col-sm-4 position-relative order-sm-2 bg-light"
                >
                    <img
                        src="{{ asset('/img/welcome-hero.png') }}"
                        class="flavor-image"
                        alt="Right Flavor Image"
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
