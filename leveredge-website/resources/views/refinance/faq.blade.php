@extends('template.public')

@section('content')

    <div class="jumbotron bg-transparent mt-0 mb-0 pb-0 pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="section-title">Frequent Questions</h1>
                    <h2 class="section-intro">Find Answers to Frequently Asked Questions or Reach out to Us</h2>
                </div>
            </div>

            <h3 class="question">What happens to my loans / obligation if my classmates default?</h3>
            <p class="answer">Nothing! While we negotiate as a group to reduce the interest rate the entire group receives, the default of your classmates has no bearing on your loan. If your classmates default on their payments, the lender cannot seek anything additional from you. You are not cosigning for your classmates. You are not agreeing to share the risk of lending to your classmates.</p>

            <h3 class="question"></h3>

        </div>
    </div>

    <div class="jumbotron bg-cream mt-0 mb-0 pb-0 pt-0">
    @include('common.contact-us')
    </div>

@endsection
