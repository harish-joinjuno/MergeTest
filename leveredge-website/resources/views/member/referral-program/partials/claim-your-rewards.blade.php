@if($amountToBePaid > 0 || isset($otherReferralProgramUsersWithPendingRewards) && $otherReferralProgramUsersWithPendingRewards->count())
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h2>Claim Your Rewards</h2>

                <table class="table table-borderless">
                    <tr>
                        <td>
                            <p>Your Unclaimed Rewards</p>
                        </td>
                        <td>
                            <p class="float-right">${{ $amountToBePaid }}</p>
                        </td>
                    </tr>
                </table>

                <p class="mt-4">Select a Payment Method</p>

                <form class="mt-3" method="post" action="{{ url('/member/referral-program-reward-claim') }}"
                      id="payment-method-form">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $amountToBePaid }}">
                    <input type="hidden" name="referral_program_user_id" value="{{ $referralProgramUser->id }}">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method"
                               id="paymentMethod1-{{ $referralProgramUser->id }}"
                               value="{{ \App\PaymentMethod::PAYMENT_METHOD_DIGITAL_CHECK }}" {{ $amountToBePaid ? 'checked' : 'disabled' }}>
                        <label class="form-check-label" for="paymentMethod1-{{ $referralProgramUser->id }}">
                            Digital Check to {{ Auth::user()->email }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method"
                               id="paymentMethod2-{{ $referralProgramUser->id }}"
                               value="{{ \App\PaymentMethod::PAYMENT_METHOD_AMAZON_GIFT_CARD }}" {{ $amountToBePaid ? '' : 'disabled' }}>
                        <label class="form-check-label" for="paymentMethod2-{{ $referralProgramUser->id }}">
                            Amazon Gift Card to {{ Auth::user()->email }}
                        </label>
                    </div>
                    @if($referralProgramUser->referralProgram->slug == \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_SCHOLARSHIP_POT)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method"
                                   id="paymentMethod3-{{ $referralProgramUser->id }}"
                                   value="{{ \App\PaymentMethod::PAYMENT_METHOD_SCHOLARSHIP_POT }}" {{ $amountToBePaid ? '' : 'disabled' }}>
                            <label class="form-check-label" for="paymentMethod3-{{ $referralProgramUser->id }}">
                                Juno Scholarship Pot
                            </label>
                        </div>
                    @endif
                    <button type="submit"
                            class="btn btn-primary btn-sm {{$amountToBePaid ? '' : 'pointer-events-none'}} " {{ $amountToBePaid ? '' : 'disabled' }}>
                        Claim Rewards
                    </button>
                </form>
            </div>

            @if($referralProgramUser->referralProgram->slug == \App\ReferralProgram::REFERRAL_PROGRAM_SLUG_TWO_SIDE_WITH_MILESTONE_PRIZES)
                <p class="mt-5">To claim prizes, email <a href="mailto:support@joinjuno.com">support@joinjuno.com</a> with
                    your mailing address.</p>
            @endif
            @if(isset($otherReferralProgramUsersWithPendingRewards) && $otherReferralProgramUsersWithPendingRewards->count())
                @foreach($otherReferralProgramUsersWithPendingRewards as $referralProgramUser)
                    <div class="alert alert-info mt-3">
                        <p>You have unclaimed rewards from an older referral program. View details <a
                                href="{{ url('member/referral-program/' . $referralProgramUser->referralProgram->id) }}">here</a>.
                        </p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endif
