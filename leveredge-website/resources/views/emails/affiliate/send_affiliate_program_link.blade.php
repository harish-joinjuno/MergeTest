@component('mail::message')
# Juno Referral Program

Hi {{$name}},<br><br>

Click on the button below to track your rewards and see the details of the Juno Referral Program.

@component('mail::button', ['url' => 'https://joinjuno.com/dashboard/'.$code])
View Referral Program
@endcomponent

If the button doesn't work, you can copy and paste this link in your browser: https://joinjuno.com/dashboard/{{ $code }}<br><br>

Thanks,<br>
Juno
@endcomponent
