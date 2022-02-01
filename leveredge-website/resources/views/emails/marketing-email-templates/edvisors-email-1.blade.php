@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->name }}, you’re invited to <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up for Juno</a> and join us as
        we use group buying power to get lenders to offer lower interest rates on student loans. You’ll save a ton of money on
        your education with lower interest rates than you could get on your own.
    </p>

    <p>
        But don’t just take our word for it — see what <a href="https://studentloanhero.com/featured/leveredge-review-collective-bargaining-student-loans/">Student Loan Hero</a>,
        the <a href="https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html">Boston Globe </a>,
        and <a href="https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000">Wall Street Journal</a> have to say about us.
    </p>

    <p>
        There’s no cost to signing up for Juno and you don’t have to take the rate we negotiate. It’s 100% no-cost and no-risk,
        so why wouldn’t you keep your options open for a lower rate?
    </p>

@component('mail::button', ['url' => addUtmCodes(url('/register'), $marketingEmail) ])
    Sign Up
@endcomponent

    <p>
        Thanks for being here with us. You all are the reason why we do what we do.
    </p>

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>

@endsection
