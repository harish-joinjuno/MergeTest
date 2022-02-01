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
                    <h2>Preferences</h2>
                    <p class="desc">We want to keep the group's preferences in mind as we negotiate these deals. <br /> If you'd like to have additional input, shoot a note to <a href="mailto:hello@joinjuno.com">hello@joinjuno.com</a></p>
                    <form class="mt-1" method="POST" action="{{route('bar-prep.step4')}}">
                        @csrf

                        @include('user_profile.forms.bar_prep.step4')

                        <div class="sign-up-next form-group mb-0">
                            <a href="{{ route('bar-prep.step3') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5"></div>
@endsection
