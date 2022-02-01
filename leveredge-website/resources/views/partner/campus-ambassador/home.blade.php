@extends('template.public')

@section('content')
    <div id="next-steps">
        <div class="container">
            <div class="row justify-content-center mt-4 mb-4">
                <div class="col-md-8">
                    <h1>{{ Auth::user()->name }}'s Growth Marketing Dashboard</h1>
                </div>
            </div>
        </div>

        <div class="jumbotron my-0 py-0 border-radius-0 secondary-sticky-menu">
            <div class="container my-0 py-0">
                <div class="row mb-0 justify-content-center">
                    <div class="col-md-8 mb-0">
                        <nav class="nav nav-pills nav-justified mb-0" style="margin-left: -1rem;">
                            @hasPageSection(\App\PageSection::PAGE_CAMPUS_AMBASSADOR_DASHBOARD,'Resources')
                            <a class="nav-link" href="#ResourcesHeading">Resources</a>
                            @endhasPageSection
                            <a class="nav-link" href="#TasksHeading">Tasks</a>
                            <a class="nav-link" href="#RewardsHeading">Rewards</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @hasPageSection(\App\PageSection::PAGE_CAMPUS_AMBASSADOR_DASHBOARD,'Resources')
        @php
            $section = \App\PageSection::query()
                        ->where('target_page', '=', \App\PageSection::PAGE_CAMPUS_AMBASSADOR_DASHBOARD)
                        ->where('section_name', '=', 'Resources')
                        ->first();
        @endphp
        <div class="position-relative">
            <div id="ResourcesHeading" class="secondary-sticky-menu-target"></div>
            <div class="jumbotron py-0 my-0 bg-brand border-radius-0">
                <div class="container py-0 my-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-light">Resources</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center mt-1">
                    <div class="col-md-8">
                        {!! $section->published_content !!}
                    </div>
                </div>
            </div>
        </div>
        @endhasPageSection

        <div class="position-relative">
            <div id="TasksHeading" class="secondary-sticky-menu-target"></div>
            <div class="jumbotron py-0 my-0 bg-brand border-radius-0">
                <div class="container py-0 my-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-light">Tasks</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center mt-1">
                    <div class="col-md-8">
                        <h2>Here are a few tasks you can knock out</h2>
                        <p class="mt-1">Have a new idea? Reach out to us and we’ll add it.</p>

                        <h3 class="mt-3">One-Time Tasks</h3>
                        @forelse(\App\CampusAmbassadorTask::where('task_recurrence',\App\CampusAmbassadorTask::TASK_RECURRENCE_NONE)->orderBy('sort_order')->get() as $campusAmbassadorTask)

                            @unless( \App\CompletedCampusAmbassadorTask::where('user_id', Auth::user()->id)->where('campus_ambassador_task_id',$campusAmbassadorTask->id)->exists() )
                                @include('partner.campus-ambassador.incomplete_task_card',['campusAmbassadorTask' => $campusAmbassadorTask])
                            @endunless

                        @empty
                            No one-time tasks
                        @endforelse

                        <h3 class="mt-3">Ongoing Tasks</h3>
                        @forelse(\App\CampusAmbassadorTask::where('task_recurrence',\App\CampusAmbassadorTask::TASK_RECURRENCE_RECURRING)->orderBy('sort_order')->get() as $campusAmbassadorTask)
                            @unless( Auth::user()->completedCampusAmbassadorTasks->contains($campusAmbassadorTask->id) && $campusAmbassadorTask->task_recurrence == \App\CampusAmbassadorTask::TASK_RECURRENCE_NONE)
                                @include('partner.campus-ambassador.incomplete_task_card',['campusAmbassadorTask' => $campusAmbassadorTask])
                            @endunless

                        @empty
                            No recurring tasks
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative">
            <div id="RewardsHeading" class="secondary-sticky-menu-target"></div>
            <div class="relative jumbotron py-0 my-0 bg-brand border-radius-0">
                <div class="container py-0 my-0">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <h2 class="text-light">Rewards</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center mt-1">
                    <div class="col-md-8">
                        <h2>Your Referral Link</h2>
                        <p class="mt-1">We encourage you to use this link everywhere you can.</p>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p class="card-title">You earn 0.25% of the first qualifying loan taken by a member
                                    that signs up using your link.</p>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" readonly id="campaign-url" class="form-control"
                                               value="{{ url('/?grow=' . Auth::user()->referral_code) }}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="copyUrl()"><i
                                        class="fa fa-paste"></i> Copy Url
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                        <h2>The rewards you have earned</h2>

                        <h3 class="mt-3">Referral Rewards</h3>
                        <p>You earn 0.25% of the first qualifying loan taken by a member
                            that signs up using your link.</p>

                        <p>
                            You've earned ${{ $partner->currentReferralProgramUser()->getEarnedAmount() }}
                        </p>

                        <h3 class="mt-3">Task Payments</h3>
                        <p>You earn $15 per hour and/or amounts and bonuses associated with each task.</p>

                        <table class="table table-bordered mt-3">
                            <tr>
                                <th>Task</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>

                            @foreach(Auth::user()->completedCampusAmbassadorTasks as $campusAmbassadorTask)
                                <tr>
                                    <td>{{ $campusAmbassadorTask->title }}</td>
                                    <td>${{ number_format($campusAmbassadorTask->pivot->amount) }}</td>
                                    @if($campusAmbassadorTask->pivot->payment_completed)
                                        <td class="text-center"><i class="far fa-check-circle brand-color"></i></td>
                                    @else
                                        <td>Pending</td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


                <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                        <h2>
                            The impact you have made
                        </h2>

                        <div class="card mt-3">
                            <div class="card-body">
                                <h5 class="card-title"># of People who</h5>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Signed up to Juno
                                        <span class="badge badge-secondary badge-pill">{{ $partner->currentReferralProgramUser()->getReferralsCount() }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Closed a loan with a Qualifying Lender
                                        <span
                                            class="badge badge-secondary badge-pill">{{ $partner->currentReferralProgramUser()->getSuccessfulReferralsCount() }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('footer-scripts')
    <script>
        function copyUrl() {
            const copyText = document.getElementById('campaign-url');
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand('copy');
        }
    </script>
@endpush
