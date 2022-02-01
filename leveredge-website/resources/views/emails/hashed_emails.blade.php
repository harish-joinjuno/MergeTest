@component('mail::message')
Hi,

Please find attached a CSV file that contains hashed email addresses of Juno Members.

This information may only be used to calculate the percentage of Juno referrers that use the same email address on the Juno site and the Lender's site. It may NOT be used for any other purposes.

The emails were hashed using the bcrypt algorithm. For the exact implementation, you can refer to <a href="https://laravel.com/docs/7.x/hashing">https://laravel.com/docs/7.x/hashing</a>.

For your testing purposes, you can be assured that the hash of "exists@joinjuno.com" is in the list and "does.not.exist@joinjuno.com" is not in the list.

You may contact nikhil@joinjuno.com if you need any help.

Best,

Nikhil
@endcomponent
