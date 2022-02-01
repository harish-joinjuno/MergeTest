@extends('template.auth_template')

@push('header-scripts')
    <link href="{{mix('mix/css/pages/dashboard.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <div class="container">
        <div class="new-dashboard">
{{--            @include('includes.action-notifications')--}}
            <greeting name="{{ Auth::user()->first_name != '' ? Auth::user()->first_name : 'Guest' }}"></greeting>

            <!-- TODO: Complete Formatting of Negotiation Group and add the Icons for the Progress State -->
            @foreach($enrolledNegotiationGroupUsers as $negotiationGroupUser)
                <negotiation-group
                    :negotiation-group="{{  json_encode($negotiationGroupUser->negotiationGroup) }}"
                    :negotiation-group-user-id="{{ $negotiationGroupUser->id }}">
                </negotiation-group>
            @endforeach

            @if($eligibleAcademicYears->count() > 0)
                <div class="dashboard-row mb-4 mt-4">
                    <div class="head p-3 p-md-4">
                        <h2 class="h4 off-black mb-0 mx-md-2">
                            Looking for a different loan?
                        </h2>
                        <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
                    </div>
                    @foreach($eligibleAcademicYears as $academicYear)
                        <div class="content text-center p-5">
                            <div class="d-flex justify-content-center mb-2">
                                <h2 class="off-black title">
                                    Want to join the {{ $academicYear->display_name }}?
                                </h2>
                            </div>

                            <form method="post" action="{{ url('/member/join-negotiation-group') }}">
                                @csrf
                                <input type="hidden" name="academic_year_id" value="{{ $academicYear->id }}">
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ __('Join the Group') }}
                                    </button>
                                </div>
                            </form>

                        </div>

                    @endforeach
                </div>
            @endif

            @if($eligibleForRewards)
                <div class="dashboard-row mb-4 mt-4">
                    <div class="head p-3 p-md-4">
                        <h2 class="h4 off-black mb-0 mx-md-2">
                            Request Rewards
                        </h2>
                        <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
                    </div>
                    <div class="content text-center p-5">
                        <div class="d-flex justify-content-center mb-2">
                            <h2 class="off-black title">
                                Secured a loan via Juno? Request any associated reward here:
                            </h2>
                        </div>

                        <form method="get" action="{{ url('/member/reward-claim') }}">
                            @csrf
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    {{ __('Request Rewards') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            @endif

            <referral-center link="{{ user()->referral_link}}"></referral-center>
            <help-support></help-support>





            <div class="py-md-5"></div>
        </div>
    </div>
@endsection
