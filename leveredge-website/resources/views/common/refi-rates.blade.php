
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-title text-left">Expected Rates</h1>
                <h2 class="section-intro text-left">We ask lenders to beat the rates broadly available to you.</h2>
            </div>
            <div class="col-md-12">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Fixed</th>
                        <th scope="col">Variable</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">5 Year</th>
                        <td>&lt;3.20%</td>
                        <td>&lt;2.24%</td>
                    </tr>
                    <tr>
                        <th scope="row">10 Year</th>
                        <td>&lt;3.70%</td>
                        <td>&lt;2.74%</td>
                    </tr>

                    </tbody>
                </table>

                <p>For many, the rates above seem accessible<sup>2</sup></p>
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

