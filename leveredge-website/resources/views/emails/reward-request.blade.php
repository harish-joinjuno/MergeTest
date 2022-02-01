@component('mail::message')
Hi {{ $user['first_name'] }},

Thank you for requesting your Juno Rewards. You can check the status of the reward anytime.

@component('mail::button', ['url' => url('/2020rewardsprogram')])
    Check Reward Status
@endcomponent

Please note, the timing of the reward is not instant. You’ll receive the Juno Reward once the partner
confirms that Juno will be paid for referring you to them. Typically, this happens a few days after when
the loan amount gets sent by the lender to the school.

If your loan has multiple disbursements, the reward may also be split proportionally to the rewards.

Best,<br>
Chris & Nikhil<br>
Founders, {{ config('app.name') }}
@endcomponent
