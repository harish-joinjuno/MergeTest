@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyAndShareButton = document.getElementById('copyAndShare');
            const copyAndShareInput = document.getElementById('copyAndShareInput');
            const oldTitle = copyAndShareButton.title;

            copyAndShareButton.addEventListener('click', function() {
                copyAndShareInput.select();
                document.execCommand('copy');
                $(copyAndShareButton)
                    .attr('data-original-title', 'Copied to Clipboard!')
                    .tooltip('show');

                setTimeout(function() {
                    copyAndShareInput.blur();
                    $(copyAndShareButton)
                        .attr('data-original-title', oldTitle)
                        .tooltip('show');
                }, 2500);
            });
        });
    </script>
@endpush

<div class="row">
    <div class="col-6 mb-3">
        <a
            href="https://www.facebook.com/dialog/share?app_id=2142075722511834&display=popup&href={{ urlencode($shareLink) }}&quote={{ urlencode($facebookShareMessage) }}"
            target="_blank"
            rel="noopener noreferrer"
            id="facebookButton"
            class="btn btn-sm btn-block text-white px-0 share-button"
            data-share-target="Facebook"
            data-toggle="tooltip"
            data-placement="top"
            title="Share on Facebook"
            style="background-color:#445691;"
        >
            <i class="fab fa-facebook mr-1"></i>
            Facebook
        </a>
    </div>
    <div class="col-6 mb-3">
        <a
            href="https://twitter.com/intent/tweet?text={{ urlencode($twitterShareMessage) }}&url={{ urlencode($shareLink) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="btn btn-sm btn-block text-white px-0 share-button"
            data-share-target="Twitter"
            data-toggle="tooltip"
            data-placement="top"
            title="Share on Twitter"
            style="background-color:#64A6E4;"
        >
            <i class="fab fa-twitter mr-1"></i>
            Twitter
        </a>
    </div>
    {{--                                <div class="col-6 mb-3">--}}
    {{--                                    <a--}}
    {{--                                        href="https://www.facebook.com/dialog/send?app_id=2142075722511834&link={{ urlencode($shareLink) }}"--}}
    {{--                                        target="_blank"--}}
    {{--                                        rel="noopener noreferrer"--}}
    {{--                                        id="messengerButton"--}}
    {{--                                        class="btn btn-sm btn-block text-white px-0"--}}
    {{--                                        data-toggle="tooltip"--}}
    {{--                                        data-placement="top"--}}
    {{--                                        title="Share on Messenger"--}}
    {{--                                        style="background-color:#01A6FF;"--}}
    {{--                                    >--}}
    {{--                                        <i class="fab fa-facebook-messenger mr-1"></i>--}}
    {{--                                        Messenger--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    <div class="col-6 mb-3">
        <button
            id="copyAndShare"
            class="btn btn-sm btn-block text-white px-0 share-button"
            style="background-color:#3F3356;"
            data-share-target="Copy"
            data-toggle="tooltip"
            data-placement="top"
            title="Copy the URL"
        >
            <i class="fas fa-copy mr-1"></i>
            Copy &amp; Share
        </button>

        <input
            aria-hidden="true"
            class="form-control"
            id="copyAndShareInput"
            type="text"
            value="{{ $shareLink }}"
            style="position:absolute;top:-9999%;left:-9999%;"
            readonly
        >
    </div>
</div>
