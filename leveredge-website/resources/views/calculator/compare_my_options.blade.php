@extends('template.public')

@push('header-scripts')
    <link rel="stylesheet" href="{{ mix('/mix/css/components/compare-my-options.css') }}" />
@endpush

@section('content')
    <compare-my-options></compare-my-options>
@endsection


