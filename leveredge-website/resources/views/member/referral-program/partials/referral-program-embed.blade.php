@if(\View::exists('member.referral-program.partials.' . $referralProgramUser->referralProgram->slug))
    @include('member.referral-program.partials.' . $referralProgramUser->referralProgram->slug, compact('referralProgramUser'))
@else
    @include('member.referral-program.partials.default-referral-program', compact('referralProgramUser'))
@endif
@include('member.referral-program.partials.referral-link-and-share-buttons')
