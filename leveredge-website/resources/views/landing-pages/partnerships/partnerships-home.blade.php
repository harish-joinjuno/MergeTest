@extends('landing-pages.home')

@section('pre-header')
    @if(!empty($partner))
        @include('landing-pages.partnerships._partnership-header', [
            'partner' => $partner,
        ])
    @endif
@endsection
