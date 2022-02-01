@push('header-scripts')
    <style>
        #detailed-referral-stats h3{
            text-transform: none;
        }

        #detailed-referral-stats h4.referral-status{
            font-size: 16px;
        }

        #detailed-referral-stats .referral-status-steps{
            font-size: 13px;
        }

        #detailed-referral-stats .referral-status-steps .incomplete{
            color: #757575;
        }

        #detailed-referral-stats .card-body{
            padding: 1rem;
        }
    </style>
@endpush

@if($referralProgramUser->getReferralsCount())
    <div class="container" id="detailed-referral-stats">
        <div class="row">
            <div class="col-12">
                <h2>Detailed Referral Stats</h2>
                <!-- TODO: Implement Search for Content Below -->
            </div>
        </div>

        <div class="row">
            @foreach($referralProgramUser->referredUsers() as $referredUser)
                <div class="col-12 col-md-4 mt-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="mb-3">{{ $referredUser->first_name }}</h3>
                            <h4 class="mb-2 referral-status">Referral Status: {{ $referredUser->referralStatus() }}</h4>
                            <p class="referral-status-steps mb-3">
                                <i class="fas fa-check-circle brand-color"></i>&nbsp;Signed Up&nbsp;&nbsp;

                                @if($referredUser->referralStatus() == 'Profile Complete' || $referredUser->referralStatus() == 'Borrowed')
                                    <i class="fas fa-check-circle brand-color"></i>&nbsp;Profile Completed&nbsp;&nbsp;
                                @else
                                    <span class="incomplete"><i class="far fa-check-circle"></i>&nbsp;Profile Completed</span>
                                @endif

                                @if( $referredUser->referralStatus() == 'Borrowed' )
                                    <i class="fas fa-check-circle brand-color"></i>&nbsp;Borrowed
                                @else
                                    <span class="incomplete"><i class="far fa-check-circle"></i>&nbsp;Borrowed</span>
                                @endif
                            </p>
                        </div>
                        <div class="card-footer">
                            @if( $referredUser->referralStatus() == 'Borrowed' )
                                <span class="brand-color"><i class="fas fa-award"></i> You've earned a reward</span>
                            @else
                                Your friend hasn't borrowed
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
