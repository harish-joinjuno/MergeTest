<div class="jumbotron my-0 @if(isset($useWhiteBackground) && $useWhiteBackground) bg-white @else bg-translucent-green @endif">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-6">
                <img src="{{ asset('img/coins-in-vault.png') }}" class="img-fluid" style="max-height: 600px;">
            </div>
            <div class="col-12 col-lg-6 text-center text-lg-left">
                <div class="title mt-4">
                    <h4>Juno Rewards</h4>
                </div>
                <h3 class="mt-5 primary h3-class">
                    {{ $rewardText }}<sup class="foot-note-marker">&#8224;</sup>
                </h3>

                <div class="faq-half mt-5">

                    <div class="inner-content">
                        <div class="question">
                            What are Juno Rewards?
                            <span class="icon"></span>
                        </div>
                        <div class="answer">
                            <p>
                                Most partners who work with us pass along a referral fee when you take a loan.
                                Rather keep all of that to ourselves, we’re giving you a bonus using those funds.
                                This is separate from our existing referral bonuses and any additional discounts
                                we’ve negotiated.
                            </p>
                        </div>
                    </div>

                    <div class="inner-content">
                        <div class="question">
                            How are the rewards calculated?
                            <span class="icon"></span>
                        </div>
                        <div class="answer">
                            <p>
                                {{ $rewardsCalculated }}
                            </p>
                        </div>
                    </div>

                    <div class="inner-content">
                        <div class="question">
                            When will I receive Juno rewards?
                            <span class="icon"></span>
                        </div>
                        <div class="answer">
                            <p>
                                You’ll receive your Juno Reward once the partner confirms that Juno
                                will be paid for referring you to them. Typically, this happens a few days after
                                when the loan amount gets sent by the lender to the school. The exact date should
                                be in your final loan documents.
                            </p>
                        </div>
                    </div>

                    @php
                        if(!isset($termsUrl)){
                            $termsUrl = '/leveredge-rewards/terms';
                        }
                    @endphp
                    <div class="inner-content">
                        <div class="question">
                            <a href="{{ url($termsUrl) }}">You can find all the details here.</a>
                        </div>

                        <a href="{{ url('/2020rewardsprogram') }}" class="btn btn-primary">
                            Request Your Reward
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-disclaimers')
<p class="text-footer-disclaimer">
    &#8224; - Juno Rewards are payable after Juno receives a referral fee for referring you to one of our
    partners and is contingent on our partner paying us the fee. The exact timing can differ depending on the
    partner. It is typically in the month subsequent to the month in which your loan is disbursed. The reward will
    be sent to you via Digital Check or Amazon Gift Card based on your preference. Any additional bonus from our
    partners will be credited separately.
</p>
@endpush
