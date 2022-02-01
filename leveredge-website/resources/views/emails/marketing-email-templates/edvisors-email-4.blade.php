@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->first_name }}, as you fund your education, <strong>you have two choices…</strong>
    </p>

    <p>
        You can go it alone, taking the federal loans or applying for some private student loans on your own. They’ll be happy to
        give you a loan — and charge thousands in fees and interest rates.
    </p>

    <p>
        Or, you can <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up for Juno </a>. We unite students and negotiate for them, using group buying power to make lenders
        offer their lowest rates and save you thousands.
    </p>

    <p>
        <strong>You don’t have to go it alone.</strong>
    </p>

    <p>
        {{ $marketingEmail->first_name }}, you can join us by <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">signing up for Juno now!</a> Signing up is
        free and takes less than 1 minute.
    </p>

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>

@endsection
