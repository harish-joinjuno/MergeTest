@extends('template.public')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1>Last Step to Enter the Competition</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="split-background-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="firstNameInput">What's your name?</label>
                                    <input name="first_name" type="text" class="form-control" id="firstNameInput" placeholder="First Name" value="{{ old('first_name') }}">
                                </div>
                                @error('first_name')
                                <div class="alert alert-danger">Can we get on a first name basis?</div>
                                @enderror

                                <div class="form-group">
                                    <label class="mt-3">Which of the following statements are true?</label>
                                    @foreach($entrant->competition->true_statements as $index => $trueStatement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $trueStatement }}" id="statement_{{$index}}" name="true_statements[]">
                                        <label class="form-check-label" for="statement_{{$index}}">
                                            {{ $trueStatement }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @php
                                    $statement_error = "Hint: This is just us bragging ;). All of the above is true. Check all the boxes and try again."
                                @endphp
                                @if ($errors->has('true_statements') && !isset($statement_error_displayed))
                                    <div class="alert alert-danger">
                                        {{ $statement_error }}
                                    </div>
                                    @php
                                        $statement_error_displayed = true;
                                    @endphp
                                @endif

                                <div class="form-group">
                                    <label class="mt-3">Which team are you rooting for?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="colloquial_slug" id="colloquial_slug_one" value="{{ $entrant->competition->colloquial_slug_one }}" checked>
                                        <label class="form-check-label" for="colloquial_slug_one">
                                            {{ $entrant->competition->colloquial_name_one }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="colloquial_slug" id="colloquial_slug_two" value="{{ $entrant->competition->colloquial_slug_two }}">
                                        <label class="form-check-label" for="colloquial_slug_two">
                                            {{ $entrant->competition->colloquial_name_two }}
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">Enter Competition</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
