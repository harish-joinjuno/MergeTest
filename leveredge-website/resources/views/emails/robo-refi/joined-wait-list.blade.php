@component('mail::message')
Hi there,

Thank you! You've been added to the wait list. 🎉

You can check your spot in the Socially Powered waitlist any time by clicking <a href="{{ $roboRefiUser->success_link . "?utm_source=email" }}">here</a>.

Let us know if you have any questions!

Best,<br>
Chris & Nikhil<br>
Co-founders, {{ config('app.name') }}
@endcomponent
