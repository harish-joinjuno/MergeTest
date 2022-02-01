@extends('template.public')

@push('header-scripts')
    <style>
        .show-on-focus > span {
            opacity:0;
        }
        .show-on-focus:focus > span {
            opacity:1;
        }
        .show-on-focus:before {
            content: 'Click to reveal';
            color:#6c757d;
            font-size:12px;
            font-style:italic;
        }
        .show-on-focus:focus:before {
            content: '';
        }
        .truncate-cell > div {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow:hidden;
        }
        .truncate-cell:focus > div {
            -webkit-line-clamp: unset;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <p>
                    Note: This report excludes reward requests submitted to Juno in the last 20 days.
                </p>

                <table class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th>Row Number</th>
                        <th>Reward Claim ID</th>
                        <th>Reward Requested and Document Submitted On</th>
                        <th>Days since Reward Request Submitted</th>
                        <th>Member Reported Loan Amount</th>
                        <th>Reward Amount</th>
                        <th>User ID</th>
                        <th>User Email</th>
                        <th>Date User Joined Juno</th>
                        <th>Access The Deal ID (with Best Case Status)</th>
                        <th>Best Case Status</th>
                        <th>Best Case Loan Amount</th>
                        <th>Loan Amount Match?</th>
                        <th>All Access the Deal IDs for User</th>
                        <th>Date of First Click to Credible</th>
                        <th>Amount Paid to User for Credible Claims</th>
                        <th>Distribution Notes</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                    /** @var \App\LeveredgeRewardClaim $claim */
                    /** @var \App\AccessTheDeal $accessTheDeal */
                    /** @var \Illuminate\Support\Collection $credibleClaims */

                    $groupedClaims = $credibleClaims->groupBy(function ($item) use ($latestAccessTheDeal){
                        return $latestAccessTheDeal[$item->id]->dealStatus->loan_status;
                    });

                    $iterator = 1;
                    @endphp
                    @foreach($groupedClaims as $credibleClaims)
                        @foreach($credibleClaims as $claim)
                            @unless($latestAccessTheDeal[$claim->id] && $latestAccessTheDeal[$claim->id]->disbursed_amount > 0)
                                <tr>
                                    <td>{{ $iterator }}</td>
                                    @php
                                        $iterator++;
                                    @endphp
                                    <td><a href="{{ url('nova/resources/leveredge-reward-claims/'.$claim->id) }}">{{ $claim->id }}</a></td>
                                    <td>{{ $claim->created_at->format('Y-m-d') }}</td>
                                    <td>{{ now()->diffInDays($claim->created_at) }}</td>
                                    <td>{{ $claim->loan_amount }}</td>
                                    <td>{{ $claim->reward_amount }}</td>
                                    <td><a href="{{ url('nova/resources/users/'.$claim->user->id) }}">{{ $claim->user->id }}</a></td>
                                    <td tabindex="0" class="show-on-focus">
                                        <span>{{ $claim->user->email }}</span>
                                    </td>
                                    <td>{{ $claim->user->created_at->format('Y-m-d') }}</td>
                                    @if($latestAccessTheDeal[$claim->id])
                                        <td>{{ $latestAccessTheDeal[$claim->id]->id }}</td>
                                        <td>{{ $latestAccessTheDeal[$claim->id]->dealStatus->loan_status }}</td>
                                        <td>{{ $latestAccessTheDeal[$claim->id]->loan_amount }}</td>
                                        @if( abs($claim->loan_amount - $latestAccessTheDeal[$claim->id]->loan_amount)  < 5 )
                                            <td>Loan Amount Matches</td>
                                        @elseif(!$latestAccessTheDeal[$claim->id]->loan_amount > 0)
                                            <td>Unknown</td>
                                        @else
                                            <td>Loan Amount Doesnt Match</td>
                                        @endif
                                        @if(count($claim->user->accessTheDeals()->where('deal_id',3)->pluck('id')))
                                            <td>
                                            @php
                                            $ids = $claim->user->accessTheDeals()->where('deal_id',3)->pluck('id');
                                            @endphp
                                            @foreach($ids as $id)
                                                <a target="_blank" href="{{ url('nova/resources/access-the-deals/' . $id) }}">{{ $id }}</a><br>
                                            @endforeach
                                            </td>
                                        @endif

                                    @else
                                        <td colspan="4">User Never Clicked on our link</td>
                                    @endif

                                    <td>{{ $claim->user->accessTheDeals()->where('deal_id',3)->orderBy('id','asc')->first()->created_at->format('Y-m-d') }}</td>

                                    @php
                                        $amountDistributed = \App\LeveredgeRewardDistribution::where('payment_completed',true)
                                            ->whereHas('rewardClaim',function($query) use ($claim){
                                                $query->where('user_id',$claim->user->id)
                                                       ->where('deal_id',3);
                                            })->sum('amount');
                                    @endphp
                                    <td>{{ $amountDistributed }}</td>
                                    @php
                                        $distributionNotes = [];
                                        foreach($claim->distributions as $distribution){
                                            /** @var \App\LeveredgeRewardDistribution $distributionNotes */
                                            $distributionNotes[] = $distribution->admin_notes;
                                        }
                                    @endphp
                                    <td tabindex="0" class="truncate-cell">{!! implode('<br>',$distributionNotes)  !!}</td>
                                </tr>
                            @endunless
                        @endforeach
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
