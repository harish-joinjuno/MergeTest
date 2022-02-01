@component('mail::message')

# New User Created

Name: {{ $user->name }}<br>
Email: {{ $user->email }}<br>
Phone: {{ $user->profile->phone_number }}<br>
University: {{ isset($user->profile->university) ? $user->profile->university->name : "Not Specified" }}<br>
Degree: {{ isset($user->profile->degree) ? $user->profile->degree->name : "Not Specified" }}<br>
Grad Year: {{ $user->profile->graduation_year }}<br>
Joined on: {{ $user->created_at->toRfc822String() }}

@component('mail::button', ['url' => 'tel:'.$user->profile->phone_number])
Call
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

