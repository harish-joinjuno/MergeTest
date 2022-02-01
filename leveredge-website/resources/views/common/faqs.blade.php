<!-- faq start -->
<div class="faq-sec feature-sec">
    <div class="container">
        <div class="frow">
            <div class="faq-inner">
                <div class="title">
                    <h4>FAQ</h4>
                </div>
                @foreach($faqs as $faq)
                    <div class="inner-content">
                        <div class="question">
                            {{ $faq['question'] }}
                            <span class="icon"></span>
                        </div>
                        <div class="answer">
                            {!! $faq['answer'] !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- faq end -->
