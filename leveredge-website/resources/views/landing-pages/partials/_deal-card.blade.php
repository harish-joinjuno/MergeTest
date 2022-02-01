<div class="col-12 col-sm-4 mb-5 slide-fade-in">
    <div class="bg-white border shadow px-5 py-4 h-100" style="border-radius:15px;">
        <img src="{{ $img }}" class="mb-2" style="max-width:100px;">
        <h4 class="text-primary mb-3">{{ $title }}</h4>
        <ul class="list-unstyled mb-4 small" style="min-height:100px;">
            @foreach($checklistItems as $checklistItem)
                <li class="mb-2">
                    <svg
                        aria-hidden="true"
                        focusable="false"
                        role="img"
                        height="15"
                        width="15"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        class="text-primary mr-2"
                    >
                        <path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206
                    0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997
                    26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998
                    9.997-26.207 9.997-36.204-.001z" class=""></path>
                    </svg>
                    {!! $checklistItem !!}
                </li>
            @endforeach
        </ul>
        <a href="{{ url('/register') }}" class="btn btn-secondary btn-block rounded-pill mb-3 py-3">
            Access the Deal
        </a>
        <a href="{{ $learnMoreUrl }}" class="text-center d-block">
            Learn More
        </a>
    </div>
</div>
