@component('mail::message')
# You were referred by {{ $referrer_name }}

Hi {{ $new_member_name }},<br><br>

Welcome to Juno! <br><br>

Good news! You were referred by a friend, which qualifies you for a $25 reward if you end up using the negotiated deal. <br><br>

Our <a href="{{ url('/dashboard/' . $new_member_code) }}">referral program</a> will reward both you and your friend.<br><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
