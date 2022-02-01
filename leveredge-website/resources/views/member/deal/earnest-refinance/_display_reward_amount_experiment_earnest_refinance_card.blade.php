@if($negotiationGroupUser->user->profile->hasZipCodeInMichiganOrMass())
    @include('member.deal.earnest-refinance.other_state_reward')
@else
    @include('member.deal.earnest-refinance._display_reward_amount_experiment_normal_reward')
@endif
