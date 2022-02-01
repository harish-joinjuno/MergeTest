@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->first_name }}, did you know the average grad student graduates with more than <strong>$70,000 in debt?</strong>
    </p>

    <p>
        It’s a tough way to start out, but together we can do something about it.
        Making your education more affordable is why we do what we do.
    </p>

    <p>
        <strong>Our advice? Keep your options open</strong>
    </p>

    <p>
        Join Juno to make sure you hear about our negotiated loan options as they become available.
        It takes less than one minute and is completely free. The larger the group, the more power we have to negotiate lower rates
    </p>

    <p>
        <strong>After that, pick the option that makes the most sense for you</strong>
    </p>

    <p>
        When it comes time to apply for your loan, consider all the options available to you. Compare federal loans as well as
        several private loan options to make sure you’re getting yourself the best rate. By joining Juno, you’ll get access
        to the tools you need to understand and compare your options. You owe it to your future self!
    </p>

    @component('mail::button', ['url' => addUtmCodes(url('/register'), $marketingEmail) ])
        Sign Up
    @endcomponent

    <p>
        Don’t leave money on the table. What’s in your best interest is in our best interest.
    </p>

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>
    <p>
        P.S. If you’ve already graduated, Juno is still for you! <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">Sign up now</a> to learn how we can help you refinance your
        existing loans.
    </p>

@endsection
