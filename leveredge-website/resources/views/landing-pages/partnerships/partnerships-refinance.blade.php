@extends('landing-pages.refinance', [
    'pageHeading' => 'We negotiated a deal for the best refinance options.',
    'headingFlavorText' => 'Juno members earn up to $1,000 cashback when they refinance through our negotiated
    deals. Sign up today!',
])

@section('pre-header')
    @if(!empty($partner))
        @include('landing-pages.partnerships._partnership-header', [
            'partner' => $partner,
        ])
    @endif
@endsection

