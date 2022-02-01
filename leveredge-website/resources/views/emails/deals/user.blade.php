@component('mail::message')
Hi {{ $user->first_name }},

We noticed that you were interested in one of the student loan deals we have negotiated.
I hope you were able to submit your application without any hiccups.

Our deals are exclusively for Juno Members. However, the email address you provided wasn't one we had on
file as belonging to a Juno Member.

I have started setting up your account. Please <a href="{{ route('password.request') }}">reset your password</a>.
Once you have reset your password, you can login, update your profile and access all the deals Juno has negotiated.

@component('mail::button', ['url' => route('password.request')])
Reset Your Password
@endcomponent

Thanks,
Nikhil

{{ config('app.name') }}
@endcomponent
