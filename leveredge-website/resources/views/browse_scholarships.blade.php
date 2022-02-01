@extends('template.base')

@section('base-content')

    <div id="safeApp">
        @include('template._main-nav')
        <browse-scholarships
            :v-scholarships="{{ $scholarships }}"
            :title='"{{ isset($title) ? $title : '' }}"'
        ></browse-scholarships>
    </div>
@endsection

 @prepend('header-scripts')
    <link href="{{mix('mix/css/styles.css')}}" rel="stylesheet" type="text/css">
 @endprepend
