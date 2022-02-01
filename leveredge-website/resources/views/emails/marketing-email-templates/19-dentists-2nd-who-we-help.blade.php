@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        Hey {{ $marketingEmail->first_name }},
    </p>
    <p>
        Now that interest rates are falling, now is the perfect time to see if you’re eligible to reduce your debt.
        Would you mind sharing this email with your dental team so that we can help as many as possible?
    </p>
    <p>
        We’ve already saved students and alumni across the nation $40M on their student loan debt (for free!).
        Using collective bargaining, we negotiate with lenders to reduce interest and fees for our members.
    </p>
    <p>
        Right now, we’re able to help the following groups at no cost:
    </p>
    <p>
        <strong>1. People who are about to graduate, or have recently graduated, and have student loans.</strong><br />
        Now that they’re deemed ‘less risky’ by lenders, they can <a href="{{ addUtmCodes(url('/refinance-campaign'), $marketingEmail) }}">reduce total debt by refinancing.</a>
    </p>
    <p>
        <strong>2. People going to grad school and need help paying for it.</strong><br />
        Federal loans, since they’re unsubsidized for this group, are usually more expensive than <a href="{{ addUtmCodes(url('/'), $marketingEmail) }}">what we negotiate.</a>
    </p>
    <p>
        <strong>3. Families who have hit the federal lending cap for undergraduate loans.</strong><br />
        Parent PLUS loans are usually much higher than <a href="{{ addUtmCodes(url('/'), $marketingEmail) }}">what we negotiate for our members.</a>
    </p>
    <p>
        Let me know if you’re curious about learning more and I’d be happy to connect!
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
