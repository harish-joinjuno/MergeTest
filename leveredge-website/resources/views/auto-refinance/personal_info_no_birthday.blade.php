@extends('template.public')

@push('header-scripts')
    @include('landing-pages.partials._landing-pages-styles')
@endpush

@section('content')
    @include('landing-pages.partials._need-help-banner')
    <div class="py-3"></div>
    <div class="container narrow">
        @include('landing-pages.partials._step-timeline', [
                'steps' => $totalSteps ?? 0,
                'active' => $currentStep ?? 0,
            ])
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <h2 class="text-center">Personal Information</h2>
                <p class="text-center">This information helps us ensure that you'll qualify for any deal we negotiate</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                {{
                    Form::model(
                        $autoRefinanceApplication,
                        ['route' => ['auto_refinance-save_personal_info', $autoRefinanceApplication->id]]
                    )
                }}
                {{-- first name--}}
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    @if(auth()->check() && empty($autoRefinanceApplication->first_name) && !empty(user()->first_name))
                        {{
                            Form::text(
                                'first_name',
                                user()->first_name,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'First Name',
                                    'id' => 'first_name',
                                    'required' => true,
                                    'autofocus' => true,
                                ]
                            )
                        }}
                    @else
                        {{
                            Form::text(
                                'first_name',
                                $autoRefinanceApplication->first_name,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'First Name',
                                    'id' => 'first_name',
                                    'required' => true,
                                    'autofocus' => true,
                                ]
                            )
                        }}
                    @endif

                    @if ($errors->has('first_name'))
                        <span class="text-danger">
                        {{ $errors->first('first_name') }}
                    </span>
                    @endif
                </div>
                {{-- last name--}}
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    @if(auth()->check() && empty($autoRefinanceApplication->first_name) && !empty(user()->last_name))
                        {{
                            Form::text(
                                'last_name',
                                user()->last_name,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Last Name',
                                    'id' => 'last_name',
                                    'required' => true,
                                ]
                            )
                        }}
                    @else
                        {{
                            Form::text(
                                'last_name',
                                $autoRefinanceApplication->last_name,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Last Name',
                                    'id' => 'last_name',
                                    'required' => true,
                                ]
                            )
                        }}
                    @endif

                    @if ($errors->has('last_name'))
                        <span class="text-danger">
                        {{ $errors->first('last_name') }}
                    </span>
                    @endif
                </div>
                @yield('birthday')
                {{-- email --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    @if(auth()->check() && empty($autoRefinanceApplication->email) && !empty(user()->email))
                        {{
                            Form::text(
                                'email',
                                user()->email,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Email',
                                    'id' => 'email',
                                    'required' => true,
                                ]
                            )
                        }}
                    @else
                        {{
                            Form::text(
                                'email',
                                $autoRefinanceApplication->email,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Email',
                                    'id' => 'email',
                                    'required' => true,
                                ]
                            )
                        }}
                    @endif
                    @if ($errors->has('email'))
                        <span class="text-danger">
                        {{ $errors->first('email') }}
                    </span>
                    @endif
                </div>
                @yield('payoff_score')
                <button type="submit" class="btn btn-primary">Next</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="py-3"></div>
@endsection




