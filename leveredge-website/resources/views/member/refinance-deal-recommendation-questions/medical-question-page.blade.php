@extends('template.public')

@section('content')
    <div class="py-4 py-lg-5"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 text-center">
                <p class="text-center">({{$totalPages}} of {{$totalPages}})</p>
                <h1 class="off-black">What's your profession?</h1>
                <h4 class="mt-3 mb-4">Some lenders offer special rates for certain professions.</h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 col-lg-3 text-center">
                <form class="mt-5" method="POST">
                    @csrf
                    <label for="profession_id">Profession</label>
                    <select id="profession_id" class="form-control{{ $errors->has('profession_id') ? ' is-invalid' : '' }}" name="profession_id">
                        <option value="">Select your profession</option>
                        @foreach( $professions as $option )
                            <option
                                @if(old('profession_id') == $option['id']) selected @endif
                            value="{{ $option['id'] }}">
                                {{ $option['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('profession_id')
                    <div class="invalid-feedback" role="alert">
                        {{ $message }}
                    </div>
                    @enderror


                    @php
                        $prevPage = $totalPages > 1
                                    ? '/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/refinance-deal-recommendation-questions/zip-code'
                                    : '/member/negotiation-group/'.$negotiationGroupUser->negotiationGroup->id.'/refinance-deal-recommendation-questions';
                    @endphp

                    <div class="form-group mb-0 mt-5">
                        <a href="{{ url($prevPage) }}" class="btn btn-outline-primary">Back</a>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-5"></div>
    <div class="py-5"></div>
@endsection
