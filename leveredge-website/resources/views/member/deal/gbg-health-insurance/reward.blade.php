@extends('template.public')

@push('header-scripts')
    <link href="{{mix('mix/css/vue2Dropzone.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container py-5">
        <international-reward-claim-form
            :payment-methods="{{ json_encode($paymentMethods) }}"
            :previous-rewards="{{ json_encode($rewardClaims) }}"></international-reward-claim-form>
    </div>
@endsection
