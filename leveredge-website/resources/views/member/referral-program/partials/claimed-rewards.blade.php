@if($referralProgramUser->referralRewardClaims()->count())
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">

                <h2>Claimed Rewards</h2>

                <table class="table table-borderless">
                    @foreach($referralProgramUser->referralRewardClaims as $referralRewardClaim)
                        <tr>
                            <td>{{ $referralRewardClaim->reward }}</td>
                            <td class="white-space-nowrap w-1">{{ $referralRewardClaim->status ?? 'Pending' }}</td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endif
