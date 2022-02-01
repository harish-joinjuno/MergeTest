@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
    <style>
        .select2-container .selection .select2-selection {
            height:calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0;
            font-size: 1.15rem;
            line-height: 1.5;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            background-clip: padding-box;
            color:#495057;
        }
        .select2-container.select2-container--default .select2-selection--single .select2-selection__arrow {
            top:8px;
            right:8px;
        }
    </style>
@endpush

@push('footer-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('select').each(function(index, select) {
                if(select.children.length > 0 && select.children[0].value.length === 0) {
                    $(select.children[0]).attr('disabled', 'disabled');
                }
            });

            $('.select-2').select2({
                width: '100%',
            });

            const vehicleYearInput = $('#vehicle_year');
            const vehicleMakeInput = $('#vehicle_make');
            const vehicleModelInput = $('#vehicle_model');
            let year;
            let make;

            vehicleYearInput.on('change', function() {
                year = $(vehicleYearInput.find('option:selected')[0]).text();
                $.ajax({
                    url: '/api/get-makes-by-year',
                    method: 'POST',
                    data: {
                        year: year,
                    },
                    success: function(response) {
                        if(response.length) {
                            vehicleMakeInput.children().each(function(index, child) {
                                if(index > 0) {
                                    child.remove();
                                }
                            });
                            response.forEach(function(item){
                                const option = new Option(item.make, item.id);
                                vehicleMakeInput.append(option);
                            });
                            vehicleMakeInput.removeAttr('disabled');
                        }
                    },
                });
            });

            vehicleMakeInput.on('change', function() {
                make = $(vehicleMakeInput.find('option:selected')[0]).text();
                $.ajax({
                    url: '/api/get-models-by-make-and-year',
                    method: 'POST',
                    data: {
                        year: year,
                        make: make,
                    },
                    success: function(response) {
                        if(response.length) {
                            vehicleModelInput.children().each(function(index, child) {
                                if(index > 0) {
                                    child.remove();
                                }
                            });
                            response.forEach(function(item){
                                const option = new Option(item.model, item.id);
                                vehicleModelInput.append(option);
                            });
                            vehicleModelInput.removeAttr('disabled');
                        }
                    },
                });
            });
        });
    </script>
@endpush

@section('content')
    @include('landing-pages.partials._need-help-banner')

<div class="py-3"></div>
<div class="container narrow">
    @include('landing-pages.partials._step-timeline', [
        'steps' => $totalSteps ?? 0,
        'active' => $currentStep ?? 0,
    ])
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center">Let's find your vehicle</h2>
            <p class="text-center">Choose a method below to find your vehicle</p>
        </div>
    </div>

    <div id="accordionExample" class="accordion">
        <div class="row my-4">
            <div class="col-12 col-md-4">
                <div class="card collapsed" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <div class="card-body px-0">
                        <div class="mx-auto my-auto text-center">
                            <h4>Find by</h4>
                            <h2 class="off-black">License Plate</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card collapsed" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="card-body px-0">
                        <div class="mx-auto my-auto text-center">
                            <h4>Find by</h4>
                            <h2 class="off-black">VIN</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card collapsed" style="cursor: pointer;" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <div class="card-body px-0">
                        <div class="mx-auto my-auto text-center">
                            <h4>Find by</h4>
                            <h2 class="off-black">Make/Model</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row collapse" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0">
                        {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_vehicle_details', $autoRefinanceApplication->id]])}}

                        <div class="form-group col-12">
                            <label for="license_plate">License Plate</label>
                            {{Form::text('license_plate',$autoRefinanceApplication->license_plate ,['class' => 'form-control','placeholder' => 'License Plate','id' => 'license_plate'])}}
                            @if ($errors->has('license_plate'))
                                <span class="text-danger">
                                    {{ $errors->first('license_plate') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12 mt-3">
                            <label for="license_plate_state">State</label>
                            {{
                                Form::select(
                                    'license_plate_state',
                                    $states,
                                    $autoRefinanceApplication->license_plate_state,
                                    [
                                        'class' => 'form-control select-2',
                                        'placeholder' => 'State',
                                        'id' => 'license_plate_state'
                                    ]
                                )
                            }}
                            @if ($errors->has('license_plate_state'))
                                <span class="text-danger">
                                    {{ $errors->first('license_plate_state') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary mt-3">Next</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0">
                        {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_vehicle_details', $autoRefinanceApplication->id]])}}

                        <div class="form-group col-12">
                            <label for="vin">VIN</label>
                            {{Form::text('vin',$autoRefinanceApplication->vin ,['class' => 'form-control','placeholder' => 'VIN','id' => 'vin'])}}
                        </div>

                        @if ($errors->has('vin'))
                            <span class="text-danger">
                                {{ $errors->first('vin') }}
                            </span>
                        @endif

                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary mt-3">Next</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-0">
                        {{Form::model($autoRefinanceApplication, ['route' => ['auto_refinance-save_vehicle_details', $autoRefinanceApplication->id]])}}

                        <div class="col-12 form-group">
                            <label for="vehicle_year">Year</label>
                            {{
                                Form::select(
                                    'vehicle_year',
                                    $years,
                                    $autoRefinanceApplication->vehicle_year,
                                    [
                                        'class' => 'form-control select-2',
                                        'placeholder' => 'Vehicle Year',
                                        'id' => 'vehicle_year',
                                    ]
                                )
                            }}
                            @if ($errors->has('vehicle_year'))
                                <span class="text-danger">
                                {{ $errors->first('vehicle_year') }}
                                </span>
                            @endif
                        </div>

                        <div class="col-12 mt-3 form-group">
                            <label for="vehicle_make">Make</label>
                            {{
                                Form::select(
                                    'vehicle_make',
                                    $makes,
                                    $autoRefinanceApplication->vehicle_make ,
                                    [
                                        'class' => 'form-control select-2',
                                        'placeholder' => 'Vehicle Make',
                                        'id' => 'vehicle_make',
                                        'disabled' => $autoRefinanceApplication->vehicle_year ? false : true,
                                    ]
                                )
                            }}
                            @if ($errors->has('vehicle_make'))
                                <span class="text-danger">
                                    {{ $errors->first('vehicle_make') }}
                                </span>
                            @endif
                        </div>

                        <div class="col-12 mt-3 form-group">
                            <label for="vehicle_model">Model</label>
                            {{
                                Form::select(
                                    'vehicle_model',
                                    $models,
                                    $autoRefinanceApplication->vehicle_model,
                                    [
                                        'class' => 'form-control select-2',
                                        'placeholder' => 'Vehicle Model',
                                        'id' => 'vehicle_model',
                                        'disabled' => $autoRefinanceApplication->vehicle_make ? false : true,
                                    ]
                                )
                            }}
                            @if ($errors->has('vehicle_model'))
                                <span class="text-danger">
                                    {{ $errors->first('vehicle_model') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary mt-3">Next</button>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-3"></div>
@endsection




