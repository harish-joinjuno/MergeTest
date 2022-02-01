@extends('template.public')

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

    <section class="split-background-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form method="get" action="{{ url('compare-law-school-offers/results') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="program">
                                        Law Program
                                    </label>
                                    <select id="program"
                                            class="select-two form-control @error('programs') is-invalid @enderror"
                                            name="programs[]"
                                            placeholder="Select your Program"
                                            style="width: 100%;"
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

                                <button type="submit" class="btn btn-secondary pill-radius mt-3">
                                    {{ __('Compare') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
