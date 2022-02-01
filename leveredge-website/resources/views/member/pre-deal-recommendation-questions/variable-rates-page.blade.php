@extends('template.public')

@push('header-scripts')
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
    />
@endpush

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <p class="text-center">(2 of 2)</p>
                <h1 class="off-black">Are you open to variable rates?</h1>
                <h4 class="mt-3 mb-4">
                    Generally, our members have preferred fixed rate loans—which makes sense most of the time—but this
                    year variable rates are so low that many members are considering them instead.
                    We put together a <a target="_blank" href="{{ url('/fixed-vs-variable-20-21') }}">resource here <i class="small fas fa-external-link"></i></a> for you to
                    make an informed decision.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <form class="mt-5" method="POST">
                    @csrf
                    <div class="form-group custom-radio">
                        <input
                            type="radio"
                            name="open_to_variable_rates"
                            class="d-none"
                            value="1"
                            id="open_to_variable_rates-1"
                            @if(old('open_to_variable_rates', user()->profile->open_to_variable_rates) === 1) checked @endif
                        >
                        <label
                            for="open_to_variable_rates-1"
                            id="label-for-yes"
                            class="p-3 pl-5 border rounded w-100 text-left position-relative"
                        >
                            Yes
                        </label>
                    </div>
                    <div class="form-group custom-radio">
                        <input
                            type="radio"
                            name="open_to_variable_rates"
                            class="d-none"
                            value="0"
                            id="open_to_variable_rates-0"
                            @if(old('open_to_variable_rates', user()->profile->open_to_variable_rates) === 0) checked @endif
                        >
                        <label
                            for="open_to_variable_rates-0"
                            class="p-3 pl-5 border rounded w-100 text-left position-relative"
                            id="label-for-no"
                        >
                            No
                        </label>
                    </div>
                    @error('open_to_variable_rates')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="row justify-content-center mt-5" id="no-open-to-variable-rates" style="display: none">
                        <div class="col-12 col-md-11">
                            <div class="row animate__animated animate__fade_up">
                                <div class="col-3 col-md-2 d-flex align-items-center">
                                    <img src="{{ asset('img/logo/new-logo-without-copy.svg') }}" class="img-fluid">
                                </div>

                                <div class="col-9 col-md-10">
                                    <div class="speech-bubble-left p-4 inline-block">
                                        <p class="m-0 text-left">
                                            Understood. You can always change your mind later if you decide you want to check out your
                                            variable rate options. We’ll just show you your fixed rate option for now.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5" id="yes-open-to-variable-rates" style="display: none">
                        <div class="col-12 col-md-11">
                            <div class="row animate__animated animate__fade_up">
                                <div class="col-3 col-md-2 d-flex align-items-center">
                                    <img src="{{ asset('img/logo/new-logo-without-copy.svg') }}" class="img-fluid">
                                </div>

                                <div class="col-9 col-md-10">
                                    <div class="speech-bubble-left p-4 inline-block">
                                        <p class="m-0 text-left">
                                            Got it. You can always change your mind later. We’ll show you your variable
                                            rate options first.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0 mt-5">
                        <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/pre-deal-recommendation-questions/co-signer-question') }}" class="btn btn-outline-primary">Back</a>
                        <button type="submit" class="btn btn-primary" id="next-btn">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
    <div class="py-5"></div>
@endsection


@push('footer-scripts')
    <script>
        $(document).ready(function () {

            $('input:radio[name="open_to_variable_rates"]').change(function(){
                var yesSelected = $('#open_to_variable_rates-1').is(':checked');
                var noSelected = $('#open_to_variable_rates-0').is(':checked');

                if( yesSelected ){
                    $('#yes-open-to-variable-rates').show();
                    $('#no-open-to-variable-rates').hide();
                }

                if( noSelected ){
                    $('#yes-open-to-variable-rates').hide();
                    $('#no-open-to-variable-rates').show();
                }

                if(!yesSelected && !noSelected){
                    $('#yes-open-to-variable-rates').hide();
                    $('#no-open-to-variable-rates').hide();
                }
            });

            $('input:radio[name="open_to_variable_rates"]').trigger('change');

        });

    </script>
@endpush
