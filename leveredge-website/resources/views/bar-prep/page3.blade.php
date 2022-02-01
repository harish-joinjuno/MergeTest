@extends('template.public')

@section('content')
    <div class="container signup-container" id="safeApp">
        <div class="row">
            <div class="col-12">
                <div class="progress signup-progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$progress}}%"
                         aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div id="personal-form" class="mt-5">
                    <h2>Bar Prep Info</h2>
                    <form class="mt-1" method="POST" action="{{route('bar-prep.step3')}}">
                        @csrf

                        @include('user_profile.forms.bar_prep.step3')

                        <div class="sign-up-next form-group mb-0">
                            <a href="{{ route('bar-prep.step2') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
