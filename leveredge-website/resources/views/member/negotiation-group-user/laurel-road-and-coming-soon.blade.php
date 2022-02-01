@extends('template.public')
    <link href="{{mix('mix/css/pages/graduate.css')}}" rel="stylesheet">
    <link href="{{mix('mix/css/pages/laurel-road-and-coming-soon.css')}}" rel="stylesheet">
@push('header-scripts')

@endpush

@section('content')
    <div class="laurel-road-and-coming-soon py-4">
        <h1 class="off-black text-center">
            Negotiated just for you
        </h1>
        <div class="bg-translucent-green">
            <div class="container py-4">
                <p class="text-center h6">
                    <span class="secondary-green">We currently have one deal</span>
                    for you that you can access. However, for your specific demographic, if you can wait 2 weeks we truely feel
                    <span class="secondary-green">you may get an even better second deal offer later.</span>
                </p>
                <div class="row py-4">
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <div class="card active border-primary-green w-100">
                            <div class="card-body text-center">
                                <div class="card-header">
                                    <h2 class="off-black">Laurel Road</h2>
                                    <p class="font-weight-bold mb-0">Rates avalible by July 14th</p>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Only a soft credit check is required to see your rate, and Laurel Road is offering very attractive rates to prime borrowers.</li>
                                        <li>For being a Juno member, we’ll give back 1.0% your loan.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <div class="card border-primary-green w-100">
                            <div class="card-body text-center">
                                <div class="card-header">
                                    <h2 class="off-black">Second offer</h2>
                                    <p class="font-weight-bold mb-0">Variable rates starting at X.XX%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('common.faqs')
@endsection

@push('footer-scripts')

@endpush
