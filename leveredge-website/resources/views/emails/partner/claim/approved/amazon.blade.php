@component('mail::message')
# Congratulations!

You’ve got a reward coming your way!

@component('mail::button', ['url' => 'https://www.amazon.com/gp/css/gc/payment/view-gc-balance?claimCode=' . $payment->reference_information['claimCode']])
Click Here
@endcomponent

Thank you for partnering with us to tackle student debt,

Nick
{{ config('app.name') }}
@endcomponent
