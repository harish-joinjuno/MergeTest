@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <p class="text-center">(1 of 2)</p>
                <h1 class="off-black">Do you have a co-signer?</h1>
                <h4 class="mt-3 mb-4">
                    A cosigner is a person who is obligated to pay back the loan if you, the student,
                    don't make your payments. Your co-signer can be a parent, relative, spouse or any adult. Members with co-signers are more likely to get the lowest rate.
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <form class="mt-5" method="POST">
                    @csrf
                    @foreach( $cosignerStatuses as $cosignerStatus )
                        <div class="form-group custom-radio">
                            <input
                                type="radio"
                                name="cosigner_status"
                                class="d-none"
                                value="{{ $cosignerStatus }}"
                                id="cosigner-status-{{ $cosignerStatus }}"
                                @if(old('cosigner_status', user()->profile->cosigner_status) === $cosignerStatus) checked @endif
                            >
                            <label
                                for="cosigner-status-{{ $cosignerStatus }}"
                                class="p-3 pl-5 border rounded w-100 text-left position-relative"
                            >
                                {{ $cosignerStatus }}
                            </label>
                        </div>
                    @endforeach
                    @error('cosigner_status')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                    @enderror


                    <div class="row justify-content-center mt-5" id="no-to-cosigner" style="display: none">
                        <div class="col-12 col-md-11">
                            <div class="row animate__animated animate__fade_up">
                                <div class="col-3 col-md-2 d-flex align-items-center">
                                    <img src="{{ asset('img/logo/new-logo-without-copy.svg') }}" class="img-fluid">
                                </div>

                                <div class="col-9 col-md-10">
                                    <div class="speech-bubble-left p-4 inline-block">
                                        <p class="m-0 text-left">
                                            A co-signer can help you access even lower rates, but don’t worry,
                                            we have awesome options for you even without a co-signer.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-5" id="yes-to-cosigner" style="display: none">
                        <div class="col-12 col-md-11">
                            <div class="row animate__animated animate__fade_up">
                                <div class="col-3 col-md-2 d-flex align-items-center">
                                    <img src="{{ asset('img/logo/new-logo-without-copy.svg') }}" class="img-fluid">
                                </div>

                                <div class="col-9 col-md-10">
                                    <div class="speech-bubble-left p-4 inline-block">
                                        <p class="m-0 text-left">
                                            Awesome! Members with co-signers are more likely to get the lowest rates.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-0 mt-5">
                        <a href="{{ url('/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/pre-deal-recommendation-questions') }}" class="btn btn-outline-primary">Back</a>
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


            $('input:radio[name="cosigner_status"]').change(function(){
                var yesSelected = $('#cosigner-status-Yes').is(':checked');
                var noSelected = $('#cosigner-status-No').is(':checked');

                if( yesSelected ){
                    $('#yes-to-cosigner').show();
                    $('#no-to-cosigner').hide();
                }

                if( noSelected ){
                    $('#yes-to-cosigner').hide();
                    $('#no-to-cosigner').show();
                }

                if(!yesSelected && !noSelected){
                    $('#yes-to-cosigner').hide();
                    $('#no-to-cosigner').hide();
                }
            });

            $('input:radio[name="cosigner_status"]').trigger('change');

        });

    </script>
@endpush
