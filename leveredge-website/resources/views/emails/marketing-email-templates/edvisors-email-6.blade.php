@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->first_name }}, have you been searching for a way to spend less on your education?
    </p>

    <p>
        <strong>Here it is!</strong>
    </p>

    <p>
        No, you won’t have to live in a closet-sized room to save on rent or skip buying textbooks.
    </p>

    <p>
        <strong>Just sign up for Juno.</strong>
    </p>

    <p>
        Unlike normal loans (which are full of fees and high interest rates), we’ll negotiate a low interest rate on behalf of
        thousands of students to get you the best rate student loan options.
    </p>

    <p>
        It’s free and always will be for students, so <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up now for Juno!</a>
    </p>

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>

@endsection
