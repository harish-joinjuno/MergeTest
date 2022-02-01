@component('mail::message')
# Complete Guide to Student Loans for Business School

You can click on the button below to download the file.

@component('mail::button', ['url' => url('complete-guide-to-student-loans-for-business-school/download')])
Download Guide
@endcomponent

If that doesn't work, you can copy and paste this link in your browser: <a href="{{ url('complete-guide-to-student-loans-for-business-school/download') }}">{{ url('complete-guide-to-student-loans-for-business-school/download') }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
