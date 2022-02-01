@extends('template.public')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <p>
                    Note: This report excludes clicks in the last 20 days.
                </p>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Row Number</th>
                        <th>Access the Deal ID</th>
                        <th>Days since Click</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <td>Lender Reported Loan Status</td>
                        <td>Potential Reward Amount</td>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                    /** @var \App\AccessTheDeal[] $accessTheDeals */
                    /** @var \App\AccessTheDeal $accessTheDeal */
                    $groupedByStatus = $accessTheDeals->groupBy('loan_status_id');
                    $iterator = 1;
                    @endphp
                    @foreach($groupedByStatus as $accessTheDealsGroup)
                        @foreach($accessTheDealsGroup as $accessTheDeal)
                                <tr>
                                    <td>{{ $iterator }}</td>
                                    @php
                                        /** @var int $iterator */
                                        $iterator++;
                                    @endphp
                                    <td>{{ $accessTheDeal->id }}</td>
                                    <td>{{ now()->diffInDays($accessTheDeal->created_at) }}</td>
                                    <td>{{ $accessTheDeal->user->id }}</td>
                                    <td>{{ $accessTheDeal->user->email }}</td>
                                    <td>{{ $accessTheDeal->dealStatus->loan_status }}</td>
                                    <td>{{ \App\RewardPrograms\Concretes\CredibleStudentLoanRewardProgram::calculateRewardAmount($accessTheDeal->loan_amount) }}</td>
                                </tr>
                        @endforeach
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
