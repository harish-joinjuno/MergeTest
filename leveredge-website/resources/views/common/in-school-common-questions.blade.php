<div class="container" id="common-questions">
    <div class="row">
        <div class="col-md-12">
            <h2>Frequently Asked Questions</h2>
            <div class="separator"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div id="accordion">

                @include('common.common-questions-card',[
                    'question_id' => 'One',
                    'question' => 'Do international students qualify for the negotiation group?',
                    'answer' => 'Yes, international students are eligible to join the negotiation group. Note that there are fewer lenders that lend to international students. As a result, our ability to negotiate with these lenders maybe limited.',
                    'show' => true
                ])

                @include('common.common-questions-card',[
                    'question_id' => 'Two',
                    'question' => 'Do you offer fixed and variable rate loans?',
                    'answer' => 'We ask lenders to offer both fixed and variable rate options. Therefore, it is likely that both options will be available to you. During our last student survey, a majority of students expressed interest in fixed rate loans. Therefore, if we are forced to choose between the two options, we will ensure that a fixed rate option is made available.',
                    'show' => false
                ])


                @include('common.common-questions-card',[
                    'question_id' => 'Three',
                    'question' => 'Do you offer 5 year and 10 year repayment terms?',
                    'answer' => 'We ask lenders to offer several repayment term options including at least a 5 year term and 10 year term. Some lenders may choose to offer additional options such as a 7 year term. Therefore, it is likely that several options will be available to you including a 5 year repayment term and 10 year repayment term.',
                    'show' => false
                ])


                @include('common.common-questions-card',[
                    'question_id' => 'Four',
                    'question' => 'How long does it take you to negotiate an offer for me?',
                    'answer' => 'The How It Works section of this web page provides guidance on when you can expect us to conclude our negotiations and share an offer with you. If we can work faster than the timeline displayed, we will do so. For example, if we reach a sufficiently large group size earlier than expected, we would engage with lenders sooner.',
                    'show' => false
                ])

                @include('common.common-questions-card',[
                    'question_id' => 'Five',
                    'question' => 'Am I a good candidate to negotiate my student loans through Juno?',
                    'answer' => "Juno aims to negotiate a loan offer that is better than anything available to you outside the group. We don't charge students any fees. Further, joining the negotiation group does not obligate you to take the loan we negotiate on your behalf. Therefore, we think it is a no-brainer for you to join the negotiation group and at least consider the offer we negotiate for you",
                    'show' => false
                ])

            </div>

        </div>
    </div>

</div>
