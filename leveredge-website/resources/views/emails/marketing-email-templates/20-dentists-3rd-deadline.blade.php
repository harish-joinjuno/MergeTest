@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        Hey {{ $marketingEmail->first_name }},
    </p>
    <p>
        We’re so close to finalizing a deal for our members! When your colleagues add their names to our list, they’ll
        be the first to access our negotiations and learn about all of their options.
    </p>
    <p>
        There’s <strong>no cost nor commitment</strong> when you <a href="{{ addUtmCodes(url('/'), $marketingEmail) }}">join us now</a>, so don’t wait.
    </p>
    <p>
        Let’s stand together in the fight against student loan debt, and show the world the power of collective bargaining.
    </p>
    <p>
        Thanks for your support,
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
