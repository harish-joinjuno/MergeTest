@extends('member.referral-program.referral-program-template')

@section('content-before-referral-program-standard-sections')
    @if(!$referralProgramUser->isCurrentReferralProgram())
        <div class="container pb-0 pt-0">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        This referral program has expired. View your current referral program <a href="{{ url('/member/referral-program') }}">here</a>.
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('content-after-referral-program-standard-sections')
    @include('member.referral-program.partials.referral-program-embed')
@endsection



