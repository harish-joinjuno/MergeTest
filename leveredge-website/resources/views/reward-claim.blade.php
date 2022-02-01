@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/vue2Dropzone.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <section>
        <reward-claim-page
            :payment-methods="{{ json_encode($paymentMethods) }}"
            :deals="{{ json_encode($deals) }}"
            :previous-rewards="{{ json_encode($rewardClaims) }}"
        ></reward-claim-page>
    </section>
@endsection
