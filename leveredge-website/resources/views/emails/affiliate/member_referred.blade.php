@component('mail::message')
# You Referred {{ $new_member_name }}

Hi {{ $referrer_name }},<br><br>

@if($referrer_total_referrals == 1)
Congratulations on making your first referral!<br>
Did you know 98% of our members join based on a friend's recommendation?<br>
{{ $new_member_name }} is lucky to have a friend like you!<br><br>
@else
{{ $new_member_name }} is lucky to have a friend like you!<br>
You have now referred {{ $referrer_total_referrals }} members to Juno.<br><br>
@endif

Learn more about the Juno Referral Program in your dashboard.

@component('mail::button', ['url' => 'https://joinjuno.com/dashboard/' . $referrer_code])
View Dashboard
@endcomponent

We will update you as more friends join Juno. You can <a href="{{ url('/dashboard/' . $referrer_code) }}">update your preferences</a> to receive fewer emails from us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
