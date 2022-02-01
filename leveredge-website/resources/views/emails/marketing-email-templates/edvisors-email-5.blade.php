@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->first_name }}, the last thing you want to do during school is overpay for your education.
    </p>

    <p>
        Sure, you can probably get federal loans — but there’s a less expensive way to fund school. Federal loans charge high
        interest rates, origination fees and provide limited benefits for students who have good incomes after college.
    </p>

    <p>
        Instead, you can join Juno. We’ll unite thousands of students like you & negotiate the best interest rates with lenders.
        You’ll get the option of a student loan with an interest rate that you could never negotiate on your own. <strong>Trust us, we’re
            students too and we’ve checked.</strong> It’s why we got started in the first place.
    </p>

    <p>
        You can compare this to any other alternatives since joining Juno is free and you aren’t obligated to take the loan we negotiate.
    </p>

    <p>
        {{ $marketingEmail->first_name }}, if you want to avoid overpaying for your education, <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up now for Juno!</a>
    </p>

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>

    <p>
        P.S. {{ $marketingEmail->first_name }}, we’ve reached out a few times and <strong>we noticed you haven’t signed up yet</strong>. That's okay,
        no one wants to think about student loans all the time which is why we're here to help! Do you have questions we can answer?
    </p>

@endsection
