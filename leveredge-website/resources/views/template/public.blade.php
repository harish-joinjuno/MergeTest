@extends('template.base')

@inject('menuLink', 'App\MenuLink')

@section('base-content')
    <div id="safeApp">
        @if(isset($displayTransitionAnimation) && $displayTransitionAnimation)
            @include('landing-pages.brand-transition-animation')
        @endif

        @if(!empty($referringMember))
            @include('landing-pages.partials._referral-banner')
        @endif

        @include('template._main-nav')
        @stack('below-nav')
        <main>
            <div class="container">
                @include('includes.action-notifications')
            </div>
            @yield('content')
        </main>

        @include('template._footer')

    </div>
@endsection

@prepend('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}?ver=1.1" rel="stylesheet" type="text/css">
@endprepend
