@push('header-scripts')
    <style>
        .partnerships-banner {
            z-index:-1;
            margin-top:-5px;
        }
        .partnerships-banner p {
            font-size:12px;
        }
        .img-box {
            position:relative;
            height:0;
            padding-bottom:50%;
        }
        .img-box img {
            position:absolute;
            bottom:20px;
            left:50%;
            transform:translateX(-50%);
            height:auto;
            max-width:100%;
        }
        .bg-light-green {
            background:linear-gradient(0deg,#EDF6F5,#EDF6F5),linear-gradient(180deg,#f3f4ed,#fff 50%);
        }
    </style>
@endpush

<div class="container-fluid partnerships-banner bg-light-green {{ !empty($pushPartnersUp) ? 'mt-n3 mt-md-n5' : '' }} py-5">
    <div class="container px-0">
        @if(empty($hideFormerlyText))
            <h6 class="text-center my-3">~Formerly known as LeverEdge~</h6>
        @endif
        <div class="row">
            <a
                href="https://techcrunch.com/2020/05/27/leveredge-wants-to-get-you-and-your-friends-a-volume-discount-on-student-loans/"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/tc.png') }}">
                </div>
                <p class="font-small text-muted">
                    “Taking that one-off experience and systemizing it for more students in more contexts.”
                </p>
            </a>
            <a
                href="https://www.wsj.com/articles/m-b-a-students-have-billions-in-federal-loans-data-show-11564830000"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/wall-street-journal-bg-light.png') }}">
                </div>
                <p class="font-small text-muted">
                    “Saving each student around $8,300 on their combined $25 million debt”
                </p>
            </a>
            <a
                href="https://www.bostonglobe.com/business/2019/02/22/taking-group-approach-lowering-cost-college-loans/IPSLWEhI7QjVixlmk9pAxK/story.html"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/boston-globe-logo-light.png') }}">
                </div>
                <p class="font-small text-muted">
                    “From the bank’s perspective, [it’s] a more efficient way to attract new customers”
                </p>
            </a>
            <a
                href="https://poetsandquants.com/2019/03/01/these-hbs-1st-years-made-mba-loan-collective-bargaining-a-reality/"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2 d-none d-md-block"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/poets-and-quants-logo-bg-light.png') }}">

                </div>
                <p class="font-small text-muted">
                    “Two HBS admits took a look at interest rates... Then they got organized.
                </p>
            </a>
            <a
                href="https://abovethelaw.com/2020/09/a-little-leveredge-can-save-you-thousands-on-your-student-loans/"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2 d-none d-md-block"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/above-the-law-horizontal.png') }}">
                </div>
                <p class="font-small text-muted">
                    “Together, students can force lenders to compete”
                </p>
            </a>
            <a
                href="https://money.yahoo.com/leveredge-student-debt-undergrads-220143047.html"
                target="_blank"
                rel="noopener noreferrer"
                class="col-6 col-md-4 col-lg-2"
            >
                <div class="img-box">
                    <img src="{{ asset('/img/press-logo/yahoo-finance.png') }}">
                </div>
                <p class="font-small text-muted">
                    “Anything that empowers students during the borrowing process is a positive development”
                </p>
            </a>
        </div>
    </div>
</div>
