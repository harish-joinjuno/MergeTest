@extends('template.public')

@push('header-scripts')
    <style>
        #collapseFiltersLink.btn.collapsed:before
        {
            content:'Show ' ;
            display:inline;
            width:15px;
        }
        #collapseFiltersLink.btn:before
        {
            content:'Hide ' ;
            display:inline;
            width:15px;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>
                        Compare your Law School Aid Offers
                    </h1>
                    <h2 class="sub-heading">
                        Get the data you need to request more aid from your financial aid office
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="split-background-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a id="collapseFiltersLink" class="btn btn-link p-0 m-0 collapsed" data-toggle="collapse" href="#collapseFilters" role="button" aria-expanded="false" aria-controls="collapseFilters">
                                Filters Applied
                            </a>

                            <div class="collapse" id="collapseFilters">
                                <form method="get" action="{{ url('compare-law-school-offers/results') }}">
                                    @csrf
                                    <div class="form-row align-items-center">

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label for="program">
                                                    Law Program
                                                </label>
                                                <select id="program"
                                                        placeholder="Select your Program"
                                                        style="width: 100%;"
                                                        class="select-two form-control @error('programs') is-invalid @enderror"
                                                        name="programs[]"
                                                        multiple>
                                                    @foreach( $programs as $program )
                                                        <option
                                                            {{ in_array($program, old('programs') ? old('programs') : [] ) ? 'selected' : '' }}
                                                            value="{{ $program }}">
                                                            {{ $program }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('programs')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label for="lsat_score">
                                                    LSAT Score
                                                </label>
                                                <input type="number"
                                                       id="lsat_score"
                                                       name="lsat_score"
                                                       placeholder="LSAT Score"
                                                       class="form-control @error('lsat_score') is-invalid @enderror"
                                                       value="{{ old('lsat_score') }}"
                                                       required>
                                                @error('lsat_score')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label for="gpa">
                                                    GPA
                                                </label>
                                                <input type="number"
                                                       id="gpa"
                                                       name="gpa"
                                                       step="0.01"
                                                       placeholder="GPA"
                                                       class="form-control @error('gpa') is-invalid @enderror"
                                                       value="{{ old('gpa') }}"
                                                       required>
                                                @error('gpa')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-2">
                                            <button type="submit" class="btn btn-secondary btn-lg-block pill-radius mt-3">
                                                {{ __('Update') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="green-background d-none d-lg-block pt-0" style="margin-top: -32px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-0 p-lg-5">
                            <table class="table table-borderless table-striped text-center vertically-padded-table m-0">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-left">Program</th>
                                    <th scope="col">Min</th>
                                    <th scope="col">25%</th>
                                    <th scope="col" class="light-green-background">Median</th>
                                    <th scope="col">75%</th>
                                    <th scope="col">Max</th>
                                    <th scope="col">Download</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dataRows as $dataRow)
                                    <tr>
                                        <td class="text-left" scope="row">{{ $dataRow['program'] }}</td>
                                        <td>{{ $dataRow['min']  }}</td>
                                        <td>{{ $dataRow['25th_percentile']  }}</td>
                                        <td class="light-green-background">{{ $dataRow['median']  }}</td>
                                        <td>{{ $dataRow['75th_percentile']  }}</td>
                                        <td>{{ $dataRow['max']  }}</td>
                                        <td><form method="post" action="{{ url('compare-law-school-offers/download-results') }}">
                                                @csrf
                                                <input type="hidden" name="program" value="{{ $dataRow['program'] }}">
                                                <input type="hidden" name="lsat_score" value="{{ old('lsat_score') }}">
                                                <input type="hidden" name="gpa" value="{{ old('gpa') }}">
                                                <button type="submit" class="btn btn-link p-0 m-0">
                                                    Download
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="green-background d-lg-none pt-0" style="margin-top: -32px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach($dataRows as $dataRow)
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="mb-4">
                                    {{ $dataRow['program'] }}
                                </h4>
                                <table class="table table-borderless table-striped">
                                    <tr>
                                        <td>Min</td>
                                        <td>{{ $dataRow['min']  }}</td>
                                    </tr>

                                    <tr>
                                        <td>Median</td>
                                        <td>{{ $dataRow['median']  }}</td>
                                    </tr>

                                    <tr>
                                        <td>Max</td>
                                        <td>{{ $dataRow['max']  }}</td>
                                    </tr>
                                </table>
                                <form method="post" action="{{ url('compare-law-school-offers/download-results') }}">
                                    @csrf
                                    <input type="hidden" name="program" value="{{ $dataRow['program'] }}">
                                    <input type="hidden" name="lsat_score" value="{{ old('lsat_score') }}">
                                    <input type="hidden" name="gpa" value="{{ old('gpa') }}">
                                    <button type="submit" class="btn btn-link p-0 m-0">
                                        Download
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
