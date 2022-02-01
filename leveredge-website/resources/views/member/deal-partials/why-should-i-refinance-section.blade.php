<div class="jumbotron my-0 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-5">
                <h3 class="mt-5 h3-class text-right" style="color:#3F3356;">
                    Why should I refinance my student loans?
                </h3>
                <img src="{{ asset('img/loans-offered.png') }}" class="img-fluid pl-5">
            </div>
            <div class="col-12 col-lg-7 text-center text-lg-left">
                <div class="faq-half mt-5">

                    @foreach($reasons as $reason)
                        <div class="inner-content">
                            <div class="question">
                                {{ $reason['question'] }}
                                <span class="icon"></span>
                            </div>
                            <div class="answer">
                                <p class="small-text">
                                    {!! $reason['answer'] !!}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    @php
                        if(!isset($termsUrl)){
                            $termsUrl = '/leveredge-rewards/terms';
                        }
                    @endphp
                </div>
            </div>
        </div>
    </div>
</div>
