<div id="scholarship-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {{--<div class="modal-header">--}}
            {{--<h5 class="modal-title">Modal title</h5>--}}
            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
            {{--<span aria-hidden="true">&times;</span>--}}
            {{--</button>--}}
            {{--</div>--}}
            <div class="modal-body">
                <div class="text-center">
                    <img class="img-fluid mt-2" src="{{ url('/img/scholarship-image.jpg') }}">
                    <h2 class="mt-3"><span class="green-color">Win $5K</span> to help pay for grad school</h2>
                    <h3 class="mt-2">Alumni, Current, and Incoming students are all eligible.</h3>
                    <p class="mt-3">
                        One winner will be selected at random from the program with the highest participation*.
                    </p>
                    <p>
                        Does your school have what it takes to win?
                    </p>
                    <a href="{{ url('/scholarship-2019') }}" class="btn btn-primary mt-4">ENTER TO WIN</a>
                    <br>
                    <button type="button" class="btn btn-link text-grey" data-dismiss="modal">No, I don't like free money</button>
                    <div class="mt-4">
                        <small>
                            *Participation is defined as number of entrants from a program divided by total enrollment at the program. Alumni are eligible too!
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{--@push('footer-scripts')--}}
    {{--<script>--}}
        {{--$(document).ready(--}}
            {{--setTimeout(--}}
                {{--function()--}}
                {{--{--}}
                    {{--$('#scholarship-modal').modal()--}}
                {{--}, 3000)--}}
        {{--);--}}
    {{--</script>--}}
{{--@endpush--}}

