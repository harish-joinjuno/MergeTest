<style>
    .container.narrow {
        max-width:800px;
    }
    .container.ultra-narrow {
        max-width:640px;
    }
    .banner {
        background-image:url({{ asset($headingBackgroundImage ?? '/assets/images/green-balloon-background.png') }});
        background-repeat:no-repeat;
        background-size:contain;
        background-position:95% 100%;
        padding-bottom:150px;
        position:relative;
        z-index:1;
    }
    p {
        font-weight:400;
    }
    .font-semibold {
        font-weight:500;
    }
    .text-box {
        display:inline-block;
        position:relative;
    }
    .text-box input,
    .text-box button {
        border:none;
        height:50px;
        border-radius:25px;
        display:inline;
        width:100%;
        outline:none;
        font-weight:600;
    }
    .text-box .input-group-append {
        display:inline;
        position:absolute;
        right:0;
        top:0;
        bottom:0;
        float:right;
        width:40%;
    }
    .square {
        position:relative;
        height:0;
        padding-bottom:100%;
    }
    .square img {
        position:absolute;
        top:50%;
        top:50%;
        left:50%;
        transform:translate(-50%, -50%);
        height:auto;
        max-width:100%;
    }
    .bg-light-green {
        background:linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
    }
    h4 {
        font-family:'CooperMediumBT', serif;
        position:relative;
    }
    h4.underlined:after {
        content:'';
        position:absolute;
        left:50%;
        bottom:-5px;
        width:50px;
        margin-left:-25px;
        border-bottom:3px solid #3F3356;
    }
    .faq {
        box-shadow:0 2px 5px rgba(0,0,0,.1);
        border-radius:10px;
    }
    a.rates-button {
        border-radius:21px;
        font-size:16px;
    }
    .ld-dropdown {
        outline:none;
        cursor:pointer;
        position:relative;
    }
    .ld-dropdown .dropdown-trigger {
        position:relative;
    }
    .ld-dropdown .dropdown-trigger p {
        font-weight:600;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    .ld-dropdown .icon {
        position:absolute;
        right:1em;
        top:50%;
        height:16px;
        width:16px;
        pointer-events:none;
        transform:translateY(-50%);
    }
    .ld-dropdown .icon,
    .ld-dropdown .dropdown-trigger {
        pointer-events:none;
        outline:none;
    }
    .ld-dropdown .icon:before,
    .ld-dropdown .icon:after {
        content: '';
        position:absolute;
        top:50%;
        left:50%;
        background-color:#2F706B;
        transform:translate(-50%, -50%);
        transition:all .4s;
        border-radius:2px;
    }
    .ld-dropdown .icon:before {
        height:100%;
        width:3px;
    }
    .ld-dropdown .icon:after {
        height:3px;
        width:100%;
    }
    .ld-dropdown:focus .icon,
    .ld-dropdown:focus .dropdown-trigger {
        pointer-events:auto;
    }
    .ld-dropdown:focus .icon:before,
    .ld-dropdown:focus .icon:after,
    .ld-dropdown .dropdown-content:focus-within ~ .icon:before,
    .ld-dropdown .dropdown-content:focus-within ~ .icon:after {
        transform:translate(-50%, -50%) rotate(-90deg);
    }
    .ld-dropdown:focus .icon:after,
    .ld-dropdown .dropdown-content:focus-within .icon:after {
        opacity:0;
    }
    .ld-dropdown .dropdown-content {
        opacity:0;
        max-height:0;
        transition:all .4s linear;
        cursor: text;
        overflow:hidden;
    }
    .ld-dropdown:focus .dropdown-content,
    .ld-dropdown .dropdown-content:focus-within {
        opacity:1;
        max-height:500px;
        padding:20px;
    }
    .divider {
        margin:3rem auto;
        height:5px;
        width:150px;
        background-color:#ECF3F3;
    }
    .bg-dark-green {
        background:#B3DAD9;
    }
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
    .video-box > iframe {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
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
    .custom-header {
        font-size:3em;
    }
    .home-header-image {
        margin-top:-5em;
        margin-bottom:-8em;
    }
    .home-checklist li {
        display:inline-block;
    }
    .green-underline:after {
        content: '';
        width:100%;
        margin-top:10px;
        height:4px;
        display:block;
        background:#B3DAD9;
    }
    @media screen and (max-width:768px) {
        h1 {
            font-size:32px;
        }
        .banner {
            padding-bottom:300px;
        }
        .text-box .input-group-append {
            font-size:.75em;
        }
        .home-header-image {
            margin-top:-250px;
            margin-bottom:-6em;
        }
        .home-checklist li {
            display:block;
        }
        .custom-header {
            font-size:2em;
        }
        .green-underline:after {
            margin-left:-15px;
            margin-right:-15px;
            width:100vw;
        }
    }

    .fade-in {
        transform-origin:top center;
        animation-name:fadeIn;
        animation-iteration-count:1;
        animation-duration:.5s;
    }

    .slide-fade-in {
        animation-duration:1s;
        animation-iteration-count:1;
        opacity:0;
    }

    .slide-fade-in.active {
        animation-name:slideFadeIn;
        opacity:1;
    }

    .flashing-button {
        position:relative;
    }

    .flashing-button:after {
        content: '';
        position:absolute;
        border-radius:50rem;
        top:0;
        left:0;
        bottom:0;
        right:0;
        box-shadow: 0 0 2px rgba(0,0,0,.5);
        animation-name:flashingShadow;
        animation-duration:2.5s;
        animation-iteration-count: infinite;
    }

    .number-background {
        position:relative;
    }
    .number-background:before {
        position: absolute;
        top: 0;
        left:0;
        font-family:sans-serif;
        font-size:72px;
        line-height:1em;
        font-weight:900;
        transform:translate(-50%, -40%);
        z-index:0;
        opacity:.1;
    }

    .number-background:before {
        content: attr(data-number);
    }

    @keyframes flashingShadow {
        0% {
            box-shadow: 0 0 4px rgba(39, 141, 135, .8);
        }

        50% {
            box-shadow: 0 0 8px rgba(39, 141, 135, .8);
        }

        100% {
            box-shadow: 0 0 4px rgba(39, 141, 135, .8);
        }
    }

    @keyframes slideFadeIn {
        from {
            opacity:0;
            transform:translateY(200px);
        }
        to {
            opacity:1;
            transform:translateY(0);
        }
    }
    @keyframes fadeIn {
        from {
            opacity:0;
            transform:scale(.95);
        }
        to {
            opacity:1;
            transform:scale(1);
        }
    }
</style>
