@extends('template.public')

@section('content')

    <div class="jumbotron mt-0 mb-0 pt-0 pb-0 bg-lighter-grey">
        <div class="container">
            <div class="row">
                <div class="col-12">


                    <h4>
                        Thank you! We can't wait to get you access to the negotiated deal!
                    </h4>

                    <h4 class="mt-3">
                        If you want to skip the wait, the fastest way is to be referred by one of hundreds of recent graduates who already have access to the deal.
                    </h4>

                    <h4 class="mt-3">
                        Nikhil + Chris <br>
                        Founders of Juno
                    </h4>

                    <h4 class="mt-3">
                        ps. please spread the word to be referred :)
                    </h4>

                    <div class="card mt-5">
                        <div class="card-body">
                            "<span id="text-for-sharing">{{ 'Hey all, I’m trying to get access to the Juno + Earnest refinance loan deal. Does anyone have an access code I can use?' }}</span>"
                        </div>
                        <button class="btn btn-primary copy-button" data-clipboard-target="#text-for-sharing">Copy to Clipboard</button>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection


@push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

    <script>
        new ClipboardJS('.copy-button');
    </script>
@endpush
