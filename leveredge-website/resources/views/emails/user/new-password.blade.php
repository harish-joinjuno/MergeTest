@php
$resetLink = \Illuminate\Support\Facades\URL::temporarySignedRoute('password.new',now()->addDays(2), ['user' => $user->id])
@endphp
<p>Hi, {{ $user->name }}</p>

<p>Thanks for joining Juno!</p>

To save your progress and complete sign-up, please use this link <a href="{{ $resetLink }}">to create your password.</a>

<p>Please note that this link is valid for 48 hours.</p>

<p>
    Thanks for being here with us,<br/>
    Team Juno
</p>
