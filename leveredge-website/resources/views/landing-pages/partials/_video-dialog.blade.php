@push('header-scripts')
    <style>
        .absolute-center {
            position:absolute;
            top:50%;
            left:50%;
            width:100%;
            transform:translate(-50%, -50%);
        }
        .play-button {
            cursor:pointer;
            background-color:#fff;
            width:80px;
            height:80px;
            transform:scale(1);
            transition: all .2s ease-in-out;
            color:#67B6B3;
            padding:20px 20px 20px 25px;
        }
        .play-button:hover {
            background-color:#e4e4e4;
        }
        .play-button:focus {
            box-shadow:0 0 10px #B3DAD9;
            border:2px solid #67B6B3;
            outline:none;
            transform:scale(.9);
        }
        .play-button svg {
            height:100%;
            width:100%;
        }
        .video-box {
            box-sizing:content-box;
            /*border:2px solid transparent;*/
        }
        .video-box:focus {
            box-shadow:0 0 10px #B3DAD9;
            /*border:2px solid #67B6B3;*/
            outline:none;
        }
        .video-box:focus .play-button {
            box-shadow:0 0 10px #B3DAD9;
            border:2px solid #67B6B3;
            outline:none;
            transform:scale(.9);
        }
        .widescreen {
            position:relative;
            width:100%;
            height:0;
            padding-bottom:56.25%;
        }
        .widescreen iframe {
            position:absolute;
            top:0;
            left:0;
            height:100%;
            width:100%;
        }
    </style>
@endpush

@push('footer-scripts')
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        var player;
        function onYouTubeIframeAPIReady() {
            $('#videoModal').on('show.bs.modal', function() {
                player = new YT.Player('youtube-iframe', {
                    videoId: '{{ $youtubeId ?? '' }}',
                    events: {
                        'onReady': onPlayerReady,
                    }
                });
            });
            $('#videoModal').on('hide.bs.modal', function() {
                player.destroy();
            });
        }
        function onPlayerReady(event) {
            player.playVideo();
            if (ga) {
                const trackerName = ga.getAll()[0].get('name')
                ga(trackerName + '.send', 'event', 'Videos', 'play', '{{ request()->path() }}');
            }

        }
    </script>
@endpush

<div
    class="modal fade"
    id="videoModal"
    tabindex="-1"
    aria-label="Testimonial Dialog"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body p-0">
                <div class="widescreen">
                    <div id="youtube-iframe"></div>
                </div>
            </div>
        </div>
    </div>
</div>
