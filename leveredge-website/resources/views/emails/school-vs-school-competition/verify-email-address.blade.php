@component('mail::message')
Hi!

Please click on the button to verify your email address.

@component('mail::button', ['url' => url('competition/verify-email/' . $entrant->verification_code)])
    Verify Email Address
@endcomponent

If you did not enter the Juno Competition, no further action is required and you can ignore this email.

Cheers and best of luck,<br>
Nikhil,<br>
Co-founder, Juno
@endcomponent
