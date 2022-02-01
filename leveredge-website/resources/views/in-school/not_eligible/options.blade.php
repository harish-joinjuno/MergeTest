@extends('template.public')

@section('content')

    <div class="jumbotron mt-0 mb-0 pb-0 pt-0 bg-transparent">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h4 class="mt-3">
                        Unfortunately, your program is not currently eligible for the negotiated student loan deal, but we've partnered with Credible to help you access competitive student loan rates.
                    </h4>

                    {{--<form class="mt-5">--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="university-select">University</label>--}}
                            {{--<select id="university-select" class="form-control selectpicker" name="university-select" data-live-search="true">--}}
                                {{--<option value="">Select your University</option>--}}
                                {{--@foreach($universities as $university)--}}
                                    {{--<option value="{{ $university->id }}">{{ $university->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="graduation-year-select">Graduation Year</label>--}}
                            {{--<select id="graduation-year-select" class="form-control" name="graduation-year-select">--}}
                                {{--<option value="">Select your Graduation Year</option>--}}
                                {{--<option value="2019">2019</option>--}}
                                {{--<option value="2020">2020</option>--}}
                                {{--<option value="2021">2021</option>--}}
                                {{--<option value="2022">2022</option>--}}
                                {{--<option value="2023">2023</option>--}}
                                {{--<option value="2024">2024</option>--}}
                                {{--<option value="2025">2025</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<label for="cosigner-status-select">{{ __('Cosigner Status') }}</label>--}}
                            {{--<select id="cosigner-status-select" class="form-control" name="cosigner-status-select">--}}
                                {{--<option value="">Select if you have a co-signer</option>--}}
                                {{--<option value="1">I have a co-Signer</option>--}}
                                {{--<option value="0">I don't have a co-Signer</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</form>--}}


                    {{--<div class="mt-5" id="credible-option" style="display: none;">--}}
                    <div class="mt-5" id="credible-option">
                        @include('in-school.not_eligible.credible_option')
                    </div>




                </div>
            </div>

        </div>
    </div>





@endsection


@push('header-scripts')
    <!-- Latest compiled and minified CSS for Bootstrap Select -->
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--}}
@endpush

@push('footer-scripts')

    {{--<!-- Latest compiled and minified JavaScript for Bootstrap Select -->--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>--}}


    {{--<script>--}}
        {{--$(function () {--}}


            {{--$("#cosigner-status-select").change(function () {--}}
                {{--$.ajax({--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ url('/access-the-deal/' . $record_id) }}",--}}
                    {{--data: {--}}
                        {{--cosigner_status : $(this).val()--}}
                    {{--}--}}
                {{--});--}}


                {{--if( $(this).val() === "1"  ){--}}
                    {{--$('#credible-option').show();--}}
                    {{--$('#more-students').hide();--}}
                {{--}else if($(this).val() === "0"){--}}
                    {{--$('#credible-option').show();--}}
                    {{--$('#more-students').hide();--}}
                {{--}else{--}}
                    {{--$('#credible-option').hide();--}}
                    {{--$('#more-students').hide();--}}
                {{--}--}}


            {{--});--}}



            {{--$("#graduation-year-select").change(function () {--}}
                {{--$.ajax({--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ url('/access-the-deal/' . $record_id) }}",--}}
                    {{--data: {--}}
                        {{--graduation_year : $(this).val()--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}



            {{--$("#university-select").change(function () {--}}
                {{--$.ajax({--}}
                    {{--type: "POST",--}}
                    {{--url: "{{ url('/access-the-deal/' . $record_id) }}",--}}
                    {{--data: {--}}
                        {{--university : $(this).val()--}}
                    {{--}--}}
                {{--});--}}
            {{--});--}}



        {{--});--}}
    {{--</script>--}}

@endpush
