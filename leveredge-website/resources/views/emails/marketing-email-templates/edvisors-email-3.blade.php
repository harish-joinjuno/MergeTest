@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        {{ $marketingEmail->first_name }}, you’re setting yourself up for a bright future by going to school – but don’t put yourself in a position
        where student loan debt holds you back!
    </p>

    <p>
        For too many students, excessive debt has kept them from being able to accept their dream job, travel or move to a new
        city after graduation. <strong>But it doesn’t always have to be that way.</strong>
    </p>

    <p>
        Juno uses group buying power to get lenders to compete and offer lower rates on student loans than you can get on your own.
        In fact, when you <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up for Juno</a>, you improve our ability to
        negotiate loans for all our members.
    </p>

    <p>
        In 2019, with the help of a few thousand members, we helped students get more than $250M in loans that saved them more
        than $40M compared to their federal options.
    </p>

    <p>
        The best part, there’s no obligation or cost to join Juno… just the opportunity to
        <strong>save big on your education and own your financial future.</strong>
    </p>

    <p>
        No matter how you use the money you saved, your future self will look back and be thankful you thought ahead.
    </p>

    <p>
        {{ $marketingEmail->first_name }}, <a href="{{ addUtmCodes(url('/register'), $marketingEmail) }}">sign up</a> for Juno now and help us negotiate the best
        deal yet! Still need convincing? Check us out on <a href="https://studentloanhero.com/featured/leveredge-review-collective-bargaining-student-loans/">Student Loan Hero</a>,
        the <a href="https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html">Boston Globe </a>,
        and <a href="https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000">Wall Street Journal</a>.
    </p>

    @component('mail::button', ['url' => addUtmCodes(url('/register'), $marketingEmail) ])
        Sign Up
    @endcomponent

    <p>
        Nikhil & Chris <br />
        Founders, Juno
    </p>

    <p>
        P.S. Have questions about how Juno works or how much it can reduce your debt? Reply to this email.
    </p>

@endsection
