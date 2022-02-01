<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card border-0">

                <h2>Referral Stats</h2>

                <table class="table table-borderless">
                    <tr>
                        <td>Referrals</td>
                        <td class="d-none d-md-table-cell">People who have signed up using your link</td>
                        <td><p class="float-right">{{ $referralProgramUser->getReferralsCount() }}</p></td>
                    </tr>

                    <tr>
                        <td>Pending</td>
                        <td class="d-none d-md-table-cell">Amount you stand to earn if your referrals take our loan</td>
                        <td><p class="float-right">${{ $referralProgramUser->getPendingAmount() }}</p></td>
                    </tr>

                    <tr>
                        <td>Earned</td>
                        <td class="d-none d-md-table-cell">Amount you have earned</td>
                        <td><p class="float-right">${{ $referralProgramUser->getEarnedAmount() }}</p></td>
                    </tr>

                    <tr>
                        <td>Claimed</td>
                        <td class="d-none d-md-table-cell">Amount that has already been claimed to you</td>
                        <td><p class="float-right">${{ $referralProgramUser->getPaidAmount() }}</p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
