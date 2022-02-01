@extends('template.base')

@inject('menuLink', 'App\MenuLink')

@section('base-content')
    <div id="safeApp">

        @include('template._main-nav')
        @include('template._auth-nav-under-main-nav')

        @stack('below-nav')
        <main>
            <div class="container">
                @include('includes.action-notifications')
            </div>
            @yield('content')
        </main>

{{--        <div class="d-flex" id="wrapper">--}}

{{--            <!-- Sidebar -->--}}
{{--            <div class="bg-white border-right" id="sidebar-wrapper">--}}
{{--                <left-menu></left-menu>--}}
{{--            </div>--}}
{{--            <!-- /#sidebar-wrapper -->--}}

{{--            <!-- Page Content -->--}}
{{--            <div id="page-content-wrapper">--}}
{{--                <div class="container px-0 px-md-3">--}}
{{--                    @yield('content')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /#page-content-wrapper -->--}}

{{--        </div>--}}
{{--        <!-- /#wrapper -->--}}



{{--        @include('template._auth-nav')--}}
{{--        <main class="pt-2">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-0 col-md-3 p-0">--}}
{{--                        <left-menu></left-menu>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-md-9 col-lg-8">--}}
{{--                        @yield('content')--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </main>--}}

        @include('template._footer')
    </div>
@endsection

@prepend('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{mix('mix/css/components/left-menu.css')}}" rel="stylesheet" type="text/css">
@endprepend

@prepend('footer-scripts')
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
@endprepend
