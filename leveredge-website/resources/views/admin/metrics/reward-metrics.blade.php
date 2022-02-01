@extends('template.new_public')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h3>By Deal Metrics</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Deal Name</th>
                        <th style="width: 12.5%">Users with signed loans</th>
                        <th style="width: 12.5%">Users with reward claims</th>
                        <th style="width: 12.5%">Claims</th>
                        <th style="width: 12.5%">Paid out Claims</th>
                        <th style="width: 12.5%">Users with unpaid claim and signed loan</th>
                    </tr>
                    </thead>

                    @foreach($deals as $deal)
                        <tr>
                            <td>{{ $deal->name }}</td>
                            <td>{{ $usersWithSignedLoansByDeal[$deal->name] }}</td>
                            <td>{{ $usersWithRewardClaimsForDeal[$deal->name] }}</td>
                            <td>{{ $claimsByDeal[$deal->name] }}</td>
                            <td>{{ $rewardClaimForDealWithCompletedDistribution[$deal->name] }}</td>
                            <td>{{ $usersWithUnpaidClaimAndSignedLoan[$deal->name] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection




