@extends('template.base')

@section('base-content')

    <div id="safeApp">
        @include('template._main-nav')
        <general-scholarships
            :v-scholarships="{{ $scholarships }}"
            :title='"{{ isset($title) ? $title : '' }}"'
            :total-results="{{ $totalResults }}"
        >
        </general-scholarships>
    </div>
@endsection

@prepend('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endprepend

@prepend('footer-scripts')
    <script src="{{mix('mix/js/browse_scholarships/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endprepend
