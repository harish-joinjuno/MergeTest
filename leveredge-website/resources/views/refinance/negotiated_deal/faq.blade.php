<div class="container">
    <div class="row">
        <div class="col-12">

            <h2 class="mb-3">Frequently Asked Questions</h2>
            <div class="separator"></div>

            <div class="mt--3">

            @include('refinance.negotiated_deal.question-card',[
                'heading' => "I have a federal loan. Is refinancing with a private loan a good option for me?",
                'body' => "While you can save money by refinancing your federal loans with a private loan, you should keep in mind that you may be giving up flexible repayment plans like Income Based Repayment and programs like public service loan forgiveness. We think Student Loan Hero does a good job of laying out the trade offs between keeping a federal loan and refinancing with a private loan. You can read their article <a href='https://studentloanhero.com/featured/should-you-refinance-your-federal-student-loans/' target='_blank'>here</a>. ",
                'id' => "one"
            ])


            @include('refinance.negotiated_deal.question-card',[
                'heading' => "What happens in case of death or total and permanent disability?",
                'body' => "In the unfortunate event of death or total and permanent disability, Earnest will discharge the student loan.",
                'id' => "two"
            ])


            @include('refinance.negotiated_deal.question-card',[
                'heading' => "What is Earnest's Forbearance policy?",
                'body' => "You can learn more about Earnest's Forbearance policy <a href=\"https://help.earnest.com/hc/en-us/articles/360024577813-How-can-I-apply-for-forbearance-Student-Loan-Refinance\" target='_blank'>here</a>.",
                'id' => "three"
            ])


            {{--@include('refinance.negotiated_deal.question-card',[--}}
                {{--'heading' => "When do I start getting the auto-pay discount?",--}}
                {{--'body' => "Need a response from Earnest. Do they get it right from the first one if they opt for it during the sign-up flow?",--}}
                {{--'id' => "four"--}}
            {{--])--}}


            {{--@include('refinance.negotiated_deal.question-card',[--}}
                {{--'heading' => "How do I know I am getting the negotiated Juno rate?",--}}
                {{--'body' => "Need a response from Earnest.",--}}
                {{--'id' => "five"--}}
            {{--])--}}


            {{--@include('refinance.negotiated_deal.question-card',[--}}
                {{--'heading' => "Why doesn't every Juno Member receive the same rate?",--}}
                {{--'body' => "Need a response from Earnest.",--}}
                {{--'id' => "six"--}}
            {{--])--}}

            {{--@include('refinance.negotiated_deal.question-card',[--}}
                {{--'heading' => "Earnest told me that I am not eligible, what should I do?",--}}
                {{--'body' => "Need a response from Earnest.",--}}
                {{--'id' => "seven"--}}
            {{--])--}}

            </div>

        </div>
    </div>
</div>
