@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        Hi {{ $marketingEmail->first_name }},
    </p>
    <p>
        Two years ago, my co-founder and I were accepted to HBS. We were ecstatic!
        But, we had to figure out how to pay the annual $109,300 cost of attendance.
    </p>
    <p>
        We needed student loans, so we started an initiative to negotiate bulk discounts for our classmates.
        Over the past two years, we’ve helped thousands of <a href="{{ addUtmCodes(url('/reviews'), $marketingEmail) }}">students and recent graduates</a>
        access over $100M in funding and save $40M in interest and fees.
    </p>
    <p>
        Using Juno is <strong>always free for students and alumni</strong>, and signing up doesn’t commit you to
        take a loan or refinance.
    </p>
    <p>
        If you’re interested in reducing your current debt, or know someone who might need help paying for school next semester,
        please <a href="{{ addUtmCodes(url('/'), $marketingEmail) }}">sign up today</a>. The more of you join our cause, the more bargaining power we have with lenders.
    </p>
    <p>
        Thank for your support,
    </p>
    <p>
        Chris + Nikhil
    </p>
    <p>
        P.S. Check us out in <a href="https://poetsandquants.com/2019/08/28/leveredge-helping-mba-students-reduce-loans-takes-off/?pq-category=business-school-news&pq-category-2=students">Poets & Quants</a>,
        <a href="https://www.clearadmit.com/2019/12/introducing-leveredge/">Clear Admit</a>,
        <a href="https://studentloanhero.com/featured/leveredge-review-collective-bargaining-student-loans/">Student Loan Hero</a>,
        the <a href="https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html">Boston Globe</a>,
        and <a href="https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000">Wall Street Journal</a>.
    </p>
@endsection
