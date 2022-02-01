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
                    <h2>Personal Information</h2>
                    <form class="mt-1" method="POST" action="{{route('bar-prep.step1')}}">
                        @csrf

                        @include('user_profile.forms.bar_prep.step1')

                        <div class="sign-up-next form-group mb-0">
                            <a href="{{ route('user-profile.loan-type') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>
                @include('bar-prep.explain')
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
