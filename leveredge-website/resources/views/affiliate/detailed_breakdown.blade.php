<a data-toggle="collapse" href="#detailed-referrals" role="button" aria-expanded="false" aria-controls="detailed-referrals">
    Detailed Referral Information
</a>

<div class="collapse" id="detailed-referrals">
    <table class="table table-bordered bg-white">
        <tr>
            <td></td>
            <td></td>
            <td colspan="2">Status</td>
        </tr>

        <tr>
            <td>ID</td>
            <td>Email</td>
            <td>Student Loan</td>
            <td>Refinance</td>
        </tr>


        @foreach($affiliate->referredSubscribers as $subscriber)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ substr($subscriber->email, 0, 1)  }} ... {{ substr($subscriber->email, strlen($subscriber->email)-5 , 5)  }}
                </td>
                <td>
                    @if($subscriber->isInschoolSubscriber())
                        Signed Up
                    @endif
                </td>
                <td>
                    @if($subscriber->isRefinanceSubscriber())
                        Signed Up
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
