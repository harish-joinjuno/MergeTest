<h3 style="color: black">User</h3>
<ul>
    <li>
        <a href="{{url('/nova/resources/users/' . $user->id . '')}}">{{$user->name}}</a>
    </li>
</ul>
@if($user->accessTheDeals->count())
    <h3 style="color: black">Access The Deals</h3>
    <ul>
        @foreach($user->accessTheDeals as $accessTheDeal)
            <li>
                <a href="{{url('/nova/resources/access-the-deals/' . $accessTheDeal->id . '')}}">{{ $accessTheDeal->deal->name }} - {{ $accessTheDeal->dealStatus->loan_status }}</a>
            </li>
        @endforeach
    </ul>
@endif
@if($user->rewardClaims->count())
    <h3 style="color: black">Reward Claims</h3>
    <ul>
        @foreach($user->rewardClaims as $rewardClaim)
            <li>
                <a href="{{url('/nova/resources/leveredge-reward-claims/' . $rewardClaim->id . '')}}">{{ $rewardClaim->deal->name }} - ${{ $rewardClaim->reward_amount }}</a>
            </li>
        @endforeach
    </ul>
@endif
