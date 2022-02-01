@extends('emails.marketing-email-templates.marketing-email', ['email' => $marketingEmail->email_address])

@section('content')
    <p>
        Hi {{ $marketingEmail->first_name }},
    </p>
    <p>
        I'm a student at Harvard Business School and founder of Juno, an exclusive collective bargaining
        group for student loans.
    </p>
    <p>
        We are not a lender. Instead, we use group buying power to negotiate student loan refinancing discounts for
        graduates of top JD, MBA, and Medical programs.
    </p>
    <p>
        As a graduate of GW Law, I hope you find our service useful. If not, I’d love any feedback you might have.
    </p>
    <p>
        How it works:
    </p>
    <p>
        1. We gather interest from top graduating students and alumni seeking to refinance student loans until May 15.<br />
        2. Next, we pitch that portfolio to banks, and get them to compete on rates.<br />
        3. Finally, we select one lender who offers the lowest rates to our members and send you a link.<br />
    </p>
    <p>
        Over the past year, we've grown our group to 10,000+ members from Harvard, Stanford, Berkeley, Chicago, and
        more, almost entirely through word-of-mouth. You can read more in <a href="https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html">this Boston Globe article</a> or in the <a href="https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000">Wall
            Street Journal</a>.
    </p>
    <p>
        If you have student loans that you’d like to refinance, I’d like to invite you to <a href="https://joinjuno.com/refinance-campaign?utm_source=email&utm_medium=internal_email&utm_campaign=liscrape&utm_term=full_pitch_v1&utm_content=post_jd_debt_subj">join the group</a> to get access
        to the next deal we negotiate. Signing up is free and non-binding.
    </p>
    <p>
        We hope you find this email useful and welcome any feedback.
    </p>
    <p>
        Best,<br />
        Nikhil & Chris <br />
        Founders, Juno
    </p>
@endsection
