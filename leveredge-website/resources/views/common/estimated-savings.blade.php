<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="section-title text-left">Estimated Savings</h1>
            <h2 class="section-intro text-left">The more students that sign up,the more bargaining power we have to negotiate lower rates and bring them to you!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-left">
            {{--<p>It is difficult to estimate the savings we can achieve, but it is easy to see it adds up quickly.</p>--}}
            <p class="estimate-text">Consider the savings participating in a negotiation group could bring if you are currently getting a 10 year loan of $100,000 at a 3.5% fixed interest rate by yourself.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Interest Rate Reduction</th>
                    <th scope="col">Savings over Loan Term</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>0.1%</td>
                    <td>$268</td>
                </tr>
                <tr>
                    <td>0.5%</td>
                    <td>$1,338</td>
                </tr>
                <tr>
                    <td>1%</td>
                    <td>$2,666</td>
                </tr>
                <tr>
                    <td>1.5%</td>
                    <td>$3,983</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Get Started Button -->
    @if(isset($call_to_action_link) && isset($call_to_action_text))
        <div class="row pt-10">
            <div class="col-lg-12 text-center get-started-button">
                <a href="{{ $call_to_action_link }}" class="btn btn-primary btn-lg">{{ $call_to_action_text }}</a>
            </div>
        </div>
    @endif

</div>
