@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/vue2Dropzone.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <section>
        <screenshot-claim-page
            :previous-rewards="{{ json_encode($rewardClaims) }}"
        ></screenshot-claim-page>
    </section>
@endsection
