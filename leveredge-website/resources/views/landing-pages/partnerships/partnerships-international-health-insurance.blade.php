@extends('landing-pages.international-health-insurance')

@section('pre-header')
    @if(!empty($partner))
        <div class="container-fluid bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col py-5">
                        <h4>Welcome {{ ucfirst($name ?? '') }} members!</h4>
                        <p class="mb-0">The average international student saves $1,000 - $3000 per year by using our deals.</p>
                        <p class="mb-0">Sign-up to see how much we could save you!</p>
                    </div>
                    <div class="col-12 col-sm-auto text-center py-5">
                        <img
                            src="{{ asset($partner['logo']) }}"
                            alt="{{ $name ?? '' }} Logo"
                            style="max-width:175px;"
                        >
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

